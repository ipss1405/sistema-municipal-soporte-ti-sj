# Guía de Presentación - MesaTI Municipal

## 1. Presentación del proyecto

El proyecto desarrollado se llama **MesaTI Municipal**.

Es una plataforma web interna orientada a la gestión de requerimientos informáticos dentro de un contexto municipal. Su objetivo principal es permitir que los funcionarios registren solicitudes de soporte o requerimientos técnicos, y que el área de informática pueda revisar, gestionar, responder, actualizar o eliminar dichos requerimientos desde una sección administrativa.

El sistema fue desarrollado utilizando **Laravel**, **Blade**, **PHP** y **MySQL**, aplicando una estructura basada en el patrón **MVC**.

---

## 2. Objetivo del sistema

El objetivo del sistema es ordenar el proceso de atención de requerimientos informáticos municipales.

El sistema permite:

- Registrar requerimientos.
- Listar requerimientos ingresados.
- Ver el detalle de cada requerimiento.
- Gestionar los requerimientos desde administración.
- Actualizar estado y respuesta administrativa.
- Eliminar requerimientos desde administración.
- Visualizar estados mediante un componente reutilizable.

---

## 3. Arquitectura general del proyecto

El proyecto utiliza la arquitectura propia de Laravel, basada en el patrón **MVC**, que significa Modelo, Vista y Controlador.

La estructura principal utilizada es:

- `routes/web.php`: define las rutas del sistema.
- `app/Http/Controllers/RequerimientoController.php`: contiene la lógica del sistema.
- `app/Models/Requerimiento.php`: representa la tabla de requerimientos en la base de datos.
- `resources/views`: contiene las vistas Blade que ve el usuario.
- `database/migrations`: contiene la estructura de la tabla creada en MySQL.

La idea principal es que el usuario navega por una página, esa página está conectada a una ruta, la ruta llama a un controlador, el controlador usa el modelo y finalmente se muestran los datos en una vista Blade.

---

## 4. Explicación simple del flujo MVC

El flujo general del sistema funciona de la siguiente manera:

1. El usuario entra a una URL del sistema.
2. Laravel revisa esa URL en el archivo `routes/web.php`.
3. La ruta puede mostrar una vista directamente o llamar a un método del controlador.
4. El controlador procesa la solicitud.
5. El controlador utiliza el modelo `Requerimiento` para guardar, consultar, actualizar o eliminar datos.
6. Los datos se envían a una vista Blade.
7. La vista muestra la información al usuario.

Ejemplo del flujo al crear un requerimiento:

1. El funcionario entra a `/requerimientos/crear`.
2. Laravel muestra la vista `requerimientos/create.blade.php`.
3. El funcionario completa el formulario.
4. El formulario envía los datos mediante POST a `/requerimientos`.
5. La ruta llama al método `store` del controlador.
6. El controlador valida los datos.
7. El controlador guarda el requerimiento usando el modelo `Requerimiento`.
8. El sistema redirige al listado de requerimientos.

---

## 5. Rutas principales del sistema

Las rutas están definidas en el archivo `routes/web.php`.

| Método HTTP | Ruta | Función |
|---|---|---|
| GET | `/` | Muestra la página principal del sistema |
| GET | `/login` | Muestra la vista visual de inicio de sesión |
| GET | `/registro` | Muestra la vista visual de registro |
| GET | `/funcionario` | Muestra el panel visual del funcionario |
| GET | `/requerimientos/crear` | Muestra el formulario para crear requerimientos |
| POST | `/requerimientos` | Guarda un nuevo requerimiento |
| GET | `/mis-requerimientos` | Lista los requerimientos registrados |
| GET | `/requerimientos/{requerimiento}` | Muestra el detalle de un requerimiento |
| GET | `/admin/requerimientos` | Muestra la administración de requerimientos |
| GET | `/admin/requerimientos/{requerimiento}/editar` | Muestra el formulario administrativo de gestión |
| PUT | `/admin/requerimientos/{requerimiento}` | Actualiza estado y respuesta del requerimiento |
| DELETE | `/admin/requerimientos/{requerimiento}` | Elimina un requerimiento desde administración |

Con estas rutas se cubren las operaciones principales solicitadas por la evaluación: listar, crear, mostrar detalle, actualizar y eliminar.

---

## 6. Verbos HTTP utilizados

El sistema utiliza los verbos HTTP de acuerdo con la función que se realiza:

- **GET**: para mostrar páginas y consultar información.
- **POST**: para guardar un nuevo requerimiento.
- **PUT**: para actualizar el estado y la respuesta administrativa.
- **DELETE**: para eliminar un requerimiento desde administración.

Esto permite que las rutas estén organizadas según la acción que realiza el sistema.

---

## 7. Controlador principal

El controlador principal del sistema es:

`app/Http/Controllers/RequerimientoController.php`

Este controlador contiene la lógica asociada a los requerimientos.

