@extends('layout')

@section('content')

<div class="card">
    <h1>Mis requerimientos</h1>

    <p>
        En esta sección podrás revisar los requerimientos informáticos ingresados,
        consultar su estado actual y acceder al detalle de cada solicitud.
    </p>
</div>

<div class="card" style="margin-top: 25px; overflow-x: auto;">
    <h2>Listado de solicitudes</h2>

    <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
        <thead>
            <tr style="background: #5B3F95; color: white;">
                <th style="padding: 12px; text-align: left;">N°</th>
                <th style="padding: 12px; text-align: left;">Título</th>
                <th style="padding: 12px; text-align: left;">Categoría</th>
                <th style="padding: 12px; text-align: left;">Prioridad</th>
                <th style="padding: 12px; text-align: left;">Estado</th>
                <th style="padding: 12px; text-align: left;">Fecha</th>
                <th style="padding: 12px; text-align: left;">Acción</th>
            </tr>
        </thead>

        <tbody>
            <tr style="border-bottom: 1px solid #e5e7eb;">
                <td style="padding: 12px;">1</td>
                <td style="padding: 12px;">Problema para acceder al correo</td>
                <td style="padding: 12px;">Correo institucional</td>
                <td style="padding: 12px;">Alta</td>
                <td style="padding: 12px;">En revisión</td>
                <td style="padding: 12px;">02-07-2026</td>
                <td style="padding: 12px;">
                    <a href="/requerimientos/1" class="btn" style="padding: 8px 12px; margin-top: 0;">
                        Ver detalle
                    </a>
                    </a>
                </td>
            </tr>

            <tr style="border-bottom: 1px solid #e5e7eb;">
                <td style="padding: 12px;">2</td>
                <td style="padding: 12px;">Impresora no responde</td>
                <td style="padding: 12px;">Impresora</td>
                <td style="padding: 12px;">Media</td>
                <td style="padding: 12px;">Pendiente</td>
                <td style="padding: 12px;">02-07-2026</td>
                <td style="padding: 12px;">
                    <a href="/requerimientos/1" class="btn" style="padding: 8px 12px; margin-top: 0;">
                        Ver detalle
                    </a>
                </td>
            </tr>

            <tr style="border-bottom: 1px solid #e5e7eb;">
                <td style="padding: 12px;">3</td>
                <td style="padding: 12px;">Solicitud de creación de usuario</td>
                <td style="padding: 12px;">Usuario y contraseña</td>
                <td style="padding: 12px;">Baja</td>
                <td style="padding: 12px;">Resuelto</td>
                <td style="padding: 12px;">01-07-2026</td>
                <td style="padding: 12px;">
                    <a href="/requerimientos/1" class="btn" style="padding: 8px 12px; margin-top: 0;">
                        Ver detalle
                    </a>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

    <a href="/funcionario" class="btn" style="background: #6B7280; margin-top: 20px;">
        Volver al panel
    </a>
</div>

@endsection