# MesaTI Municipal — Sistema Municipal de Soporte TI

Aplicación web desarrollada con Laravel para registrar, gestionar y hacer seguimiento a requerimientos informáticos de funcionarios municipales.

Esta versión corresponde a la continuidad del sistema desarrollado en EVA2 y actualizado para EVA3, incorporando una base de datos PostgreSQL remota en Supabase.

---

## Objetivo

Centralizar las solicitudes de soporte TI en una plataforma donde:

- Los funcionarios puedan registrar requerimientos y revisar su estado.
- El administrador pueda clasificar, priorizar y derivar los requerimientos.
- Los técnicos puedan gestionar las atenciones asignadas.
- Los usuarios reciban notificaciones durante el flujo de atención.
- La información quede almacenada en una base de datos remota PostgreSQL mediante Supabase.

---

## Evolución EVA2 → EVA3

### EVA2

La versión anterior trabajaba con:

- Laravel.
- MySQL local.
- Laragon.
- Roles funcionario y administrador.
- CRUD de requerimientos.
- Notificaciones internas.
- Migraciones, Seeder y Factory.

### EVA3

La versión actual mantiene la lógica de MesaTI e incorpora:

- PostgreSQL como motor de base de datos.
- Supabase Cloud como base de datos remota.
- Conexión mediante Session Pooler.
- Región Sudamérica (São Paulo).
- Rol técnico.
- Derivación de requerimientos a técnicos.
- Gestión técnica de atención.
- Información de avance para el funcionario.
- Materiales o repuestos requeridos.
- Tiempo estimado de atención.
- Dashboard administrativo.
- Dashboard técnico.
- Filtros administrativos.
- Paginación de requerimientos.
- Modernización visual con Tabler UI.
- Interfaz responsive y colores institucionales.

---

## Arquitectura general

El sistema utiliza el patrón MVC de Laravel.

```text
Navegador
    ↓
Ruta
    ↓
Controlador
    ↓
Modelo / Eloquent
    ↓
PostgreSQL
    ↓
Supabase Cloud
    ↓
Vista Blade
    ↓
Usuario
```

Para EVA3, la conexión de base de datos funciona de la siguiente forma:

```text
MesaTI Laravel
      ↓
Eloquent
      ↓
DB_CONNECTION=pgsql
      ↓
Session Pooler
Puerto 5432
      ↓
Supabase Cloud
Sudamérica (São Paulo)
      ↓
PostgreSQL remoto
```

---

## Tecnologías utilizadas

- Laravel.
- PHP 8.3.
- Blade.
- Eloquent ORM.
- PostgreSQL.
- Supabase.
- Session Pooler.
- Tabler UI.
- Bootstrap/CSS.
- JavaScript.
- SweetAlert2.
- Laragon.
- Composer.
- Git y GitHub.
- Visual Studio Code.

---

## Roles del sistema

El sistema utiliza tres roles principales:

```text
funcionario
administrador
tecnico
```

### Funcionario

Puede:

- Registrarse e iniciar sesión.
- Crear requerimientos informáticos.
- Consultar solamente sus propios requerimientos.
- Revisar prioridad y estado.
- Consultar el detalle de cada solicitud.
- Recibir información del área de Informática.
- Recibir notificaciones cuando el requerimiento cambia.
- Crear nuevos requerimientos desde su panel.

La prioridad no es seleccionada por el funcionario.

Al crear una solicitud:

```text
Prioridad = sin_asignar
Estado = pendiente
```

La prioridad es posteriormente definida por el administrador.

### Administrador

Puede:

- Iniciar sesión en el panel administrativo.
- Consultar todos los requerimientos.
- Identificar al funcionario solicitante.
- Asignar prioridad.
- Cambiar el estado.
- Derivar el requerimiento a un técnico TI.
- Registrar una tarea para el técnico.
- Registrar información para el funcionario.
- Consultar responsables y fechas de asignación.
- Filtrar por estado, prioridad, categoría y funcionario.
- Eliminar requerimientos con confirmación SweetAlert2.
- Recibir notificaciones cuando un funcionario crea una solicitud.
- Consultar indicadores generales en el dashboard.

### Técnico

Puede:

- Iniciar sesión en su Panel Técnico TI.
- Visualizar únicamente los requerimientos derivados a su atención.
- Consultar datos del funcionario y del requerimiento.
- Registrar avance o trabajo realizado.
- Cambiar el estado técnico.
- Indicar si requiere materiales o repuestos.
- Registrar materiales requeridos.
- Informar tiempo estimado.
- Registrar información visible para el funcionario.
- Marcar un requerimiento como resuelto.

El técnico puede llegar hasta el estado:

```text
resuelto
```

El cierre definitivo corresponde al administrador.

---

## Flujo principal del sistema

```text
Funcionario
crea requerimiento
      ↓
Pendiente
Sin asignar
      ↓
Administrador
revisa solicitud
      ↓
Asigna prioridad
      ↓
Deriva a Técnico TI
      ↓
Técnico
gestiona atención
      ↓
Registra avance
materiales
tiempo estimado
      ↓
Funcionario
recibe seguimiento
      ↓
Técnico
marca Resuelto
      ↓
Administrador
realiza cierre definitivo
```

