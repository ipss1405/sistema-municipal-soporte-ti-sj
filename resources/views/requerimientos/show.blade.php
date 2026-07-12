@extends('layout')

@section('content')

<div class="card">
    <h1>Detalle del requerimiento</h1>

    <p>
        En esta sección se muestra la información registrada para el requerimiento
        y los avances realizados por el área de informática.
    </p>
</div>

<div class="grid-inicio" style="margin-top: 25px;">

    <section class="card">
        <h2>Información de la solicitud</h2>

        <p><strong>N° de requerimiento:</strong> 1</p>
        <p><strong>Título:</strong> Problema para acceder al correo</p>
        <p><strong>Categoría:</strong> Correo institucional</p>
        <p><strong>Prioridad:</strong> Alta</p>
        <p><strong>Estado actual:</strong> En revisión</p>
        <p><strong>Fecha de ingreso:</strong> 02-07-2026</p>

        <h3>Descripción del problema</h3>

        <p>
            El funcionario indica que no puede acceder a su correo institucional.
            Al intentar ingresar, el sistema muestra un mensaje de error de autenticación.
        </p>

        <a href="/mis-requerimientos" class="btn" style="background: #6B7280;">
            Volver al listado
        </a>
    </section>

    <aside class="panel-accesos">
        <h2>Seguimiento</h2>

        <div style="background: #6B4BB0; padding: 12px; border-radius: 5px; margin-bottom: 12px;">
            <strong>02-07-2026 09:30</strong>
            <p style="margin-bottom: 0;">
                Requerimiento ingresado por el funcionario.
            </p>
        </div>

        <div style="background: #6B4BB0; padding: 12px; border-radius: 5px; margin-bottom: 12px;">
            <strong>02-07-2026 10:15</strong>
            <p style="margin-bottom: 0;">
                El área de informática revisa la solicitud y cambia el estado a En revisión.
            </p>
        </div>

        <div style="background: #6B4BB0; padding: 12px; border-radius: 5px;">
            <strong>02-07-2026 11:00</strong>
            <p style="margin-bottom: 0;">
                Se verifica el acceso del usuario y se solicita revisión de credenciales.
            </p>
        </div>
    </aside>

</div>

@endsection