# Backend y Gestión de Requerimientos

## Descripción general

El backend de MesaTI Municipal fue desarrollado utilizando Laravel, aplicando el patrón MVC para separar las responsabilidades del sistema.

El sistema permite registrar, listar, visualizar, administrar y actualizar requerimientos informáticos ingresados por funcionarios municipales.

## Patrón MVC aplicado

Laravel trabaja bajo el patrón MVC:

- Modelo.
- Vista.
- Controlador.

En este proyecto se aplicó de la siguiente forma:

- Las vistas Blade muestran la información al usuario.
- Las rutas reciben las solicitudes del navegador.
- El controlador procesa las acciones.
- El modelo se comunica con la base de datos.
- MySQL almacena la información de los requerimientos.

## Modelo principal

El modelo utilizado para gestionar los requerimientos es `app/Models/Requerimiento.php`.

Este modelo representa la tabla `requerimientos` de la base de datos y permite trabajar con los datos mediante Eloquent ORM.

## Migración de la base de datos

Se creó una migración para generar la tabla principal del sistema.

La migración se encuentra en la carpeta `database/migrations`.

La tabla creada se llama `requerimientos`.

## Campos principales de la tabla

La tabla `requerimientos` contiene los siguientes campos:

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

Estos campos permiten registrar la información del requerimiento, su estado, la respuesta del área informática y las fechas de creación o actualización.

## Controlador principal

El controlador utilizado es `app/Http/Controllers/RequerimientoController.php`.

Este controlador contiene la lógica principal del sistema.

## Funciones implementadas en el controlador

El controlador permite:

- Listar requerimientos.
- Guardar nuevos requerimientos.
- Mostrar el detalle de un requerimiento.
- Mostrar la vista de administración.
- Editar un requerimiento desde administración.
- Actualizar el estado del requerimiento.
- Registrar la respuesta del área informática.

## Registro de requerimientos

El funcionario puede ingresar un nuevo requerimiento desde el formulario ubicado en `resources/views/requerimientos/create.blade.php`.

Al enviar el formulario, los datos se validan y se guardan en la base de datos MySQL.

## Listado de requerimientos

Los requerimientos registrados se muestran en `resources/views/requerimientos/index.blade.php`.

Esta vista muestra los datos reales almacenados en la base de datos.

## Detalle del requerimiento

Cada requerimiento puede revisarse en una vista de detalle ubicada en `resources/views/requerimientos/show.blade.php`.

En esta pantalla se visualiza:

- Número de requerimiento.
- Título.
- Categoría.
- Prioridad.
- Estado.
- Fecha de ingreso.
- Descripción.
- Respuesta del área informática.
- Seguimiento.

## Administración de requerimientos

El área de informática cuenta con una vista de administración ubicada en `resources/views/admin/requerimientos/index.blade.php`.

Desde esta vista se pueden revisar todos los requerimientos ingresados.

## Gestión del requerimiento

La pantalla de gestión se encuentra en `resources/views/admin/requerimientos/edit.blade.php`.

Desde esta pantalla el área informática puede:

- Cambiar el estado del requerimiento.
- Registrar una respuesta.
- Guardar la actualización.
- Dejar seguimiento visible para el funcionario.

## Estados disponibles

El sistema considera los siguientes estados:

- Pendiente.
- En revisión.
- En proceso.
- Resuelto.
- Cerrado.
- Rechazado.

Estos estados permiten controlar el avance del requerimiento dentro del flujo de atención.

## Validaciones aplicadas

El sistema valida los datos ingresados antes de guardarlos.

Entre las validaciones utilizadas se consideran:

- Categoría obligatoria.
- Título obligatorio.
- Descripción obligatoria.
- Prioridad obligatoria.
- Estado válido al actualizar desde administración.

## Seguridad básica aplicada

El proyecto utiliza medidas básicas de seguridad propias de Laravel:

- Uso de `@csrf` en formularios.
- Validación de datos desde el controlador.
- Uso del archivo `.env` para la configuración de base de datos.
- Separación de responsabilidades mediante MVC.
- Uso de rutas definidas en `routes/web.php`.

## Flujo backend implementado

El flujo principal del backend es:

- Formulario Blade.
- Ruta Laravel.
- Controlador.
- Modelo Requerimiento.
- Base de datos MySQL.
- Vista con datos reales.

## Conclusión

El backend de MesaTI Municipal permite gestionar requerimientos informáticos de forma funcional, utilizando Laravel, MySQL, rutas, controlador, modelo, migraciones y vistas Blade.

El sistema permite crear, listar, visualizar y actualizar requerimientos, entregando una base funcional para la gestión interna del área informática municipal.