# Evidencias de Pruebas

## 1. Descripción general

Este documento registra las evidencias obtenidas durante la ejecución manual de los casos de prueba del **Sistema Municipal de Soporte TI**.

Las capturas se encuentran almacenadas en:

```text
documentacion/CAPTURAS/
```

## 2. Resultado general

```text
Casos ejecutados: 12
Casos aprobados: 12
Casos rechazados: 0
Casos bloqueados: 0
Porcentaje de aprobación: 100 %
```

## 3. Evidencias oficiales

| Código | Caso de prueba                                        | Evidencia principal                     | Estado   |
| ------ | ----------------------------------------------------- | --------------------------------------- | -------- |
| CP-01  | Inicio de sesión correcto del funcionario             | `CP01_login_funcionario_aprobado.png`   | Aprobado |
| CP-02  | Inicio de sesión con contraseña incorrecta            | `CP02_login_incorrecto.png`             | Aprobado |
| CP-03  | Registro de un nuevo funcionario                      | `CP03_registro_funcionario.png`         | Aprobado |
| CP-04  | Creación correcta de un requerimiento                 | `CP04_requerimiento_creado.png`         | Aprobado |
| CP-05  | Validación de campo obligatorio                       | `CP05_validaciones_formulario.png`      | Aprobado |
| CP-06  | Consulta de requerimientos propios                    | `CP06_mis_requerimientos_detalle.png`   | Aprobado |
| CP-07  | Acceso de la administradora                           | `CP07_panel_administracion.png`         | Aprobado |
| CP-08  | Actualización de estado y notificación al funcionario | `CP08_actualizacion_y_notificacion.png` | Aprobado |
| CP-09  | Bloqueo de acceso administrativo                      | `CP09_acceso_bloqueado_403.png`         | Aprobado |
| CP-10  | Cancelación de eliminación con SweetAlert2            | `CAP10_sweetalert_confirmacion.png`      | Aprobado |
| CP-11  | Confirmación de eliminación                           | `CP11_requerimiento_eliminado.png`      | Aprobado |
| CP-12  | Notificaciones marcadas como leídas                   | `CP12_notificaciones_leidas.png`        | Aprobado |

## 4. Evidencias complementarias

Además de las evidencias oficiales, se registraron capturas complementarias para documentar la interfaz, navegación por roles, cambios de estado y seguridad.

Entre ellas:

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

## 5. Evidencia de seguridad adicional

La captura `CAP_SEGURIDAD_cierre_sesion_correcto.png` muestra el mensaje `Sesión cerrada correctamente` y respalda el funcionamiento del cierre seguro de sesión.

## 6. Evidencia documental final

Las capturas pueden incorporarse posteriormente en:

```text
documentacion/EVIDENCIAS_EVA2_SISTEMA_SOPORTE_TI.pdf
```

## Conclusión

Las evidencias recopiladas respaldan la ejecución de los 12 casos de prueba funcionales. Todos los casos definidos fueron aprobados y cuentan con respaldo visual dentro de `documentacion/CAPTURAS/`.
