# Evidencias de Pruebas

## 1. Descripción general

Este documento registra las evidencias de pruebas del sistema **MesaTI Municipal – Sistema Municipal de Soporte TI**.

La documentación conserva las evidencias correspondientes a EVA2 y agrega las comprobaciones realizadas durante EVA3.

Las capturas del proyecto pueden almacenarse en:

```text
documentacion/CAPTURAS/
```

Para EVA3 se incorporan además evidencias relacionadas con:

- Rol técnico.
- Derivación de requerimientos.
- Gestión técnica.
- Notificaciones.
- Paginación.
- Conexión de Laravel con Supabase.
- Migraciones en PostgreSQL remoto.
- Seeders.
- Lectura de datos remotos.
- Escritura de datos desde la interfaz.

---

## 2. Evidencias anteriores de EVA2

Durante EVA2 se registraron capturas correspondientes a las principales funciones del sistema.

Entre las evidencias documentadas se encuentran:

| Código | Caso de prueba | Evidencia |
|---|---|---|
| CP-01 | Inicio de sesión correcto del funcionario | `CP01_login_funcionario_aprobado.png` |
| CP-02 | Inicio de sesión con contraseña incorrecta | `CP02_login_incorrecto.png` |
| CP-03 | Registro de un nuevo funcionario | `CP03_registro_funcionario.png` |
| CP-04 | Creación correcta de un requerimiento | `CP04_requerimiento_creado.png` |
| CP-05 | Validación de campos obligatorios | `CP05_validaciones_formulario.png` |
| CP-06 | Consulta de requerimientos propios | `CP06_mis_requerimientos_detalle.png` |
| CP-07 | Acceso de la administradora | `CP07_panel_administracion.png` |
| CP-08 | Actualización y notificación | `CP08_actualizacion_y_notificacion.png` |
| CP-09 | Bloqueo de acceso administrativo | `CP09_acceso_bloqueado_403.png` |
| CP-10 | Cancelación con SweetAlert2 | `CAP10_sweetalert_confirmacion.png` |
| CP-11 | Eliminación de requerimiento | `CP11_requerimiento_eliminado.png` |
| CP-12 | Notificaciones marcadas como leídas | `CP12_notificaciones_leidas.png` |

Estas evidencias corresponden a la etapa anterior del proyecto y se mantienen como respaldo histórico.

---

## 3. Evidencias complementarias de EVA2

También se registraron capturas complementarias para documentar la interfaz, navegación, cambios de estado y seguridad.

```text
CAP01_pagina_principal_sin_sesion.png
CAP01_pagina_principal_funcionario_autenticado.png
CAP02_login_funcionario_datos.png
CAP03_formulario_registro.png
CAP04_formulario_requerimiento_01.png
CAP04_notificacion_admin_requerimiento_34.png
CAP07_login_administrador_correcto.png
CAP08_detalle_requerimiento_admin_antes.png
CAP08_gestion_requerimiento_antes_01.png
CAP08_actualizacion_exitosa_admin.png
CAP08_estado_actualizado_admin.png
CAP08_estado_actualizado_funcionario.png
CAP08_detalle_actualizado_funcionario.png
CAP10_sweetalert_confirmacion.png
CAP_SEGURIDAD_cierre_sesion_correcto.png
```

---

## 4. Evidencias de la nueva versión de MesaTI

Durante la mejora del sistema se comprobó el funcionamiento del flujo con tres roles:

```text
Funcionario
    ↓
Administrador
    ↓
Técnico
    ↓
Funcionario
```

### Funcionario

Se comprobó:

- Inicio de sesión.
- Creación de requerimiento.
- Prioridad inicial `Sin asignar`.
- Estado inicial `Pendiente`.
- Consulta de requerimientos propios.
- Recepción de notificaciones.

### Administrador

Se comprobó:

- Acceso al dashboard.
- Visualización de requerimientos.
- Filtros administrativos.
- Asignación de prioridad.
- Cambio de estado.
- Derivación a técnico.
- Registro de tarea.
- Visualización del funcionario asociado.

### Técnico

Se comprobó:

- Inicio de sesión.
- Panel Técnico TI.
- Visualización de solicitudes asignadas.
- Gestión de atención.
- Registro de avance.
- Materiales.
- Tiempo estimado.
- Cambio de estado.
- Notificación al funcionario.

---

## 5. Evidencia del flujo de derivación

Durante la prueba funcional se utilizó el requerimiento:

```text
N.º 33
Título: Sin internet
Categoría: Internet
```

El administrador realizó la siguiente gestión:

```text
Prioridad: Alta
Estado: En revisión
Técnico: David Guajardo
```

Posteriormente, al iniciar sesión como David Guajardo, el requerimiento apareció correctamente en su Panel Técnico TI.

Esta prueba permitió comprobar la relación:

```text
requerimientos.tecnico_id
        ↓
Técnico responsable
```

También se verificó el registro de información de derivación:

```text
asignado_por_id
fecha_asignacion
tarea_asignada
```

---

## 6. Evidencia de gestión técnica

El técnico gestionó el requerimiento asignado y registró información de atención.

Entre los datos probados se incluyeron:

```text
Estado: En proceso
Avance técnico
Material requerido
Tiempo estimado
Información para el funcionario
```

La actualización se guardó correctamente.

Posteriormente el funcionario recibió una notificación con el título:

```text
Actualización de atención TI
```

Esto permitió comprobar el flujo:

```text
Técnico
    ↓
Actualiza atención
    ↓
Laravel
    ↓
Base de datos
    ↓
Notificación
    ↓
Funcionario
```

---

## 7. Evidencia de notificación al técnico

Durante una primera prueba de asignación, el requerimiento apareció correctamente en el panel del técnico, pero el contador de la campanita no aumentó.

Después de detectar este comportamiento se realizó una mejora en `RequerimientoController` para crear una notificación cuando existe una nueva asignación o reasignación.

La nueva lógica genera una notificación con el título:

```text
Nuevo requerimiento asignado
```

Esta mejora queda documentada como pendiente de una nueva prueba de regresión para confirmar visualmente el contador de notificaciones.

---

# Evidencias EVA3 – Supabase

## 8. Conexión PostgreSQL

Para EVA3 se cambió la conexión desde MySQL local hacia PostgreSQL remoto mediante Supabase.

Antes de realizar la conexión fue necesario habilitar:

```text
pdo_pgsql
pgsql
```

La comprobación se realizó con:

```bash
php -m | findstr /I "pgsql"
```

Resultado:

```text
pdo_pgsql
pgsql
```

Esto confirmó que PHP tenía soporte para PostgreSQL.

---

## 9. Evidencia de conexión con Supabase

Se ejecutó:

```bash
php artisan config:clear
php artisan db:show
```

El resultado confirmó:

```text
Connection: pgsql
Database: postgres
Port: 5432
PostgreSQL: 17.6
```

Esto demuestra que Laravel estaba conectado a PostgreSQL remoto y no a la antigua base MySQL local.

Nombre sugerido para la captura:

```text
EVA3_01_supabase_db_show.png
```

---

## 10. Evidencia de migraciones

Antes de crear las tablas se ejecutó:

```bash
php artisan migrate:status
```

Inicialmente Laravel indicó que la tabla de migraciones todavía no existía.

Luego se ejecutó:

```bash
php artisan migrate
```

Las migraciones finalizaron correctamente con estado:

```text
DONE
```

Entre las estructuras creadas se encuentran:

```text
users
cache
jobs
requerimientos
notificaciones
migrations
```

Además se aplicaron las migraciones relacionadas con:

- Rol.
- Derivación TI.
- Prioridad.
- Gestión técnica.

Nombre sugerido para la captura:

```text
EVA3_02_migraciones_supabase_done.png
```

---

## 11. Evidencia de Seeders

Después de las migraciones se ejecutó:

```bash
php artisan db:seed
```

El proceso terminó correctamente.

Los datos cargados fueron:

```text
1 administradora
5 funcionarios
4 técnicos
30 requerimientos
```

Nombre sugerido para la captura:

```text
EVA3_03_seeders_supabase.png
```

---

## 12. Evidencia de lectura remota mediante Tinker

Se utilizó:

```bash
php artisan tinker
```

Para consultar usuarios:

```php
App\Models\User::count();
```

Resultado:

```text
10
```

Para consultar requerimientos:

```php
App\Models\Requerimiento::count();
```

Resultado inicial:

```text
30
```

Esto confirmó que Laravel podía leer correctamente la información almacenada en Supabase.

Nombre sugerido para la captura:

```text
EVA3_04_tinker_usuarios_requerimientos.png
```

---

## 13. Evidencia de lectura desde la interfaz

Con la configuración de Supabase activa se inició Laravel mediante:

```bash
php artisan serve --port=8002
```

La aplicación estuvo disponible en:

```text
http://127.0.0.1:8002
```

Se inició sesión correctamente con una cuenta almacenada en la base remota.

El dashboard administrativo cargó los datos sin errores.

Esto confirma el flujo:

```text
Interfaz Laravel
    ↓
Eloquent
    ↓
PostgreSQL
    ↓
Supabase
```

Nombre sugerido para la captura:

```text
EVA3_05_dashboard_con_supabase.png
```

---

## 14. Evidencia de escritura remota desde la interfaz

Para comprobar que la conexión no fuera solamente de lectura, se creó un requerimiento directamente desde la interfaz.

Datos del requerimiento:

```text
N.º 31
Título: Apagado
Categoría: Computador
Prioridad: Sin asignar
Estado: Pendiente
```

El registro apareció correctamente después de ser creado.

Esto demuestra que Laravel puede escribir información en PostgreSQL remoto mediante Supabase.

Flujo comprobado:

```text
Funcionario
    ↓
Formulario Laravel
    ↓
RequerimientoController
    ↓
Modelo Eloquent
    ↓
Supabase PostgreSQL
```

Nombre sugerido para la captura:

```text
EVA3_06_requerimiento_31_supabase.png
```

---

## 15. Resumen de evidencias EVA3

| Evidencia | Comprobación | Resultado |
|---|---|---|
| PostgreSQL habilitado en PHP | `pdo_pgsql` y `pgsql` | Aprobado |
| Conexión Supabase | `php artisan db:show` | Aprobado |
| Migraciones | `php artisan migrate` | Aprobado |
| Seeders | `php artisan db:seed` | Aprobado |
| Usuarios remotos | 10 usuarios | Aprobado |
| Requerimientos iniciales | 30 requerimientos | Aprobado |
| Login con base remota | Dashboard carga correctamente | Aprobado |
| Escritura remota | Requerimiento #31 | Aprobado |
| Derivación a técnico | Requerimiento #33 | Aprobado |
| Gestión técnica | Actualización del caso | Aprobado |
| Notificación al funcionario | Actualización de atención TI | Aprobado |
| Notificación al técnico | Mejora implementada | Pendiente de nueva prueba |

---

## 16. Evidencia de seguridad

El proyecto mantiene las credenciales reales fuera del repositorio.

El archivo:

```text
.env
```

no se sube a GitHub.

Además, el respaldo de la antigua configuración MySQL:

```text
.env.mysql.backup
```

fue agregado a `.gitignore`.

Las credenciales de Supabase no se escriben en:

- README.
- Documentación.
- Repositorio público.

La conexión PostgreSQL utiliza:

```env
DB_SSLMODE=require
```

---

## 17. Evidencia documental

La documentación actual del proyecto incluye:

```text
01_INTERFAZ_USUARIO.md
02_BACKEND_REQUERIMIENTOS.md
03_FLUJO_DEL_SISTEMA.md
04_CASOS_DE_PRUEBA.md
05_EVIDENCIAS.md
06_EVA3_SUPABASE.md
```

Estos archivos documentan la evolución desde EVA2 hacia EVA3.

---

## 18. Estado actual de las pruebas

No todos los casos del documento `04_CASOS_DE_PRUEBA.md` se consideran ejecutados nuevamente después de los últimos cambios.

Por esta razón, la evidencia EVA3 diferencia entre:

```text
Pruebas comprobadas
Pruebas pendientes
Pruebas pendientes de regresión
```

Esto evita declarar un porcentaje de aprobación del 100 % cuando todavía existen casos que deben volver a ejecutarse.

Los estados oficiales de cada caso se encuentran documentados en:

```text
documentacion/04_CASOS_DE_PRUEBA.md
```

---

## Conclusión

Las evidencias permiten comprobar la evolución funcional y técnica de MesaTI Municipal.

En EVA2 se documentaron las funciones principales de autenticación, requerimientos, administración, seguridad y notificaciones.

En la versión actual se agregaron la derivación a técnicos y la gestión técnica.

Para EVA3 se comprobó además que Laravel puede conectarse a PostgreSQL remoto mediante Supabase, crear su estructura mediante migraciones, cargar datos con Seeders, consultar registros y escribir nuevos requerimientos directamente desde la interfaz.

La principal evidencia técnica de EVA3 corresponde al flujo:

```text
Laravel
    ↓
Eloquent
    ↓
Session Pooler
    ↓
Supabase
    ↓
PostgreSQL remoto
```
