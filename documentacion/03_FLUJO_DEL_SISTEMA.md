# Flujo del Sistema

## Descripción general

El Sistema Municipal de Soporte TI permite gestionar requerimientos informáticos internos desde el registro de la solicitud hasta su revisión, actualización y respuesta por parte del área de Informática.

El sistema trabaja con dos tipos de usuario:

- Funcionario municipal.
- Administrador del área de Informática.

Cada usuario debe iniciar sesión y visualiza opciones diferentes según su rol.

## Flujo de acceso al sistema

El flujo de acceso es el siguiente:

```text
Usuario ingresa al sistema
        ↓
Completa correo y contraseña
        ↓
Laravel valida las credenciales
        ↓
El sistema revisa el rol
        ↓
Funcionario → Panel funcionario
Administrador → Administración de requerimientos
```

Si las credenciales no son correctas, el sistema muestra un mensaje de error y no permite el acceso.

## Flujo de registro de usuario

El sistema permite registrar nuevos usuarios mediante el formulario de registro.

El flujo es:

```text
Usuario completa el formulario
        ↓
Laravel valida nombre, correo y contraseña
        ↓
Se crea la cuenta en la tabla users
        ↓
El usuario recibe rol funcionario
        ↓
Se inicia la sesión
        ↓
El usuario accede al panel funcionario
```

Los usuarios registrados desde la interfaz no pueden asignarse el rol administrador.

## Flujo principal del funcionario

El funcionario puede:

- Iniciar sesión.
- Acceder al panel funcionario.
- Crear un requerimiento.
- Consultar sus propios requerimientos.
- Revisar el detalle de una solicitud.
- Ver el estado y la respuesta administrativa.
- Consultar sus notificaciones.
- Cerrar sesión.

El funcionario no puede acceder a la administración ni visualizar requerimientos de otros usuarios.

## Flujo de creación de requerimiento

Cuando un funcionario crea una solicitud, el sistema realiza el siguiente proceso:

```text
Funcionario abre el formulario
        ↓
Selecciona categoría y prioridad
        ↓
Ingresa título y descripción
        ↓
Envía el formulario mediante POST
        ↓
Laravel valida los datos
        ↓
El sistema asigna el user_id del funcionario
        ↓
El modelo Requerimiento guarda en MySQL
        ↓
Se notifica a los administradores
        ↓
El funcionario vuelve a su listado
```

El formulario se encuentra en:

```text
resources/views/requerimientos/create.blade.php
```

La ruta utilizada es:

```text
POST /requerimientos
```

El método responsable es:

```text
store()
```

## Estado inicial del requerimiento

Cuando se crea una solicitud, el estado inicial es:

```text
Pendiente
```

Esto indica que el requerimiento fue registrado, pero todavía no ha sido revisado por el área de Informática.

## Flujo de notificación al administrador

Después de crear el requerimiento:

- El sistema busca a los usuarios con rol administrador.
- Crea una notificación para cada administrador.
- La campanita aumenta su contador.
- El administrador puede abrir la sección de notificaciones.
- Desde la notificación puede revisar la nueva solicitud.

La notificación queda registrada en la tabla:

```text
notificaciones
```

## Flujo de visualización del funcionario

Para consultar sus solicitudes, el funcionario ingresa a:

```text
GET /mis-requerimientos
```

El método `index()` obtiene solamente los registros asociados al usuario autenticado.

El flujo es:

```text
Funcionario abre Mis requerimientos
        ↓
Controlador obtiene Auth::id()
        ↓
Consulta los requerimientos del usuario
        ↓
Envía los datos a la vista
        ↓
La vista muestra el listado
```

La vista utilizada es:

```text
resources/views/requerimientos/index.blade.php
```

## Flujo de detalle del requerimiento

Cuando el usuario selecciona Ver detalle:

```text
Usuario selecciona un requerimiento
        ↓
Ingresa a /requerimientos/{requerimiento}
        ↓
El método show() revisa el acceso
        ↓
El sistema muestra la información
```

La vista se encuentra en:

```text
resources/views/requerimientos/show.blade.php
```

En esta pantalla se visualiza:

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

## Control de acceso al detalle

El requerimiento puede ser consultado por:

- El funcionario que lo creó.
- Un administrador.

Si otro funcionario intenta ingresar manualmente a una solicitud ajena, el sistema bloquea el acceso con error:

```text
403 - Acceso no autorizado
```

## Flujo principal del administrador

El administrador puede:

- Iniciar sesión.
- Acceder directamente a Administración.
- Consultar todos los requerimientos.
- Identificar al funcionario que creó cada solicitud.
- Abrir el detalle.
- Gestionar el estado.
- Registrar una respuesta.
- Eliminar requerimientos.
- Consultar notificaciones.
- Cerrar sesión.

## Flujo del listado administrativo

