# Backend y Gestión de Requerimientos

## Descripción general

El backend del Sistema Municipal de Soporte TI fue desarrollado con Laravel y MySQL, aplicando el patrón MVC para separar las responsabilidades del sistema.

El sistema permite autenticar usuarios, registrar requerimientos, consultar información, gestionar estados, eliminar registros y generar notificaciones internas entre funcionarios y administradores.

## Patrón MVC aplicado

Laravel trabaja con el patrón Modelo, Vista y Controlador.

En este proyecto se aplica de la siguiente manera:

- **Modelo:** representa las tablas de la base de datos mediante Eloquent ORM.
- **Vista:** muestra la información al usuario mediante archivos Blade.
- **Controlador:** procesa las solicitudes, valida los datos y ejecuta las operaciones.
- **Ruta:** conecta una dirección URL y un método HTTP con una función del controlador.
- **Base de datos:** almacena usuarios, requerimientos y notificaciones.

Flujo general:

```text
Vista Blade → Ruta → Controlador → Modelo Eloquent → Base de datos MySQL
```

## Modelos principales

El sistema utiliza los siguientes modelos:

```text
app/Models/User.php
app/Models/Requerimiento.php
app/Models/Notificacion.php
```

### Modelo User

El modelo `User` representa la tabla `users`.

Sus campos principales son:

- `name`
- `email`
- `password`
- `rol`

También contiene relaciones con requerimientos y notificaciones.

```php
public function requerimientos(): HasMany
{
    return $this->hasMany(Requerimiento::class);
}

public function notificaciones(): HasMany
{
    return $this->hasMany(Notificacion::class);
}
```

### Modelo Requerimiento

El modelo `Requerimiento` representa la tabla `requerimientos`.

Sus campos asignables son:

```php
protected $fillable = [
    'user_id',
    'categoria',
    'titulo',
    'descripcion',
    'prioridad',
    'estado',
    'respuesta_admin',
    'fecha_cierre',
];
```

El modelo pertenece a un usuario y puede tener varias notificaciones.

```php
public function usuario(): BelongsTo
{
    return $this->belongsTo(User::class, 'user_id');
}

public function notificaciones(): HasMany
{
    return $this->hasMany(Notificacion::class);
}
```

### Modelo Notificacion

El modelo `Notificacion` representa la tabla `notificaciones`.

Permite registrar avisos para funcionarios y administradores.

```php
protected $fillable = [
    'user_id',
    'requerimiento_id',
    'titulo',
    'mensaje',
    'leida',
    'fecha_leida',
];
```

Cada notificación pertenece a un usuario y puede estar relacionada con un requerimiento.

## Relaciones Eloquent

Las relaciones implementadas son:

```text
Usuario → tiene muchos requerimientos
Usuario → tiene muchas notificaciones
Requerimiento → pertenece a un usuario
Requerimiento → tiene muchas notificaciones
Notificación → pertenece a un usuario
Notificación → pertenece a un requerimiento
```

Para estas relaciones se utilizan:

```php
hasMany()
belongsTo()
```

## Migraciones de la base de datos

Las migraciones se encuentran en:

```text
database/migrations
```

La base de datos utilizada para la evaluación es:

```text
sistema_soporte_ti_eva2
```

Las tablas principales son:

- `users`
- `requerimientos`
- `notificaciones`

También existen las tablas internas de Laravel para caché, sesiones y trabajos.

## Tabla users

La tabla `users` almacena los datos de autenticación.

Campos principales:

- `id`
- `name`
- `email`
- `password`
- `rol`
- `remember_token`
- `created_at`
- `updated_at`

El campo `rol` utiliza por defecto el valor:

```text
funcionario
```

Los roles disponibles son:

```text
funcionario
administrador
```

## Tabla requerimientos

La tabla `requerimientos` contiene los siguientes campos:

- `id`
- `user_id`
- `categoria`
- `titulo`
- `descripcion`
- `prioridad`
- `estado`
- `respuesta_admin`
- `fecha_cierre`
- `created_at`
- `updated_at`

El campo `user_id` relaciona cada requerimiento con el funcionario que lo creó.

## Tabla notificaciones

La tabla `notificaciones` contiene:

- `id`
- `user_id`
- `requerimiento_id`
- `titulo`
- `mensaje`
- `leida`
- `fecha_leida`
- `created_at`
- `updated_at`

Esta tabla permite almacenar las notificaciones internas del sistema.

## Claves foráneas

El sistema utiliza claves foráneas para mantener las relaciones entre las tablas.

Ejemplo:

```php
$table->foreignId('user_id')
    ->nullable()
    ->constrained('users')
    ->nullOnDelete();
```

