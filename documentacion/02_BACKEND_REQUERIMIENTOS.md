# Backend y Gestión de Requerimientos

## Descripción general

El backend de MesaTI Municipal fue desarrollado con Laravel aplicando el patrón MVC para separar las responsabilidades del sistema.

En EVA2 la aplicación trabajaba con MySQL de forma local. Para EVA3, el sistema fue actualizado para utilizar PostgreSQL remoto mediante Supabase.

El backend permite:

- Autenticar usuarios.
- Diferenciar permisos según rol.
- Registrar requerimientos.
- Consultar información.
- Asignar prioridad.
- Derivar solicitudes a técnicos.
- Gestionar la atención técnica.
- Actualizar estados.
- Registrar información para el funcionario.
- Generar notificaciones internas.
- Eliminar requerimientos.
- Trabajar con datos almacenados remotamente en Supabase.

---

## Patrón MVC aplicado

Laravel utiliza el patrón Modelo, Vista y Controlador.

En MesaTI se aplica de la siguiente manera:

- **Modelo:** representa las tablas de la base de datos mediante Eloquent ORM.
- **Vista:** muestra la información al usuario mediante archivos Blade.
- **Controlador:** procesa solicitudes, valida datos y ejecuta las operaciones.
- **Ruta:** conecta una URL y un método HTTP con una función del controlador.
- **Base de datos:** almacena usuarios, requerimientos y notificaciones.

Flujo general actual:

```text
Navegador
    ↓
Ruta
    ↓
Controlador
    ↓
Modelo Eloquent
    ↓
PostgreSQL
    ↓
Supabase Cloud
    ↓
Vista Blade
    ↓
Usuario
```

---

## Modelos principales

El sistema utiliza los siguientes modelos:

```text
app/Models/User.php
app/Models/Requerimiento.php
app/Models/Notificacion.php
```

### Modelo User

El modelo `User` representa la tabla `users`.

Campos principales:

```text
name
email
password
rol
```

Los roles utilizados actualmente son:

```text
funcionario
administrador
tecnico
```

El modelo mantiene relaciones con requerimientos y notificaciones.

Ejemplos:

```php
public function requerimientos()
{
    return $this->hasMany(Requerimiento::class);
}

public function notificaciones()
{
    return $this->hasMany(Notificacion::class);
}
```

---

## Modelo Requerimiento

El modelo `Requerimiento` representa la tabla `requerimientos`.

Además de los datos originales de la solicitud, actualmente contiene información de clasificación, derivación y gestión técnica.

Campos principales:

```text
user_id
categoria
titulo
descripcion
prioridad
estado
respuesta_admin
fecha_cierre
tecnico_id
asignado_por_id
fecha_asignacion
tarea_asignada
avance_tecnico
requiere_materiales
materiales_requeridos
tiempo_estimado
```

Relaciones principales:

```text
usuario
tecnico
asignadoPor
notificaciones
```

Ejemplo conceptual:

```php
public function usuario()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function tecnico()
{
    return $this->belongsTo(User::class, 'tecnico_id');
}

public function asignadoPor()
{
    return $this->belongsTo(User::class, 'asignado_por_id');
}

public function notificaciones()
{
    return $this->hasMany(Notificacion::class);
}
```

---

## Modelo Notificacion

El modelo `Notificacion` representa la tabla `notificaciones`.

Permite registrar avisos para funcionarios, administradores y técnicos.

Campos principales:

```text
user_id
requerimiento_id
titulo
mensaje
leida
fecha_leida
```

Cada notificación pertenece a un usuario y puede estar relacionada con un requerimiento.

---

## Relaciones Eloquent

Las relaciones principales del sistema son:

```text
Usuario → tiene muchos requerimientos
Usuario → tiene muchas notificaciones

Requerimiento → pertenece al funcionario que lo creó
Requerimiento → puede pertenecer a un técnico asignado
Requerimiento → puede registrar al administrador que realizó la asignación
Requerimiento → tiene muchas notificaciones

Notificación → pertenece a un usuario
Notificación → pertenece a un requerimiento
```

