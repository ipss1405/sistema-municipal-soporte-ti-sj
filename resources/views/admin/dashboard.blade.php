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
        --sj-texto-suave: #5F6B7A;
        --sj-borde: #E5E7EB;
    }

    /* =========================================================
       CONTENEDOR GENERAL
       ========================================================= */

    .dashboard-admin-wrapper {
        margin-top: 24px;
        margin-bottom: 24px;
    }

    /* =========================================================
       CABECERA
       ========================================================= */

    .dashboard-admin-hero {
        position: relative;
        overflow: hidden;

        background:
            linear-gradient(
                135deg,
                #5B3F95 0%,
                #A43D70 45%,
                #EF3E24 78%,
                #F26B21 100%
            );

        color: #ffffff;

        border-radius: 20px;

        padding: 28px 32px;

        border-top: 6px solid var(--sj-verde);

        box-shadow:
            0 12px 30px rgba(91, 63, 149, 0.15);

        margin-bottom: 22px;
    }

    .dashboard-admin-hero::after {
        content: "";

        position: absolute;

        width: 180px;
        height: 180px;

        right: -60px;
        bottom: -100px;

        border-radius: 50%;

        background:
            rgba(255, 255, 255, 0.08);
    }

    .badge-admin {
        display: inline-flex;
        align-items: center;

        background: var(--sj-verde);

        color: #ffffff;

        font-weight: 700;
        font-size: 0.86rem;

        padding: 7px 15px;

        border-radius: 999px;

        margin-bottom: 13px;
    }

    .dashboard-admin-hero h1 {
        color: #ffffff;

        font-size: 2.15rem;
        font-weight: 800;

        margin-bottom: 8px;

        position: relative;
        z-index: 1;
    }

    .dashboard-admin-hero p {
        color:
            rgba(255, 255, 255, 0.88);

        font-size: 0.95rem;
        line-height: 1.55;

        margin-bottom: 0;

        max-width: 850px;

        position: relative;
        z-index: 1;
    }

    /* =========================================================
       RESUMEN PRINCIPAL
       ========================================================= */

    .resumen-grid {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 16px;

        margin-bottom: 22px;
    }

    .resumen-card {
        background: #ffffff;

        border: 1px solid #EEF0F3;
        border-top: 5px solid var(--sj-verde);

        border-radius: 16px;

        padding: 19px 21px;

        box-shadow:
            0 7px 18px rgba(91, 63, 149, 0.08);

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            border-top-color 0.2s ease;
    }

    .resumen-card:hover {
        transform: translateY(-2px);

        border-top-color:
            var(--sj-morado);

        box-shadow:
            0 12px 24px rgba(91, 63, 149, 0.13);
    }

    .resumen-label {
        color: var(--sj-morado);

        font-weight: 800;
        font-size: 0.94rem;

        margin-bottom: 9px;
    }

    .resumen-value {
        color: var(--sj-texto);

        font-size: 2rem;
        line-height: 1;

        font-weight: 800;
    }

    /* =========================================================
       SECCIONES
       ========================================================= */

    .seccion-card {
        background: #ffffff;

        border: 1px solid #EEF0F3;
        border-top: 5px solid var(--sj-verde);

        border-radius: 18px;

        padding: 24px;

        box-shadow:
            0 8px 22px rgba(91, 63, 149, 0.08);

        margin-bottom: 22px;
    }

    .seccion-card h2 {
        color: var(--sj-morado);

        font-size: 1.55rem;
        font-weight: 800;

        margin-bottom: 6px;
    }

    .subtexto {
        color: var(--sj-texto-suave);

        font-size: 0.91rem;

        margin-bottom: 20px;
    }

    /* =========================================================
       ESTADOS
       ========================================================= */

    .estado-info {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 15px;
    }

    .estado-mini {
        background: #F9FAFB;

        border:
            1px solid #E8EAEF;

        border-left:
            5px solid var(--sj-morado);

        border-radius: 13px;

        padding: 15px 18px;
    }

    .estado-mini strong {
        display: block;

        color: var(--sj-morado);

        font-size: 0.90rem;
        font-weight: 800;

        margin-bottom: 7px;
    }

    .estado-mini span {
        color: var(--sj-texto);

        font-size: 1.55rem;
        font-weight: 800;
    }

    /* =========================================================
       CATEGORÍAS
       ========================================================= */

    .categorias-grid {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 14px 22px;
    }

    .categoria-item {
        background: #F9FAFB;

        border:
            1px solid #E8EAEF;

        border-radius: 13px;

        padding: 14px 16px;

        transition:
            background 0.2s ease,
            box-shadow 0.2s ease;
    }

    .categoria-item:hover {
        background: #FCFFF8;

        box-shadow:
            0 7px 17px rgba(120, 190, 32, 0.09);
    }

    .categoria-header {
        display: flex;

        justify-content: space-between;
        align-items: center;

        gap: 12px;

        margin-bottom: 9px;
    }

    .categoria-nombre {
        color: var(--sj-texto);

        font-size: 0.91rem;
        font-weight: 800;
    }

    .categoria-total {
        color: var(--sj-morado);

        font-size: 0.94rem;
        font-weight: 800;
    }

    .categoria-barra {
        width: 100%;
        height: 11px;

        background: #E1E5EA;

        border-radius: 999px;

        overflow: hidden;
    }

    .categoria-progreso {
        height: 100%;

        border-radius: 999px;

        background:
            linear-gradient(
                90deg,
                var(--sj-morado) 0%,
                #726299 40%,
                var(--sj-verde) 100%
            );
    }

    /* =========================================================
       ACCIONES
       ========================================================= */

    .acciones-dashboard {
        display: flex;

        flex-wrap: wrap;

        gap: 10px;

        margin-top: 20px;
    }

    .btn-dashboard {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        min-height: 42px;

        padding: 9px 16px;

        border-radius: 9px;

        font-size: 0.88rem;
        font-weight: 700;

        text-decoration: none;

        transition:
            background 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .btn-dashboard:hover {
        transform: translateY(-1px);
    }

    .btn-principal {
        background:
            var(--sj-morado);

        color: #ffffff;
    }

    .btn-principal:hover {
        background:
            var(--sj-verde);

        color: #ffffff;
    }

    .btn-outline-admin {
        background: #ffffff;

        color: var(--sj-morado);

        border:
            1px solid var(--sj-morado);
    }

    .btn-outline-admin:hover {
        background:
            #F4F0FA;

        color:
            var(--sj-morado);
    }

    .btn-secundario {
        background: #6B7280;

        color: #ffffff;
    }

    .btn-secundario:hover {
        background: #4B5563;

        color: #ffffff;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 991px) {

        .resumen-grid,
        .estado-info {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 767px) {

        .dashboard-admin-wrapper {
            margin-top: 16px;
            margin-bottom: 16px;
        }

        .dashboard-admin-hero {
            padding: 23px;
        }

        .dashboard-admin-hero h1 {
            font-size: 1.8rem;
        }

        .resumen-grid,
        .estado-info,
        .categorias-grid {
            grid-template-columns: 1fr;
        }

        .seccion-card {
            padding: 19px;
        }

        .acciones-dashboard {
            flex-direction: column;
        }

        .btn-dashboard {
            width: 100%;
        }
    }
</style>


<div class="container dashboard-admin-wrapper">

    {{-- =====================================================
         CABECERA
         ===================================================== --}}

    <div class="dashboard-admin-hero">

        <span class="badge-admin">
            Panel administrativo
        </span>

        <h1>
            Administración de MesaTI
        </h1>

        <p>
            Consulte los principales indicadores del sistema
            y acceda a la gestión de los requerimientos
            registrados.
        </p>

    </div>


    {{-- =====================================================
         INDICADORES GENERALES
         ===================================================== --}}

    <div class="resumen-grid">

        <div class="resumen-card">

            <div class="resumen-label">
                👥 Usuarios registrados
            </div>

            <div class="resumen-value">
                {{ $totalUsuarios }}
            </div>

        </div>


        <div class="resumen-card">

            <div class="resumen-label">
                📋 Total requerimientos
            </div>

            <div class="resumen-value">
                {{ $totalRequerimientos }}
            </div>

        </div>


        <div class="resumen-card">

            <div class="resumen-label">
                🚨 Prioridad urgente
            </div>

            <div class="resumen-value">
                {{ $totalUrgentes }}
            </div>

        </div>

    </div>


    {{-- =====================================================
         ESTADO GENERAL
         ===================================================== --}}

    <div class="seccion-card">

        <h2>
            Estado general
        </h2>

        <p class="subtexto">
            Resumen actual del flujo de atención
            de los requerimientos.
        </p>


        <div class="estado-info">

            <div class="estado-mini">

                <strong>
                    ⏱ Pendientes
                </strong>

                <span>
                    {{ $totalPendientes }}
                </span>

            </div>


            <div class="estado-mini">

                <strong>
                    🔧 En proceso
                </strong>

                <span>
                    {{ $totalEnProceso }}
                </span>

            </div>


            <div class="estado-mini">

                <strong>
                    ✅ Resueltos
                </strong>

                <span>
                    {{ $totalResueltos }}
                </span>

            </div>

        </div>

    </div>


    {{-- =====================================================
         REQUERIMIENTOS POR CATEGORÍA
         ===================================================== --}}

    <div class="seccion-card">

        <h2>
            Requerimientos por categoría
        </h2>

        <p class="subtexto">
            Distribución de los requerimientos registrados
            según el tipo de problema o solicitud.
        </p>


        @php
            $maxCategoria =
                $requerimientosPorCategoria->max('total') ?: 1;
        @endphp


        <div class="categorias-grid">

            @forelse (
                $requerimientosPorCategoria as $categoria
            )

                <div class="categoria-item">

                    <div class="categoria-header">

                        <span class="categoria-nombre">
                            {{ ucfirst($categoria->categoria) }}
                        </span>

                        <span class="categoria-total">
                            {{ $categoria->total }}
                        </span>

                    </div>


                    <div class="categoria-barra">

                        <div
                            class="categoria-progreso"
                            style="
                                width:
                                {{
                                    ($categoria->total / $maxCategoria)
                                    * 100
                                }}%;
                            "
                        >
                        </div>

                    </div>

                </div>

            @empty

                <p>
                    No existen requerimientos registrados
                    por categoría.
                </p>

            @endforelse

        </div>


        {{-- =================================================
             ACCIONES
             ================================================= --}}

        <div class="acciones-dashboard">

            <a
                href="{{ route('admin.requerimientos.index') }}"
                class="btn-dashboard btn-principal"
            >
                Ver requerimientos
            </a>


            <a
                href="{{ route('notificaciones.index') }}"
                class="btn-dashboard btn-outline-admin"
            >
                Ver notificaciones
            </a>


            <a
                href="{{ url('/') }}"
                class="btn-dashboard btn-secundario"
            >
                Volver a MesaTI
            </a>

        </div>

    </div>

</div>

@endsection