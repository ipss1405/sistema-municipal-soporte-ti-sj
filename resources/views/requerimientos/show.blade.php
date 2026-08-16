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

    .tarea-tecnico {
        background: #F3E8FF;
        padding: 15px;
        border-radius: 8px;
        border-left: 5px solid #5B3F95;
        margin: 18px 0;
    }

    .tarea-tecnico h3 {
        color: #5B3F95;
        margin-top: 0;
        margin-bottom: 8px;
        font-size: 19px;
    }

    .tarea-tecnico p {
        margin-bottom: 0;
    }

    .gestion-tecnica {
        background: #F8FAFC;
        border: 1px solid #E5E7EB;
        border-left: 5px solid #5B3F95;
        border-radius: 8px;
        padding: 16px;
        margin: 18px 0;
    }

    .gestion-tecnica h3 {
        color: #5B3F95;
        margin-top: 0;
        margin-bottom: 12px;
        font-size: 20px;
    }

    .gestion-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px 20px;
    }

    .gestion-item {
        margin: 0;
    }

    .gestion-item strong {
        display: block;
        margin-bottom: 3px;
    }

    .avance-interno {
        background: #FFFFFF;
        border-radius: 6px;
        padding: 12px;
        margin-top: 12px;
        border-left: 4px solid #78BE20;
    }

    .seguimiento-funcionario {
        background: #EEF7E8;
        padding: 15px;
        border-radius: 8px;
        border-left: 5px solid #78BE20;
        margin: 18px 0;
    }

    .seguimiento-funcionario h3 {
        color: #5B3F95;
        margin: 0 0 10px 0;
        font-size: 19px;
    }

    .seguimiento-funcionario p {
        margin: 6px 0;
    }

    @media (max-width: 800px) {
        .detalle-grid {
            grid-template-columns: 1fr;
        }

        .gestion-grid {
            grid-template-columns: 1fr;
        }
    }
</style>


@php
    $rolUsuario = auth()->user()->rol;

    $esTecnicoAsignado =
        $rolUsuario === 'tecnico' &&
        $requerimiento->tecnico_id === auth()->id();

    $puedeVerGestionInterna =
        $rolUsuario === 'administrador' ||
        $esTecnicoAsignado;
@endphp


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

                    <h3>Responsable TI</h3>

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


            {{-- TAREA ASIGNADA --}}
            {{-- Solo administrador y técnico asignado --}}
            @if ($puedeVerGestionInterna)

                @if ($requerimiento->tarea_asignada)

                    <div class="tarea-tecnico">

                        <h3>Tarea asignada al técnico</h3>

                        <p>
                            {{ $requerimiento->tarea_asignada }}
                        </p>

                    </div>

                @endif

            @endif


            {{-- DESCRIPCIÓN ORIGINAL --}}
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


            {{-- GESTIÓN TÉCNICA INTERNA --}}
            {{-- Visible solo para administrador y técnico responsable --}}
            @if (
                $puedeVerGestionInterna &&
                (
                    $requerimiento->avance_tecnico ||
                    $requerimiento->tiempo_estimado ||
                    $requerimiento->requiere_materiales
                )
            )

                <div class="gestion-tecnica">

                    <h3>Gestión técnica</h3>

                    <div class="gestion-grid">

                        <p class="gestion-item">

                            <strong>Responsable</strong>

                            {{ $requerimiento->tecnico?->name ?? 'Sin responsable' }}

                        </p>


                        <p class="gestion-item">

                            <strong>Estado actual</strong>

                            <x-estado :estado="$requerimiento->estado" />

                        </p>


                        <p class="gestion-item">

                            <strong>¿Requiere materiales?</strong>

                            {{ $requerimiento->requiere_materiales ? 'Sí' : 'No' }}

                        </p>


                        <p class="gestion-item">

                            <strong>Tiempo estimado</strong>

                            {{ $requerimiento->tiempo_estimado ?: 'No informado' }}

                        </p>

                    </div>


                    @if (
                        $requerimiento->requiere_materiales &&
                        $requerimiento->materiales_requeridos
                    )

                        <div style="
                            background: #FFF7ED;
                            border-left: 4px solid #F26B21;
                            padding: 12px;
                            border-radius: 6px;
                            margin-top: 12px;
                        ">

                            <strong>
                                Materiales o repuestos requeridos:
                            </strong>

                            <div style="margin-top: 5px;">
                                {{ $requerimiento->materiales_requeridos }}
                            </div>

                        </div>

                    @endif


                    @if ($requerimiento->avance_tecnico)

                        <div class="avance-interno">

                            <strong>
                                Avance o trabajo realizado:
                            </strong>

                            <div style="margin-top: 6px;">
                                {{ $requerimiento->avance_tecnico }}
                            </div>

                        </div>

                    @endif

                </div>

            @endif


            {{-- INFORMACIÓN SIMPLIFICADA PARA EL FUNCIONARIO --}}
            @if (
                $rolUsuario === 'funcionario' &&
                $requerimiento->tiempo_estimado
            )

                <div class="seguimiento-funcionario">

                    <h3>Seguimiento de la atención</h3>

                    <p>
                        <strong>Responsable TI:</strong>
                        {{ $requerimiento->tecnico?->name ?? 'Pendiente de asignación' }}
                    </p>

                    <p>
                        <strong>Estado:</strong>
                        <x-estado :estado="$requerimiento->estado" />
                    </p>

                    <p>
                        <strong>Tiempo estimado:</strong>
                        {{ $requerimiento->tiempo_estimado }}
                    </p>

                </div>

            @endif


            {{-- INFORMACIÓN PARA EL FUNCIONARIO --}}
            @if ($requerimiento->respuesta_admin)

                <p>
                    <strong>Información para el funcionario:</strong>
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
                    información para este requerimiento.
                </p>

            @endif


            {{-- NAVEGACIÓN SEGÚN ROL --}}

            @if ($rolUsuario === 'administrador')

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


            @elseif ($rolUsuario === 'tecnico')

                <a
                    href="{{ route('tecnico.requerimientos.gestionar', $requerimiento) }}"
                    class="btn"
                >
                    Gestionar atención
                </a>

                <a
                    href="{{ route('tecnico.dashboard') }}"
                    class="btn"
                    style="
                        background: #6B7280;
                        margin-left: 10px;
                    "
                >
                    Volver al Panel Técnico
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


        {{-- PANEL DE SEGUIMIENTO --}}
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


            @if ($requerimiento->tiempo_estimado)

                <p>
                    <strong>Tiempo estimado:</strong><br>
                    {{ $requerimiento->tiempo_estimado }}
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