Métodos principales:

| Método | Función |
|---|---|
| `index()` | Lista los requerimientos registrados |
| `store()` | Valida y guarda un nuevo requerimiento |
| `show()` | Muestra el detalle de un requerimiento |
| `adminIndex()` | Muestra la vista administrativa |
| `edit()` | Muestra el formulario para gestionar un requerimiento |
| `update()` | Actualiza estado y respuesta administrativa |
| `destroy()` | Elimina un requerimiento desde administración |

---

## 8. Explicación del método store

El método `store` se encarga de guardar un nuevo requerimiento.

Primero recibe los datos enviados desde el formulario. Luego valida que los campos obligatorios estén completos. Después asigna valores iniciales, como el estado `pendiente`. Finalmente guarda el registro en la base de datos usando el modelo `Requerimiento`.

Este método se usa cuando el funcionario completa el formulario de creación de requerimientos.

Explicación para la presentación:

“El método store recibe los datos del formulario, valida los campos requeridos y luego crea un nuevo registro en la tabla requerimientos mediante el modelo Requerimiento.”

---

## 9. Explicación del método update

El método `update` permite que administración cambie el estado del requerimiento y agregue una respuesta.

Este método recibe los datos desde el formulario administrativo, valida que el estado sea válido y actualiza el registro correspondiente en la base de datos.

Si el estado queda como `resuelto` o `cerrado`, también se registra una fecha de cierre.

Explicación para la presentación:

“El método update permite actualizar un requerimiento existente. En este caso se usa para cambiar el estado y registrar una respuesta administrativa.”

---

## 10. Explicación del método destroy

El método `destroy` permite eliminar un requerimiento desde administración.

Este método recibe el requerimiento seleccionado y ejecuta la acción de eliminación mediante:

`$requerimiento->delete();`

Después redirige nuevamente a la vista administrativa mostrando un mensaje de confirmación.

Explicación para la presentación:

“El método destroy elimina el requerimiento seleccionado desde la base de datos. Esta acción se ejecuta desde un formulario Blade que utiliza el verbo DELETE mediante la directiva `@method('DELETE')`.”

---

## 11. Modelo utilizado

El modelo principal es:

`app/Models/Requerimiento.php`

Este modelo representa la tabla `requerimientos` de la base de datos.

El modelo permite que Laravel trabaje con los datos como objetos, sin escribir consultas SQL manuales para cada operación.

El modelo tiene definidos los campos que se pueden guardar de forma masiva mediante `$fillable`, por ejemplo:

- `user_id`
- `categoria`
- `titulo`
- `descripcion`
- `prioridad`
- `estado`
- `respuesta_admin`
- `fecha_cierre`

Explicación para la presentación:

“El modelo Requerimiento representa la tabla de requerimientos en MySQL. A través de este modelo el controlador puede crear, leer, actualizar y eliminar registros.”

---

## 12. Base de datos

La base de datos utilizada es:

`mesa_ti_municipal`

La tabla principal es:

`requerimientos`

Esta tabla almacena la información ingresada por los funcionarios y gestionada por administración.

Campos principales:

- `id`
- `user_id`
- `categoria`
- `titulo`
- `descripcion`
- `prioridad`
- `estado`
- `respuesta_admin`
- `fecha_cierre`
- `created_at`
- `updated_at`

---

## 13. Vistas Blade desarrolladas

El sistema utiliza varias vistas Blade ubicadas en la carpeta `resources/views`.

Vistas principales:

| Vista | Función |
|---|---|
| `inicio.blade.php` | Página principal del sistema |
| `auth/login.blade.php` | Vista visual de inicio de sesión |
| `auth/register.blade.php` | Vista visual de registro |
| `funcionario/dashboard.blade.php` | Panel visual del funcionario |
| `requerimientos/create.blade.php` | Formulario para crear requerimientos |
| `requerimientos/index.blade.php` | Listado de requerimientos |
| `requerimientos/show.blade.php` | Detalle de un requerimiento |
| `admin/requerimientos/index.blade.php` | Administración de requerimientos |
| `admin/requerimientos/edit.blade.php` | Gestión administrativa del requerimiento |

---

## 14. Conexión entre páginas

Las páginas están conectadas mediante enlaces y rutas.

Ejemplos:

- Desde la página principal se puede ingresar al login, registro o panel.
- Desde el panel del funcionario se puede ir a crear un requerimiento o revisar requerimientos.
- Desde el formulario de creación se guarda el requerimiento y luego se redirige al listado.
- Desde el listado se puede abrir el detalle de un requerimiento.
- Desde administración se puede gestionar o eliminar un requerimiento.
- Desde la gestión administrativa se puede actualizar el estado y la respuesta.

Esto demuestra que el proyecto no tiene páginas aisladas, sino un flujo conectado.

---

## 15. Layout reutilizable

