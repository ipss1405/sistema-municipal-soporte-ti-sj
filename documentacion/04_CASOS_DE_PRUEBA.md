# Casos de Prueba

## 1. Descripción general

Este documento reúne los casos de prueba funcionales de **MesaTI Municipal – Sistema Municipal de Soporte TI**.

Los casos originales de EVA2 se mantienen como referencia y se actualizan para reflejar la versión actual del sistema. Para EVA3 se incorporan además pruebas relacionadas con:

- Rol técnico.
- Derivación de requerimientos.
- Gestión técnica.
- Notificaciones.
- Paginación.
- Conexión remota a PostgreSQL mediante Supabase.
- Lectura y escritura de datos en la base remota.

Las pruebas se ejecutan manualmente desde la aplicación y mediante comandos de Laravel cuando corresponde.

---

## 2. Entorno de prueba actual

```text
Proyecto: MesaTI Municipal
URL local: http://127.0.0.1:8002

Aplicación: Laravel
Servidor local: Laragon
PHP: 8.3
Navegador: Google Chrome

Base de datos EVA3:
PostgreSQL remoto mediante Supabase

Región Supabase:
Sudamérica (São Paulo)

Método de conexión:
Session Pooler

Puerto:
5432
```

---

## 3. Usuarios de prueba

### Administradora

```text
Correo: rosa@sanjoaquin.cl
Contraseña: Municipal2026!
Rol: administrador
```

### Funcionaria

```text
Correo: ana.martinez@sanjoaquin.cl
Contraseña: Municipal2026!
Rol: funcionario
```

### Técnico

```text
Correo: davidguajardo@sanjoaquin.cl
Contraseña: Municipal2026!
Rol: tecnico
```

También existen otros técnicos de prueba:

```text
Gabriel Silva
Carlos Saavedra
Alejandro Adio
```

---

## 4. Estados utilizados

Cada caso puede quedar con uno de los siguientes estados:

- **Pendiente:** todavía no se ejecuta.
- **Aprobado:** el resultado coincide con lo esperado.
- **Rechazado:** el resultado no coincide con lo esperado.
- **Bloqueado:** no fue posible completar la prueba.
- **Pendiente de nueva prueba:** se realizó un ajuste posterior y debe volver a comprobarse.

---

# CP-01: Inicio de sesión correcto del funcionario

## Objetivo

Comprobar que un funcionario registrado pueda iniciar sesión y acceder a su panel.

## Precondiciones

- El servidor Laravel debe estar funcionando.
- El usuario debe existir en la base de datos.
- No debe existir otra sesión abierta.

## Pasos

1. Abrir la pantalla de inicio de sesión.
2. Ingresar correo y contraseña correctos.
3. Presionar **Iniciar sesión**.
4. Revisar la redirección.

## Resultado esperado

El sistema permite el acceso y muestra el panel funcionario.

El usuario puede visualizar:

- Crear requerimiento.
- Mis requerimientos.
- Notificaciones.
- Cerrar sesión.

## Resultado obtenido

El acceso se realizó correctamente y se mostró el panel funcionario.

## Estado

**Aprobado**

## Evidencia sugerida

```text
CP01_login_funcionario_aprobado.png
```

---

# CP-02: Inicio de sesión con contraseña incorrecta

## Objetivo

Comprobar que el sistema rechace credenciales incorrectas.

## Precondiciones

- El usuario debe existir.
- No debe existir una sesión abierta.

## Datos de prueba

```text
Correo: ana.martinez@sanjoaquin.cl
Contraseña: ClaveIncorrecta123
```

## Pasos

1. Abrir la pantalla de inicio de sesión.
2. Ingresar el correo correcto.
3. Ingresar una contraseña incorrecta.
4. Presionar **Iniciar sesión**.

## Resultado esperado

El sistema no permite el acceso y muestra un mensaje indicando que las credenciales no coinciden.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

## Evidencia sugerida

```text
CP02_login_incorrecto.png
```

---

# CP-03: Registro de un nuevo funcionario

## Objetivo

Comprobar que un usuario nuevo pueda registrarse y quede con rol funcionario.

## Precondiciones

- El correo utilizado no debe existir.
- No debe existir una sesión abierta.

## Pasos