---

## Notificaciones

Las notificaciones se relacionan con usuarios y requerimientos.

Se generan, entre otros casos, cuando:

- Un funcionario crea un requerimiento.
- El administrador modifica prioridad o estado.
- El administrador deriva un requerimiento.
- El técnico actualiza la atención.
- El técnico informa avances al funcionario.

Relaciones principales:

```text
notificaciones.user_id
        ↓
Usuario destinatario

notificaciones.requerimiento_id
        ↓
Requerimiento relacionado
```

---

## CRUD de requerimientos

Operación    |Método HTTP|     Acción |
|---|---|---|
| Crear     | `POST` | Registrar requerimiento |
| Consultar | `GET`  | Listar y mostrar detalle |
| Actualizar| `PUT`  | Actualizar gestión administrativa o técnica |
| Eliminar  | `DELETE`| Eliminar requerimiento |

---

## Relaciones principales

La base de datos utiliza relaciones Eloquent como:

```php
hasMany()
belongsTo()
```

Relaciones principales:

```text
users.id
  ↓
requerimientos.user_id
Funcionario que creó la solicitud

users.id
  ↓
requerimientos.tecnico_id
Técnico responsable

users.id
  ↓
requerimientos.asignado_por_id
Administrador que realizó la derivación

users.id
  ↓
notificaciones.user_id
Destinatario de la notificación

requerimientos.id
  ↓
notificaciones.requerimiento_id
Solicitud asociada
```

---

## Base de datos EVA3

En EVA3 la aplicación utiliza:

```text
Motor: PostgreSQL
Servicio: Supabase
Región: Sudamérica (São Paulo)
Conexión: Session Pooler
Puerto: 5432
```

Tablas principales de MesaTI:

```text
users
requerimientos
notificaciones
migrations
cache
jobs
```

Supabase también mantiene tablas internas propias de sus servicios.

---

## Configuración de conexión

Laravel utiliza variables de entorno para conectarse a Supabase.

Ejemplo seguro:

```env
DB_CONNECTION=pgsql
DB_HOST=TU_HOST_SUPABASE
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=TU_USUARIO_SUPABASE
DB_PASSWORD="TU_CONTRASEÑA"
DB_SSLMODE=require
```

> Nunca se deben subir contraseñas reales al repositorio.

El archivo `.env` permanece ignorado por Git.

También se mantiene un respaldo local de la configuración MySQL:

```text
.env.mysql.backup
```

Este archivo también está protegido mediante `.gitignore`.

---

## PostgreSQL en PHP

Para utilizar PostgreSQL desde Laravel fue necesario habilitar las extensiones:

```text
pdo_pgsql
pgsql
```

Comprobación:

```bash
php -m | findstr /I "pgsql"
```

Resultado esperado:

```text
pdo_pgsql
pgsql
```

---

## Migraciones en Supabase

Las migraciones fueron ejecutadas directamente sobre PostgreSQL remoto con:

```bash
php artisan migrate
```

Se aplicaron correctamente las migraciones correspondientes a:

- Usuarios.
- Cache.
- Jobs.
- Requerimientos.
- Notificaciones.
- Rol de usuario.
- Derivación a técnico TI.
- Cambio de prioridad por defecto.
- Gestión técnica.

> En la base remota no se recomienda ejecutar `php artisan migrate:fresh` durante el uso normal, ya que elimina las tablas antes de volver a crearlas.

---

## Seeders

El proyecto utiliza:

```text
DatabaseSeeder.php
TecnicosSeeder.php
```

El Seeder crea datos de demostración:

- 1 administradora.
- 5 funcionarios.
- 4 técnicos TI.
- 30 requerimientos de prueba.

Los técnicos creados son:

- Gabriel Silva.
- David Guajardo.
- Carlos Saavedra.
- Alejandro Adio.

Comando utilizado:

```bash
php artisan db:seed
```

---

## Pruebas realizadas con Supabase

Se verificó la conexión remota mediante:

```bash
php artisan db:show
```

La aplicación confirmó:

```text
Connection: pgsql
Database: postgres
Port: 5432
PostgreSQL remoto en Supabase
```

También se verificaron los datos mediante Tinker:

```php
App\Models\User::count();
```

Resultado:

```text
10
```

Y:

```php
App\Models\Requerimiento::count();
```

Resultado inicial:

```text
30
```

Posteriormente se creó un nuevo requerimiento directamente desde la interfaz web, confirmando que Laravel puede escribir datos en Supabase.

Esto demuestra que la aplicación realiza:

```text
Lectura remota ✅
Escritura remota ✅
Migraciones remotas ✅
Seeders remotos ✅
Autenticación con datos remotos ✅
```

---

## Paginación

La administración utiliza paginación real de Laravel:

```php
->paginate(10)
->withQueryString();
```

La vista de requerimientos del funcionario también utiliza:

```php
->paginate(10);
```

