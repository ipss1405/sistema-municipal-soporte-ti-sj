# Interfaz de Usuario

## Descripción general

La interfaz del Sistema Municipal de Soporte TI fue diseñada para el uso interno de funcionarios municipales.

El diseño utiliza colores institucionales, logo municipal, navegación simple, tarjetas informativas y accesos adaptados según el tipo de usuario.

## Objetivo de la interfaz

El objetivo es permitir que funcionarios y administradores comprendan rápidamente el funcionamiento del sistema y accedan fácilmente a las opciones correspondientes a su rol.

La interfaz busca ser:

- Clara.
- Ordenada.
- Fácil de utilizar.
- Adaptable a distintos tamaños de pantalla.
- Coherente con un entorno institucional municipal.

## Diseño institucional

La interfaz incorpora los siguientes elementos:

- Logo de la Municipalidad de San Joaquín.
- Nombre del sistema en el encabezado.
- Colores institucionales en botones y tarjetas.
- Menú de navegación.
- Accesos rápidos.
- Información del servicio informático.
- Diseño basado en tarjetas.
- Efectos visuales suaves.

## Página principal

La página principal presenta información general sobre el Sistema Municipal de Soporte TI.

Está dividida en dos áreas principales:

### Accesos rápidos

Los accesos cambian según el estado de la sesión y el rol del usuario.

#### Usuario sin iniciar sesión

Puede visualizar:

- Login.
- Registro.

#### Funcionario autenticado

Puede visualizar:

- Panel funcionario.
- Crear requerimiento.
- Mis requerimientos.

#### Administrador autenticado

Puede visualizar:

- Panel funcionario.
- Crear requerimiento.
- Mis requerimientos.
- Administración.

De esta forma, cada usuario visualiza solamente las funciones que le corresponden.

### Información del servicio

La portada también muestra información del área de Informática:

- Unidad responsable.
- Dirección municipal.
- Teléfono y anexos.
- Correo electrónico.
- Horario de atención.
- Tipo de atención.

## Login y registro

El sistema cuenta con login y registro funcionales.

El usuario debe ingresar su correo y contraseña para iniciar sesión.

Después del ingreso, Laravel revisa el rol registrado en la base de datos:

```text
Funcionario → Panel funcionario
Administrador → Administración de requerimientos
```
Los usuarios creados mediante el formulario de registro quedan automáticamente con rol funcionario.

## Panel funcionario

El panel funcionario permite acceder a las funciones principales:

Crear un requerimiento.
Consultar los requerimientos propios.
Revisar el estado de las solicitudes.
Acceder al detalle de un requerimiento.
Consultar las notificaciones recibidas.

Cada funcionario puede visualizar solamente los requerimientos asociados a su cuenta.

## Administración de requerimientos

La vista administrativa permite:

Consultar todos los requerimientos.
Identificar al funcionario que creó cada solicitud.
Revisar categoría, prioridad y estado.
Gestionar un requerimiento.
Registrar una respuesta.
Cambiar el estado.
Eliminar un requerimiento.

El acceso está limitado a usuarios con rol administrador.

## Notificaciones internas

La barra superior contiene una campanita con contador.

El sistema genera notificaciones en ambos sentidos:

El administrador recibe un aviso cuando un funcionario crea un requerimiento.
El funcionario recibe un aviso cuando el administrador cambia el estado de su solicitud.

Cada usuario puede consultar solamente sus propias notificaciones.

## Navegación según el rol

La interfaz muestra botones y enlaces diferentes según el rol del usuario.

Un funcionario no visualiza la opción Administración.

Aunque intente ingresar manualmente a la ruta administrativa, el sistema bloquea el acceso mediante un error 403.

Esto permite combinar una navegación clara con control de acceso.

## Layout reutilizable

El sistema utiliza un layout principal ubicado en:

resources/views/layout.blade.php

Las vistas heredan esta estructura mediante:

@extends('layout')

Cada vista define su contenido con:

@section('content')
@endsection

El layout incorpora el contenido mediante:

@yield('content')

Esto permite reutilizar:

Encabezado.
Logo.
Barra de navegación.
Estilos generales.
Contenedor principal.
Scripts.
Pie de página.

## Componente reutilizable de estado

Se creó un componente Blade ubicado en:

resources/views/components/estado.blade.php

El componente permite mostrar los estados:

Pendiente.
En revisión.
En proceso.
Resuelto.
Cerrado.
Rechazado.

Cada estado utiliza una etiqueta visual para facilitar su identificación.

## Formularios

Los formularios mantienen una estructura clara y muestran mensajes cuando existen datos incorrectos.

Se utilizan instrucciones Blade como:

@csrf
@method('PUT')
@method('DELETE')
old()
@error

Estas instrucciones permiten:

Proteger los formularios.
Mantener los valores ingresados.
Mostrar mensajes de validación.
Actualizar registros.
Eliminar registros.

## Confirmación de eliminación

La eliminación de requerimientos utiliza SweetAlert2.

Antes de eliminar, el sistema muestra una ventana de confirmación con las opciones:

Sí, eliminar.
Cancelar.

Esto ayuda a evitar eliminaciones accidentales.

## Diseño adaptable

La interfaz fue preparada para ajustarse a distintos tamaños de pantalla.

En equipos grandes, los contenidos se muestran en columnas.

En pantallas pequeñas, las tarjetas y accesos se organizan verticalmente para facilitar la navegación.

## Vistas principales

Las vistas principales del sistema son:

resources/views/inicio.blade.php
resources/views/auth/login.blade.php
resources/views/auth/register.blade.php
resources/views/funcionario/dashboard.blade.php
resources/views/notificaciones/index.blade.php
resources/views/requerimientos/create.blade.php
resources/views/requerimientos/index.blade.php
resources/views/requerimientos/show.blade.php
resources/views/admin/requerimientos/index.blade.php
resources/views/admin/requerimientos/edit.blade.php

## Conclusión

La interfaz del Sistema Municipal de Soporte TI permite que funcionarios y administradores utilicen la plataforma de manera clara y ordenada.

La navegación se adapta al rol del usuario, facilita la creación y seguimiento de requerimientos e incorpora notificaciones, validaciones, confirmaciones y un diseño institucional adaptable.