1. Abrir la opción **Registrarse**.
2. Completar los campos.
3. Crear la cuenta.
4. Iniciar sesión con el nuevo usuario.
5. Revisar el panel mostrado.

## Resultado esperado

El sistema crea la cuenta y permite acceder al panel funcionario.

## Resultado obtenido

Se creó un nuevo funcionario sin errores y posteriormente se utilizó esa cuenta para registrar un requerimiento.

## Estado

**Aprobado**

## Evidencia sugerida

```text
CP03_registro_funcionario.png
```

---

# CP-04: Creación correcta de un requerimiento

## Objetivo

Comprobar que un funcionario pueda registrar una solicitud válida.

## Precondiciones

- El funcionario debe tener una sesión iniciada.
- Debe estar disponible el formulario de creación.

## Datos utilizados en prueba

```text
Título: Sin internet
Categoría: Internet
Descripción: Computador sin servicio internet
```

## Pasos

1. Ingresar al panel funcionario.
2. Presionar **Crear requerimiento**.
3. Completar categoría, título y descripción.
4. Registrar la solicitud.
5. Abrir **Mis requerimientos**.

## Resultado esperado

El sistema guarda el requerimiento y lo asocia al usuario autenticado.

El registro debe quedar inicialmente con:

```text
Prioridad: Sin asignar
Estado: Pendiente
```

Además debe aparecer en **Mis requerimientos**.

## Resultado obtenido

El requerimiento se creó correctamente y apareció en el listado con prioridad **Sin asignar** y estado **Pendiente**.

## Estado

**Aprobado**

## Evidencia sugerida

```text
CP04_requerimiento_creado.png
```

---

# CP-05: Validación de campos obligatorios

## Objetivo

Comprobar que el sistema no permita crear una solicitud con información obligatoria incompleta.

## Precondiciones

- El funcionario debe tener una sesión iniciada.
- Debe estar abierto el formulario de creación.

## Datos de prueba

```text
Categoría: Sin seleccionar
Título: Vacío
Descripción: Vacío
```

## Pasos

1. Abrir **Crear requerimiento**.
2. Dejar los campos obligatorios sin completar.
3. Intentar registrar la solicitud.

## Resultado esperado

El sistema no guarda el requerimiento y muestra mensajes de validación.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

---

# CP-06: Consulta de requerimientos propios

## Objetivo

Comprobar que un funcionario visualice solamente los requerimientos asociados a su cuenta.

## Precondiciones

- El funcionario debe tener sesión iniciada.
- Debe existir al menos una solicitud del usuario.

## Pasos

1. Ingresar a **Mis requerimientos**.
2. Revisar el listado.
3. Abrir **Ver detalle**.

## Resultado esperado

El sistema muestra solamente los requerimientos del usuario autenticado.

El detalle debe mostrar información como:

- Número.
- Categoría.
- Título.
- Descripción.
- Prioridad.
- Estado.
- Responsable TI cuando exista.
- Información de seguimiento.
- Fechas.

## Resultado obtenido

Durante la prueba el nuevo funcionario pudo consultar su requerimiento correctamente.

## Estado

**Aprobado**

---

# CP-07: Acceso de la administradora

## Objetivo

Comprobar que la administradora pueda iniciar sesión y acceder al dashboard administrativo.

## Precondiciones

- La administradora debe existir.
- No debe existir otra sesión abierta.

## Pasos

1. Iniciar sesión como administradora.
2. Revisar el dashboard.
3. Abrir la administración de requerimientos.

## Resultado esperado

El sistema muestra:

- Dashboard administrativo.
- Indicadores.
- Listado de requerimientos.
- Funcionario asociado.
- Prioridad.
- Estado.
- Botones Ver detalle, Gestionar y Eliminar.
- Notificaciones.

## Resultado obtenido

La administradora inició sesión correctamente y pudo consultar y gestionar los requerimientos.

## Estado

**Aprobado**

---

# CP-08: Clasificación y derivación de un requerimiento

## Objetivo

Comprobar que la administradora pueda asignar prioridad, cambiar estado y derivar una solicitud a un técnico.

## Precondiciones

- La administradora debe tener una sesión iniciada.
- Debe existir un requerimiento pendiente.

## Datos utilizados

```text
Requerimiento: #33 Sin internet
Prioridad: Alta
Estado: En revisión
Técnico: David Guajardo
```

## Pasos

