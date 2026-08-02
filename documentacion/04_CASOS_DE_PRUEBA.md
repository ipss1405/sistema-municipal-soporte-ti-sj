# Casos de Prueba

## 1. Descripción general

Este documento contiene los casos de prueba funcionales del **Sistema Municipal de Soporte TI**.

Las pruebas se ejecutaron manualmente en el entorno local del proyecto. Cada caso debe registrar el resultado real y una captura en formato PNG como evidencia.

## 2. Entorno de prueba

```text
Proyecto: Sistema Municipal de Soporte TI
URL: http://127.0.0.1:8001
Base de datos: sistema_soporte_ti_eva2
Navegador: Google Chrome
Servidor local: Laragon
```

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

## 4. Estados de los casos de prueba

Cada prueba debe finalizar con uno de estos estados:

- **Pendiente:** todavía no se ejecuta.
- **Aprobado:** el resultado obtenido coincide con el esperado.
- **Rechazado:** el resultado obtenido no coincide con el esperado.
- **Bloqueado:** no fue posible ejecutar la prueba por un problema previo.

---

# CP-01: Inicio de sesión correcto del funcionario

## Objetivo

Comprobar que una funcionaria registrada pueda iniciar sesión y acceder a su panel.

## Precondiciones

- El servidor debe estar funcionando.
- La usuaria debe existir en la base de datos.
- No debe existir otra sesión abierta.

## Datos de prueba

```text
Correo: ana.martinez@sanjoaquin.cl
Contraseña: Municipal2026!
```

## Pasos

1. Abrir `http://127.0.0.1:8001/login`.
2. Ingresar el correo.
3. Ingresar la contraseña.
4. Presionar **Iniciar sesión**.

## Resultado esperado

El sistema permite el acceso y muestra el panel funcionario.

El usuario puede visualizar:

- Crear requerimiento.
- Mis requerimientos.
- Campanita de notificaciones.
- Cerrar sesión.

La opción **Administración** no debe aparecer.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

## Evidencia

```text
CP01_login_funcionario_aprobado.png
```

---

# CP-02: Inicio de sesión con contraseña incorrecta

## Objetivo

Comprobar que el sistema rechace credenciales incorrectas.

## Precondiciones

- La usuaria debe existir.
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

## Evidencia

```text
CP02_login_incorrecto.png
```

---

# CP-03: Registro de un nuevo funcionario

## Objetivo

Comprobar que un usuario nuevo pueda registrarse y quede con rol funcionario.

## Precondiciones

- El correo utilizado no debe existir en la base de datos.
- No debe existir una sesión abierta.

## Datos de prueba

```text
Nombre: Usuario Prueba
Correo: usuario.prueba@sanjoaquin.cl
Contraseña: Municipal2026!
Confirmación: Municipal2026!
```

## Pasos

1. Abrir la opción **Registro**.
2. Completar todos los campos.
3. Presionar el botón de registro.
4. Verificar la redirección.

## Resultado esperado

El sistema crea la cuenta, inicia la sesión y muestra el panel funcionario.

El usuario nuevo debe quedar con rol `funcionario`.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

## Evidencia

```text
CP03_registro_funcionario.png
```

---

# CP-04: Creación correcta de un requerimiento

## Objetivo

Comprobar que una funcionaria pueda registrar un requerimiento válido.

## Precondiciones

- La funcionaria debe tener una sesión iniciada.
- Debe estar disponible el formulario de creación.

## Datos de prueba

```text
Categoría: Hardware
Título: Teclado no responde
Descripción: El teclado del equipo dejó de responder durante la jornada.
Prioridad: Media
```

## Pasos

1. Ingresar al panel funcionario.
2. Presionar **Crear requerimiento**.
3. Completar los campos.
4. Presionar el botón para registrar.
5. Revisar el listado de requerimientos.

## Resultado esperado

El sistema guarda el requerimiento en la base de datos.

El registro debe:

- Quedar asociado a la funcionaria autenticada.
- Tener estado inicial `pendiente`.
- Aparecer en **Mis requerimientos**.
- Generar una notificación para la administradora.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

## Evidencia

```text
CP04_requerimiento_creado.png
```

---

# CP-05: Validación de campos obligatorios

## Objetivo

Comprobar que el sistema no permita crear un requerimiento con campos obligatorios vacíos.

## Precondiciones

- La funcionaria debe tener una sesión iniciada.
- Debe estar abierto el formulario de creación.

## Datos de prueba

```text
Categoría: Sin seleccionar
Título: Vacío
Descripción: Vacío
Prioridad: Sin seleccionar
```

## Pasos

1. Abrir **Crear requerimiento**.
2. Dejar los campos obligatorios sin completar.
3. Presionar el botón para registrar.

## Resultado esperado

El sistema no guarda el requerimiento y muestra mensajes de validación en los campos obligatorios.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

## Evidencia

```text
CP05_validaciones_formulario.png
```

---

# CP-06: Consulta de requerimientos propios

## Objetivo

Comprobar que una funcionaria visualice solamente los requerimientos asociados a su cuenta.

## Precondiciones

- La funcionaria debe tener una sesión iniciada.
- Debe existir al menos un requerimiento de la usuaria.

## Pasos

1. Ingresar a **Mis requerimientos**.
2. Revisar el listado.
3. Abrir **Ver detalle** en una solicitud.

## Resultado esperado

El sistema muestra solamente los requerimientos de la funcionaria autenticada.

El detalle debe mostrar:

- Categoría.
- Título.
- Descripción.
- Prioridad.
- Estado.
- Respuesta administrativa.
- Fechas correspondientes.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

## Evidencia

```text
CP06_mis_requerimientos_detalle.png
```

---

# CP-07: Acceso de la administradora

## Objetivo

Comprobar que la administradora pueda iniciar sesión y visualizar todos los requerimientos.

## Precondiciones

- La administradora debe existir.
- No debe existir otra sesión abierta.

## Datos de prueba

```text
Correo: rosa@sanjoaquin.cl
Contraseña: Municipal2026!
```

## Pasos

1. Abrir la pantalla de inicio de sesión.
2. Ingresar las credenciales de administradora.
3. Presionar **Iniciar sesión**.
4. Revisar la vista administrativa.

## Resultado esperado

El sistema redirige a la administración de requerimientos.

La vista debe mostrar:

- Todos los requerimientos.
- Nombre del funcionario.
- Categoría.
- Prioridad.
- Estado.
- Botones Gestionar y Eliminar.
- Campanita de notificaciones.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

## Evidencia

```text
CP07_panel_administracion.png
```

---

# CP-08: Actualización del estado y respuesta

## Objetivo

Comprobar que la administradora pueda cambiar el estado y registrar una respuesta.

## Precondiciones

- La administradora debe tener una sesión iniciada.
- Debe existir un requerimiento pendiente.

## Datos de prueba

```text
Nuevo estado: En proceso
Respuesta: Se revisará el equipo durante la jornada de mañana.
```

## Pasos

1. Ingresar a Administración.
2. Seleccionar **Gestionar** en un requerimiento.
3. Cambiar el estado.
4. Escribir la respuesta.
5. Guardar la actualización.
6. Iniciar sesión como funcionaria.
7. Revisar la campanita y el detalle.

## Resultado esperado

El sistema actualiza el estado y la respuesta.

Además:

- La funcionaria recibe una notificación.
- El nuevo estado aparece en el detalle.
- La respuesta administrativa queda visible.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

## Evidencia

```text
CP08_actualizacion_y_notificacion.png
```

---

# CP-09: Bloqueo de acceso administrativo

## Objetivo

Comprobar que una funcionaria no pueda acceder a la sección administrativa.

## Precondiciones

- La funcionaria debe tener una sesión iniciada.

## Pasos

