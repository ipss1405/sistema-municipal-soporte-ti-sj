# MesaTI Municipal

Sistema web interno para la gestión de requerimientos informáticos municipales, desarrollado con Laravel, Blade y MySQL.

## Descripción del proyecto

MesaTI Municipal es una plataforma orientada al uso interno de funcionarios municipales. Permite registrar solicitudes de soporte informático, revisar su estado, visualizar el seguimiento y consultar la respuesta entregada por el área de Informática.

El sistema también cuenta con una sección de administración donde el área informática puede revisar los requerimientos ingresados, cambiar su estado, registrar una respuesta para el funcionario y eliminar requerimientos cuando corresponda.

## Objetivo general

Desarrollar una plataforma web municipal para registrar, gestionar y hacer seguimiento a requerimientos informáticos internos, aplicando estructura MVC, vistas Blade, rutas, controladores, modelo y base de datos MySQL.

## Tecnologías utilizadas

- Laravel.
- PHP.
- Blade.
- MySQL.
- Laragon.
- Composer.
- Git.
- GitHub.
- Visual Studio Code.

## Funcionalidades principales

- Página principal institucional.
- Logo municipal incorporado al layout.
- Login visual.
- Registro visual.
- Panel funcionario visual.
- Formulario para registrar requerimientos.
- Guardado de requerimientos en MySQL.
- Listado de requerimientos registrados.
- Visualización del detalle de un requerimiento.
- Administración de requerimientos.
- Cambio de estado del requerimiento.
- Registro de respuesta del área informática.
- Eliminación de requerimientos desde administración.
- Seguimiento visible para el funcionario.
- Componente reutilizable para mostrar estados.
- Efectos visuales suaves en la portada.
- Documentación técnica del sistema.
- Capturas de evidencia del funcionamiento.

## Estructura general del sistema

El sistema utiliza el patrón MVC propio de Laravel:

- **Modelo:** representa los datos del sistema.
- **Vista:** muestra la información al usuario mediante Blade.
- **Controlador:** procesa las solicitudes y coordina la lógica.
- **Base de datos:** almacena la información en MySQL.

La estructura principal utilizada es:

- `routes/web.php`
- `app/Http/Controllers/RequerimientoController.php`
- `app/Models/Requerimiento.php`
- `resources/views`
- `resources/views/components`
- `database/migrations`
- `documentacion`

## Modelo principal

El modelo principal del sistema es `Requerimiento`.

Archivo:

`app/Models/Requerimiento.php`

Este modelo permite trabajar con la tabla `requerimientos` mediante Eloquent ORM.

El modelo contiene los campos permitidos para registro y actualización mediante `$fillable`.

## Controlador principal

El controlador principal es:

`app/Http/Controllers/RequerimientoController.php`

Este controlador permite:

- Listar requerimientos.
- Guardar nuevos requerimientos.
- Mostrar el detalle de un requerimiento.
- Mostrar la vista de administración.
- Editar requerimientos desde administración.
- Actualizar estado y respuesta.
- Eliminar requerimientos desde administración.

Métodos principales del controlador:

- `index()`
- `store()`
- `show()`
- `adminIndex()`
- `edit()`
- `update()`
- `destroy()`

## Base de datos

Base de datos utilizada:

`mesa_ti_municipal`

Tabla principal:

`requerimientos`

Campos principales:

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

## Rutas principales

| Método | Ruta | Descripción |
|---|---|---|
| GET | `/` | Página principal |
| GET | `/login` | Login visual |
| GET | `/registro` | Registro visual |
| GET | `/funcionario` | Panel funcionario |
| GET | `/requerimientos/crear` | Formulario para crear requerimiento |
| POST | `/requerimientos` | Guarda un nuevo requerimiento |
| GET | `/mis-requerimientos` | Listado de requerimientos |
| GET | `/requerimientos/{requerimiento}` | Detalle del requerimiento |
| GET | `/admin/requerimientos` | Administración de requerimientos |
| GET | `/admin/requerimientos/{requerimiento}/editar` | Gestión administrativa del requerimiento |
| PUT | `/admin/requerimientos/{requerimiento}` | Actualiza estado y respuesta |
| DELETE | `/admin/requerimientos/{requerimiento}` | Elimina un requerimiento desde administración |

## Verbos HTTP utilizados

El proyecto utiliza los verbos HTTP solicitados para una estructura CRUD:

- **GET:** mostrar vistas y consultar información.
- **POST:** guardar nuevos requerimientos.
- **PUT:** actualizar estado y respuesta administrativa.
- **DELETE:** eliminar requerimientos desde administración.

## Flujo principal del sistema

1. El funcionario ingresa un requerimiento.
2. El sistema guarda la solicitud en MySQL.
3. El requerimiento queda con estado inicial Pendiente.
4. El funcionario puede revisar el listado y detalle.
5. El área de Informática revisa el requerimiento.
6. Administración cambia el estado y registra una respuesta.
7. El funcionario visualiza el seguimiento actualizado.
8. Administración puede eliminar un requerimiento si corresponde.

## Estados del requerimiento

El sistema considera los siguientes estados:

- Pendiente.
- En revisión.
- En proceso.
- Resuelto.
- Cerrado.
- Rechazado.

