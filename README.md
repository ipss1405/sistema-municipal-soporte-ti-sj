# Sistema Municipal de Soporte TI

Aplicación web desarrollada con Laravel para registrar, gestionar y hacer seguimiento a requerimientos informáticos de funcionarios municipales.

## Objetivo

Centralizar las solicitudes de soporte TI en una plataforma donde los funcionarios puedan registrar requerimientos y revisar su estado, mientras el administrador puede gestionarlos, responderlos y cerrarlos.

## Tecnologías utilizadas

- Laravel y PHP
- Blade
- MySQL
- Bootstrap y CSS
- Laragon
- Composer
- Git y GitHub
- Visual Studio Code
- SweetAlert2

## Funcionalidades principales

### Funcionario

- Registrarse e iniciar sesión.
- Crear requerimientos informáticos.
- Consultar solamente sus propios requerimientos.
- Revisar el estado y la respuesta de cada solicitud.
- Recibir notificaciones cuando cambia el estado de un requerimiento.

### Administrador

- Iniciar sesión y acceder directamente a Administración.
- Consultar todos los requerimientos.
- Identificar al funcionario que creó cada solicitud.
- Cambiar el estado del requerimiento.
- Registrar una respuesta administrativa.
- Eliminar requerimientos con confirmación SweetAlert.
- Recibir notificaciones cuando un funcionario crea una solicitud.

## Roles y seguridad

El sistema utiliza dos roles:

- `funcionario`
- `administrador`

Las rutas privadas requieren una sesión iniciada. Además, las funciones administrativas validan el rol del usuario.

Un funcionario no visualiza el acceso a Administración. Si intenta ingresar manualmente a la ruta administrativa, el sistema bloquea el acceso mediante un error `403`.

También se implementaron:

- Protección de formularios con `@csrf`.
- Validaciones desde los controladores.
- Contraseñas almacenadas mediante hash.
- Cierre seguro de sesión.
- Sesión con 30 minutos de duración.
- Navegación adaptada según el rol.

## Arquitectura MVC

El proyecto utiliza el patrón MVC de Laravel:

- **Modelo:** representa y administra los datos mediante Eloquent.
- **Vista:** muestra la interfaz mediante Blade.
- **Controlador:** procesa solicitudes, valida datos y ejecuta operaciones.
- **Ruta:** conecta una URL y un método HTTP con el controlador.

Flujo general:

```text
```
Vista → Ruta → Controlador → Modelo → Base de datos
Herencia de vistas Blade

Las vistas reutilizan el diseño principal mediante:

@extends('layout')
@section('content')
@endsection

El archivo layout.blade.php recibe el contenido mediante:

@yield('content')

Esto evita repetir el encabezado, navegación, estilos y pie de página en cada vista.

CRUD de requerimientos

El sistema implementa las operaciones principales:

Operación	Método HTTP	Acción
Crear	    POST	Registrar un requerimiento
Consultar	GET	    Listar y mostrar detalles
Actualizar	PUT	    Cambiar estado y respuesta
Eliminar	DELETE	Eliminar un requerimiento

Rutas principales:

GET     /mis-requerimientos
GET     /requerimientos/crear
POST    /requerimientos
GET     /requerimientos/{requerimiento}
GET     /admin/requerimientos
GET     /admin/requerimientos/{requerimiento}/editar
PUT     /admin/requerimientos/{requerimiento}
DELETE  /admin/requerimientos/{requerimiento}
Base de datos

Base utilizada en la copia de evaluación:

sistema_soporte_ti_eva2

Tablas principales:

users
requerimientos
notificaciones

Relaciones implementadas:

Usuario → muchos requerimientos
Usuario → muchas notificaciones
Requerimiento → pertenece a un usuario
Requerimiento → muchas notificaciones

Los modelos utilizan relaciones Eloquent como:

hasMany()
belongsTo()
Migraciones, Seeder y Factory

Las migraciones crean las tablas, columnas y claves foráneas.

La Factory genera requerimientos ficticios con:

Categoría
Título
Descripción
Prioridad
Estado
Fechas
Usuario relacionado

El Seeder crea automáticamente:

1 administradora
5 funcionarios
30 requerimientos

Comando utilizado:

php artisan migrate:fresh --seed

Este comando elimina y vuelve a crear las tablas de la base configurada en .env.

Eager Loading

En la administración se utiliza:

Requerimiento::with('usuario')->get();

Esto carga anticipadamente los usuarios relacionados y evita el problema N+1, reduciendo consultas innecesarias a la base de datos.

Validaciones

Los métodos store() y update() validan los datos antes de guardarlos.

Las vistas utilizan:

@csrf
@method('PUT')
@method('DELETE')
old()
@error

Estas instrucciones protegen los formularios, permiten actualizar o eliminar registros y muestran mensajes cuando los datos son incorrectos.

Ejecución del proyecto
Iniciar Apache y MySQL desde Laragon.
Abrir una terminal en la carpeta del proyecto.
Ejecutar:
composer install
php artisan config:clear
php artisan migrate:fresh --seed
php artisan serve --port=8001
Abrir:
http://127.0.0.1:8001
Credenciales de demostración
Administradora
Correo: rosa@sanjoaquin.cl
Contraseña: Municipal2026!
Funcionaria
Correo: ana.martinez@sanjoaquin.cl
Contraseña: Municipal2026!
Documentación

La documentación complementaria se encuentra en:

documentacion/

Incluye información sobre:

Interfaz de usuario
Backend y CRUD
Flujo del sistema
Casos de prueba
Guía de presentación

Las evidencias de la Evaluación 2 se incorporarán en:

documentacion/EVIDENCIAS_EVA2_SISTEMA_SOPORTE_TI.pdf
Estado del proyecto

El desarrollo principal se encuentra terminado y funcionando.

El sistema permite autenticar usuarios, separar permisos por rol, realizar el CRUD de requerimientos, generar datos mediante Seeder y Factory, utilizar relaciones Eloquent y enviar notificaciones entre funcionarios y administración.

## Mejoras futuras
- Incorporar una agenda para programar la fecha y hora de atención de cada requerimiento.
- Asignar los requerimientos a funcionarios o técnicos del equipo de soporte.
- Permitir que el administrador agregue comentarios e instrucciones para el técnico asignado.
- Crear una bitácora con los cambios de estado, asignaciones, fechas y comentarios realizados.
- Implementar notificaciones del navegador para avisar sobre nuevos requerimientos aunque la plataforma esté minimizada.
- Incorporar una vista de calendario para organizar las atenciones programadas.
- Publicar el sistema en un servidor institucional.

## Conclusión

El Sistema Municipal de Soporte TI permite organizar y dar seguimiento a solicitudes informáticas internas.

El proyecto aplica Laravel, MVC, Blade, MySQL, migraciones, modelos Eloquent, relaciones, validaciones, Seeder, Factory, Eager Loading, roles, seguridad y operaciones CRUD.


Esta versión conserva lo importante, explica lo que realmente desarrollamos y elimina la repetición. Además, está escrita para que puedas leerla y defenderla sin necesitar un traductor oficial de Laravel 😄.