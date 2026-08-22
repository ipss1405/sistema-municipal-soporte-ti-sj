# Evidencias de Validación y Demostración

## 1. Descripción general

Este documento registra las principales comprobaciones realizadas durante el desarrollo y prueba de **MesaTI Municipal – Sistema Municipal de Soporte TI**.

Para EVA3, las evidencias no se basarán principalmente en capturas de pantalla, ya que el funcionamiento del sistema será demostrado directamente durante la presentación.

La validación se realizará mostrando en vivo:

- Funcionamiento de MesaTI.
- Acceso según roles.
- Creación de requerimientos.
- Gestión administrativa.
- Derivación a técnicos.
- Gestión técnica.
- Notificaciones.
- Conexión de Laravel con Supabase.
- Lectura y escritura de datos en PostgreSQL remoto.

---

## 2. Forma de demostrar la EVA3

Durante la presentación se puede comprobar el funcionamiento siguiendo este flujo:

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

Además, se demostrará el flujo funcional:

```text
Funcionario
    ↓
Administrador
    ↓
Técnico
    ↓
Funcionario
```

La combinación de ambos flujos permite demostrar tanto el funcionamiento de MesaTI como la conexión remota implementada para EVA3.

---

## 3. Evidencias funcionales del sistema

### Funcionario

Se comprobó que el funcionario puede:

- Iniciar sesión.
- Acceder a su panel.
- Crear un requerimiento.
- Consultar sus propias solicitudes.
- Revisar estado y prioridad.
- Consultar el detalle.
- Recibir notificaciones.

Al crear un requerimiento, el sistema registra inicialmente:

```text
Prioridad: Sin asignar
Estado: Pendiente
```

La prioridad es definida posteriormente por el administrador.

---

## 4. Evidencia de gestión administrativa

Se comprobó que el administrador puede:

- Acceder al dashboard administrativo.
- Consultar los requerimientos.
- Identificar al funcionario que creó la solicitud.
- Filtrar requerimientos.
- Asignar prioridad.
- Cambiar estado.
- Derivar un requerimiento a un técnico.
- Registrar una tarea.
- Consultar el detalle.
- Eliminar requerimientos cuando corresponde.

Durante las pruebas se utilizó el requerimiento:

```text
N.º 33
Título: Sin internet
Categoría: Internet
```

La gestión realizada fue:

```text
Prioridad: Alta
Estado: En revisión
Técnico: David Guajardo
```

El requerimiento quedó correctamente derivado al técnico seleccionado.

---

## 5. Evidencia de derivación a técnico

La asignación de un requerimiento utiliza principalmente:

```text
requerimientos.tecnico_id
```

Este campo identifica al técnico responsable.

También se registra:

```text
asignado_por_id
fecha_asignacion
tarea_asignada
```

Esto permite conocer:

- Qué técnico fue asignado.
- Qué administrador realizó la derivación.
- Cuándo se realizó.
- Qué tarea fue indicada.

Después de la asignación, el requerimiento apareció correctamente en el panel del técnico.

---

## 6. Evidencia de gestión técnica

Se comprobó que un técnico puede acceder solamente a los requerimientos derivados a su cuenta.

Durante la gestión puede registrar:

- Estado de atención.
- Avance técnico.
- Materiales o repuestos.
- Tiempo estimado.
- Información para el funcionario.

Entre los estados técnicos se encuentran:

```text
En revisión
En proceso
En espera de materiales
En espera del funcionario
Resuelto
```

Durante las pruebas, el técnico actualizó correctamente un requerimiento y el funcionario recibió seguimiento mediante una notificación.

---

## 7. Evidencia de notificaciones

Se comprobó el funcionamiento de notificaciones en distintas etapas.

### Nuevo requerimiento

```text
Funcionario crea requerimiento
        ↓
Administrador recibe aviso
```

### Actualización administrativa

```text
Administrador actualiza
        ↓
Funcionario recibe aviso
```

### Gestión técnica

```text
Técnico actualiza atención
        ↓
Funcionario recibe aviso
```

Durante las pruebas el funcionario recibió correctamente notificaciones como:

```text
Actualización de requerimiento
Actualización de atención TI
```

La notificación al técnico al momento de una nueva asignación fue mejorada posteriormente y queda pendiente de una nueva prueba de regresión.

---

# Evidencias EVA3 – Supabase

## 8. PostgreSQL habilitado en PHP

Para permitir que Laravel se conectara con PostgreSQL se habilitaron las extensiones:

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

Esta prueba confirma que PHP dispone del controlador necesario para trabajar con PostgreSQL.

---

## 9. Conexión de Laravel con Supabase

Laravel fue configurado para utilizar:

```text
DB_CONNECTION=pgsql
```

La conexión se realiza mediante:

```text
Session Pooler
Puerto 5432
```

Para comprobar la conexión se ejecutó:

```bash
php artisan config:clear
php artisan db:show
```

Laravel mostró:

```text
Connection: pgsql
Database: postgres
Port: 5432
PostgreSQL: 17.6
```

Esta comprobación demuestra que Laravel está conectado a PostgreSQL remoto mediante Supabase.

---

## 10. Migraciones en PostgreSQL remoto

Antes de crear la estructura de MesaTI en Supabase se comprobó el estado de las migraciones.

Posteriormente se ejecutó:

```bash
php artisan migrate
```

Las migraciones finalizaron correctamente con estado:

```text
DONE
```

Se crearon las tablas y modificaciones necesarias para el sistema, incluyendo:

```text
users
requerimientos
notificaciones
migrations
cache
jobs
```

Además se aplicaron las migraciones relacionadas con:

- Roles.
- Derivación TI.
- Prioridad.
- Gestión técnica.

---

## 11. Seeders en Supabase

Después de ejecutar las migraciones se cargaron datos de prueba mediante:

```bash
php artisan db:seed
```

Se incorporaron:

```text
1 administradora
5 funcionarios
4 técnicos
30 requerimientos
```

El proceso terminó correctamente.

---

## 12. Lectura de datos remotos

Para comprobar que Laravel podía consultar la información almacenada en Supabase se utilizó Tinker.

```bash
php artisan tinker
```

Consulta de usuarios:

```php
App\Models\User::count();
```

Resultado:

```text
10
```

Consulta de requerimientos:

```php
App\Models\Requerimiento::count();
```

Resultado inicial:

```text
30
```

Esto confirma que Laravel puede leer información desde PostgreSQL remoto.

---

## 13. Escritura de datos remotos

Para comprobar que la conexión no fuera solamente de lectura se creó un nuevo requerimiento desde la interfaz web.

Datos registrados:

```text
N.º 31
Título: Apagado
Categoría: Computador
Prioridad: Sin asignar
Estado: Pendiente
```

El requerimiento fue creado correctamente desde MesaTI.

Esto permite demostrar el flujo:

```text
Funcionario
    ↓
Formulario Blade
    ↓
Ruta
    ↓
Controlador
    ↓
Modelo Eloquent
    ↓
Supabase PostgreSQL
```

Por lo tanto, Laravel puede escribir datos directamente en la base de datos remota.

---

## 14. Inicio de sesión utilizando Supabase

Con la conexión PostgreSQL activa se inició Laravel mediante:

```bash
php artisan serve --port=8002
```

La aplicación funcionó en:

```text
http://127.0.0.1:8002
```

Se inició sesión correctamente y el dashboard administrativo cargó los datos almacenados en Supabase.

Esto demuestra que la autenticación y las consultas del sistema funcionan utilizando la base de datos remota.

---

## 15. Seguridad de las credenciales

La configuración real de Supabase se mantiene en:

```text
.env
```

Este archivo no se sube a GitHub.

También se mantiene fuera del repositorio el respaldo:

```text
.env.mysql.backup
```

El archivo público:

```text
.env.example
```

contiene solamente valores de ejemplo y no incluye contraseñas reales.

La conexión utiliza:

```env
DB_SSLMODE=require
```

---

## 16. Resumen de comprobaciones EVA3

| Comprobación | Resultado |
|---|---|
| PostgreSQL habilitado en PHP | Aprobado |
| Conexión Laravel–Supabase | Aprobado |
| Migraciones en PostgreSQL remoto | Aprobado |
| Seeders | Aprobado |
| Consulta de usuarios | Aprobado |
| Consulta de requerimientos | Aprobado |
| Login con base remota | Aprobado |
| Escritura desde la interfaz | Aprobado |
| Derivación a técnico | Aprobado |
| Gestión técnica | Aprobado |
| Notificación al funcionario | Aprobado |
| Notificación al técnico al asignar | Pendiente de nueva prueba |

---

## 17. Demostración sugerida durante la presentación

Para demostrar la implementación de EVA3 se puede realizar la siguiente secuencia:

```text
1. Abrir MesaTI.

2. Mostrar el inicio de sesión.

3. Ingresar como funcionario.

4. Crear o consultar un requerimiento.

5. Ingresar como administrador.

6. Mostrar prioridad y derivación a técnico.

7. Ingresar como técnico.

8. Mostrar la gestión de atención.

9. Explicar las notificaciones.

10. Mostrar en terminal:
    php artisan db:show

11. Explicar que:
    Connection = pgsql
    Database = postgres
    PostgreSQL = remoto

12. Abrir Supabase y mostrar las tablas de MesaTI.

13. Explicar el flujo:
    Laravel → Eloquent → PostgreSQL → Supabase.
```

No es necesario ejecutar todas las pruebas nuevamente durante la exposición. La demostración debe concentrarse en el flujo principal y en comprobar que la base de datos utilizada es remota.

---

## 18. Estado de las pruebas

Los resultados detallados de cada caso se encuentran en:

```text
documentacion/04_CASOS_DE_PRUEBA.md
```

Existen casos aprobados y algunos pendientes de nueva ejecución o regresión.

Por esta razón, este documento no declara un porcentaje general de aprobación del 100 %.

---

## Conclusión

Las evidencias recopiladas permiten demostrar el funcionamiento de MesaTI Municipal y su evolución hacia EVA3.

El sistema mantiene el flujo entre funcionario, administrador y técnico, mientras Laravel administra las operaciones mediante rutas, controladores y modelos Eloquent.

La principal evidencia de EVA3 es que la aplicación pasó de depender de una base MySQL local a trabajar con PostgreSQL remoto mediante Supabase.

Durante la presentación este funcionamiento puede demostrarse directamente mediante la interfaz del sistema, comandos de Laravel y la visualización de la base de datos en Supabase.