Esto permite relacionar un requerimiento con su usuario y evitar errores de integridad en la base de datos.

## Controladores utilizados

Los controladores principales son:

```text
app/Http/Controllers/AuthController.php
app/Http/Controllers/RequerimientoController.php
app/Http/Controllers/NotificacionController.php
```

## AuthController

El controlador `AuthController` administra:

- Inicio de sesión.
- Registro de usuarios.
- Cierre de sesión.
- Redirección según el rol.

Después del inicio de sesión:

```text
Administrador → Administración de requerimientos
Funcionario → Panel funcionario
```

Los usuarios creados mediante el formulario de registro reciben automáticamente el rol `funcionario`.

Las contraseñas se almacenan mediante hash utilizando la configuración del modelo `User`.

## RequerimientoController

El controlador `RequerimientoController` contiene la lógica principal del CRUD.

Sus funciones son:

- `index()`
- `create()`
- `store()`
- `show()`
- `adminIndex()`
- `edit()`
- `update()`
- `destroy()`

### Método index

Muestra solamente los requerimientos del funcionario autenticado.

```php
Requerimiento::where('user_id', Auth::id())
    ->latest()
    ->get();
```

### Método create

Muestra el formulario para crear un nuevo requerimiento.

### Método store

Valida los datos y registra el requerimiento.

También asigna automáticamente el identificador del usuario autenticado.

Después de crear el requerimiento, genera una notificación para los administradores.

### Método show

Muestra el detalle de un requerimiento.

El acceso está permitido solamente para:

- El funcionario propietario del requerimiento.
- Un usuario con rol administrador.

Si otro usuario intenta ingresar, el sistema responde con error `403`.

### Método adminIndex

Muestra todos los requerimientos en la vista administrativa.

Se utiliza Eager Loading para cargar los usuarios relacionados:

```php
Requerimiento::with('usuario')
    ->orderBy('created_at', 'desc')
    ->get();
```

### Método edit

Muestra el formulario de gestión administrativa.

El acceso está limitado al administrador.

### Método update

Permite:

- Cambiar el estado.
- Registrar una respuesta administrativa.
- Asignar la fecha de cierre.
- Generar una notificación para el funcionario.

La fecha de cierre se registra cuando el estado cambia a `resuelto` o `cerrado`.

### Método destroy

Elimina un requerimiento desde la administración.

```php
$requerimiento->delete();
```

Después de eliminar, el sistema redirige a la lista administrativa con un mensaje de confirmación.

## NotificacionController

El controlador `NotificacionController` administra las notificaciones del usuario autenticado.

Sus funciones principales son:

- Mostrar las notificaciones.
- Marcar las notificaciones como leídas.
- Entregar el contador de notificaciones no leídas.

Cada usuario puede consultar solamente sus propias notificaciones.

Cuando se abre la vista de notificaciones, las que no han sido leídas se actualizan con:

```text
leida = true
fecha_leida = fecha y hora actual
```

## Operaciones CRUD

El sistema implementa las cuatro operaciones principales:

| Operación | Método HTTP | Acción |
|---|---|---|
| Crear | `POST` | Registrar un requerimiento |
| Leer | `GET` | Listar y mostrar requerimientos |
| Actualizar | `PUT` | Cambiar estado y respuesta |
| Eliminar | `DELETE` | Eliminar un requerimiento |

## Rutas principales

Las rutas se encuentran en:

```text
routes/web.php
```

Rutas utilizadas:

```text
GET     /mis-requerimientos
GET     /requerimientos/crear
POST    /requerimientos
GET     /requerimientos/{requerimiento}
GET     /admin/requerimientos
GET     /admin/requerimientos/{requerimiento}/editar
PUT     /admin/requerimientos/{requerimiento}
DELETE  /admin/requerimientos/{requerimiento}
GET     /notificaciones
GET     /notificaciones/contador
```

Las rutas privadas utilizan autenticación.

## Registro de requerimientos

El formulario se encuentra en:

```text
resources/views/requerimientos/create.blade.php
```

El funcionario ingresa:

- Categoría.
- Título.
- Descripción.
- Prioridad.

Al enviar el formulario:

```text
Formulario → Ruta POST → store() → Validación → Modelo → MySQL
```

## Listado de requerimientos

Los funcionarios consultan sus requerimientos en:

```text
resources/views/requerimientos/index.blade.php
```

El administrador consulta todos los registros en:

```text
resources/views/admin/requerimientos/index.blade.php
```

La vista administrativa también muestra el nombre del funcionario relacionado.

## Detalle del requerimiento

