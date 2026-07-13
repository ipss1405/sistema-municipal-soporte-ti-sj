# MesaTI Municipal

Sistema web interno para la gestión de requerimientos informáticos municipales, desarrollado con Laravel, Blade y MySQL.

## Descripción del proyecto

MesaTI Municipal es una plataforma orientada a funcionarios municipales que permite registrar solicitudes de soporte informático, revisar su estado y consultar la respuesta entregada por el área de informática.

El sistema también considera una sección de administración donde el área informática puede revisar los requerimientos ingresados, cambiar su estado y registrar una respuesta para el funcionario.

## Objetivo general

Desarrollar una plataforma web municipal que permita registrar, gestionar y hacer seguimiento a requerimientos informáticos internos, aplicando estructura MVC, vistas Blade, rutas, controladores, modelo y base de datos MySQL.

---

# Evaluación 1: Frontend, vistas y estructura visual

## Funcionalidades desarrolladas

- Portada principal del sistema.
- Logo municipal incorporado en el layout general.
- Barra superior institucional.
- Menú de navegación.
- Accesos rápidos desde la página principal.
- Pantalla visual de login.
- Pantalla visual de registro.
- Panel visual del funcionario.
- Formulario visual para registrar requerimientos.
- Vista de mis requerimientos.
- Vista de detalle del requerimiento.
- Vista de administración de requerimientos.
- Vista para gestionar requerimientos.
- Uso de layout reutilizable con Blade.

## Vistas principales

Las vistas del sistema se encuentran en:

```txt
resources/views

Vistas desarrolladas:

resources/views/layout.blade.php
resources/views/inicio.blade.php
resources/views/auth/login.blade.php
resources/views/auth/register.blade.php
resources/views/funcionario/dashboard.blade.php
resources/views/requerimientos/create.blade.php
resources/views/requerimientos/index.blade.php
resources/views/requerimientos/show.blade.php
resources/views/admin/requerimientos/index.blade.php
resources/views/admin/requerimientos/edit.blade.php
Layout reutilizable

El archivo:

resources/views/layout.blade.php

se utiliza como plantilla principal del sistema.
Este layout contiene:

Logo municipal.
Nombre del sistema.
Barra superior.
Menú de navegación.
Estilos generales.
Contenedor principal.
Footer institucional.

Esto permite reutilizar la misma estructura visual en todas las páginas del sistema.

Evaluación 2: Backend, MVC, MySQL y CRUD
Funcionalidades implementadas
Creación de modelo Requerimiento.
Creación de migración para la tabla requerimientos.
Conexión con base de datos MySQL.
Creación de controlador RequerimientoController.
Registro de requerimientos desde formulario.
Guardado de requerimientos en MySQL.
Listado de requerimientos reales.
Visualización de detalle real de cada requerimiento.
Administración de requerimientos.
Actualización de estado del requerimiento.
Registro de respuesta del área informática.
Visualización de respuesta por parte del funcionario.
Uso de validaciones básicas.
Uso de protección CSRF en formularios.
Modelo utilizado

El modelo principal del sistema es:

app/Models/Requerimiento.php

Este modelo permite trabajar con la tabla requerimientos mediante Eloquent ORM.

Controlador utilizado

El controlador principal es:

app/Http/Controllers/RequerimientoController.php

Este controlador administra las acciones principales del sistema:

Listar requerimientos.
Guardar nuevos requerimientos.
Mostrar detalle de requerimiento.
Mostrar administración.
Editar estado.
Actualizar respuesta.
Base de datos

Base de datos utilizada:

mesa_ti_municipal

Tabla principal:

requerimientos

Campos principales:

id
user_id
categoria
titulo
descripcion
prioridad
estado
respuesta_admin
fecha_cierre
created_at
updated_at
Flujo del sistema
Funcionario ingresa requerimiento
↓
El sistema guarda el requerimiento en MySQL
↓
El funcionario puede ver sus requerimientos
↓
El área informática revisa el requerimiento
↓
Administración cambia el estado
↓
Administración registra una respuesta
↓
El funcionario visualiza el seguimiento actualizado
Estados del requerimiento

El sistema considera los siguientes estados:

Pendiente
En revisión
En proceso
Resuelto
Cerrado
Rechazado
Rutas principales
/                         Página principal
/login                    Login visual
/registro                 Registro visual
/funcionario              Panel funcionario
/requerimientos/crear     Crear requerimiento
/mis-requerimientos       Listado de requerimientos
/requerimientos/{id}      Detalle del requerimiento
/admin/requerimientos     Administración de requerimientos
/admin/requerimientos/{id}/editar  Gestionar requerimiento
Tecnologías utilizadas
Laravel
PHP
Blade
MySQL
Laragon
Composer
Git
GitHub
VS Code
Seguridad básica aplicada
Uso de @csrf en formularios.
Validación de datos en el controlador.
Archivo .env para configuración de base de datos.
Separación de responsabilidades mediante MVC.
Uso de rutas definidas en routes/web.php.
Funcionalidades pendientes o futuras mejoras
Login real de usuarios.
Registro real de funcionarios.
Roles de usuario: funcionario y administrador.
Protección de rutas mediante middleware.
Asociación real de requerimientos al usuario autenticado.
Notificación por correo cuando cambie el estado de un requerimiento.
Mejora visual de estados mediante etiquetas o colores.
Estado actual del proyecto

El sistema actualmente permite registrar, listar, visualizar y administrar requerimientos informáticos usando Laravel y MySQL.

El flujo principal de requerimientos se encuentra funcionando correctamente:

Crear → Guardar → Listar → Ver detalle → Gestionar → Actualizar estado y respuesta