# Interfaz de Usuario

## Descripción general

La interfaz de MesaTI Municipal fue diseñada para el uso interno de funcionarios municipales y del área de Informática.

La versión actual mantiene una navegación simple, pero incorpora una presentación más moderna y ordenada mediante Tabler UI, colores institucionales, tarjetas informativas, tablas compactas y accesos adaptados según el rol del usuario.

El sistema actualmente contempla tres perfiles:

```text
Funcionario
Administrador
Técnico
```

Cada perfil visualiza solamente las opciones que necesita para realizar sus funciones dentro del flujo de atención.

---

## Objetivo de la interfaz

El objetivo principal es que los usuarios puedan identificar rápidamente qué acciones pueden realizar y acceder a ellas sin navegar por opciones innecesarias.

La interfaz busca ser:

- Clara.
- Ordenada.
- Fácil de utilizar.
- Adaptable a distintos tamaños de pantalla.
- Coherente con un entorno institucional municipal.
- Diferenciada según el rol del usuario.
- Consistente entre las distintas secciones del sistema.

---

## Diseño institucional

La interfaz utiliza elementos asociados a la identidad visual municipal.

Entre ellos se encuentran:

- Logo de la Municipalidad de San Joaquín.
- Nombre MesaTI Municipal.
- Colores institucionales.
- Menú superior.
- Tarjetas informativas.
- Botones de acción.
- Etiquetas de prioridad y estado.
- Diseño responsive.

Los colores utilizados principalmente son:

```text
Morado:  #5B3F95
Verde:   #78BE20
Rojo:    #EF3E24
Naranjo: #F26B21
```

La modernización visual utiliza Tabler UI como apoyo para formularios, tablas, tarjetas y otros componentes.

---

## Página principal

La página principal presenta el acceso a MesaTI Municipal y mantiene una estructura simple para no mostrar información innecesaria.

### Usuario sin iniciar sesión

Puede acceder a:

- Iniciar sesión.
- Registrarse.

### Usuario autenticado

Después de iniciar sesión, las opciones cambian según el rol.

El sistema dirige al usuario al panel correspondiente.

```text
Funcionario
    ↓
Panel funcionario

Administrador
    ↓
Panel administrativo

Técnico
    ↓
Panel Técnico TI
```

---

## Login y registro

El sistema cuenta con inicio de sesión y registro funcionales.

En el login se solicita:

- Correo electrónico.
- Contraseña.
- Opción para mostrar u ocultar la contraseña.

Después de validar las credenciales, Laravel revisa el rol almacenado en la tabla `users` y dirige al usuario al panel correspondiente.

Actualmente, los usuarios creados mediante el formulario de registro ingresan como funcionarios.

Como mejora futura se propone reemplazar el registro público por un proceso donde el funcionario solicite acceso y el administrador sea quien cree o autorice la cuenta.

---

## Panel funcionario

El panel funcionario concentra las dos acciones principales del usuario:

- Crear requerimiento.
- Consultar sus requerimientos.

La pantalla utiliza una cabecera institucional y dos tarjetas principales.

El funcionario no selecciona la prioridad al momento de crear la solicitud.

La interfaz informa que la prioridad será asignada posteriormente por el área de Informática.

---

## Crear requerimiento

La vista de creación permite registrar una nueva solicitud de soporte.

El formulario contiene:

- Categoría.
- Título.
- Descripción del problema o solicitud.

La prioridad no aparece como campo editable para el funcionario.

Al registrar un requerimiento, el sistema lo crea inicialmente con:

```text
Prioridad: Sin asignar
Estado: Pendiente
```

La vista utiliza campos con estilo Tabler y mensajes de validación cuando corresponde.

---

## Mis requerimientos

La vista permite al funcionario consultar solamente sus propias solicitudes.

La tabla muestra:

- Número del requerimiento.
- Título.
- Categoría.
- Prioridad.
- Estado.
- Fecha de ingreso.
- Acción para ver el detalle.

La prioridad se representa mediante etiquetas visuales para facilitar su identificación.

Los resultados se muestran mediante paginación de Laravel de 10 registros por página.

Desde esta pantalla también se puede:

- Crear un nuevo requerimiento.
- Volver al panel funcionario.
- Abrir el detalle de una solicitud.

