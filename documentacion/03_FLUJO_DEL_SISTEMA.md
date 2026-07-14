# Flujo del Sistema

## Descripción general

El sistema MesaTI Municipal permite gestionar requerimientos informáticos internos desde el ingreso de la solicitud hasta su revisión y respuesta por parte del área de Informática.

El flujo principal está pensado para dos tipos de uso:

- Funcionario municipal.
- Área de Informática / administración.

Actualmente el login y los roles reales se encuentran considerados como mejora futura, pero el flujo funcional de requerimientos ya se encuentra implementado.

## Flujo principal del funcionario

El funcionario puede ingresar al sistema y registrar una solicitud de soporte informático.

El flujo es el siguiente:

- El funcionario ingresa a la página principal.
- Accede al formulario de nuevo requerimiento.
- Selecciona la categoría del requerimiento.
- Ingresa el título.
- Describe el problema o solicitud.
- Selecciona la prioridad.
- Envía el formulario.
- El sistema registra el requerimiento en la base de datos.
- El requerimiento queda con estado inicial Pendiente.
- El funcionario puede revisar el listado de requerimientos.
- El funcionario puede ingresar al detalle del requerimiento.
- El funcionario puede ver el estado y la respuesta del área informática.

## Flujo principal de administración

El área de Informática puede revisar los requerimientos ingresados y gestionar su avance.

El flujo es el siguiente:

- Administración ingresa a la vista de requerimientos.
- Revisa el listado completo de solicitudes registradas.
- Selecciona un requerimiento mediante la opción Gestionar.
- Revisa la información ingresada por el funcionario.
- Cambia el estado del requerimiento.
- Escribe una respuesta o gestión realizada.
- Guarda la actualización.
- El sistema actualiza la información en MySQL.
- El funcionario puede visualizar el nuevo estado y la respuesta en el detalle del requerimiento.

## Flujo técnico del sistema

El flujo técnico aplicado en Laravel es el siguiente:

- El usuario interactúa con una vista Blade.
- La acción es enviada a una ruta definida en `routes/web.php`.
- La ruta llama a un método del controlador `RequerimientoController`.
- El controlador valida y procesa los datos.
- El modelo `Requerimiento` se comunica con la base de datos.
- MySQL almacena o actualiza la información.
- Laravel retorna una vista con los datos actualizados.

## Flujo de creación de requerimiento

Cuando se crea un requerimiento, el sistema realiza el siguiente proceso:

- El usuario completa el formulario en `resources/views/requerimientos/create.blade.php`.
- El formulario envía los datos mediante método POST.
- La ruta `POST /requerimientos` recibe la solicitud.
- El método `store` del controlador valida los datos.
- El modelo `Requerimiento` guarda la información.
- El registro queda almacenado en la tabla `requerimientos`.
- El sistema redirige al listado de requerimientos.
- Se muestra el requerimiento recién creado.

## Flujo de visualización

Para visualizar los requerimientos, el sistema realiza el siguiente proceso:

- El usuario ingresa a la ruta `/mis-requerimientos`.
- El método `index` obtiene los registros desde MySQL.
- Los datos se envían a la vista `resources/views/requerimientos/index.blade.php`.
- La vista muestra el listado de requerimientos registrados.
- Cada requerimiento tiene una opción para ver el detalle.

## Flujo de detalle

Para revisar un requerimiento específico, el sistema realiza el siguiente proceso:

- El usuario selecciona Ver detalle.
- El sistema ingresa a la ruta `/requerimientos/{id}`.
- El método `show` recibe el requerimiento correspondiente.
- La vista `resources/views/requerimientos/show.blade.php` muestra la información completa.
- Se visualiza el estado, la descripción, la respuesta de informática y el seguimiento.

## Flujo de gestión administrativa

Para gestionar un requerimiento, el sistema realiza el siguiente proceso:

- Administración ingresa a `/admin/requerimientos`.
- El sistema muestra todos los requerimientos registrados.
- Administración selecciona Gestionar.
- Se abre la vista `resources/views/admin/requerimientos/edit.blade.php`.
- Administración cambia el estado del requerimiento.
- Administración ingresa una respuesta.
- El formulario envía la actualización mediante método PUT.
- El método `update` del controlador guarda los cambios.
- El sistema redirige nuevamente a administración.
- El funcionario puede revisar el estado actualizado.

## Estados del requerimiento

El sistema utiliza los siguientes estados:

- Pendiente.
- En revisión.
- En proceso.
- Resuelto.
- Cerrado.
- Rechazado.

Estos estados permiten representar el avance del requerimiento dentro del proceso de atención informática.

## Seguimiento del requerimiento

El seguimiento se muestra en la vista de detalle del requerimiento.

Esta sección permite revisar:

- Estado actual.
- Fecha de ingreso.
- Última actualización.
- Fecha de cierre si corresponde.
- Respuesta del área informática.

## Flujo resumido

El flujo general del sistema puede resumirse así:

- Funcionario registra requerimiento.
- Sistema guarda en MySQL.
- Funcionario visualiza el listado.
- Funcionario revisa el detalle.
- Administración gestiona el requerimiento.
- Administración cambia estado y registra respuesta.
- Sistema actualiza la información.
- Funcionario visualiza el seguimiento actualizado.

## Mejora futura

Como mejora futura se considera implementar:

- Login real de usuarios.
- Registro real de funcionarios.
- Roles de funcionario y administrador.
- Protección de rutas.
- Asociación del requerimiento al usuario autenticado.
- Notificación por correo cuando cambie el estado del requerimiento.

## Conclusión

El flujo del sistema permite representar un proceso completo de atención de requerimientos informáticos internos.

MesaTI Municipal permite centralizar las solicitudes, mantener trazabilidad del estado y entregar una respuesta visible para el funcionario, apoyando la gestión del área informática municipal.