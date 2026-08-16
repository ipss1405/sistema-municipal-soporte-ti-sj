@extends('layout')

@section('content')

<style>
    .detalle-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
        align-items: start;
    }

    .responsable-ti {
        background: #EEF7E8;
        padding: 15px;
        border-radius: 8px;
        border-left: 5px solid #78BE20;
        margin: 18px 0;
    }

    .responsable-ti h3 {
        color: #5B3F95;
        margin-top: 0;
        margin-bottom: 10px;
        font-size: 19px;
    }

    .responsable-ti p {
        margin: 5px 0;
    }

    .sin-responsable {
        display: inline-block;
        background: #FEF3C7;
        color: #92400E;
        padding: 8px 12px;
        border-radius: 8px;
        border-left: 4px solid #F59E0B;
        margin: 12px 0 18px;
        font-size: 14px;
        font-weight: 600;
    }

    @media (max-width: 800px) {
        .detalle-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="card">

    <h1>Detalle del requerimiento</h1>

    <div class="detalle-grid">

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

                @if ($requerimiento->prioridad === 'sin_asignar')
                    Sin asignar
                @else
                    {{ ucfirst($requerimiento->prioridad) }}
                @endif
            </p>

            <p>
                <strong>Estado:</strong>
                <x-estado :estado="$requerimiento->estado" />
            </p>

            <p>
                <strong>Fecha de ingreso:</strong>
                {{ $requerimiento->created_at->format('d-m-Y H:i') }}
            </p>

            {{-- RESPONSABLE TI --}}
            @if ($requerimiento->tecnico)

                <div class="responsable-ti">

                    <h3>
                        Responsable TI
                    </h3>

                    <p>
                        <strong>Técnico asignado:</strong>
                        {{ $requerimiento->tecnico->name }}
                    </p>

                    @if ($requerimiento->fecha_asignacion)

                        <p>
                            <strong>Fecha y hora de asignación:</strong>
                            {{ $requerimiento->fecha_asignacion->format('d-m-Y H:i') }}
                        </p>

                    @endif

                </div>

            @else

                <div class="sin-responsable">
                    ⚠️ Responsable TI pendiente de asignación
                </div>

            @endif

            {{-- DESCRIPCIÓN --}}
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

            {{-- RESPUESTA PARA EL FUNCIONARIO --}}
            @if ($requerimiento->respuesta_admin)

                <p>
                    <strong>Respuesta para el funcionario:</strong>
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
                    El área de Informática aún no ha ingresado
                    una respuesta para este requerimiento.
                </p>

            @endif

            {{-- NAVEGACIÓN SEGÚN EL ROL --}}
            @if (auth()->user()->rol === 'administrador')

                <a
                    href="{{ route('admin.requerimientos.edit', $requerimiento) }}"
                    class="btn"
                >
                    Gestionar requerimiento
                </a>

                <a
                    href="{{ route('admin.requerimientos.index') }}"
                    class="btn"
                    style="
                        background: #6B7280;
                        margin-left: 10px;
                    "
                >
                    Volver a administración
                </a>

            @else

                <a
                    href="{{ route('requerimientos.index') }}"
                    class="btn"
                    style="background: #6B7280;"
                >
                    Volver a mis requerimientos
                </a>

            @endif

        </section>

        {{-- SEGUIMIENTO --}}
        <aside class="panel-accesos">

            <h2>Seguimiento</h2>

            <p>
                <strong>Estado actual:</strong><br>
                <x-estado :estado="$requerimiento->estado" />
            </p>

            <p>
                <strong>Responsable TI:</strong><br>

                @if ($requerimiento->tecnico)
                    {{ $requerimiento->tecnico->name }}
                @else
                    Pendiente de asignación
                @endif
            </p>

            <p>
                <strong>Ingreso:</strong><br>
                {{ $requerimiento->created_at->format('d-m-Y H:i') }}
            </p>

            @if ($requerimiento->fecha_asignacion)

                <p>
                    <strong>Asignación TI:</strong><br>
                    {{ $requerimiento->fecha_asignacion->format('d-m-Y H:i') }}
                </p>

            @endif

            <p>
                <strong>Última actualización:</strong><br>
                {{ $requerimiento->updated_at->format('d-m-Y H:i') }}
            </p>

            <p>
                <strong>Fecha de cierre:</strong><br>

                @if ($requerimiento->fecha_cierre)

                    {{ $requerimiento->fecha_cierre->format('d-m-Y H:i') }}

                @else

                    Pendiente

                @endif
            </p>

        </aside>

    </div>

</div>

@endsection