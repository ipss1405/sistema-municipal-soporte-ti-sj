# Flujo del Sistema

## Descripción general

MesaTI Municipal permite gestionar solicitudes de soporte informático desde que un funcionario registra un requerimiento hasta que el área de Informática lo revisa, lo deriva a un técnico y realiza el seguimiento correspondiente.

En la versión EVA3, el flujo mantiene la lógica de Laravel, pero los datos se almacenan de forma remota en PostgreSQL mediante Supabase.

El sistema trabaja con tres roles:

```text
Funcionario
Administrador
Técnico
```

Cada rol participa en una etapa distinta del proceso.

---

## Flujo general del sistema

```text
Funcionario
    ↓
Inicia sesión
    ↓
Crea requerimiento
    ↓
Estado: Pendiente
Prioridad: Sin asignar
    ↓
Administrador recibe notificación
    ↓
Revisa requerimiento
    ↓
Asigna prioridad
    ↓
Cambia estado
    ↓
Deriva a Técnico TI
    ↓
Técnico recibe el requerimiento
    ↓
Gestiona atención
    ↓
Registra avance / materiales / tiempo
    ↓
Funcionario recibe seguimiento
    ↓
Técnico marca Resuelto
    ↓
Administrador realiza cierre definitivo
```

---

## 1. Inicio de sesión

El usuario ingresa al sistema mediante correo electrónico y contraseña.

Después de validar las credenciales, Laravel revisa el campo:

```text
users.rol
```

Según el rol, el usuario es dirigido al panel correspondiente.

```text
funcionario
    ↓
Panel funcionario

administrador
    ↓
Dashboard administrativo

tecnico
    ↓
Panel Técnico TI
```

---

## 2. Flujo del funcionario

El funcionario puede registrar solicitudes y revisar solamente sus propios requerimientos.

Flujo:

```text
Funcionario
    ↓
Panel funcionario
    ↓
Crear requerimiento
    ↓
Completa:
Categoría
Título
Descripción
    ↓
Registrar requerimiento
```

El funcionario no selecciona la prioridad.

Cuando el requerimiento se crea, Laravel registra automáticamente:

```text
user_id = usuario autenticado
prioridad = sin_asignar
estado = pendiente
```

Después:

```text
Requerimiento creado
    ↓
Se guarda en PostgreSQL
    ↓
Supabase
    ↓
Se genera notificación
    ↓
Administrador
```

El funcionario puede consultar el registro desde:

```text
Mis requerimientos
```

y revisar:

- Número.
- Título.
- Categoría.
- Prioridad.
- Estado.
- Fecha.
- Detalle.
- Seguimiento.

---

## 3. Flujo del administrador

El administrador revisa los requerimientos creados por los funcionarios.

Flujo:

```text
Administrador
    ↓
Dashboard
    ↓
Listado de requerimientos
    ↓
Selecciona Gestionar
```

Desde la gestión administrativa puede:

- Asignar prioridad.
- Cambiar estado.
- Seleccionar un técnico.
- Registrar una tarea.
- Escribir información para el funcionario.

Ejemplo:

```text
Requerimiento pendiente
    ↓
Prioridad: Alta
    ↓
Estado: En revisión
    ↓
Técnico: David Guajardo
    ↓
Tarea asignada
```

Cuando se realiza una derivación, el sistema registra información como:

```text
tecnico_id
asignado_por_id
fecha_asignacion
tarea_asignada
```

---

## 4. Derivación al técnico

La relación con el técnico se realiza mediante:

```text
requerimientos.tecnico_id
```

Este campo indica qué usuario con rol técnico queda responsable de la atención.

También se registra:

```text
requerimientos.asignado_por_id
```

que identifica al administrador que realizó la derivación.

Flujo:

```text
Administrador
    ↓
Selecciona técnico
    ↓
Laravel actualiza requerimiento
    ↓
tecnico_id
    ↓
Técnico puede visualizar el caso
```

El técnico solamente puede acceder a los requerimientos que tiene asignados.

---

## 5. Flujo del técnico

El técnico inicia sesión y accede a su Panel Técnico TI.

El panel muestra solamente los requerimientos asociados a su cuenta.

```text
Técnico
    ↓
Panel Técnico TI
    ↓
Mis requerimientos asignados
    ↓
Gestionar atención
```

Durante la gestión técnica puede registrar:

- Estado de atención.
- Avance realizado.
- Si requiere materiales.
- Materiales o repuestos.
- Tiempo estimado.
- Información para el funcionario.

Estados disponibles para el técnico:

```text
En revisión
En proceso
En espera de materiales
En espera del funcionario
Resuelto
```

El técnico puede avanzar hasta:

```text
Resuelto
```

El cierre definitivo corresponde al administrador.

---

## 6. Flujo de materiales

Si el técnico indica que necesita materiales o repuestos, la interfaz muestra automáticamente los campos correspondientes.

```text
¿Requiere materiales?
        ↓
       Sí
        ↓
Materiales requeridos
        ↓
Tiempo estimado
```

Si selecciona:

```text
No
```

el sistema muestra solamente el campo general de tiempo estimado.

Esta interacción se controla mediante JavaScript en la vista de gestión técnica.

---

## 7. Seguimiento para el funcionario

Cuando el administrador o técnico actualiza el requerimiento, el funcionario puede consultar el nuevo estado y la información entregada.

