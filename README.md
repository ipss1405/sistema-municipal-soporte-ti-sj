# MesaTI Municipal

Sistema web interno para la gestión de requerimientos informáticos municipales, desarrollado con Laravel, Blade y MySQL.

## Descripción del proyecto

MesaTI Municipal es una plataforma orientada al uso interno de funcionarios municipales. Permite registrar solicitudes de soporte informático, revisar su estado, visualizar el seguimiento y consultar la respuesta entregada por el área de Informática.

El sistema también cuenta con una sección de administración donde el área informática puede revisar los requerimientos ingresados, cambiar su estado y registrar una respuesta para el funcionario.

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
- Seguimiento visible para el funcionario.
- Componente reutilizable para mostrar estados.
- Efectos visuales suaves en la portada.

## Estructura general del sistema

El sistema utiliza el patrón MVC propio de Laravel:

- **Modelo:** representa los datos del sistema.
- **Vista:** muestra la información al usuario mediante Blade.
- **Controlador:** procesa las solicitudes y coordina la lógica.
- **Base de datos:** almacena la información en MySQL.

## Modelo principal

El modelo principal del sistema es `Requerimiento`.

Archivo:

`app/Models/Requerimiento.php`

Este modelo permite trabajar con la tabla `requerimientos` mediante Eloquent ORM.

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

## Base de datos

Base de datos utilizada:

`mesa_ti_municipal`

Tabla principal:

`requerimientos`

Campos principales:

- id.
- user_id.
- categoria.
- titulo.
- descripcion.
- prioridad.
- estado.
- respuesta_admin.
- fecha_cierre.
- created_at.
- updated_at.

## Rutas principales

| Ruta | Descripción |
|---|---|
| `/` | Página principal |
| `/login` | Login visual |
| `/registro` | Registro visual |
| `/funcionario` | Panel funcionario |
| `/requerimientos/crear` | Crear requerimiento |
| `/mis-requerimientos` | Listado de requerimientos |
| `/requerimientos/{id}` | Detalle del requerimiento |
| `/admin/requerimientos` | Administración de requerimientos |
| `/admin/requerimientos/{id}/editar` | Gestión administrativa del requerimiento |

## Flujo principal del sistema

1. El funcionario ingresa un requerimiento.
2. El sistema guarda la solicitud en MySQL.
3. El requerimiento queda con estado inicial Pendiente.
4. El funcionario puede revisar el listado y detalle.
5. El área de Informática revisa el requerimiento.
6. Administración cambia el estado y registra una respuesta.
7. El funcionario visualiza el seguimiento actualizado.

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

## Documentación del proyecto

La documentación complementaria se encuentra en la carpeta:

`documentacion/`

Archivos incluidos:

- `01_INTERFAZ_USUARIO.md`
- `02_BACKEND_REQUERIMIENTOS.md`
- `03_FLUJO_DEL_SISTEMA.md`
- `04_CASOS_DE_PRUEBA.md`

Las capturas del sistema se agregarán posteriormente en:

`documentacion/capturas/`

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

El sistema permite registrar, listar, visualizar, administrar y actualizar requerimientos informáticos.

El flujo principal de requerimientos se encuentra funcionando:

Crear requerimiento → Guardar en MySQL → Listar → Ver detalle → Gestionar → Actualizar estado y respuesta.

## Mejoras futuras

- Login real de usuarios.
- Registro real de funcionarios.
- Roles de funcionario y administrador.
- Protección de rutas mediante middleware.
- Asociación del requerimiento al usuario autenticado.
- Notificación por correo cuando cambie el estado del requerimiento.
- Incorporación de capturas finales en la documentación.

## Conclusión

MesaTI Municipal permite centralizar la gestión de requerimientos informáticos internos, manteniendo un flujo ordenado entre funcionario y área de Informática.

El proyecto aplica Laravel, MVC, Blade, MySQL, rutas, controlador, modelo, migraciones, validaciones básicas y doc