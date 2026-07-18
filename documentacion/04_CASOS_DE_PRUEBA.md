# Casos de Prueba

## Descripción general

Este documento presenta casos de prueba aplicados al sistema MesaTI Municipal, con el objetivo de verificar el correcto funcionamiento de las principales funcionalidades desarrolladas.

Las pruebas se enfocan en el flujo de requerimientos informáticos, desde el ingreso de una solicitud hasta su gestión por parte del área de Informática.

## Objetivo de las pruebas

El objetivo es comprobar que el sistema permita:

- Registrar requerimientos informáticos.
- Guardar información en la base de datos.
- Listar requerimientos registrados.
- Visualizar el detalle de un requerimiento.
- Gestionar requerimientos desde administración.
- Cambiar el estado de un requerimiento.
- Registrar una respuesta del área informática.
- Eliminar requerimientos desde administración.
- Mostrar el seguimiento actualizado al funcionario.

## Alcance de las pruebas

Las pruebas consideran las siguientes secciones del sistema:

- Página principal.
- Formulario de nuevo requerimiento.
- Listado de mis requerimientos.
- Detalle del requerimiento.
- Administración de requerimientos.
- Gestión administrativa del requerimiento.
- Eliminación de requerimientos desde administración.

Actualmente el login y el registro se encuentran implementados de forma visual, por lo que no se incluyen pruebas de autenticación real.

## Caso de prueba 1: Carga de página principal

**Objetivo:** Verificar que la página principal cargue correctamente.

**Ruta:** `/`

**Pasos:**

- Abrir el navegador.
- Ingresar a `http://127.0.0.1:8000`.
- Verificar que se muestre la portada del sistema.

**Resultado esperado:**

La página principal debe mostrar:

- Logo municipal.
- Nombre MesaTI Municipal.
- Accesos rápidos.
- Información del servicio.
- Datos de contacto.
- Bloques informativos del sistema.

**Resultado obtenido:**

La página principal carga correctamente y muestra la información institucional del sistema.

**Estado:** Aprobado.

## Caso de prueba 2: Carga de formulario de requerimiento

**Objetivo:** Verificar que el formulario para registrar requerimientos cargue correctamente.

**Ruta:** `/requerimientos/crear`

**Pasos:**

- Ingresar a la ruta `/requerimientos/crear`.
- Verificar que se muestre el formulario.
- Revisar que existan los campos de categoría, título, descripción y prioridad.

**Resultado esperado:**

El sistema debe mostrar el formulario de registro de requerimientos.

**Resultado obtenido:**

El formulario carga correctamente y muestra todos los campos requeridos.

**Estado:** Aprobado.

## Caso de prueba 3: Registro de requerimiento

**Objetivo:** Verificar que el sistema permita registrar un requerimiento informático.

**Ruta:** `/requerimientos/crear`

**Datos de prueba:**

- Categoría: Internet / Red.
- Título: Desconexión de red.
- Descripción: El equipo presenta problemas de conexión a la red municipal.
- Prioridad: Urgente.

**Pasos:**

- Ingresar al formulario de nuevo requerimiento.
- Completar los campos obligatorios.
- Presionar el botón Registrar requerimiento.

**Resultado esperado:**

El sistema debe guardar el requerimiento en MySQL y redirigir al listado de requerimientos.

**Resultado obtenido:**

El requerimiento se guarda correctamente y aparece en la vista Mis requerimientos.

**Estado:** Aprobado.

## Caso de prueba 4: Validación de campos obligatorios

**Objetivo:** Verificar que el sistema valide los campos obligatorios del formulario.

**Ruta:** `/requerimientos/crear`

**Pasos:**

- Ingresar al formulario de nuevo requerimiento.
- Dejar campos obligatorios vacíos.
- Presionar Registrar requerimiento.

**Resultado esperado:**

El sistema debe impedir el registro y mostrar mensajes de validación.

**Resultado obtenido:**

Laravel valida los campos obligatorios antes de guardar el requerimiento.

**Estado:** Aprobado.

## Caso de prueba 5: Listado de requerimientos

