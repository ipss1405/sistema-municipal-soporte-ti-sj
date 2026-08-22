@extends('layout')

@section('content')

{{-- Tabler UI --}}
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler.min.css"
>

<style>
    :root {
        --sj-morado: #5B3F95;
        --sj-morado-claro: #6B4BB0;
        --sj-verde: #78BE20;
        --sj-rojo: #EF3E24;
        --sj-naranjo: #F26B21;

        --sj-texto: #1F2937;
        --sj-texto-suave: #667085;
        --sj-borde: #E5E7EB;
        --sj-fondo-suave: #F8F9FB;
    }

    /* =========================================================
       CONTENEDOR GENERAL
       ========================================================= */

    .detalle-wrapper {
        margin-top: 24px;
        margin-bottom: 28px;
    }

    /* =========================================================
       CABECERA
       ========================================================= */

    .detalle-hero {
        position: relative;
        overflow: hidden;

        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 24px;

        padding: 26px 30px;
        margin-bottom: 20px;

        border-top: 6px solid var(--sj-verde);
        border-radius: 18px;

        background:
            linear-gradient(
                135deg,
                #5B3F95 0%,
                #A43D70 45%,
                #EF3E24 78%,
                #F26B21 100%
            );

        color: #ffffff;

        box-shadow:
            0 11px 28px rgba(91, 63, 149, 0.14);
    }

    .detalle-hero::after {
        content: "";

        position: absolute;

        width: 180px;
        height: 180px;

        right: -70px;
        bottom: -105px;

        border-radius: 50%;

        background:
            rgba(255, 255, 255, 0.08);
    }

    .detalle-hero-contenido {
        position: relative;
        z-index: 1;
    }

    .detalle-etiqueta {
        display: inline-flex;
        align-items: center;

        padding: 6px 14px;
        margin-bottom: 10px;

        border-radius: 999px;

        background: var(--sj-verde);

        color: #ffffff;

        font-size: 0.82rem;
        font-weight: 700;
    }

    .detalle-hero h1 {
        margin: 0 0 7px;

        color: #ffffff;

        font-size: 2rem;
        font-weight: 800;
    }

    .detalle-hero p {
        margin: 0;

        color:
            rgba(255, 255, 255, 0.88);

        font-size: 0.92rem;
        line-height: 1.5;
    }

    /* =========================================================
       BOTÓN VOLVER
       ========================================================= */

    .btn-volver-detalle {
        position: relative;
        z-index: 1;

        flex-shrink: 0;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 40px;

        padding: 8px 15px;

        border:
            1px solid rgba(255, 255, 255, 0.60);

        border-radius: 9px;

        background:
            rgba(255, 255, 255, 0.12);

        color: #ffffff;

        text-decoration: none;

        font-size: 0.84rem;
        font-weight: 700;

        transition:
            background 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .btn-volver-detalle:hover {
        background: #ffffff;

        color: var(--sj-morado);

        transform: translateY(-1px);
    }

    /* =========================================================
       RESUMEN SUPERIOR
       ========================================================= */

    .resumen-solicitud {
        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 14px;

        margin-bottom: 20px;
    }

    .resumen-item {
        min-height: 92px;

        padding: 16px 18px;

        border: 1px solid #ECEEF2;
        border-top: 4px solid var(--sj-verde);
        border-radius: 13px;

        background: #ffffff;

        box-shadow:
            0 6px 17px rgba(91, 63, 149, 0.06);
    }

    .resumen-item-label {
        display: block;

        margin-bottom: 6px;

        color: var(--sj-texto-suave);

        font-size: 0.75rem;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .resumen-item-valor {
        color: var(--sj-texto);

        font-size: 0.92rem;
        font-weight: 700;

        line-height: 1.4;
    }

    /* =========================================================
       TARJETAS GENERALES
       ========================================================= */

    .detalle-card {
        padding: 22px;

        margin-bottom: 18px;

        border: 1px solid #ECEEF2;
        border-radius: 15px;

        background: #ffffff;

        box-shadow:
            0 7px 20px rgba(91, 63, 149, 0.06);
    }

    .detalle-card h2 {
        margin: 0 0 16px;

        color: var(--sj-morado);

        font-size: 1.3rem;
        font-weight: 800;
    }

    .detalle-card h3 {
        margin: 0 0 10px;

        color: var(--sj-morado);

        font-size: 1rem;
        font-weight: 800;
    }

    /* =========================================================
       INFORMACIÓN PRINCIPAL
       ========================================================= */

    .datos-grid {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 14px 24px;
    }

    .dato-item {
        padding-bottom: 11px;

        border-bottom:
            1px solid #F0F1F3;
    }

    .dato-item strong {
        display: block;

        margin-bottom: 4px;

        color: #525A66;

        font-size: 0.79rem;
        font-weight: 700;
    }

    .dato-item span {
        color: var(--sj-texto);

        font-size: 0.91rem;
    }

    /* =========================================================
       DESCRIPCIÓN
       ========================================================= */

    .descripcion-box {
        padding: 15px 17px;

        border-left:
            4px solid var(--sj-verde);

        border-radius: 9px;

        background: #F8FAF7;

        color: #374151;

        font-size: 0.90rem;
        line-height: 1.6;
    }

    /* =========================================================
       RESPONSABLE / ASIGNACIÓN
       ========================================================= */

    .asignacion-card {
        border-left:
            5px solid var(--sj-verde);
    }

    .asignacion-grid {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 15px;
    }

    .asignacion-item strong {
        display: block;

        margin-bottom: 4px;

        color: var(--sj-texto-suave);

        font-size: 0.77rem;
        font-weight: 700;
    }

    .asignacion-item span {
        color: var(--sj-texto);

        font-size: 0.90rem;
        font-weight: 600;
    }

    .sin-responsable {
        display: inline-flex;
        align-items: center;

        padding: 8px 12px;

        border-left:
            4px solid #F59E0B;

        border-radius: 8px;

        background: #FEF3C7;

        color: #92400E;

        font-size: 0.83rem;
        font-weight: 700;
    }

    /* =========================================================
       TAREA ASIGNADA
       ========================================================= */

    .tarea-card {
        border-left:
            5px solid var(--sj-morado);

        background: #FBF9FD;
    }

    .tarea-texto {
        color: #374151;

        font-size: 0.90rem;
        line-height: 1.55;
    }

    /* =========================================================
       GESTIÓN TÉCNICA
       ========================================================= */

    .gestion-card {
        border-left:
            5px solid var(--sj-morado);
    }

    .gestion-grid {
        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 14px;

        margin-bottom: 16px;
    }

    .gestion-item {
        padding: 13px 14px;

        border-radius: 10px;

        background: #F8F9FB;
    }

    .gestion-item strong {
        display: block;

        margin-bottom: 5px;

        color: var(--sj-texto-suave);

        font-size: 0.76rem;
        font-weight: 700;
    }

    .gestion-item span {
        color: var(--sj-texto);

        font-size: 0.88rem;
        font-weight: 600;
    }

    /* =========================================================
       MATERIAL
       ========================================================= */

    .material-box {
        padding: 14px 16px;

        margin-top: 12px;

        border-left:
            4px solid var(--sj-naranjo);

        border-radius: 9px;

        background: #FFF7ED;
    }

    .material-box strong {
        display: block;

        margin-bottom: 5px;

        color: #9A3412;

        font-size: 0.84rem;
    }

    .material-box div {
        color: #6B3A19;

        font-size: 0.89rem;
    }

    /* =========================================================
       AVANCE
       ========================================================= */

    .avance-box {
        padding: 14px 16px;

        margin-top: 12px;

        border-left:
            4px solid var(--sj-verde);

        border-radius: 9px;

        background: #F6FBF2;
    }

    .avance-box strong {
        display: block;

        margin-bottom: 5px;

        color: #3E6815;

        font-size: 0.84rem;
    }

    .avance-box div {
        color: #374151;

        font-size: 0.89rem;
        line-height: 1.5;
    }

    /* =========================================================
       INFORMACIÓN FUNCIONARIO
       ========================================================= */

    .funcionario-card {
        border-left:
            5px solid var(--sj-verde);

        background: #FBFFF8;
    }

    .funcionario-mensaje {
        color: #374151;

        font-size: 0.91rem;
        line-height: 1.55;
    }

    .sin-informacion {
        padding: 13px 15px;

        border-left:
            4px solid var(--sj-naranjo);

        border-radius: 9px;

        background: #FEF3C7;

        color: #92400E;

        font-size: 0.85rem;
    }

    /* =========================================================
       SEGUIMIENTO FUNCIONARIO
       ========================================================= */

    .seguimiento-card {
        border-left:
            5px solid var(--sj-verde);
    }

    .seguimiento-grid {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 14px;
    }

    /* =========================================================
       ACCIONES
       ========================================================= */

    .detalle-acciones {
        display: flex;
        flex-wrap: wrap;

        gap: 10px;

        margin-top: 4px;
    }

    .btn-detalle-accion {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 42px;

        padding: 9px 17px;

        border: 0;
        border-radius: 9px;

        text-decoration: none;

        font-size: 0.86rem;
        font-weight: 700;

        transition:
            background 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .btn-detalle-accion:hover {
        transform: translateY(-1px);
    }

    .btn-accion-principal {
        background: var(--sj-morado);
        color: #ffffff;
    }

    .btn-accion-principal:hover {
        background: var(--sj-verde);
        color: #ffffff;
    }

    .btn-accion-secundaria {
        background: #6B7280;
        color: #ffffff;
    }

    .btn-accion-secundaria:hover {
        background: #4B5563;
        color: #ffffff;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 991px) {

        .resumen-solicitud {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

        .gestion-grid {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

        .asignacion-grid {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 767px) {

        .detalle-wrapper {
            margin-top: 16px;
            margin-bottom: 20px;
        }

        .detalle-hero {
            flex-direction: column;
            align-items: flex-start;

            padding: 22px;
        }

        .detalle-hero h1 {
            font-size: 1.65rem;
        }

        .btn-volver-detalle {
            width: 100%;
        }

        .resumen-solicitud,
        .datos-grid,
        .gestion-grid,
        .asignacion-grid,
        .seguimiento-grid {
            grid-template-columns: 1fr;
        }

        .detalle-card {
            padding: 18px;
        }

        .detalle-acciones {
            flex-direction: column;
        }

        .btn-detalle-accion {
            width: 100%;
        }
    }
</style>


@php

    $rolUsuario =
        auth()->user()->rol;

    $esTecnicoAsignado =
        $rolUsuario === 'tecnico' &&
        $requerimiento->tecnico_id === auth()->id();

    $puedeVerGestionInterna =
        $rolUsuario === 'administrador' ||
        $esTecnicoAsignado;

@endphp


<div class="container detalle-wrapper">

    {{-- =====================================================
         CABECERA
         ===================================================== --}}

    <div class="detalle-hero">

        <div class="detalle-hero-contenido">

            <span class="detalle-etiqueta">

                @if ($rolUsuario === 'administrador')

                    Gestión administrativa

                @elseif ($rolUsuario === 'tecnico')

                    Gestión técnica

                @else

                    Seguimiento de solicitud

                @endif

            </span>


            <h1>
                Requerimiento #{{ $requerimiento->id }}
                · {{ $requerimiento->titulo }}
            </h1>


            <p>

                {{ ucfirst($requerimiento->categoria) }}

                ·

                @if ($requerimiento->prioridad === 'sin_asignar')

                    Prioridad sin asignar

                @else

                    Prioridad
                    {{ ucfirst($requerimiento->prioridad) }}

                @endif

            </p>

        </div>


        {{-- BOTÓN VOLVER SEGÚN EL ROL --}}

        @if ($rolUsuario === 'administrador')

            <a
                href="{{ route('admin.requerimientos.index') }}"
                class="btn-volver-detalle"
            >
                ← Volver a administración
            </a>


        @elseif ($rolUsuario === 'tecnico')

            <a
                href="{{ route('tecnico.dashboard') }}"
                class="btn-volver-detalle"
            >
                ← Volver al panel técnico
            </a>


        @else

            <a
                href="{{ route('requerimientos.index') }}"
                class="btn-volver-detalle"
            >
                ← Volver a mis requerimientos
            </a>

        @endif

    </div>


    {{-- =====================================================
         RESUMEN
         ===================================================== --}}

    <div class="resumen-solicitud">

        <div class="resumen-item">

            <span class="resumen-item-label">
                Estado
            </span>

            <div class="resumen-item-valor">
                <x-estado :estado="$requerimiento->estado" />
            </div>

        </div>


        <div class="resumen-item">

            <span class="resumen-item-label">
                Responsable TI
            </span>

            <div class="resumen-item-valor">

                {{ $requerimiento->tecnico?->name
                    ?? 'Pendiente de asignación'
                }}

            </div>

        </div>


        <div class="resumen-item">

            <span class="resumen-item-label">
                Fecha de ingreso
            </span>

            <div class="resumen-item-valor">

                {{ $requerimiento->created_at->format('d-m-Y') }}

                <br>

                {{ $requerimiento->created_at->format('H:i') }}

            </div>

        </div>


        <div class="resumen-item">

            <span class="resumen-item-label">
                Última actualización
            </span>

            <div class="resumen-item-valor">

                {{ $requerimiento->updated_at->format('d-m-Y') }}

                <br>

                {{ $requerimiento->updated_at->format('H:i') }}

            </div>

        </div>

    </div>


    {{-- =====================================================
         INFORMACIÓN DE LA SOLICITUD
         ===================================================== --}}

    <div class="detalle-card">

        <h2>
            Información de la solicitud
        </h2>


        <div class="datos-grid">

            <div class="dato-item">

                <strong>
                    N.º de requerimiento
                </strong>

                <span>
                    #{{ $requerimiento->id }}
                </span>

            </div>


            <div class="dato-item">

                <strong>
                    Título
                </strong>

                <span>
                    {{ $requerimiento->titulo }}
                </span>

            </div>


            <div class="dato-item">

                <strong>
                    Categoría
                </strong>

                <span>
                    {{ ucfirst($requerimiento->categoria) }}
                </span>

            </div>


            <div class="dato-item">

                <strong>
                    Prioridad
                </strong>

                <span>

                    @if ($requerimiento->prioridad === 'sin_asignar')

                        Sin asignar

                    @else

                        {{ ucfirst($requerimiento->prioridad) }}

                    @endif

                </span>

            </div>

        </div>


        <div style="margin-top: 18px;">

            <h3>
                Descripción
            </h3>

            <div class="descripcion-box">

                {{ $requerimiento->descripcion }}

            </div>

        </div>

    </div>


    {{-- =====================================================
         RESPONSABLE TI
         ===================================================== --}}

    <div class="detalle-card asignacion-card">

        <h2>
            Asignación TI
        </h2>


        @if ($requerimiento->tecnico)

            <div class="asignacion-grid">

                <div class="asignacion-item">

                    <strong>
                        Técnico responsable
                    </strong>

                    <span>
                        {{ $requerimiento->tecnico->name }}
                    </span>

                </div>


                <div class="asignacion-item">

                    <strong>
                        Fecha de asignación
                    </strong>

                    <span>

                        @if ($requerimiento->fecha_asignacion)

                            {{ $requerimiento->fecha_asignacion->format('d-m-Y H:i') }}

                        @else

                            No registrada

                        @endif

                    </span>

                </div>


                <div class="asignacion-item">

                    <strong>
                        Tiempo estimado
                    </strong>

                    <span>
                        {{ $requerimiento->tiempo_estimado
                            ?: 'No informado'
                        }}
                    </span>

                </div>

            </div>


        @else

            <div class="sin-responsable">
                Responsable TI pendiente de asignación
            </div>

        @endif

    </div>


    {{-- =====================================================
         TAREA INTERNA
         SOLO ADMINISTRADOR Y TÉCNICO ASIGNADO
         ===================================================== --}}

    @if (
        $puedeVerGestionInterna &&
        $requerimiento->tarea_asignada
    )

        <div class="detalle-card tarea-card">

            <h2>
                Tarea asignada al técnico
            </h2>

            <div class="tarea-texto">

                {{ $requerimiento->tarea_asignada }}

            </div>

        </div>

    @endif


    {{-- =====================================================
         GESTIÓN TÉCNICA INTERNA
         ===================================================== --}}

    @if (
        $puedeVerGestionInterna &&
        (
            $requerimiento->avance_tecnico ||
            $requerimiento->tiempo_estimado ||
            $requerimiento->requiere_materiales
        )
    )

        <div class="detalle-card gestion-card">

            <h2>
                Gestión técnica
            </h2>


            <div class="gestion-grid">

                <div class="gestion-item">

                    <strong>
                        Responsable
                    </strong>

                    <span>
                        {{ $requerimiento->tecnico?->name
                            ?? 'Sin responsable'
                        }}
                    </span>

                </div>


                <div class="gestion-item">

                    <strong>
                        Estado actual
                    </strong>

                    <span>
                        <x-estado :estado="$requerimiento->estado" />
                    </span>

                </div>


                <div class="gestion-item">

                    <strong>
                        ¿Requiere materiales?
                    </strong>

                    <span>
                        {{ $requerimiento->requiere_materiales
                            ? 'Sí'
                            : 'No'
                        }}
                    </span>

                </div>


                <div class="gestion-item">

                    <strong>
                        Tiempo estimado
                    </strong>

                    <span>
                        {{ $requerimiento->tiempo_estimado
                            ?: 'No informado'
                        }}
                    </span>

                </div>

            </div>


            {{-- MATERIAL --}}

            @if (
                $requerimiento->requiere_materiales &&
                $requerimiento->materiales_requeridos
            )

                <div class="material-box">

                    <strong>
                        Materiales o repuestos requeridos
                    </strong>

                    <div>
                        {{ $requerimiento->materiales_requeridos }}
                    </div>

                </div>

            @endif


            {{-- AVANCE --}}

            @if ($requerimiento->avance_tecnico)

                <div class="avance-box">

                    <strong>
                        Avance o trabajo realizado
                    </strong>

                    <div>
                        {{ $requerimiento->avance_tecnico }}
                    </div>

                </div>

            @endif

        </div>

    @endif


    {{-- =====================================================
         SEGUIMIENTO SIMPLIFICADO PARA FUNCIONARIO
         ===================================================== --}}

    @if (
        $rolUsuario === 'funcionario' &&
        $requerimiento->tiempo_estimado
    )

        <div class="detalle-card seguimiento-card">

            <h2>
                Seguimiento de la atención
            </h2>


            <div class="seguimiento-grid">

                <div class="gestion-item">

                    <strong>
                        Responsable TI
                    </strong>

                    <span>
                        {{ $requerimiento->tecnico?->name
                            ?? 'Pendiente de asignación'
                        }}
                    </span>

                </div>


                <div class="gestion-item">

                    <strong>
                        Estado
                    </strong>

                    <span>
                        <x-estado :estado="$requerimiento->estado" />
                    </span>

                </div>


                <div class="gestion-item">

                    <strong>
                        Tiempo estimado
                    </strong>

                    <span>
                        {{ $requerimiento->tiempo_estimado }}
                    </span>

                </div>

            </div>

        </div>

    @endif


    {{-- =====================================================
         INFORMACIÓN PARA EL FUNCIONARIO
         ===================================================== --}}

    <div class="detalle-card funcionario-card">

        <h2>
            Información para el funcionario
        </h2>


        @if ($requerimiento->respuesta_admin)

            <div class="funcionario-mensaje">

                {{ $requerimiento->respuesta_admin }}

            </div>


        @else

            <div class="sin-informacion">

                El área de Informática aún no ha ingresado
                información para este requerimiento.

            </div>

        @endif

    </div>


    {{-- =====================================================
         FECHAS DE CIERRE
         ===================================================== --}}

    <div class="detalle-card">

        <h2>
            Seguimiento del requerimiento
        </h2>


        <div class="datos-grid">

            <div class="dato-item">

                <strong>
                    Fecha de ingreso
                </strong>

                <span>
                    {{ $requerimiento->created_at->format('d-m-Y H:i') }}
                </span>

            </div>


            <div class="dato-item">

                <strong>
                    Última actualización
                </strong>

                <span>
                    {{ $requerimiento->updated_at->format('d-m-Y H:i') }}
                </span>

            </div>


            <div class="dato-item">

                <strong>
                    Fecha de asignación TI
                </strong>

                <span>

                    @if ($requerimiento->fecha_asignacion)

                        {{ $requerimiento->fecha_asignacion->format('d-m-Y H:i') }}

                    @else

                        Pendiente

                    @endif

                </span>

            </div>


            <div class="dato-item">

                <strong>
                    Fecha de cierre
                </strong>

                <span>

                    @if ($requerimiento->fecha_cierre)

                        {{ $requerimiento->fecha_cierre->format('d-m-Y H:i') }}

                    @else

                        Pendiente

                    @endif

                </span>

            </div>

        </div>

    </div>


    {{-- =====================================================
         ACCIONES SEGÚN ROL
         ===================================================== --}}

    <div class="detalle-acciones">

        @if ($rolUsuario === 'administrador')

            <a
                href="{{ route(
                    'admin.requerimientos.edit',
                    $requerimiento
                ) }}"
                class="
                    btn-detalle-accion
                    btn-accion-principal
                "
            >
                Gestionar requerimiento
            </a>


            <a
                href="{{ route(
                    'admin.requerimientos.index'
                ) }}"
                class="
                    btn-detalle-accion
                    btn-accion-secundaria
                "
            >
                Volver a administración
            </a>


        @elseif ($rolUsuario === 'tecnico')

            <a
                href="{{ route(
                    'tecnico.requerimientos.gestionar',
                    $requerimiento
                ) }}"
                class="
                    btn-detalle-accion
                    btn-accion-principal
                "
            >
                Gestionar atención
            </a>


            <a
                href="{{ route('tecnico.dashboard') }}"
                class="
                    btn-detalle-accion
                    btn-accion-secundaria
                "
            >
                Volver al panel técnico
            </a>


        @else

            <a
                href="{{ route('requerimientos.index') }}"
                class="
                    btn-detalle-accion
                    btn-accion-secundaria
                "
            >
                Volver a mis requerimientos
            </a>

        @endif

    </div>

</div>

@endsection