El proyecto utiliza un layout principal:

`resources/views/layout.blade.php`

Este archivo contiene la estructura base del sitio, como:

- Encabezado.
- Logo institucional.
- Menú de navegación.
- Estilos CSS generales.
- Contenedor principal.
- Pie de página.

Las demás vistas reutilizan este layout mediante directivas Blade como:

`@extends('layout')`

`@section('content')`

Esto evita repetir la misma estructura HTML en todas las páginas.

Explicación para la presentación:

“El layout permite reutilizar una estructura común en todas las páginas. Así el diseño se mantiene ordenado y consistente.”

---

## 16. Componente reutilizable de estado

El sistema utiliza un componente Blade reutilizable:

`resources/views/components/estado.blade.php`

Este componente recibe el estado del requerimiento y lo muestra con un texto y color correspondiente.

Se usa de esta forma:

`<x-estado :estado="$requerimiento->estado" />`

Estados utilizados:

- Pendiente
- En revisión
- En proceso
- Resuelto
- Cerrado
- Rechazado

Explicación para la presentación:

“El componente de estado evita repetir código en varias vistas. Se reutiliza tanto en el listado, como en el detalle y en la administración.”

---

## 17. Directivas Blade utilizadas

En las vistas se utilizaron directivas Blade como:

- `@extends`
- `@section`
- `@yield`
- `@if`
- `@forelse`
- `@csrf`
- `@method`
- `{{ }}`
- `<x-estado>`

Estas directivas permiten trabajar con plantillas, condiciones, ciclos, protección de formularios y componentes reutilizables.

---

## 18. Validaciones

El sistema valida los datos antes de guardar o actualizar información.

Por ejemplo, al crear un requerimiento se valida que existan:

- Categoría.
- Título.
- Descripción.
- Prioridad válida.

Esto evita guardar registros incompletos o incorrectos en la base de datos.

Explicación para la presentación:

“Antes de guardar, el controlador valida los datos recibidos desde el formulario. Si falta un campo obligatorio, Laravel muestra los errores en la vista.”

---

## 19. Seguridad básica aplicada

El sistema utiliza `@csrf` en los formularios para proteger las solicitudes enviadas desde las vistas.

También se utiliza `@method('PUT')` y `@method('DELETE')` para indicar a Laravel que algunos formularios deben comportarse como solicitudes PUT o DELETE.

Esto es importante porque los formularios HTML trabajan principalmente con GET y POST, y Laravel permite simular otros métodos HTTP usando estas directivas.

---

## 20. Diseño de interfaz

La interfaz fue diseñada con una orientación institucional municipal.

Se utilizaron:

- Colores asociados a la identidad visual municipal.
- Logo institucional.
- Tarjetas de contenido.
- Accesos rápidos.
- Botones claros.
- Etiquetas visuales de estado.
- Diseño dinámico con efectos suaves.

La portada fue trabajada con inspiración en estilos modernos de prototipado de interfaces, similares a herramientas como Google Stitch, pero adaptada al contexto del proyecto municipal.

---

## 21. Decisiones técnicas

Algunas decisiones técnicas tomadas fueron:

- Usar Laravel porque permite organizar el proyecto con rutas, controladores, modelos y vistas.
- Usar Blade porque permite construir interfaces reutilizables.
- Usar MySQL porque permite guardar los requerimientos de forma persistente.
- Usar un componente para los estados, porque el mismo dato se muestra en distintas vistas.
- Usar una sección administrativa para separar la gestión interna de la vista del funcionario.
- Agregar eliminación con DELETE para cumplir la rúbrica de operaciones CRUD.
- Mantener estados como pendiente, en revisión, en proceso, resuelto, cerrado o rechazado para representar el avance del requerimiento.

---

## 22. Demostración funcional sugerida

Para presentar el sistema, se recomienda seguir este orden:

1. Levantar el proyecto con `php artisan serve`.
2. Abrir `http://127.0.0.1:8000`.
3. Mostrar la página principal.
4. Mostrar el panel del funcionario.
5. Crear un nuevo requerimiento.
6. Mostrar el listado de requerimientos.
7. Abrir el detalle de un requerimiento.
8. Entrar a administración.
9. Gestionar un requerimiento.
10. Cambiar estado y agregar respuesta.
11. Mostrar que el cambio se refleja en el listado o detalle.
12. Crear un requerimiento de prueba.
13. Eliminarlo desde administración usando el botón Eliminar.
14. Mostrar el mensaje de confirmación.

---
## 23. Conclusión

El proyecto cumple con los requerimientos principales de la evaluación, ya que implementa rutas, vistas Blade, controlador, modelo, conexión con base de datos, componentes reutilizables, estilos CSS y operaciones CRUD.

Además, el sistema representa un caso real y coherente aplicado a un contexto municipal, permitiendo demostrar el uso de Laravel y Blade en una aplicación funcional.
---

---