**Objetivo:** Verificar que el sistema muestre los requerimientos registrados en la base de datos.

**Ruta:** `/mis-requerimientos`

**Pasos:**

- Ingresar a la ruta `/mis-requerimientos`.
- Revisar la tabla de requerimientos.
- Verificar que aparezca el requerimiento registrado.

**Resultado esperado:**

El sistema debe mostrar los requerimientos almacenados en MySQL.

**Resultado obtenido:**

El listado muestra correctamente los requerimientos registrados.

**Estado:** Aprobado.

## Caso de prueba 6: Visualización de detalle

**Objetivo:** Verificar que el sistema permita visualizar el detalle de un requerimiento.

**Ruta:** `/requerimientos/{id}`

**Pasos:**

- Ingresar a Mis requerimientos.
- Presionar el botón Ver detalle.
- Revisar la información mostrada.

**Resultado esperado:**

El sistema debe mostrar:

- Número de requerimiento.
- Título.
- Categoría.
- Prioridad.
- Estado.
- Fecha de ingreso.
- Descripción.
- Respuesta de informática si existe.
- Seguimiento.

**Resultado obtenido:**

El detalle del requerimiento se muestra correctamente con datos reales.

**Estado:** Aprobado.

## Caso de prueba 7: Carga de administración

**Objetivo:** Verificar que la vista de administración muestre los requerimientos registrados.

**Ruta:** `/admin/requerimientos`

**Pasos:**

- Ingresar a la ruta `/admin/requerimientos`.
- Revisar el listado de requerimientos.
- Verificar que exista la opción Gestionar.

**Resultado esperado:**

El sistema debe mostrar todos los requerimientos registrados y permitir acceder a su gestión.

**Resultado obtenido:**

La vista de administración carga correctamente y muestra los requerimientos disponibles.

**Estado:** Aprobado.

## Caso de prueba 8: Gestión de requerimiento

**Objetivo:** Verificar que administración pueda ingresar a la pantalla de gestión de un requerimiento.

**Ruta:** `/admin/requerimientos/{id}/editar`

**Pasos:**

- Ingresar a la vista de administración.
- Presionar el botón Gestionar.
- Revisar que se muestre la información del requerimiento.

**Resultado esperado:**

El sistema debe mostrar la pantalla de gestión con los datos del requerimiento seleccionado.

**Resultado obtenido:**

La pantalla de gestión carga correctamente y muestra la información del requerimiento.

**Estado:** Aprobado.

## Caso de prueba 9: Actualización de estado

**Objetivo:** Verificar que administración pueda cambiar el estado de un requerimiento.

**Ruta:** `/admin/requerimientos/{id}/editar`

**Datos de prueba:**

- Estado anterior: Pendiente.
- Estado nuevo: En revisión.

**Pasos:**

- Ingresar a la pantalla de gestión.
- Cambiar el estado del requerimiento.
- Presionar Guardar actualización.

**Resultado esperado:**

El sistema debe actualizar el estado del requerimiento y redirigir a la administración.

**Resultado obtenido:**

El estado se actualiza correctamente y se visualiza en administración y en el detalle del requerimiento.

**Estado:** Aprobado.

## Caso de prueba 10: Registro de respuesta administrativa

**Objetivo:** Verificar que administración pueda registrar una respuesta para el funcionario.

**Ruta:** `/admin/requerimientos/{id}/editar`

**Datos de prueba:**

Respuesta: Se revisa el requerimiento informado por el funcionario. El área de informática se encuentra verificando la conexión de red.

**Pasos:**

- Ingresar a la pantalla de gestión.
- Escribir una respuesta en el campo Respuesta del área informática.
- Guardar la actualización.
- Ingresar al detalle del requerimiento.

**Resultado esperado:**

La respuesta debe quedar guardada y visible para el funcionario en el detalle del requerimiento.

**Resultado obtenido:**

La respuesta se guarda correctamente y se muestra en la vista de detalle.

**Estado:** Aprobado.

## Caso de prueba 11: Visualización de etiqueta de estado