1. Abrir Administración.
2. Seleccionar **Gestionar**.
3. Asignar prioridad.
4. Cambiar el estado.
5. Seleccionar técnico.
6. Registrar la tarea.
7. Guardar.

## Resultado esperado

El sistema actualiza la solicitud y registra:

- Prioridad.
- Estado.
- Técnico responsable.
- Fecha de asignación.
- Administrador que realizó la derivación.
- Tarea asignada.

El funcionario debe recibir una notificación.

## Resultado obtenido

El requerimiento #33 quedó con prioridad **Alta**, estado **En revisión** y fue derivado a **David Guajardo**. El funcionario recibió la notificación correspondiente.

## Estado

**Aprobado**

---

# CP-09: Bloqueo de acceso administrativo

## Objetivo

Comprobar que un funcionario no pueda utilizar funciones administrativas.

## Precondiciones

- El funcionario debe tener una sesión iniciada.

## Pasos

1. Iniciar sesión como funcionario.
2. Intentar acceder manualmente a una ruta administrativa.
3. Revisar la respuesta.

## Resultado esperado

El sistema bloquea el acceso y devuelve error `403`.

## Resultado obtenido

```text
Pendiente de nueva comprobación en EVA3.
```

## Estado

**Pendiente**

---

# CP-10: Cancelación de eliminación con SweetAlert2

## Objetivo

Comprobar que la administradora pueda cancelar una eliminación.

## Precondiciones

- La administradora debe tener una sesión iniciada.
- Debe existir un requerimiento de prueba.

## Pasos

1. Presionar **Eliminar**.
2. Revisar la ventana de SweetAlert2.
3. Presionar **Cancelar**.
4. Verificar el listado.

## Resultado esperado

El requerimiento permanece registrado.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

---

# CP-11: Confirmación de eliminación

## Objetivo

Comprobar que la administradora pueda eliminar un requerimiento creado para pruebas.

## Pasos

1. Seleccionar un requerimiento de prueba.
2. Presionar **Eliminar**.
3. Confirmar mediante SweetAlert2.
4. Revisar el listado.

## Resultado esperado

El sistema elimina el registro y muestra la confirmación correspondiente.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

---

# CP-12: Notificaciones del funcionario

## Objetivo

Comprobar que el funcionario reciba avisos cuando su requerimiento es actualizado.

## Precondiciones

- Debe existir un requerimiento del funcionario.
- El administrador o técnico debe realizar una actualización.

## Pasos

1. Actualizar el requerimiento desde administración.
2. Gestionar posteriormente desde el técnico.
3. Iniciar sesión como funcionario.
4. Revisar notificaciones.

## Resultado esperado

El funcionario recibe notificaciones relacionadas con los cambios realizados.

## Resultado obtenido

Se visualizaron correctamente:

```text
Actualización de requerimiento
Actualización de atención TI
```

Las notificaciones mostraron el número y título del requerimiento, además de la información de la actualización.

## Estado

**Aprobado**

---

# CP-13: Acceso del técnico a sus requerimientos asignados

## Objetivo

Comprobar que el técnico visualice los requerimientos derivados a su atención.

## Precondiciones

- Debe existir un técnico.
- El administrador debe haber asignado un requerimiento a ese técnico.

## Datos utilizados

```text
Técnico: David Guajardo
Requerimiento: #33 Sin internet
```

## Pasos

1. Iniciar sesión como David Guajardo.
2. Abrir Panel Técnico TI.
3. Revisar **Mis requerimientos asignados**.

## Resultado esperado

El requerimiento #33 aparece en el panel de David.

## Resultado obtenido

El requerimiento asignado apareció correctamente en el Panel Técnico TI.

## Estado

**Aprobado**

---

# CP-14: Gestión técnica del requerimiento

## Objetivo

Comprobar que el técnico pueda actualizar la atención de un requerimiento asignado.

## Precondiciones

- El técnico debe tener una sesión iniciada.
- El requerimiento debe estar asignado a su cuenta.

## Datos utilizados

```text
Estado: En proceso
Avance: revisión de conexión
Material requerido: cable
Tiempo estimado: durante la tarde
Información para funcionario: actualización de la atención
```

## Pasos

1. Abrir **Gestionar atención**.
2. Cambiar el estado.
3. Registrar avance.
4. Indicar materiales cuando corresponda.
5. Registrar tiempo estimado.
6. Escribir información para el funcionario.
7. Guardar.