Para estas relaciones se utilizan métodos como:

```php
hasMany()
belongsTo()
```

---

## Relaciones mediante claves foráneas

Las relaciones principales de la base de datos son:

```text
requerimientos.user_id
        ↓
users.id
Funcionario que creó la solicitud

requerimientos.tecnico_id
        ↓
users.id
Técnico responsable

requerimientos.asignado_por_id
        ↓
users.id
Administrador que realizó la derivación

notificaciones.user_id
        ↓
users.id
Usuario destinatario

notificaciones.requerimiento_id
        ↓
requerimientos.id
Solicitud relacionada
```

Estas relaciones ayudan a mantener la integridad de los datos.

---

## Evolución de la base de datos

La estructura del sistema fue creciendo mediante migraciones de Laravel.

### Primera etapa

Inicialmente se utilizaron:

```text
users
requerimientos
```

### Incorporación de roles

Se agregó el campo:

```text
rol
```

a la tabla `users`.

Esto permitió separar los permisos de:

```text
funcionario
administrador
```

Posteriormente se incorporó también:

```text
tecnico
```

### Incorporación de notificaciones

Se creó la tabla:

```text
notificaciones
```

relacionada con usuarios y requerimientos.

### Derivación a técnicos

Posteriormente la tabla `requerimientos` incorporó:

```text
tecnico_id
asignado_por_id
fecha_asignacion
tarea_asignada
```

Esto permite registrar:

- Qué técnico recibe el caso.
- Qué administrador realizó la asignación.
- Cuándo fue asignado.
- Qué tarea se le indicó realizar.

### Gestión técnica

También se agregaron:

```text
avance_tecnico
requiere_materiales
materiales_requeridos
tiempo_estimado
```

Estos campos permiten registrar el avance de la atención y antecedentes técnicos.

### Evolución general

```text
users + requerimientos
        ↓
rol de usuario
        ↓
notificaciones
        ↓
derivación a técnico
        ↓
gestión técnica
        ↓
PostgreSQL remoto en Supabase
```

---

## Base de datos EVA3

La versión actual utiliza:

```text
Motor: PostgreSQL
Servicio: Supabase
Región: Sudamérica (São Paulo)
Conexión: Session Pooler
Puerto: 5432
```

Las tablas principales de MesaTI son:

```text
users
requerimientos
notificaciones
migrations
```

Laravel también utiliza tablas como:

```text
cache
jobs
```

Supabase mantiene además sus propias tablas internas.

---

## Migraciones

Las migraciones se encuentran en:

```text
database/migrations
```

Entre las migraciones del proyecto se encuentran:

```text
0001_01_01_000000_create_users_table.php
0001_01_01_000001_create_cache_table.php
0001_01_01_000002_create_jobs_table.php
2026_07_12_040035_create_requerimientos_table.php
2026_07_29_170958_crear_notificaciones_table.php
2026_07_29_193943_agregar_rol_a_users_table.php
2026_08_15_192046_agregar_derivacion_ti_a_requerimientos.php
2026_08_15_205057_cambiar_prioridad_default_en_requerimientos.php
2026_08_15_211604_agregar_gestion_tecnica_a_requerimientos_table.php
```

En EVA3 se ejecutaron en PostgreSQL remoto mediante:

```bash
php artisan migrate
```

Todas finalizaron correctamente.

---

## PostgreSQL y Supabase

Para EVA3 Laravel fue configurado para utilizar PostgreSQL.

Ejemplo de configuración:

```env
DB_CONNECTION=pgsql
DB_HOST=TU_HOST_SUPABASE
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=TU_USUARIO_SUPABASE
DB_PASSWORD="TU_CONTRASEÑA"
DB_SSLMODE=require
```

Las credenciales reales se mantienen solamente en `.env` y no se suben a GitHub.

También fue necesario habilitar en PHP:

```text
pdo_pgsql
pgsql
```

La conexión se comprobó mediante:

```bash
php artisan db:show
```

Laravel confirmó conexión con PostgreSQL remoto en Supabase.

---