Flujo:

```text
Administrador / Técnico
        ↓
Actualiza requerimiento
        ↓
Se guarda información
        ↓
Se genera notificación
        ↓
Funcionario
        ↓
Consulta seguimiento
```

La información visible para el funcionario puede incluir:

- Estado.
- Prioridad.
- Técnico responsable.
- Avance.
- Información de atención.
- Fechas.

---

## 8. Flujo de notificaciones

Las notificaciones se relacionan con usuarios y requerimientos.

Campos principales:

```text
notificaciones.user_id
notificaciones.requerimiento_id
```

### Cuando el funcionario crea un requerimiento

```text
Funcionario
    ↓
Crea solicitud
    ↓
Notificación
    ↓
Administrador
```

### Cuando el administrador actualiza o deriva

```text
Administrador
    ↓
Actualiza prioridad / estado / técnico
    ↓
Notificación
    ↓
Funcionario
```

Cuando corresponde una nueva asignación o reasignación, el sistema también puede generar una notificación al técnico.

### Cuando el técnico gestiona

```text
Técnico
    ↓
Actualiza atención
    ↓
Notificación
    ↓
Funcionario
```

---

## 9. Flujo del detalle del requerimiento

La vista de detalle es compartida, pero la información cambia según el rol.

### Funcionario

Puede visualizar información relacionada con su solicitud y seguimiento.

### Administrador

Puede visualizar información administrativa, derivación y gestión interna.

### Técnico asignado

Puede visualizar la información necesaria para atender el caso.

El control de acceso considera:

```text
Funcionario propietario
Administrador
Técnico asignado
```

Si un usuario no cumple alguna de estas condiciones, el sistema puede responder con:

```text
403
```

---

## 10. Flujo de datos con Supabase

En EVA3 la aplicación continúa funcionando desde Laravel local, pero la base de datos se encuentra en Supabase.

El flujo técnico es:

```text
Usuario
    ↓
Vista Blade
    ↓
Ruta
    ↓
Controlador
    ↓
Modelo Eloquent
    ↓
DB_CONNECTION=pgsql
    ↓
Session Pooler
    ↓
Supabase Cloud
    ↓
PostgreSQL remoto
```

Esto significa que acciones como:

```text
Crear requerimiento
Actualizar estado
Asignar técnico
Registrar avance
Crear notificación
```

se almacenan directamente en PostgreSQL remoto.

---

## 11. Flujo de creación en backend

```text
Funcionario completa formulario
        ↓
POST /requerimientos
        ↓
RequerimientoController::store()
        ↓
Validación
        ↓
Requerimiento::create()
        ↓
Eloquent
        ↓
Supabase PostgreSQL
        ↓
Notificación al administrador
        ↓
Redirección a Mis requerimientos
```

---

## 12. Flujo de gestión administrativa

```text
Administrador
    ↓
Gestionar requerimiento
    ↓
PUT
    ↓
RequerimientoController::update()
    ↓
Validación
    ↓
Actualiza:
prioridad
estado
tecnico_id
asignado_por_id
fecha_asignacion
tarea_asignada
respuesta_admin
    ↓
Supabase PostgreSQL
    ↓
Notificaciones
```

---

## 13. Flujo de gestión técnica

```text
Técnico
    ↓
Gestionar atención
    ↓
PUT
    ↓
Controlador de gestión técnica
    ↓
Validación
    ↓
Actualiza:
estado
avance_tecnico
requiere_materiales
materiales_requeridos
tiempo_estimado
respuesta_admin
    ↓
Supabase PostgreSQL
    ↓
Notificación al funcionario
```

---

## 14. Flujo de cierre

El técnico puede marcar la atención como:

```text
Resuelto
```

Luego el administrador puede realizar el cierre definitivo.

```text
Técnico
    ↓
Resuelto
    ↓
Administrador revisa
    ↓
Cerrado
```

Esta separación permite distinguir entre:

```text
Trabajo técnico terminado
```

y:

```text
Cierre administrativo del requerimiento
```

---

## 15. Flujo resumido para presentación

```text
1. El funcionario crea una solicitud.

2. Laravel la guarda en PostgreSQL remoto mediante Supabase.

3. El administrador recibe el requerimiento.

4. El administrador asigna prioridad y técnico.

5. El técnico recibe el caso y registra la atención.

6. El funcionario recibe seguimiento y notificaciones.

7. El técnico puede marcar el caso como resuelto.

8. El administrador realiza el cierre definitivo.
```

---

## Diferencia entre EVA2 y EVA3

### EVA2

```text
Laravel
    ↓
MySQL local
```

### EVA3

```text
Laravel local
    ↓
Eloquent
    ↓
PostgreSQL
    ↓
Session Pooler
    ↓
Supabase Cloud
```

El flujo funcional del sistema se mantiene, pero los datos ya no dependen solamente de una base local.

---

## Conclusión

El flujo actual de MesaTI Municipal conecta las funciones de los tres roles del sistema:

```text
Funcionario
    ↓
Administrador
    ↓
Técnico
    ↓
Funcionario
```

Laravel controla las rutas, validaciones y operaciones del sistema, mientras Eloquent administra las relaciones y el acceso a los datos.

En EVA3, estos datos se almacenan remotamente en PostgreSQL mediante Supabase, permitiendo mantener el mismo flujo funcional con una base de datos en la nube.