Estos estados se muestran mediante un componente visual reutilizable ubicado en:

`resources/views/components/estado.blade.php`

El componente se utiliza en distintas vistas para mantener una visualización consistente del estado del requerimiento.

## Vistas principales

El sistema cuenta con las siguientes vistas Blade:

- `resources/views/inicio.blade.php`
- `resources/views/auth/login.blade.php`
- `resources/views/auth/register.blade.php`
- `resources/views/funcionario/dashboard.blade.php`
- `resources/views/requerimientos/create.blade.php`
- `resources/views/requerimientos/index.blade.php`
- `resources/views/requerimientos/show.blade.php`
- `resources/views/admin/requerimientos/index.blade.php`
- `resources/views/admin/requerimientos/edit.blade.php`

## Layout y componente reutilizable

El sistema utiliza un layout principal ubicado en:

`resources/views/layout.blade.php`

Este layout contiene la estructura general del sitio:

- Encabezado.
- Logo institucional.
- Menú de navegación.
- Estilos CSS.
- Contenedor principal.
- Pie de página.

También se creó un componente reutilizable para mostrar los estados:

`resources/views/components/estado.blade.php`

Este componente permite mostrar el estado del requerimiento con texto y color correspondiente.

## Diseño de interfaz

La interfaz fue diseñada con enfoque institucional municipal, utilizando logo, colores asociados a la Municipalidad de San Joaquín, accesos rápidos, bloques informativos y navegación simple.

La portada incorpora una distribución moderna basada en tarjetas, microinteracciones y efectos visuales suaves, inspirada en estilos actuales de prototipado de interfaces como Google Stitch, adaptados al contexto municipal.

## Seguridad básica aplicada

El sistema utiliza medidas básicas propias de Laravel:

- Uso de `@csrf` en formularios.
- Validación de datos desde el controlador.
- Uso del archivo `.env` para configuración local.
- Separación de responsabilidades mediante MVC.
- Rutas definidas en `routes/web.php`.
- Uso de `@method('PUT')` para actualización.
- Uso de `@method('DELETE')` para eliminación.

## Documentación del proyecto

La documentación complementaria se encuentra en la carpeta:

`documentacion/`

Archivos incluidos:

- `01_INTERFAZ_USUARIO.md`
- `02_BACKEND_REQUERIMIENTOS.md`
- `03_FLUJO_DEL_SISTEMA.md`
- `04_CASOS_DE_PRUEBA.md`
- `05_GUIA_PRESENTACION.md`

Las capturas del sistema se encuentran en:

`documentacion/capturas/`

Capturas principales incluidas:

- `01_estructura_proyecto.png`
- `02_portada.png`
- `03_formulario_requerimiento.png`
- `04_mis_requerimientos.png`
- `05_detalle_requerimiento.png`
- `06_administracion_requerimientos.png`
- `07_gestion_requerimiento.png`
- `08_actualizacion_estado.png`
- `09_eliminacion_requerimiento.png`

## Cómo ejecutar el proyecto

1. Abrir Laragon.
2. Iniciar los servicios con **Start All**.
3. Abrir el proyecto en Visual Studio Code.
4. Abrir una terminal en la carpeta del proyecto.
5. Ejecutar:

`php artisan serve`

6. Abrir en el navegador:

`http://127.0.0.1:8000`

## Estado actual del proyecto

El sistema permite registrar, listar, visualizar, administrar, actualizar y eliminar requerimientos informáticos.

El flujo principal de requerimientos se encuentra funcionando:

Crear requerimiento → Guardar en MySQL → Listar → Ver detalle → Gestionar → Actualizar estado y respuesta → Eliminar requerimiento desde administración.

## Relación con la rúbrica

El proyecto cumple con los principales requerimientos de la evaluación:

- Uso de Laravel y Blade.
- Mínimo de 5 rutas.
- Uso de rutas en `web.php`.
- Uso de controlador.
- Uso de modelo.
- Uso de vistas Blade.
- Uso de layout reutilizable.
- Uso de componente reutilizable.
- Aplicación de estilos CSS.
- Uso de verbos HTTP GET, POST, PUT y DELETE.
- Operaciones principales: listar, crear, mostrar detalle, actualizar y eliminar.
- Presentación funcional mediante `php artisan serve`.

## Mejoras futuras

- Login real de usuarios.
- Registro real de funcionarios.
- Roles de funcionario y administrador.
- Protección de rutas mediante middleware.
- Asociación del requerimiento al usuario autenticado.
- Notificación por correo cuando cambie el estado del requerimiento.
- Implementación de permisos para separar acceso funcionario y administrador.
- Historial de cambios por requerimiento.

## Conclusión

MesaTI Municipal permite centralizar la gestión de requerimientos informáticos internos, manteniendo un flujo ordenado entre funcionario y área de Informática.

El proyecto aplica Laravel, MVC, Blade, MySQL, rutas, controlador, modelo, migraciones, validaciones básicas, documentación técnica, capturas de evidencia y operaciones CRUD.

La aplicación permite demostrar el funcionamiento de una solución web coherente con un contexto municipal real, cumpliendo los criterios técnicos principales de la evaluación.