---

## Eager Loading

Para evitar consultas innecesarias se utiliza Eager Loading.

Ejemplo:

```php
Requerimiento::with([
    'usuario',
    'tecnico',
])->get();
```

Esto permite cargar anticipadamente las relaciones requeridas y ayuda a evitar el problema N+1.

---

## Validaciones y seguridad

El sistema utiliza:

- Sesiones autenticadas.
- Validación de roles.
- Protección de formularios con `@csrf`.
- Validaciones desde controladores.
- Contraseñas almacenadas mediante hash.
- Cierre de sesión.
- Restricción de acceso a requerimientos.
- Validación de técnico asignado.
- Error `403` cuando un usuario intenta acceder a información sin autorización.

Las vistas utilizan:

```blade
@csrf
@method('PUT')
@method('DELETE')
old()
@error
```

---

## Herencia de vistas Blade

Las vistas reutilizan el diseño principal:

```blade
@extends('layout')

@section('content')

    ...

@endsection
```

El layout principal utiliza:

```blade
@yield('content')
```

Esto evita repetir navegación, encabezado y estructura general.

---

## Interfaz

La versión EVA3 fue modernizada usando Tabler UI y los colores institucionales:

```text
Morado:  #5B3F95
Verde:   #78BE20
Rojo:    #EF3E24
Naranjo: #F26B21
```

Se modernizaron las principales pantallas de funcionario, administrador y técnico.

---

## Ejecución del proyecto

### 1. Iniciar Laragon

Es necesario disponer de PHP y las extensiones PostgreSQL habilitadas.

### 2. Instalar dependencias

```bash
composer install
```

### 3. Configurar `.env`

Configurar la conexión PostgreSQL de Supabase.

### 4. Limpiar configuración

```bash
php artisan config:clear
```

### 5. Ejecutar migraciones

Solo si la base aún no tiene la estructura:

```bash
php artisan migrate
```

### 6. Cargar datos de demostración

Solo cuando sea necesario:

```bash
php artisan db:seed
```

### 7. Levantar Laravel

```bash
php artisan serve --port=8002
```

Abrir:

```text
http://127.0.0.1:8002
```

---

## Credenciales de demostración

Las cuentas son únicamente para ambiente académico y de pruebas.

### Administradora

```text
Correo: rosa@sanjoaquin.cl
Contraseña: Municipal2026!
```

### Funcionaria

```text
Correo: ana.martinez@sanjoaquin.cl
Contraseña: Municipal2026!
```

### Técnico

```text
Correo: davidguajardo@sanjoaquin.cl
Contraseña: Municipal2026!
```

---

## Documentación

La documentación complementaria se encuentra en:

```text
documentacion/
```

Archivos actuales:

```text
01_INTERFAZ_USUARIO.md
02_BACKEND_REQUERIMIENTOS.md
03_FLUJO_DEL_SISTEMA.md
04_CASOS_DE_PRUEBA.md
05_EVIDENCIAS.md
```

Para EVA3 se incorpora:

```text
06_EVA3_SUPABASE.md
```

---

## Estado actual del proyecto

Actualmente MesaTI permite:

- Autenticar usuarios.
- Separar permisos por tres roles.
- Crear y gestionar requerimientos.
- Asignar prioridades.
- Derivar solicitudes a técnicos.
- Registrar gestión técnica.
- Informar avances al funcionario.
- Generar notificaciones.
- Utilizar relaciones Eloquent.
- Filtrar requerimientos.
- Paginar resultados.
- Consultar dashboards.
- Trabajar con PostgreSQL remoto mediante Supabase.

La conexión con Supabase fue comprobada mediante lectura y escritura real desde la aplicación.

---

## Mejoras futuras

-  Agregar una bitácora para registrar los cambios realizados en cada requerimiento.
- Mostrar un historial más detallado de estados y técnicos asignados.
- Incorporar filtros en la sección de notificaciones.
- Permitir que el administrador gestione usuarios y técnicos desde el sistema.
- Reemplazar el registro público de usuarios por un sistema de solicitud de acceso, donde el administrador sea quien autorice y cree las cuentas.
- Incorporar una agenda para organizar las fechas de atención.
- Implementar avisos del navegador para nuevas solicitudes o actualizaciones.
- Desplegar la aplicación Laravel en un servidor remoto para complementar la base de datos que actualmente funciona en Supabase.
- Mejorar el manejo administrativo de estados como espera de materiales y espera del funcionario.
---

## Conclusión

MesaTI Municipal permite organizar y dar seguimiento al soporte informático interno mediante un flujo que conecta funcionarios, administradores y técnicos.

La versión EVA3 mantiene la arquitectura MVC de Laravel y amplía el proyecto mediante una base de datos PostgreSQL remota en Supabase.

La aplicación utiliza Eloquent, migraciones, relaciones, validaciones, roles, notificaciones, CRUD, dashboards y gestión técnica.

La conexión remota fue probada exitosamente mediante migraciones, seeders, consultas y creación de nuevos requerimientos desde la interfaz web.

