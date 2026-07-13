@extends('layout')

@section('content')

<div class="card">
    <h1>Detalle del requerimiento</h1>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px; align-items: start;">

        <section>
            <h2>Información de la solicitud</h2>

            <p>
                <strong>N° de requerimiento:</strong>
                {{ $requerimiento->id }}
            </p>

            <p>
                <strong>Título:</strong>
                {{ $requerimiento->titulo }}
            </p>

            <p>
                <strong>Categoría:</strong>
                {{ ucfirst($requerimiento->categoria) }}
            </p>

            <p>
                <strong>Prioridad:</strong>
                {{ ucfirst($requerimiento->prioridad) }}
            </p>

            <p>
                <strong>Estado:</strong>
                <x-estado :estado="$requerimiento->estado" />
            </p>

            <p>
                <strong>Fecha de ingreso:</strong>
                {{ $requerimiento->created_at->format('d-m-Y H:i') }}
            </p>

            <p>
                <strong>Descripción:</strong>
            </p>

            <p style="
                background: #F9FAFB;
                padding: 15px;
                border-radius: 6px;
                border-left: 5px solid #78BE20;
            ">
                {{ $requerimiento->descripcion }}
            </p>

            @if ($requerimiento->respuesta_admin)
                <p>
                    <strong>Respuesta de informática:</strong>
                </p>

                <p style="
                    background: #EAF7E3;
                    padding: 15px;
                    border-radius: 6px;
                    border-left: 5px solid #5B3F95;
                ">
                    {{ $requerimiento->respuesta_admin }}
                </p>
            @else
                <p style="
                    background: #FEF3C7;
                    color: #92400E;
                    padding: 12px;
                    border-radius: 6px;
                    border-left: 5px solid #F26B21;
                ">
                    El área de informática aún no ha ingresado una respuesta para este requerimiento.
                </p>
            @endif

            <a href="/mis-requerimientos" class="btn" style="background: #6B7280;">
                Volver al listado
            </a>
        </section>

        <aside class="panel-accesos">
            <h2>Seguimiento</h2>

            <p>
                <strong>Estado actual:</strong><br>
                <x-estado :estado="$requerimiento->estado" />
            </p>

            <p>
                <strong>Ingreso:</strong><br>
                {{ $requerimiento->created_at->format('d-m-Y H:i') }}
            </p>

            <p>
                <strong>Última actualización:</strong><br>
                {{ $requerimiento->updated_at->format('d-m-Y H:i') }}
            </p>

            @if ($requerimiento->fecha_cierre)
                <p>
                    <strong>Fecha de cierre:</strong><br>
                    {{ $requerimiento->fecha_cierre }}
                </p>
            @else
                <p>
                    <strong>Fecha de cierre:</strong><br>
                    Pendiente
                </p>
            @endif
        </aside>

    </div>
</div>

@endsection