## Resultado esperado

La información técnica queda almacenada y el funcionario recibe una actualización.

## Resultado obtenido

La gestión se guardó correctamente y el funcionario recibió una notificación de **Actualización de atención TI**.

## Estado

**Aprobado**

---

# CP-15: Notificación al técnico al momento de la asignación

## Objetivo

Comprobar que el técnico reciba una notificación cuando un administrador le asigna un nuevo requerimiento.

## Precondiciones

- Debe existir un requerimiento sin técnico.
- Debe existir un técnico registrado.

## Pasos

1. Iniciar sesión como administrador.
2. Asignar el requerimiento a un técnico.
3. Guardar.
4. Iniciar sesión como el técnico.
5. Revisar el contador de notificaciones.

## Resultado esperado

El técnico recibe una notificación con información del requerimiento asignado.

## Resultado obtenido

Durante la primera prueba el requerimiento sí apareció en el panel técnico, pero el contador de la campanita no aumentó.

Se incorporó posteriormente una mejora en `RequerimientoController` para generar la notificación al momento de una nueva asignación o reasignación.

## Estado

**Pendiente de nueva prueba**

---

# CP-16: Conexión de Laravel con Supabase

## Objetivo

Comprobar que Laravel pueda conectarse a PostgreSQL remoto mediante Supabase.

## Precondiciones

- Extensiones `pdo_pgsql` y `pgsql` habilitadas.
- `.env` configurado para PostgreSQL.
- Credenciales válidas de Supabase.

## Pasos

1. Ejecutar:

```bash
php artisan config:clear
```

2. Ejecutar:

```bash
php artisan db:show
```

## Resultado esperado

Laravel muestra información de PostgreSQL remoto.

## Resultado obtenido

La conexión se realizó correctamente.

Se verificó:

```text
Connection: pgsql
Database: postgres
Port: 5432
PostgreSQL: 17.6
```

## Estado

**Aprobado**

## Evidencia sugerida

```text
CP16_supabase_db_show.png
```

---

# CP-17: Creación de tablas mediante migraciones en Supabase

## Objetivo

Comprobar que las migraciones Laravel se ejecuten correctamente sobre PostgreSQL remoto.

## Pasos

1. Ejecutar:

```bash
php artisan migrate
```

2. Revisar el resultado.

## Resultado esperado

Las migraciones deben finalizar correctamente y crear las tablas de MesaTI.

## Resultado obtenido

Todas las migraciones finalizaron con estado:

```text
DONE
```

Se crearon las estructuras de:

```text
users
cache
jobs
requerimientos
notificaciones
migrations
```

y las modificaciones posteriores del proyecto.

## Estado

**Aprobado**

## Evidencia sugerida

```text
CP17_migraciones_supabase_done.png
```

---

# CP-18: Carga de datos mediante Seeders en Supabase

## Objetivo

Comprobar que los datos de prueba puedan insertarse en PostgreSQL remoto.

## Pasos

1. Ejecutar:

```bash
php artisan db:seed
```

2. Revisar el resultado.

## Resultado esperado

Los Seeders finalizan sin errores.

## Resultado obtenido

El proceso finalizó correctamente.

Se cargaron:

```text
1 administradora
5 funcionarios
4 técnicos
30 requerimientos
```

## Estado

**Aprobado**

---

# CP-19: Comprobación de datos remotos mediante Tinker

## Objetivo

Comprobar que Laravel pueda consultar los registros almacenados en Supabase.

## Pasos

1. Ejecutar:

```bash
php artisan tinker
```

2. Consultar usuarios:

```php
App\Models\User::count();
```

3. Consultar requerimientos:

```php
App\Models\Requerimiento::count();
```

## Resultado esperado

```text
Usuarios: 10
Requerimientos iniciales: 30
```

## Resultado obtenido

```text
Usuarios: 10
Requerimientos: 30
```

## Estado

**Aprobado**

---

# CP-20: Inicio de sesión utilizando datos almacenados en Supabase

## Objetivo

Comprobar que MesaTI pueda autenticar usuarios utilizando la base remota.

## Precondiciones

- Supabase debe estar configurado en `.env`.
- Los Seeders deben haberse ejecutado.

## Pasos