---

## Panel administrativo

El administrador dispone de un dashboard que resume información general del sistema.

Entre los indicadores disponibles se encuentran:

- Usuarios registrados.
- Total de requerimientos.
- Requerimientos con prioridad urgente.
- Requerimientos pendientes.
- Requerimientos en proceso.
- Requerimientos resueltos.

También se muestra un resumen por categoría.

Desde el panel se puede acceder a:

- Gestión de requerimientos.
- Notificaciones.
- Navegación general de MesaTI.

---

## Administración de requerimientos

La vista administrativa permite consultar los requerimientos registrados por los funcionarios.

La tabla muestra información como:

- Número.
- Funcionario.
- Título.
- Categoría.
- Prioridad.
- Estado.
- Fecha de ingreso.
- Acciones.

Las acciones principales son:

- Ver detalle.
- Gestionar.
- Eliminar.

El administrador dispone de filtros por:

- Estado.
- Prioridad.
- Categoría.
- Funcionario.

Los resultados se muestran con paginación de 10 registros por página.

La eliminación utiliza SweetAlert2 para solicitar confirmación antes de eliminar un registro.

---

## Gestión administrativa

La pantalla de gestión permite al administrador clasificar y derivar un requerimiento.

El administrador puede:

- Asignar prioridad.
- Modificar el estado.
- Seleccionar un técnico.
- Registrar una tarea para el técnico.
- Escribir información para el funcionario.

También se muestran datos relacionados con la derivación:

- Responsable TI.
- Administrador que realizó la asignación.
- Fecha de asignación.
- Tarea asignada.

---

## Panel Técnico TI

El técnico dispone de un panel propio.

La cabecera identifica al usuario conectado y muestra indicadores como:

- Total asignados.
- Pendientes.
- En revisión.
- En proceso o espera.
- Resueltos.

La tabla muestra únicamente los requerimientos derivados al técnico autenticado.

Entre los datos visibles se encuentran:

- Número del requerimiento.
- Funcionario.
- Título.
- Categoría.
- Prioridad.
- Estado.
- Fecha de asignación.

Las acciones disponibles son:

- Ver requerimiento.
- Gestionar atención.

---

## Gestión de atención técnica

La vista de gestión técnica permite registrar el trabajo realizado por el técnico.

La pantalla muestra primero un resumen del requerimiento:

- Funcionario.
- Título.
- Categoría.
- Prioridad.
- Estado actual.
- Responsable TI.
- Fecha de asignación.
- Tarea asignada.

Luego el técnico puede registrar:

- Estado de atención.
- Avance o trabajo realizado.
- Si requiere materiales o repuestos.
- Materiales requeridos.
- Tiempo estimado.
- Información para el funcionario.

Los estados disponibles para la gestión técnica incluyen:

```text
En revisión
En proceso
En espera de materiales
En espera del funcionario
Resuelto
```

La interfaz informa que el técnico puede llegar hasta `Resuelto` y que el cierre definitivo corresponde al administrador.

Cuando el técnico indica que necesita materiales, la interfaz muestra automáticamente los campos asociados mediante JavaScript.

---

## Detalle del requerimiento

La vista de detalle es compartida entre distintos roles, pero la información visible cambia según quién consulta.

### Funcionario

Puede consultar:

- Datos de su solicitud.
- Estado.
- Prioridad.
- Responsable TI.
- Seguimiento.
- Información entregada por Informática.

### Administrador

Puede consultar además información interna de gestión y derivación.

### Técnico asignado

Puede consultar la información necesaria para atender el requerimiento y acceder a su gestión técnica.

Esta diferencia evita mostrar información interna a usuarios que no la necesitan.

---

## Notificaciones internas

La barra superior incorpora una campanita para acceder a las notificaciones.

El sistema genera avisos en distintos momentos del flujo.

Ejemplos:

- El administrador recibe un aviso cuando un funcionario crea un requerimiento.
- El funcionario recibe un aviso cuando el administrador actualiza prioridad, estado o derivación.
- El funcionario recibe avisos cuando el técnico registra avances.
- El técnico puede recibir una notificación cuando se le asigna un nuevo requerimiento.

Cada notificación puede relacionarse con un requerimiento específico y permite acceder a su detalle.