**Objetivo:** Verificar que los estados se muestren mediante el componente visual reutilizable.

**Vistas revisadas:**

- `/mis-requerimientos`.
- `/admin/requerimientos`.
- `/requerimientos/{id}`.
- `/admin/requerimientos/{id}/editar`.

**Pasos:**

- Ingresar a cada una de las vistas.
- Revisar la visualización del estado.
- Confirmar que aparezca como etiqueta de color.

**Resultado esperado:**

El estado debe mostrarse como una etiqueta visual diferenciada por color.

**Resultado obtenido:**

El componente de estado se muestra correctamente en las vistas revisadas.

**Estado:** Aprobado.

## Caso de prueba 12: Dinamismo visual de la portada

**Objetivo:** Verificar que la portada muestre efectos visuales suaves.

**Ruta:** `/`

**Pasos:**

- Ingresar a la página principal.
- Pasar el mouse sobre las tarjetas y accesos rápidos.
- Observar el comportamiento visual.

**Resultado esperado:**

Las tarjetas deben mostrar un movimiento suave y sombras dinámicas al pasar el mouse.

**Resultado obtenido:**

Los efectos visuales se ejecutan correctamente sin afectar la navegación del sistema.

**Estado:** Aprobado.

## Caso de prueba 13: Eliminar requerimiento desde administración

**Objetivo:** Verificar que el administrador pueda eliminar un requerimiento registrado utilizando la opción Eliminar desde la vista de administración.

**Ruta:** `/admin/requerimientos`

**Datos de prueba:**

- Requerimiento de prueba: Prueba eliminar.
- Acción: Botón Eliminar.
- Método utilizado: DELETE.

**Precondiciones:**

- El proyecto debe estar ejecutándose con `php artisan serve`.
- Laragon debe tener MySQL iniciado.
- Debe existir al menos un requerimiento de prueba registrado en el sistema.
- El usuario debe estar ubicado en la vista de administración de requerimientos.

**Pasos:**

- Ingresar a la ruta `/admin/requerimientos`.
- Identificar un requerimiento de prueba en la tabla.
- Presionar el botón Eliminar.
- Confirmar la eliminación en la ventana emergente del navegador.
- Verificar que el sistema redirige nuevamente a la administración.
- Revisar que el requerimiento eliminado ya no aparezca en la tabla.

**Resultado esperado:**

El sistema debe eliminar correctamente el requerimiento seleccionado, mostrar el mensaje `Requerimiento eliminado correctamente.` y quitar el registro de la tabla administrativa.

**Resultado obtenido:**

El requerimiento fue eliminado correctamente desde administración. El sistema mostró el mensaje de confirmación y el registro ya no se visualizó en la tabla.

**Estado:** Aprobado.

## Resumen de pruebas

| N° | Prueba | Estado |
|---|---|---|
| 1 | Carga de página principal | Aprobado |
| 2 | Carga de formulario de requerimiento | Aprobado |
| 3 | Registro de requerimiento | Aprobado |
| 4 | Validación de campos obligatorios | Aprobado |
| 5 | Listado de requerimientos | Aprobado |
| 6 | Visualización de detalle | Aprobado |
| 7 | Carga de administración | Aprobado |
| 8 | Gestión de requerimiento | Aprobado |
| 9 | Actualización de estado | Aprobado |
| 10 | Registro de respuesta administrativa | Aprobado |
| 11 | Visualización de etiqueta de estado | Aprobado |
| 12 | Dinamismo visual de la portada | Aprobado |
| 13 | Eliminar requerimiento desde administración | Aprobado |

## Conclusión

Las pruebas realizadas permiten comprobar que el sistema MesaTI Municipal cumple correctamente con el flujo principal de gestión de requerimientos informáticos.

El sistema permite crear, guardar, listar, visualizar, administrar, actualizar y eliminar requerimientos, además de mostrar el seguimiento y la respuesta del área informática al funcionario.

La prueba de eliminación confirma que la funcionalidad DELETE fue implementada correctamente desde la vista administrativa, cumpliendo con las operaciones principales solicitadas en la evaluación.

---