1. Reiniciar Laravel.
2. Abrir `http://127.0.0.1:8002`.
3. Iniciar sesión como administradora.
4. Revisar el dashboard.

## Resultado esperado

El sistema autentica al usuario y carga la información almacenada en Supabase.

## Resultado obtenido

La administradora inició sesión correctamente y el dashboard cargó los datos de la base remota.

## Estado

**Aprobado**

---

# CP-21: Escritura desde la interfaz hacia Supabase

## Objetivo

Comprobar que Laravel pueda guardar un nuevo requerimiento directamente en PostgreSQL remoto.

## Precondiciones

- Laravel conectado a Supabase.
- Funcionario autenticado.

## Datos utilizados

```text
N.º generado: 31
Título: Apagado
Categoría: Computador
Prioridad inicial: Sin asignar
Estado inicial: Pendiente
```

## Pasos

1. Iniciar sesión como funcionario.
2. Crear un nuevo requerimiento.
3. Abrir **Mis requerimientos**.
4. Revisar el nuevo registro.

## Resultado esperado

El requerimiento se guarda correctamente en la base remota y aparece en la interfaz.

## Resultado obtenido

El requerimiento #31 se creó correctamente con estado **Pendiente** y prioridad **Sin asignar**.

## Estado

**Aprobado**

## Evidencia sugerida

```text
CP21_escritura_supabase_requerimiento31.png
```

---

# CP-22: Paginación administrativa

## Objetivo

Comprobar que el listado administrativo muestre los requerimientos de 10 en 10.

## Precondiciones

- Deben existir más de 10 requerimientos.

## Pasos

1. Iniciar sesión como administrador.
2. Abrir el listado de requerimientos.
3. Cambiar de página.
4. Aplicar un filtro y revisar la paginación.

## Resultado esperado

El sistema utiliza paginación real de Laravel y mantiene los filtros al cambiar de página.

## Resultado obtenido

La paginación administrativa se comprobó correctamente durante la modernización del listado.

## Estado

**Aprobado**

---

# Resumen de ejecución

| Código | Caso de prueba | Estado |
|---|---|---|
| CP-01 | Inicio de sesión correcto del funcionario | Aprobado |
| CP-02 | Inicio de sesión con contraseña incorrecta | Pendiente |
| CP-03 | Registro de un nuevo funcionario | Aprobado |
| CP-04 | Creación correcta de un requerimiento | Aprobado |
| CP-05 | Validación de campos obligatorios | Pendiente |
| CP-06 | Consulta de requerimientos propios | Aprobado |
| CP-07 | Acceso de la administradora | Aprobado |
| CP-08 | Clasificación y derivación | Aprobado |
| CP-09 | Bloqueo de acceso administrativo | Pendiente |
| CP-10 | Cancelación de eliminación | Pendiente |
| CP-11 | Confirmación de eliminación | Pendiente |
| CP-12 | Notificaciones del funcionario | Aprobado |
| CP-13 | Acceso del técnico a requerimientos asignados | Aprobado |
| CP-14 | Gestión técnica | Aprobado |
| CP-15 | Notificación al técnico al asignar | Pendiente de nueva prueba |
| CP-16 | Conexión Laravel–Supabase | Aprobado |
| CP-17 | Migraciones en Supabase | Aprobado |
| CP-18 | Seeders en Supabase | Aprobado |
| CP-19 | Consulta remota mediante Tinker | Aprobado |
| CP-20 | Login utilizando Supabase | Aprobado |
| CP-21 | Escritura desde interfaz hacia Supabase | Aprobado |
| CP-22 | Paginación administrativa | Aprobado |

---

## Conclusión

Las pruebas realizadas permiten comprobar el funcionamiento de las principales características de MesaTI Municipal.

La versión actual fue validada en distintos puntos del flujo:

```text
Funcionario
    ↓
Administrador
    ↓
Técnico
    ↓
Funcionario
```

También se comprobó la integración correspondiente a EVA3:

```text
Laravel
    ↓
Eloquent
    ↓
PostgreSQL
    ↓
Supabase Cloud
```

Las pruebas confirmaron lectura y escritura remota, ejecución de migraciones, carga de Seeders, autenticación, gestión administrativa, gestión técnica, notificaciones y paginación.

Los casos que todavía aparecen como pendientes se mantienen documentados para una futura ejecución o regresión.