---

## Navegación según el rol

La navegación cambia según el usuario autenticado.

```text
FUNCIONARIO
    ↓
Panel funcionario
Crear requerimiento
Mis requerimientos
Notificaciones

ADMINISTRADOR
    ↓
Dashboard administrativo
Requerimientos
Gestión
Notificaciones

TÉCNICO
    ↓
Panel Técnico TI
Requerimientos asignados
Gestión técnica
Notificaciones
```

Además de ocultar opciones que no corresponden, el sistema realiza validaciones de permisos.

Por ejemplo, un usuario que intenta acceder a información o funciones no autorizadas puede recibir un error `403`.

---

## Layout reutilizable

El sistema utiliza un layout principal ubicado en:

```text
resources/views/layout.blade.php
```

Las vistas reutilizan esta estructura mediante:

```blade
@extends('layout')
```

Cada vista define su contenido con:

```blade
@section('content')

@endsection
```

El layout incorpora el contenido mediante:

```blade
@yield('content')
```

Esto permite reutilizar elementos comunes como:

- Logo.
- Encabezado.
- Navegación.
- Contenedor principal.
- Scripts.
- Estructura general.

---

## Componente reutilizable de estado

El sistema utiliza un componente Blade para representar visualmente los estados de los requerimientos.

Archivo:

```text
resources/views/components/estado.blade.php
```

El componente facilita la identificación visual de estados como:

- Pendiente.
- En revisión.
- En proceso.
- Resuelto.
- Cerrado.
- Rechazado.

La gestión técnica también contempla estados de espera utilizados durante la atención.

---

## Formularios

Los formularios utilizan instrucciones de Blade y Laravel como:

```blade
@csrf
@method('PUT')
@method('DELETE')
old()
@error
```

Estas instrucciones permiten:

- Proteger los formularios.
- Mantener valores ingresados cuando existe un error.
- Mostrar mensajes de validación.
- Ejecutar actualizaciones.
- Ejecutar eliminaciones.

---

## Confirmación de eliminación

La eliminación de requerimientos utiliza SweetAlert2.

Antes de eliminar, el sistema solicita confirmación para evitar acciones accidentales.

El usuario puede:

- Confirmar la eliminación.
- Cancelar la acción.

---

## Diseño adaptable

La interfaz fue preparada para adaptarse a diferentes tamaños de pantalla.

En pantallas grandes, tarjetas y campos pueden organizarse en varias columnas.

En dispositivos más pequeños, los elementos se reorganizan verticalmente para mantener la lectura y facilitar el uso.

---

## Vistas principales

Las principales vistas del sistema son:

```text
resources/views/inicio.blade.php

resources/views/auth/login.blade.php
resources/views/auth/register.blade.php

resources/views/funcionario/dashboard.blade.php

resources/views/notificaciones/index.blade.php

resources/views/requerimientos/create.blade.php
resources/views/requerimientos/index.blade.php
resources/views/requerimientos/show.blade.php

resources/views/admin/dashboard.blade.php
resources/views/admin/requerimientos/index.blade.php
resources/views/admin/requerimientos/edit.blade.php

resources/views/tecnico/dashboard.blade.php
resources/views/tecnico/gestionar.blade.php
```

---

## Relación con Supabase

Aunque este documento se concentra en la interfaz, en EVA3 los datos que se muestran y modifican desde estas pantallas se almacenan en PostgreSQL remoto mediante Supabase.

Por ejemplo:

```text
Funcionario completa formulario
        ↓
Vista Blade
        ↓
Controlador
        ↓
Modelo Eloquent
        ↓
Supabase PostgreSQL
```

Esto permite que la misma interfaz continúe funcionando aunque la base de datos ya no se encuentre en MySQL local.

---

## Conclusión

La interfaz de MesaTI Municipal permite que funcionarios, administradores y técnicos utilicen el sistema de acuerdo con sus responsabilidades.

La versión actual incorpora una presentación más moderna mediante Tabler UI, navegación diferenciada por rol, dashboards, filtros, paginación, gestión técnica y notificaciones.

Además, las pantallas continúan utilizando la arquitectura de Laravel mientras los datos se almacenan remotamente en PostgreSQL mediante Supabase.
