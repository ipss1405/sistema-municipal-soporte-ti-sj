# Casos de Prueba

## 1. Descripción general

Este documento contiene los casos de prueba funcionales ejecutados manualmente sobre el **Sistema Municipal de Soporte TI**.

Las pruebas se realizaron en el entorno local del proyecto y fueron respaldadas mediante capturas almacenadas en `documentacion/CAPTURAS/`.

## 2. Entorno de prueba

```text
Proyecto: Sistema Municipal de Soporte TI
URL: http://127.0.0.1:8001
Base de datos: sistema_soporte_ti_eva2
Navegador: Google Chrome
Servidor local: Laragon
Fecha de ejecución: 07-08-2026
```

## 3. Usuarios de prueba

### Administradora

```text
Correo: rosa@sanjoaquin.cl
Contraseña: Municipal2026!
Rol: administrador
```

### Funcionaria utilizada en pruebas iniciales

```text
Correo: ana.martinez@sanjoaquin.cl
Contraseña: Municipal2026!
Rol: funcionario
```

Durante las pruebas también se creó una nueva cuenta de funcionario desde el formulario de registro.

## 4. Estados utilizados

- **Aprobado:** el resultado obtenido coincide con el resultado esperado.
- **Rechazado:** el resultado obtenido no coincide con el esperado.
- **Bloqueado:** no fue posible ejecutar la prueba.

---

# CP-01: Inicio de sesión correcto del funcionario

## Resultado obtenido

El inicio de sesión fue correcto. La funcionaria accedió a `/funcionario` y visualizó las opciones correspondientes a su rol. La opción Administración no se mostró.

## Estado

**Aprobado**

## Evidencia

`CP01_login_funcionario_aprobado.png`

---

# CP-02: Inicio de sesión con contraseña incorrecta

## Resultado obtenido

El sistema rechazó las credenciales incorrectas, mantuvo al usuario en la pantalla de login y mostró mensajes indicando que el correo o la contraseña no eran correctos.

## Estado

**Aprobado**

## Evidencia

`CP02_login_incorrecto.png`

---

# CP-03: Registro de un nuevo funcionario

## Resultado obtenido

El sistema creó correctamente la nueva cuenta, mostró el mensaje `Cuenta creada correctamente`, inició la sesión y redirigió al usuario al Panel funcionario.

## Estado

**Aprobado**

## Evidencia

`CP03_registro_funcionario.png`

---

# CP-04: Creación correcta de un requerimiento

## Datos utilizados

```text
Categoría: Correo
Título: clave de acceso
Descripción: No puedo ingresar con mi clave
Prioridad: Urgente
```

## Resultado obtenido

El requerimiento Nº 34 fue creado correctamente, quedó visible en Mis requerimientos con estado inicial `Pendiente` y se generó una notificación para la administradora.

## Estado

**Aprobado**

## Evidencia

- `CP04_requerimiento_creado.png`
- `CAP04_notificacion_admin_requerimiento_34.png`

---

# CP-05: Validación de campo obligatorio

## Resultado obtenido

Se dejó vacío el campo Descripción y se intentó registrar el requerimiento. El navegador impidió el envío y mostró el mensaje `Completa este campo.`

## Estado

**Aprobado**

## Evidencia

`CP05_validaciones_formulario.png`

---

# CP-06: Consulta de requerimientos propios

## Resultado obtenido

La funcionaria visualizó el requerimiento asociado a su cuenta y pudo acceder correctamente al detalle.

## Estado

**Aprobado**

## Evidencia

`CP06_mis_requerimientos_detalle.png`

---

# CP-07: Acceso de la administradora

## Resultado obtenido

La administradora inició sesión correctamente y fue redirigida a `/admin/requerimientos`, donde visualizó los requerimientos y las acciones administrativas.

## Estado

**Aprobado**

## Evidencia

- `CP07_panel_administracion.png`
- `CAP07_login_administrador_correcto.png`

---

# CP-08: Actualización de estado y notificación al funcionario

## Resultado obtenido

El requerimiento Nº 34 fue actualizado desde Administración. El estado cambió de `Pendiente` a `En revisión`, el sistema confirmó la actualización y la funcionaria recibió una notificación informando el cambio.

## Estado

**Aprobado**

## Evidencia

- `CAP08_actualizacion_exitosa_admin.png`
- `CAP08_estado_actualizado_admin.png`
- `CP08_actualizacion_y_notificacion.png`

---

# CP-09: Bloqueo de acceso administrativo

## Resultado obtenido

Con una sesión de funcionario activa se ingresó manualmente a `/admin/requerimientos`. El sistema bloqueó el acceso y mostró el error `403 - No tiene permiso para acceder a esta sección.`

## Estado

**Aprobado**

## Evidencia

`CP09_acceso_bloqueado_403.png`

---

# CP-10: Cancelación de eliminación con SweetAlert2

## Resultado obtenido

SweetAlert2 mostró la confirmación de eliminación. Al seleccionar Cancelar, el requerimiento permaneció visible en el listado administrativo.

## Estado

**Aprobado**

## Evidencia

`CAP10_sweetalert_confirmacion.png`

---

# CP-11: Confirmación de eliminación

## Resultado obtenido

La eliminación fue confirmada y el sistema mostró el mensaje `Requerimiento eliminado correctamente.`

## Estado

**Aprobado**

## Evidencia

`CP11_requerimiento_eliminado.png`

---

# CP-12: Notificaciones marcadas como leídas

## Resultado obtenido

Antes de abrir la sección, la campanita mostraba una notificación pendiente. Después de ingresar a Notificaciones, el contador desapareció y la notificación dejó de mostrarse como `Nueva`.

## Estado

**Aprobado**

## Evidencia

`CP12_notificaciones_leidas.png`

---

# Resumen de ejecución

| Código | Caso de prueba                                        | Estado   |
| ------ | ----------------------------------------------------- | -------- |
| CP-01  | Inicio de sesión correcto del funcionario             | Aprobado |
| CP-02  | Inicio de sesión con contraseña incorrecta            | Aprobado |
| CP-03  | Registro de un nuevo funcionario                      | Aprobado |
| CP-04  | Creación correcta de un requerimiento                 | Aprobado |
| CP-05  | Validación de campo obligatorio                       | Aprobado |
| CP-06  | Consulta de requerimientos propios                    | Aprobado |
| CP-07  | Acceso de la administradora                           | Aprobado |
| CP-08  | Actualización de estado y notificación al funcionario | Aprobado |
| CP-09  | Bloqueo de acceso administrativo                      | Aprobado |
| CP-10  | Cancelación de eliminación con SweetAlert2            | Aprobado |
| CP-11  | Confirmación de eliminación                           | Aprobado |
| CP-12  | Notificaciones marcadas como leídas                   | Aprobado |

## Resultado general

```text
Casos ejecutados: 12
Casos aprobados: 12
Casos rechazados: 0
Casos bloqueados: 0
Porcentaje de aprobación: 100 %
```

## Conclusión

Los 12 casos definidos fueron ejecutados satisfactoriamente y cuentan con evidencia almacenada en `documentacion/CAPTURAS/`.
