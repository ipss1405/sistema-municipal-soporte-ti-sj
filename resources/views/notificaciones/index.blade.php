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

    .notificaciones-wrapper {
        margin-top: 24px;
        margin-bottom: 28px;
    }

    /* =========================================================
       CABECERA
       ========================================================= */

    .notificaciones-hero {
        position: relative;
        overflow: hidden;

        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 24px;

        padding: 26px 30px;

        margin-bottom: 20px;

        border-top:
            6px solid var(--sj-verde);

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

    .notificaciones-hero::after {
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

    .hero-notificaciones-contenido {
        position: relative;
        z-index: 1;
    }

    .hero-etiqueta {
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

    .notificaciones-hero h1 {
        margin: 0 0 7px;

        color: #ffffff;

        font-size: 2rem;
        font-weight: 800;
    }

    .notificaciones-hero p {
        max-width: 760px;

        margin: 0;

        color:
            rgba(255, 255, 255, 0.88);

        font-size: 0.92rem;
        line-height: 1.5;
    }

    /* =========================================================
       BOTÓN VOLVER
       ========================================================= */

    .btn-volver-panel {
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

    .btn-volver-panel:hover {
        background: #ffffff;

        color: var(--sj-morado);

        transform: translateY(-1px);
    }

    /* =========================================================
       CONTENEDOR DE NOTIFICACIONES
       ========================================================= */

    .notificaciones-card {
        background: #ffffff;

        border:
            1px solid #ECEEF2;

        border-radius: 16px;

        padding: 20px;

        box-shadow:
            0 8px 22px rgba(91, 63, 149, 0.07);
    }

    .notificaciones-cabecera {
        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 15px;

        padding-bottom: 15px;

        margin-bottom: 16px;

        border-bottom:
            1px solid #ECEEF2;
    }

    .notificaciones-cabecera h2 {
        margin: 0;

        color: var(--sj-morado);

        font-size: 1.2rem;
        font-weight: 800;
    }

    .notificaciones-total {
        display: inline-flex;
        align-items: center;

        padding: 6px 12px;

        border-radius: 999px;

        background:
            rgba(91, 63, 149, 0.08);

        color: var(--sj-morado);

        font-size: 0.80rem;
        font-weight: 700;
    }

    /* =========================================================
       NOTIFICACIÓN
       ========================================================= */

    .notificacion-item {
        position: relative;

        margin-bottom: 12px;

        padding: 17px 18px;

        border:
            1px solid #E8EAEF;

        border-left:
            5px solid var(--sj-morado);

        border-radius: 13px;

        background: #FAFAFB;

        transition:
            background 0.2s ease,
            border-color 0.2s ease,
            box-shadow 0.2s ease,
            transform 0.2s ease;
    }

    .notificacion-item:last-child {
        margin-bottom: 0;
    }

    .notificacion-item:hover {
        background: #FFFFFF;

        box-shadow:
            0 8px 18px rgba(91, 63, 149, 0.09);

        transform: translateY(-1px);
    }

    /* Notificación todavía marcada como nueva */

    .notificacion-nueva {
        border-left-color:
            var(--sj-verde);

        background: #FBFFF8;
    }

    .notificacion-cabecera-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;

        gap: 15px;

        margin-bottom: 8px;
    }

    .notificacion-titulo {
        color: var(--sj-morado);

        font-size: 0.98rem;
        font-weight: 800;

        line-height: 1.35;
    }

    .notificacion-indicador {
        display: inline-flex;
        align-items: center;

        gap: 8px;
    }

    .notificacion-punto {
        width: 9px;
        height: 9px;

        flex-shrink: 0;

        border-radius: 50%;

        background:
            var(--sj-morado);
    }

    .notificacion-nueva .notificacion-punto {
        background:
            var(--sj-verde);
    }

    .badge-nueva {
        flex-shrink: 0;

        padding: 5px 10px;

        border-radius: 999px;

        background:
            var(--sj-verde);

        color: #ffffff;

        font-size: 0.72rem;
        font-weight: 800;
    }

    /* =========================================================
       MENSAJE
       ========================================================= */

    .notificacion-mensaje {
        color: #374151;

        font-size: 0.88rem;
        line-height: 1.55;

        margin-bottom: 13px;
    }

    /* =========================================================
       PIE DE LA NOTIFICACIÓN
       ========================================================= */

    .notificacion-pie {
        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 15px;

        padding-top: 11px;

        border-top:
            1px solid #ECEEF2;
    }

    .notificacion-fecha {
        color: #7A8493;

        font-size: 0.78rem;
    }

    .notificacion-fecha strong {
        color: #5D6672;
        font-weight: 700;
    }

    /* =========================================================
       VER REQUERIMIENTO
       ========================================================= */

    .btn-requerimiento {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 36px;

        padding: 7px 13px;

        border: 0;
        border-radius: 8px;

        background:
            var(--sj-morado);

        color: #ffffff;

        text-decoration: none;

        font-size: 0.78rem;
        font-weight: 700;

        transition:
            background 0.2s ease,
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .btn-requerimiento:hover {
        background:
            var(--sj-verde);

        color: #ffffff;

        transform: translateY(-1px);

        box-shadow:
            0 6px 14px rgba(120, 190, 32, 0.18);
    }

    /* =========================================================
       SIN NOTIFICACIONES
       ========================================================= */

    .sin-notificaciones {
        padding: 34px 22px;

        border:
            1px dashed #CED4DC;

        border-radius: 13px;

        background: #FAFAFB;

        color: #667085;

        text-align: center;

        font-size: 0.90rem;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 767px) {

        .notificaciones-wrapper {
            margin-top: 16px;
            margin-bottom: 20px;
        }

        .notificaciones-hero {
            flex-direction: column;
            align-items: flex-start;

            padding: 22px;
        }

        .notificaciones-hero h1 {
            font-size: 1.7rem;
        }

        .btn-volver-panel {
            width: 100%;
        }

        .notificaciones-card {
            padding: 16px;
        }

        .notificaciones-cabecera {
            flex-direction: column;
            align-items: flex-start;
        }

        .notificacion-cabecera-item {
            flex-direction: column;
        }

        .notificacion-pie {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-requerimiento {
            width: 100%;
        }
    }
</style>


@php
    $rolUsuario = auth()->user()->rol;
@endphp


<div class="container notificaciones-wrapper">

    {{-- =====================================================
         CABECERA
         ===================================================== --}}

    <div class="notificaciones-hero">

        <div class="hero-notificaciones-contenido">

            <span class="hero-etiqueta">
                Centro de avisos
            </span>

            <h1>
                Notificaciones
            </h1>


            {{-- TEXTO SEGÚN ROL --}}

            @if ($rolUsuario === 'administrador')

                <p>
                    Consulte los nuevos requerimientos y las
                    actualizaciones realizadas durante la gestión
                    administrativa y técnica.
                </p>


            @elseif ($rolUsuario === 'tecnico')

                <p>
                    Consulte los avisos relacionados con los
                    requerimientos derivados a su atención
                    y las actualizaciones de la gestión técnica.
                </p>


            @else

                <p>
                    Consulte las actualizaciones relacionadas con
                    sus requerimientos y el seguimiento realizado
                    por el área de Informática.
                </p>

            @endif

        </div>


        {{-- REGRESO SEGÚN ROL --}}

        @if ($rolUsuario === 'administrador')

            <a
                href="{{ route('admin.dashboard') }}"
                class="btn-volver-panel"
            >
                ← Volver al panel
            </a>


        @elseif ($rolUsuario === 'tecnico')

            <a
                href="{{ route('tecnico.dashboard') }}"
                class="btn-volver-panel"
            >
                ← Volver al panel técnico
            </a>


        @else

            <a
                href="{{ route('funcionario.dashboard') }}"
                class="btn-volver-panel"
            >
                ← Volver al panel
            </a>

        @endif

    </div>


    {{-- =====================================================
         LISTADO
         ===================================================== --}}

    <div class="notificaciones-card">

        <div class="notificaciones-cabecera">

            <h2>
                Historial de notificaciones
            </h2>

            <div class="notificaciones-total">

                {{ $notificaciones->count() }}

                {{ $notificaciones->count() === 1
                    ? 'notificación'
                    : 'notificaciones'
                }}

            </div>

        </div>


        @forelse ($notificaciones as $notificacion)

            <div
                class="
                    notificacion-item
                    {{ !$notificacion->leida
                        ? 'notificacion-nueva'
                        : ''
                    }}
                "
            >

                {{-- CABECERA DE LA NOTIFICACIÓN --}}
                <div class="notificacion-cabecera-item">

                    <div class="notificacion-indicador">

                        <span class="notificacion-punto"></span>

                        <div class="notificacion-titulo">
                            {{ $notificacion->titulo }}
                        </div>

                    </div>


                    @if (!$notificacion->leida)

                        <span class="badge-nueva">
                            Nueva
                        </span>

                    @endif

                </div>


                {{-- MENSAJE --}}
                <div class="notificacion-mensaje">

                    {{ $notificacion->mensaje }}

                </div>


                {{-- PIE --}}
                <div class="notificacion-pie">

                    <div class="notificacion-fecha">

                        Recibida el

                        <strong>
                            {{ $notificacion->created_at->format('d-m-Y') }}
                        </strong>

                        ·

                        {{ $notificacion->created_at->format('H:i') }}

                    </div>


                    @if ($notificacion->requerimiento_id)

                        <a
                            href="{{ route(
                                'requerimientos.show',
                                $notificacion->requerimiento_id
                            ) }}"
                            class="btn-requerimiento"
                        >
                            Ver requerimiento
                        </a>

                    @endif

                </div>

            </div>


        @empty

            <div class="sin-notificaciones">

                No hay notificaciones registradas
                por el momento.

            </div>

        @endforelse

    </div>

</div>

@endsection