1. Iniciar sesión como funcionaria.
2. Escribir manualmente en el navegador:

```text
http://127.0.0.1:8001/admin/requerimientos
```

3. Presionar Enter.

## Resultado esperado

El sistema bloquea el acceso y muestra un error:

```text
403 - Acceso no autorizado
```

La opción Administración tampoco debe aparecer en el menú.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

## Evidencia

```text
CP09_acceso_bloqueado_403.png
```

---

# CP-10: Cancelación de eliminación con SweetAlert2

## Objetivo

Comprobar que la administradora pueda cancelar una eliminación y conservar el requerimiento.

## Precondiciones

- La administradora debe tener una sesión iniciada.
- Debe existir un requerimiento de prueba.

## Pasos

1. Ingresar a Administración.
2. Presionar **Eliminar** en un requerimiento.
3. Revisar la ventana SweetAlert2.
4. Presionar **Cancelar**.
5. Revisar el listado.

## Resultado esperado

SweetAlert2 muestra una advertencia con las opciones de confirmar o cancelar.

Al presionar **Cancelar**, el requerimiento permanece en el listado.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

## Evidencia

```text
CP10_sweetalert_cancelar.png
```

---

# CP-11: Confirmación de eliminación

## Objetivo

Comprobar que la administradora pueda eliminar un requerimiento de prueba.

## Precondiciones

- La administradora debe tener una sesión iniciada.
- Debe utilizarse un registro creado exclusivamente para esta prueba.

## Pasos

1. Crear o identificar un requerimiento de prueba.
2. Ingresar a Administración.
3. Presionar **Eliminar**.
4. Confirmar la eliminación en SweetAlert2.
5. Revisar nuevamente el listado.

## Resultado esperado

El sistema elimina el requerimiento y muestra un mensaje de confirmación.

El registro ya no aparece en el listado administrativo.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

## Evidencia

```text
CP11_requerimiento_eliminado.png
```

---

# CP-12: Notificaciones marcadas como leídas

## Objetivo

Comprobar que las notificaciones del usuario se marquen como leídas al abrir la sección.

## Precondiciones

- El usuario debe tener una notificación sin leer.
- Debe tener una sesión iniciada.

## Pasos

1. Revisar el número mostrado en la campanita.
2. Abrir la sección de notificaciones.
3. Volver a revisar el contador.

## Resultado esperado

El sistema muestra las notificaciones del usuario autenticado.

Al abrir la sección:

- Las notificaciones quedan marcadas como leídas.
- Se registra la fecha de lectura.
- El contador disminuye o queda en cero.

## Resultado obtenido

```text
Pendiente de ejecución.
```

## Estado

**Pendiente**

## Evidencia

```text
CP12_notificaciones_leidas.png
```

---

# Resumen de ejecución

| Código | Caso de prueba | Estado |
|---|---|---|
| CP-01 | Inicio de sesión correcto del funcionario | Pendiente |
| CP-02 | Inicio de sesión con contraseña incorrecta | Pendiente |
| CP-03 | Registro de un nuevo funcionario | Pendiente |
| CP-04 | Creación correcta de un requerimiento | Pendiente |
| CP-05 | Validación de campos obligatorios | Pendiente |
| CP-06 | Consulta de requerimientos propios | Pendiente |
| CP-07 | Acceso de la administradora | Pendiente |
| CP-08 | Actualización del estado y respuesta | Pendiente |
| CP-09 | Bloqueo de acceso administrativo | Pendiente |
| CP-10 | Cancelación de eliminación con SweetAlert2 | Pendiente |
| CP-11 | Confirmación de eliminación | Pendiente |
| CP-12 | Notificaciones marcadas como leídas | Pendiente |

## Conclusión

Los casos de prueba definidos permiten comprobar las funciones principales del Sistema Municipal de Soporte TI.

Los resultados obtenidos, estados y evidencias se completarán a medida que cada prueba sea ejecutada manualmente.
