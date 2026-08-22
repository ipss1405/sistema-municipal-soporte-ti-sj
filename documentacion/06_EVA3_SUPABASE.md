# EVA 3 – Conexión de MesaTI con Supabase

## Introducción

Para la Evaluación 3 se continuó trabajando sobre el sistema MesaTI Municipal desarrollado previamente.

La principal mejora realizada fue conectar la aplicación Laravel a una base de datos remota utilizando Supabase.

En la versión anterior, el sistema trabajaba con MySQL de forma local. Para EVA3 se cambió la conexión a PostgreSQL utilizando Supabase como servicio en la nube.

La aplicación Laravel continúa ejecutándose localmente, pero los datos ahora se almacenan en una base de datos remota.

---

## Objetivo de la implementación

El objetivo principal fue conectar MesaTI con una base de datos PostgreSQL remota para que la información ya no dependa solamente del entorno local.

El nuevo funcionamiento queda de la siguiente forma:

```text
MesaTI Laravel
      ↓
Eloquent
      ↓
PostgreSQL
      ↓
Session Pooler
      ↓
Supabase Cloud
      ↓
Base de datos remota
```

---

## Supabase

Supabase es una plataforma en la nube que permite trabajar con bases de datos PostgreSQL.

Para esta evaluación se creó un proyecto en Supabase con la siguiente configuración:

```text
Proyecto: MesaTI-Municipal-EVA3
Motor: PostgreSQL
Región: Sudamérica (São Paulo)
Plan: Gratuito
```

La región de São Paulo fue seleccionada por ser una ubicación cercana a Chile.

---

## Conexión utilizada

Para conectar Laravel local con Supabase se utilizó:

```text
Session Pooler
```

La conexión utiliza el puerto:

```text
5432
```

El flujo de conexión es:

```text
Laravel
   ↓
DB_CONNECTION=pgsql
   ↓
Session Pooler
   ↓
Supabase
   ↓
PostgreSQL
```

---

## Habilitación de PostgreSQL en PHP

Antes de conectar Laravel fue necesario habilitar las extensiones de PostgreSQL en PHP.

Se habilitaron:

```text
pdo_pgsql
pgsql
```

La comprobación se realizó mediante:

```bash
php -m | findstr /I "pgsql"
```

El resultado fue:

```text
pdo_pgsql
pgsql
```

Esto confirmó que PHP podía trabajar con PostgreSQL.

---

## Respaldo de la conexión MySQL

Antes de modificar el archivo `.env`, se creó un respaldo de la configuración anterior.

Archivo creado:

```text
.env.mysql.backup
```

Este archivo conserva la configuración utilizada anteriormente con MySQL.

También se agregó al archivo `.gitignore` para evitar que se suba a GitHub.

---

## Configuración del archivo .env

Laravel fue configurado para utilizar PostgreSQL mediante las variables de entorno.

Ejemplo:

```env
DB_CONNECTION=pgsql
DB_HOST=TU_HOST_SUPABASE
DB_PORT=5432
DB_DATABASE=postgres
DB_USERNAME=TU_USUARIO_SUPABASE
DB_PASSWORD="TU_CONTRASEÑA"
DB_SSLMODE=require
```

Por seguridad, las credenciales reales no se incluyen en la documentación ni en GitHub.

---

## Prueba de conexión

Después de configurar el archivo `.env`, se limpió la configuración de Laravel mediante:

```bash
php artisan config:clear
```

Luego se verificó la conexión utilizando:

```bash
php artisan db:show
```

Laravel mostró información de PostgreSQL remoto.

Entre los datos comprobados se encontraban:

```text
Connection: pgsql
Database: postgres
Port: 5432
PostgreSQL: 17.6
```

Con esto se confirmó que Laravel podía conectarse correctamente con Supabase.

---

## Migraciones

Al consultar inicialmente las migraciones mediante:

```bash
php artisan migrate:status
```

Laravel mostró:

```text
Migration table not found.
```

Esto era esperado porque la base de datos de Supabase todavía no tenía las tablas del proyecto.

Posteriormente se ejecutó:

```bash
php artisan migrate
```

Las migraciones finalizaron correctamente con estado:

```text
DONE
```

Se crearon las estructuras correspondientes a:

```text
users
cache
jobs
requerimientos
notificaciones
migrations
```

También se aplicaron migraciones adicionales relacionadas con:

- Rol de usuario.
- Derivación a técnico.
- Prioridad por defecto.
- Gestión técnica.

---

## Compatibilidad de migraciones

Antes de ejecutar las migraciones se revisaron instrucciones que podían estar relacionadas con MySQL.

Se buscaron elementos como:

```text
enum
change()
after()
DB::statement
unsigned
charset
collation
```

La revisión permitió confirmar que las migraciones podían ejecutarse correctamente sobre PostgreSQL.

---

## Seeders

Después de crear las tablas se ejecutaron los Seeders del proyecto.

Archivos utilizados:

```text
DatabaseSeeder.php
TecnicosSeeder.php
```

Comando:

```bash
php artisan db:seed
```

El proceso terminó correctamente.

Los datos de prueba generados fueron:

```text
1 administradora
5 funcionarios
4 técnicos
30 requerimientos
```

Los técnicos creados fueron:

```text
Gabriel Silva
David Guajardo
Carlos Saavedra
Alejandro Adio
```

---

## Comprobación de usuarios

Para comprobar que los usuarios estaban almacenados en Supabase se utilizó Tinker:

```bash
php artisan tinker
```

Luego:

```php
App\Models\User::count();
```

Resultado:

```text
10
```

Esto confirmó que los usuarios se encontraban almacenados en la base de datos remota.

---

## Comprobación de requerimientos

También se verificaron los requerimientos mediante:

```php
App\Models\Requerimiento::count();
```

Resultado inicial:

```text
30
```

Esto confirmó que los requerimientos generados mediante el Seeder estaban almacenados correctamente en Supabase.

---

## Prueba desde la interfaz

Después de comprobar la base de datos mediante consola, se inició nuevamente Laravel:

```bash
php artisan serve --port=8002
```

La aplicación se abrió mediante:

```text
http://127.0.0.1:8002
```

Se inició sesión correctamente utilizando una cuenta almacenada en Supabase.

El dashboard administrativo cargó los datos de la base remota.

---

## Prueba de escritura

Para comprobar que Laravel no solamente podía leer la base de datos, sino también escribir datos nuevos, se creó un requerimiento desde la interfaz de funcionario.

Requerimiento creado:

```text
N.º 31
Título: Apagado
Categoría: Computador
Prioridad: Sin asignar
Estado: Pendiente
```

El requerimiento apareció correctamente en la aplicación.

Esto confirmó que Laravel puede escribir información directamente en PostgreSQL remoto.

---

## Resultado de las pruebas

Las pruebas realizadas permitieron comprobar:

```text
Conexión PostgreSQL remota        ✅
Lectura de datos                  ✅
Escritura de datos                ✅
Migraciones                       ✅
Seeders                           ✅
Usuarios almacenados              ✅
Requerimientos almacenados        ✅
Inicio de sesión                  ✅
Dashboard administrativo          ✅
Creación desde interfaz           ✅
```

---

## Diferencia entre EVA2 y EVA3

### EVA2

```text
Laravel
   ↓
MySQL local
   ↓
Laragon
```

Los datos estaban almacenados en el computador local.

### EVA3

```text
Laravel local
   ↓
Internet
   ↓
Session Pooler
   ↓
Supabase
   ↓
PostgreSQL remoto
```

La principal diferencia es que ahora la información se encuentra almacenada en una base de datos remota.

---

## Seguridad

Durante la configuración se tomaron las siguientes medidas:

- El archivo `.env` no se sube a GitHub.
- Las credenciales reales de Supabase no se incluyen en el README.
- La contraseña de PostgreSQL se mantiene solamente en el entorno local.
- El respaldo `.env.mysql.backup` fue agregado a `.gitignore`.
- Se utiliza SSL mediante:

```env
DB_SSLMODE=require
```

---

## Flujo completo actual

El sistema funciona actualmente de la siguiente forma:

```text
Funcionario
      ↓
Crea requerimiento
      ↓
Laravel
      ↓
Eloquent
      ↓
Supabase PostgreSQL
      ↓
Administrador revisa
      ↓
Asigna prioridad
      ↓
Deriva a Técnico
      ↓
Técnico gestiona atención
      ↓
Funcionario recibe seguimiento
```

Todos los datos utilizados por este flujo se almacenan actualmente en PostgreSQL remoto mediante Supabase.

---

## Estado actual

Actualmente el sistema MesaTI tiene:

- Laravel funcionando localmente.
- Base de datos PostgreSQL funcionando remotamente.
- Conexión mediante Supabase.
- Roles funcionario, administrador y técnico.
- Gestión administrativa.
- Gestión técnica.
- Notificaciones.
- Dashboard.
- Filtros.
- Paginación.
- Lectura y escritura de datos remotos.

---

## Posibles mejoras futuras

A futuro se podría:

- Desplegar también la aplicación Laravel en un servidor remoto.
- Implementar una bitácora completa de cada requerimiento.
- Mejorar el historial de estados y asignaciones.
- Incorporar una agenda de atención.
- Permitir que solamente el administrador cree cuentas de usuario.
- Incorporar un proceso donde el funcionario solicite acceso al sistema.
- Mejorar los avisos y notificaciones.
- Incorporar administración de usuarios desde el panel administrativo.

---

## Conclusión

La conexión de MesaTI con Supabase se implementó correctamente.

Laravel pasó de utilizar una base de datos MySQL local a trabajar con PostgreSQL remoto mediante Supabase.

Se comprobó que la aplicación puede conectarse, ejecutar migraciones, insertar datos mediante Seeders, consultar información y crear nuevos requerimientos desde la interfaz.

Esto permite que la información del sistema se encuentre almacenada de forma remota y representa la principal mejora incorporada para EVA3.