El administrador ingresa a:

```text
GET /admin/requerimientos
```

El sistema realiza:

```text
Administrador abre la vista
        ↓
Se valida su rol
        ↓
El controlador consulta todos los requerimientos
        ↓
Eager Loading carga los usuarios relacionados
        ↓
La vista muestra la información
```

La consulta utiliza:

```php
Requerimiento::with('usuario')
    ->orderBy('created_at', 'desc')
    ->get();
```

Esto permite mostrar el nombre del funcionario y evitar consultas innecesarias.

## Flujo de gestión administrativa

Para gestionar un requerimiento:

```text
Administrador selecciona Gestionar
        ↓
Se abre la vista de edición
        ↓
Cambia el estado
        ↓
Escribe una respuesta
        ↓
Envía el formulario mediante PUT
        ↓
Laravel valida la información
        ↓
El requerimiento se actualiza
        ↓
Se genera una notificación al funcionario
        ↓
El sistema vuelve a Administración
```

La vista de gestión se encuentra en:

```text
resources/views/admin/requerimientos/edit.blade.php
```

La ruta utilizada es:

```text
PUT /admin/requerimientos/{requerimiento}
```

El método responsable es:

```text
update()
```

## Estados del requerimiento

El sistema utiliza los siguientes estados:

- Pendiente.
- En revisión.
- En proceso.
- Resuelto.
- Cerrado.
- Rechazado.

Estos estados permiten representar el avance de la atención.

## Flujo de actualización del estado

Cuando el administrador cambia el estado:

- El sistema compara el estado anterior con el nuevo.
- Guarda la actualización en MySQL.
- Registra una respuesta si fue ingresada.
- Asigna fecha de cierre cuando corresponde.
- Crea una notificación para el funcionario.

Si el estado cambia a `resuelto` o `cerrado`, se registra la fecha de cierre.

## Flujo de notificación al funcionario

Después de una actualización:

```text
Administrador cambia el estado
        ↓
El sistema guarda los cambios
        ↓
Crea una notificación para el funcionario
        ↓
La campanita aumenta su contador
        ↓
El funcionario abre la notificación
        ↓
Consulta el estado actualizado
```

Cada usuario puede ver solamente sus propias notificaciones.

Cuando se abre la vista de notificaciones, estas quedan marcadas como leídas.

## Flujo de eliminación

La eliminación está disponible solamente para el administrador.

El flujo es:

```text
Administrador selecciona Eliminar
        ↓
SweetAlert2 solicita confirmación
        ↓
Administrador confirma o cancela
        ↓
El formulario envía DELETE
        ↓
El método destroy() elimina el registro
        ↓
El sistema vuelve al listado
```

La ruta utilizada es:

```text
DELETE /admin/requerimientos/{requerimiento}
```

El método responsable es:

```text
destroy()
```

Si el administrador cancela la operación, el registro no se elimina.

## Flujo técnico general

El flujo técnico aplicado en Laravel es:

```text
Vista Blade
    ↓
Ruta definida en routes/web.php
    ↓
Controlador
    ↓
Validación
    ↓
Modelo Eloquent
    ↓
Base de datos MySQL
    ↓
Redirección o vista actualizada
```

## Métodos HTTP utilizados

El sistema utiliza:

| Método | Uso |
|---|---|
| `GET` | Mostrar páginas y consultar datos |
| `POST` | Crear requerimientos y registrar usuarios |
| `PUT` | Actualizar estados y respuestas |
| `DELETE` | Eliminar requerimientos |

## Flujo resumido del sistema

El flujo general puede resumirse así:

```text
Funcionario inicia sesión
        ↓
Crea un requerimiento
        ↓
El sistema guarda la solicitud
        ↓
Administrador recibe una notificación
        ↓
Administrador revisa y gestiona
        ↓
Cambia el estado y registra respuesta
        ↓
Funcionario recibe una notificación
        ↓
Funcionario revisa el seguimiento
        ↓
El requerimiento puede quedar resuelto o cerrado
```

## Mejoras futuras

Como evolución del sistema se considera:

- Incorporar una agenda para programar fecha y hora de atención.
- Asignar requerimientos a técnicos del equipo de soporte.
- Agregar comentarios e instrucciones para el técnico asignado.
- Crear una bitácora con cambios, asignaciones y fechas.
- Incorporar notificaciones del navegador cuando el sistema esté minimizado.
- Implementar una vista de calendario.
- Publicar el sistema en un servidor institucional.

## Conclusión

El flujo del Sistema Municipal de Soporte TI permite representar un proceso completo de atención de requerimientos informáticos internos.

El sistema incorpora autenticación, roles, creación de solicitudes, gestión administrativa, control de acceso, notificaciones internas, actualización de estados y eliminación segura, manteniendo la información centralizada en Laravel y MySQL.