## Controladores principales

Entre los controladores utilizados se encuentran:

```text
app/Http/Controllers/AuthController.php
app/Http/Controllers/RequerimientoController.php
app/Http/Controllers/NotificacionController.php
app/Http/Controllers/AdminDashboardController.php
app/Http/Controllers/TecnicoDashboardController.php
```

Además, el sistema contiene la lógica correspondiente a la gestión técnica de los requerimientos.

---

## AuthController

El `AuthController` administra:

- Inicio de sesión.
- Registro de usuarios.
- Cierre de sesión.
- Redirección según el rol.

Después de iniciar sesión:

```text
Funcionario
    ↓
Panel funcionario

Administrador
    ↓
Dashboard administrativo

Técnico
    ↓
Panel Técnico TI
```

Las contraseñas se almacenan mediante hash.

Actualmente el registro público crea usuarios con rol `funcionario`.

Como mejora futura se propone que el funcionario solicite acceso y que el administrador sea quien cree o autorice las cuentas.

---

## RequerimientoController

El `RequerimientoController` contiene gran parte de la lógica relacionada con los requerimientos.

Funciones principales:

```text
index()
create()
store()
show()
adminIndex()
edit()
update()
destroy()
```

### Método index()

Muestra solamente los requerimientos del funcionario autenticado.

Actualmente utiliza paginación:

```php
Requerimiento::where('user_id', Auth::id())
    ->orderBy('created_at', 'desc')
    ->paginate(10);
```

### Método create()

Muestra el formulario para registrar un requerimiento.

### Método store()

Valida y registra una nueva solicitud.

El funcionario ingresa:

```text
Categoría
Título
Descripción
```

El backend asigna automáticamente:

```text
user_id = usuario autenticado
prioridad = sin_asignar
estado = pendiente
```

Después se genera una notificación para los administradores.

Flujo:

```text
Funcionario completa formulario
        ↓
Ruta POST
        ↓
store()
        ↓
Validación
        ↓
Modelo Requerimiento
        ↓
Supabase PostgreSQL
        ↓
Notificación al administrador
```

### Método show()

Muestra el detalle de un requerimiento.

El acceso está permitido para:

- Funcionario propietario.
- Administrador.
- Técnico asignado.

Si un usuario intenta visualizar un requerimiento sin permiso, Laravel responde con error:

```text
403
```

### Método adminIndex()

Muestra los requerimientos a los administradores.

Permite filtrar por:

- Estado.
- Prioridad.
- Categoría.
- Funcionario.

Utiliza Eager Loading para cargar relaciones como:

```text
usuario
tecnico
```

Los resultados utilizan:

```php
->paginate(10)
->withQueryString();
```

Esto permite conservar los filtros al cambiar de página.

### Método edit()

Muestra el formulario de gestión administrativa.

Desde esta pantalla se pueden consultar técnicos disponibles y los datos de derivación.

### Método update()

Permite al administrador:

- Asignar prioridad.
- Modificar estado.
- Asignar un técnico.
- Registrar quién realizó la asignación.
- Registrar la fecha de asignación.
- Registrar una tarea.
- Escribir información para el funcionario.
- Generar notificaciones.

Cuando se asigna o reasigna un técnico, el sistema puede generar una notificación para el nuevo responsable.

También se generan avisos al funcionario cuando cambian datos importantes de su solicitud.

### Método destroy()

Elimina un requerimiento.

```php
$requerimiento->delete();
```

La acción está disponible para administración y utiliza una confirmación visual con SweetAlert2 antes del envío.

---

## Gestión técnica

El técnico visualiza únicamente los requerimientos derivados a su cuenta.

El backend utiliza el campo:

```text
tecnico_id
```

para relacionar el requerimiento con el técnico responsable.

Durante la gestión se pueden registrar:

```text
estado
avance_tecnico
requiere_materiales
materiales_requeridos
tiempo_estimado
respuesta_admin
```

Los estados técnicos disponibles incluyen:

```text
en_revision
en_proceso
en_espera_materiales
en_espera_funcionario
resuelto
```