El detalle se encuentra en:

```text
resources/views/requerimientos/show.blade.php
```

Muestra:

- Número del requerimiento.
- Funcionario.
- Categoría.
- Título.
- Descripción.
- Prioridad.
- Estado.
- Respuesta administrativa.
- Fecha de creación.
- Fecha de cierre.

Los botones de navegación cambian según el rol del usuario.

## Gestión administrativa

La vista de gestión se encuentra en:

```text
resources/views/admin/requerimientos/edit.blade.php
```

Desde esta pantalla, el administrador puede:

- Cambiar el estado.
- Registrar una respuesta.
- Guardar la actualización.
- Notificar al funcionario.

## Estados disponibles

El sistema considera los siguientes estados:

- Pendiente.
- En revisión.
- En proceso.
- Resuelto.
- Cerrado.
- Rechazado.

Los estados permiten controlar el avance de la atención.

## Validaciones aplicadas

El método `store()` valida:

- Categoría obligatoria y válida.
- Título obligatorio.
- Descripción obligatoria.
- Prioridad obligatoria y válida.

El método `update()` valida:

- Estado obligatorio y válido.
- Respuesta administrativa opcional.

Las vistas utilizan:

```blade
@csrf
@method('PUT')
@method('DELETE')
old()
@error
```

Estas instrucciones permiten proteger formularios, conservar datos ingresados y mostrar mensajes de validación.

## Seguridad aplicada

El sistema incorpora:

- Autenticación de usuarios.
- Contraseñas almacenadas mediante hash.
- Protección CSRF.
- Validación de datos.
- Separación de permisos según el rol.
- Acceso restringido a requerimientos propios.
- Bloqueo con error `403`.
- Cierre seguro de sesión.
- Sesión configurada con 30 minutos de duración.
- Configuración de base de datos mediante `.env`.

La validación del rol administrador se realiza dentro del controlador antes de ejecutar acciones administrativas.

## Seeder

El archivo principal se encuentra en:

```text
database/seeders/DatabaseSeeder.php
```

El Seeder crea:

- 1 administradora.
- 5 funcionarios.
- 30 requerimientos.

Esto permite disponer de datos suficientes para probar el sistema.

## Factory

La Factory se encuentra en:

```text
database/factories/RequerimientoFactory.php
```

Genera datos ficticios para:

- Categoría.
- Título.
- Descripción.
- Prioridad.
- Estado.
- Respuesta.
- Fecha de cierre.
- Usuario relacionado.

Comando utilizado:

```bash
php artisan migrate:fresh --seed
```

Este comando elimina las tablas existentes, ejecuta las migraciones y carga los datos del Seeder.

## Eager Loading

En la administración se utiliza:

```php
Requerimiento::with('usuario')->get();
```

Esto permite cargar los funcionarios relacionados junto con los requerimientos.

Su uso evita el problema N+1, reduciendo consultas innecesarias a la base de datos.

## Flujo backend implementado

El flujo general para crear un requerimiento es:

```text
Funcionario completa formulario
            ↓
Ruta POST recibe la solicitud
            ↓
RequerimientoController valida los datos
            ↓
Modelo Requerimiento guarda en MySQL
            ↓
Se genera una notificación al administrador
            ↓
El funcionario vuelve a su listado
```

El flujo de actualización es:

```text
Administrador abre el requerimiento
            ↓
Cambia el estado y registra una respuesta
            ↓
Ruta PUT envía la información
            ↓
RequerimientoController actualiza el registro
            ↓
Se genera una notificación al funcionario
            ↓
El funcionario revisa el nuevo estado
```

## Eliminación de requerimientos

La eliminación se realiza mediante:

```text
DELETE /admin/requerimientos/{requerimiento}
```

Esta ruta llama al método:

```php
destroy(Requerimiento $requerimiento)
```

El formulario utiliza:

```blade
@csrf
@method('DELETE')
```

Antes de enviar la eliminación, SweetAlert2 solicita confirmación al administrador.

## Comandos utilizados

Comandos principales del proyecto:

```bash
php artisan migrate
php artisan migrate:fresh --seed
php artisan route:list
php artisan config:clear
php artisan serve --port=8001
php artisan tinker
```

## Conclusión

El backend del Sistema Municipal de Soporte TI permite autenticar usuarios, gestionar requerimientos y enviar notificaciones internas mediante Laravel y MySQL.

El proyecto aplica MVC, rutas, métodos HTTP, controladores, modelos Eloquent, relaciones, migraciones, validaciones, Seeder, Factory, Eager Loading, seguridad por roles y operaciones CRUD completas.