El técnico puede llegar hasta:

```text
resuelto
```

El cierre definitivo corresponde al administrador.

---

## Dashboard administrativo

El backend calcula información para mostrar indicadores como:

```text
Usuarios registrados
Total de requerimientos
Pendientes
En proceso
Resueltos
Urgentes
Distribución por categoría
```

Esto permite entregar un resumen general al administrador.

---

## Dashboard técnico

El panel técnico muestra indicadores asociados al usuario autenticado.

Ejemplos:

```text
Total asignados
Pendientes
En revisión
En proceso / espera
Resueltos
```

La consulta considera solamente requerimientos asociados al técnico mediante `tecnico_id`.

---

## NotificacionController

El `NotificacionController` administra las notificaciones del usuario autenticado.

Entre sus funciones se encuentran:

- Mostrar notificaciones.
- Marcar notificaciones como leídas.
- Entregar el contador de avisos no leídos.

Cada usuario puede consultar solamente sus propias notificaciones.

Cuando corresponde, las notificaciones se actualizan con:

```text
leida = true
fecha_leida = fecha y hora actual
```

---

## Notificaciones del flujo

El sistema genera avisos durante distintas etapas.

### Funcionario crea requerimiento

```text
Funcionario
    ↓
Nuevo requerimiento
    ↓
Notificación al administrador
```

### Administrador actualiza o deriva

```text
Administrador
    ↓
Prioridad / Estado / Técnico
    ↓
Notificación al funcionario
    ↓
Notificación al técnico cuando corresponde
```

### Técnico gestiona

```text
Técnico
    ↓
Actualiza atención
    ↓
Notificación al funcionario
```

---

## Operaciones principales

Dentro del sistema, los requerimientos se manejan mediante distintas operaciones HTTP según la acción que se necesite realizar.

| Proceso | Método HTTP | Descripción |
|---|---|---|
| Registrar | `POST` | Guarda un nuevo requerimiento en el sistema. |
| Visualizar | `GET` | Permite consultar el listado y revisar el detalle de una solicitud. |
| Modificar | `PUT` | Actualiza la información y el seguimiento de un requerimiento. |
| Eliminar | `DELETE` | Quita un requerimiento registrado en el sistema. |

---

## Rutas

Las rutas se encuentran en:

```text
routes/web.php
```

El sistema posee rutas para:

- Login.
- Registro.
- Panel funcionario.
- Panel administrador.
- Panel técnico.
- Crear requerimientos.
- Consultar requerimientos.
- Gestionar requerimientos.
- Gestión técnica.
- Notificaciones.

Las rutas privadas utilizan autenticación mediante Laravel.

Además, los controladores y la lógica del sistema validan que el usuario tenga permisos para acceder a las funciones correspondientes.

---

## Prioridad

En la versión actual el funcionario ya no selecciona la prioridad.

Al crear el requerimiento se registra:

```text
sin_asignar
```

Luego el administrador puede clasificarlo como:

```text
baja
media
alta
urgente
```

Esto permite que la prioridad sea definida por el área responsable de la atención.

---

## Estados

El sistema utiliza estados administrativos y técnicos.

Entre ellos se encuentran:

```text
pendiente
en_revision
en_proceso
en_espera_materiales
en_espera_funcionario
resuelto
cerrado
rechazado
```

El flujo puede variar según la atención requerida.

---

## Validaciones

El método `store()` valida información como:

- Categoría obligatoria y válida.
- Título obligatorio.
- Descripción obligatoria.

El funcionario no envía la prioridad.

El método administrativo `update()` valida:

- Prioridad.
- Estado.
- Técnico seleccionado.
- Tarea asignada cuando existe derivación.
- Información administrativa.

La gestión técnica valida los campos necesarios para actualizar la atención.

Las vistas utilizan:

```blade
@csrf
@method('PUT')
@method('DELETE')
old()
@error
```

---

## Seguridad aplicada

El sistema incorpora:

- Autenticación.
- Contraseñas almacenadas mediante hash.
- Protección CSRF.
- Validación de formularios.
- Separación de funciones por rol.
- Restricción de requerimientos propios.
- Restricción de requerimientos técnicos asignados.
- Error `403` ante accesos no autorizados.
- Cierre de sesión.
- Configuración de base de datos mediante `.env`.
- Credenciales de Supabase excluidas del repositorio.

El archivo:

```text
.env
```

no se sube a GitHub.

El respaldo:

```text
.env.mysql.backup
```

también se encuentra ignorado.

---

## Seeder

El archivo principal se encuentra en:

```text
database/seeders/DatabaseSeeder.php
```

En EVA3 se utiliza además:

```text
database/seeders/TecnicosSeeder.php
```

Los Seeders generan:

```text
1 administradora
5 funcionarios
4 técnicos
30 requerimientos
```

El comando utilizado sobre Supabase fue:

```bash
php artisan db:seed
```

---

## Factory

La Factory se encuentra en:

```text
database/factories/RequerimientoFactory.php
```

Permite generar requerimientos de prueba.

Los datos pueden incluir:

- Categoría.
- Título.
- Descripción.
- Prioridad.
- Estado.
- Respuesta.
- Fechas.
- Usuario relacionado.

En la base remota se utilizó:

```bash
php artisan migrate
php artisan db:seed
```

En lugar de utilizar `migrate:fresh`, evitando eliminar las tablas ya creadas en Supabase.

---

## Eager Loading

Para cargar relaciones de forma anticipada se utiliza Eager Loading.

Ejemplo:

```php
Requerimiento::with([
    'usuario',
    'tecnico',
])->get();
```

Esto permite obtener los datos relacionados y ayuda a evitar el problema N+1.

---

## Pruebas realizadas en Supabase

La conexión fue comprobada mediante:

```bash
php artisan db:show
```

Laravel confirmó:

```text
Connection: pgsql
Database: postgres
Port: 5432
PostgreSQL remoto
```

Los usuarios fueron comprobados mediante Tinker:

```php
App\Models\User::count();
```

Resultado:

```text
10
```

Los requerimientos fueron comprobados mediante:

```php
App\Models\Requerimiento::count();
```

Resultado inicial:

```text
30
```

También se creó un nuevo requerimiento desde la interfaz, confirmando escritura real en Supabase.

---

## Flujo backend actual

### Creación

```text
Funcionario
    ↓
Formulario
    ↓
Ruta POST
    ↓
RequerimientoController
    ↓
Validación
    ↓
Eloquent
    ↓
Supabase PostgreSQL
    ↓
Notificación al administrador
```

### Gestión administrativa

```text
Administrador
    ↓
Clasifica prioridad
    ↓
Cambia estado
    ↓
Asigna técnico
    ↓
Registra tarea
    ↓
Actualiza en Supabase
    ↓
Genera notificaciones
```

### Gestión técnica

```text
Técnico asignado
    ↓
Registra avance
    ↓
Materiales / tiempo
    ↓
Actualiza estado
    ↓
Eloquent
    ↓
Supabase PostgreSQL
    ↓
Funcionario recibe seguimiento
```

---

## Comandos utilizados

Entre los comandos utilizados durante la implementación se encuentran:

```bash
php artisan config:clear
php artisan db:show
php artisan migrate:status
php artisan migrate
php artisan db:seed
php artisan tinker
php artisan route:list
php artisan serve --port=8002
```

Para verificar PostgreSQL en PHP:

```bash
php -m | findstr /I "pgsql"
```

---

## Conclusión

El backend de MesaTI Municipal permite gestionar el flujo completo de los requerimientos mediante Laravel.

La versión actual incorpora funcionarios, administradores y técnicos, derivación de solicitudes, gestión técnica, notificaciones, filtros, paginación y relaciones Eloquent.

Para EVA3, la principal mejora fue reemplazar la dependencia de MySQL local por una conexión PostgreSQL remota mediante Supabase.

Se comprobó que Laravel puede conectarse, ejecutar migraciones, cargar datos, consultar registros y guardar nuevos requerimientos directamente en la base de datos remota.
