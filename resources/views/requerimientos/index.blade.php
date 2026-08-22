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
        --sj-verde: #78BE20;
        --sj-rojo: #EF3E24;
        --sj-naranjo: #F26B21;

        --sj-texto: #1F2937;
        --sj-texto-suave: #667085;
        --sj-borde: #E5E7EB;
    }

    .mis-wrapper {
        margin-top: 24px;
        margin-bottom: 28px;
    }

    /* =========================================================
       CABECERA
       ========================================================= */

    .mis-hero {
        position: relative;
        overflow: hidden;

        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 24px;

        padding: 25px 29px;
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

    .mis-hero::after {
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

    .mis-hero-contenido {
        position: relative;
        z-index: 1;
    }

    .mis-etiqueta {
        display: inline-flex;

        padding: 6px 14px;
        margin-bottom: 10px;

        border-radius: 999px;

        background: var(--sj-verde);

        color: #ffffff;

        font-size: 0.82rem;
        font-weight: 700;
    }

    .mis-hero h1 {
        margin: 0 0 7px;

        color: #ffffff;

        font-size: 1.9rem;
        font-weight: 800;
    }

    .mis-hero p {
        margin: 0;

        color:
            rgba(255, 255, 255, 0.88);

        font-size: 0.91rem;
    }

    .hero-acciones {
        position: relative;
        z-index: 1;

        display: flex;
        align-items: center;

        gap: 8px;

        flex-shrink: 0;
    }

    .btn-hero {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 40px;

        padding: 8px 14px;

        border-radius: 9px;

        text-decoration: none;

        font-size: 0.82rem;
        font-weight: 700;

        transition:
            background 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .btn-nuevo {
        border: 1px solid #ffffff;

        background: #ffffff;

        color: var(--sj-morado);
    }

    .btn-nuevo:hover {
        background: var(--sj-verde);
        border-color: var(--sj-verde);

        color: #ffffff;

        transform: translateY(-1px);
    }

    .btn-volver {
        border:
            1px solid rgba(255,255,255,0.60);

        background:
            rgba(255,255,255,0.12);

        color: #ffffff;
    }

    .btn-volver:hover {
        background: #ffffff;

        color: var(--sj-morado);
    }

    /* =========================================================
       MENSAJE DE ÉXITO
       ========================================================= */

    .mensaje-exito {
        margin-bottom: 17px;

        padding: 12px 15px;

        border-left: 4px solid var(--sj-verde);
        border-radius: 9px;

        background: #F4FBF0;

        color: #3F6B18;

        font-size: 0.86rem;
        font-weight: 600;
    }

    /* =========================================================
       TABLA
       ========================================================= */

    .tabla-card {
        overflow: hidden;

        border: 1px solid #ECEEF2;
        border-radius: 16px;

        background: #ffffff;

        box-shadow:
            0 8px 22px rgba(91, 63, 149, 0.07);
    }

    .tabla-cabecera {
        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 15px;

        padding: 16px 18px;

        border-bottom: 1px solid #ECEEF2;
    }

    .tabla-cabecera h2 {
        margin: 0;

        color: var(--sj-morado);

        font-size: 1.15rem;
        font-weight: 800;
    }

    .total-requerimientos {
        padding: 6px 11px;

        border-radius: 999px;

        background:
            rgba(120,190,32,0.12);

        color: #4E7F18;

        font-size: 0.78rem;
        font-weight: 700;
    }

    .tabla-scroll {
        width: 100%;
        overflow-x: auto;
    }

    .tabla-mis {
        width: 100%;
        margin: 0;

        border-collapse: collapse;
    }

    .tabla-mis thead th {
        padding: 13px 12px;

        background: #F5F3F8;

        color: var(--sj-morado);

        border-bottom: 1px solid #E5E7EB;

        font-size: 0.81rem;
        font-weight: 800;

        white-space: nowrap;
    }

    .tabla-mis tbody td {
        padding: 13px 12px;

        border-bottom: 1px solid #ECEEF2;

        color: #374151;

        font-size: 0.86rem;

        vertical-align: middle;
    }

    .tabla-mis tbody tr:hover {
        background: #FBFAFD;
    }

    .tabla-mis tbody tr:last-child td {
        border-bottom: 0;
    }

    .numero-requerimiento {
        color: var(--sj-morado);
        font-weight: 800;
    }

    .titulo-requerimiento {
        min-width: 170px;

        color: var(--sj-texto);

        font-weight: 600;
    }

    /* =========================================================
       PRIORIDADES
       ========================================================= */

    .badge-prioridad {
        display: inline-flex;

        padding: 5px 10px;

        border-radius: 999px;

        font-size: 0.75rem;
        font-weight: 700;

        white-space: nowrap;
    }

    .prioridad-sin-asignar {
        background: #FEF3C7;
        color: #92400E;
    }

    .prioridad-baja {
        background: #DCFCE7;
        color: #166534;
    }

    .prioridad-media {
        background: #E0E7FF;
        color: #3730A3;
    }

    .prioridad-alta {
        background: #FFEDD5;
        color: #9A3412;
    }

    .prioridad-urgente {
        background: #FEE2E2;
        color: #991B1B;
    }

    /* =========================================================
       FECHA
       ========================================================= */

    .fecha-requerimiento {
        min-width: 105px;

        white-space: nowrap;

        color: #667085;
    }

    .fecha-requerimiento .hora {
        display: block;

        margin-top: 2px;

        color: #98A0AC;

        font-size: 0.76rem;
    }

    /* =========================================================
       BOTÓN VER
       ========================================================= */

    .btn-ver-detalle {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 36px;

        padding: 7px 12px;

        border-radius: 8px;

        background: var(--sj-morado);

        color: #ffffff;

        text-decoration: none;

        font-size: 0.78rem;
        font-weight: 700;

        white-space: nowrap;

        transition:
            background 0.2s ease,
            transform 0.2s ease;
    }

    .btn-ver-detalle:hover {
        background: var(--sj-verde);

        color: #ffffff;

        transform: translateY(-1px);
    }

    /* =========================================================
       PAGINACIÓN
       ========================================================= */

    .paginacion-contenedor {
        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 16px;

        padding: 16px 18px;

        border-top: 1px solid #ECEEF2;

        background: #FCFCFD;

        flex-wrap: wrap;
    }

    .paginacion-info {
        color: #6B7280;

        font-size: 0.81rem;
    }

    .paginacion {
        display: flex;
        align-items: center;

        gap: 5px;

        flex-wrap: wrap;
    }

    .pagina-enlace,
    .pagina-deshabilitada {
        min-width: 36px;
        height: 36px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 0 10px;

        border-radius: 7px;

        font-size: 0.78rem;
        font-weight: 700;
    }

    .pagina-enlace {
        border: 1px solid #E1E4E9;

        background: #ffffff;

        color: var(--sj-morado);

        text-decoration: none;
    }

    .pagina-enlace:hover {
        border-color: var(--sj-morado);

        background: #F5F1FA;

        color: var(--sj-morado);
    }

    .pagina-activa {
        border-color: var(--sj-morado);

        background: var(--sj-morado);

        color: #ffffff;
    }

    .pagina-activa:hover {
        background: var(--sj-morado);
        color: #ffffff;
    }

    .pagina-deshabilitada {
        border: 1px solid #E5E7EB;

        background: #F3F4F6;

        color: #A0A7B0;
    }

    .sin-resultados {
        padding: 35px !important;

        text-align: center;

        color: #7A8493 !important;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 767px) {

        .mis-wrapper {
            margin-top: 16px;
        }

        .mis-hero {
            flex-direction: column;
            align-items: flex-start;

            padding: 22px;
        }

        .mis-hero h1 {
            font-size: 1.65rem;
        }

        .hero-acciones {
            width: 100%;

            flex-direction: column;
        }

        .btn-hero {
            width: 100%;
        }

        .tabla-cabecera {
            flex-direction: column;
            align-items: flex-start;
        }

        .paginacion-contenedor {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>


<div class="container mis-wrapper">

    {{-- =====================================================
         CABECERA
         ===================================================== --}}

    <div class="mis-hero">

        <div class="mis-hero-contenido">

            <span class="mis-etiqueta">
                Seguimiento
            </span>

            <h1>
                Mis requerimientos
            </h1>

            <p>
                Consulte sus solicitudes y el estado
                actual de cada atención.
            </p>

        </div>


        <div class="hero-acciones">

            <a
                href="{{ route('requerimientos.create') }}"
                class="btn-hero btn-nuevo"
            >
                + Nuevo requerimiento
            </a>

            <a
                href="{{ route('funcionario.dashboard') }}"
                class="btn-hero btn-volver"
            >
                ← Volver al panel
            </a>

        </div>

    </div>


    {{-- MENSAJE DE ÉXITO --}}

    @if (session('success'))

        <div class="mensaje-exito">
            {{ session('success') }}
        </div>

    @endif


    {{-- =====================================================
         TABLA
         ===================================================== --}}

    <div class="tabla-card">

        <div class="tabla-cabecera">

            <h2>
                Solicitudes registradas
            </h2>

            <span class="total-requerimientos">

                {{ $requerimientos->total() }}

                {{ $requerimientos->total() === 1
                    ? 'requerimiento'
                    : 'requerimientos'
                }}

            </span>

        </div>


        <div class="tabla-scroll">

            <table class="table table-vcenter tabla-mis">

                <thead>

                    <tr>
                        <th>N°</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Fecha ingreso</th>
                        <th>Acción</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse ($requerimientos as $requerimiento)

                        <tr>

                            <td>
                                <span class="numero-requerimiento">
                                    #{{ $requerimiento->id }}
                                </span>
                            </td>


                            <td class="titulo-requerimiento">
                                {{ $requerimiento->titulo }}
                            </td>


                            <td>
                                {{ ucfirst($requerimiento->categoria) }}
                            </td>


                            <td>

                                @switch($requerimiento->prioridad)

                                    @case('sin_asignar')

                                        <span class="badge-prioridad prioridad-sin-asignar">
                                            Sin asignar
                                        </span>

                                        @break


                                    @case('baja')

                                        <span class="badge-prioridad prioridad-baja">
                                            Baja
                                        </span>

                                        @break


                                    @case('media')

                                        <span class="badge-prioridad prioridad-media">
                                            Media
                                        </span>

                                        @break


                                    @case('alta')

                                        <span class="badge-prioridad prioridad-alta">
                                            Alta
                                        </span>

                                        @break


                                    @case('urgente')

                                        <span class="badge-prioridad prioridad-urgente">
                                            Urgente
                                        </span>

                                        @break


                                    @default

                                        {{ ucfirst($requerimiento->prioridad) }}

                                @endswitch

                            </td>


                            <td>
                                <x-estado :estado="$requerimiento->estado" />
                            </td>


                            <td class="fecha-requerimiento">

                                {{ $requerimiento->created_at->format('d-m-Y') }}

                                <span class="hora">
                                    {{ $requerimiento->created_at->format('H:i') }}
                                </span>

                            </td>


                            <td>

                                <a
                                    href="{{ route(
                                        'requerimientos.show',
                                        $requerimiento
                                    ) }}"
                                    class="btn-ver-detalle"
                                >
                                    Ver detalle
                                </a>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="7"
                                class="sin-resultados"
                            >
                                No existen requerimientos registrados.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =================================================
             PAGINACIÓN
             ================================================= --}}

        @if ($requerimientos->hasPages())

            <div class="paginacion-contenedor">

                <div class="paginacion-info">

                    Mostrando

                    <strong>
                        {{ $requerimientos->firstItem() }}
                    </strong>

                    a

                    <strong>
                        {{ $requerimientos->lastItem() }}
                    </strong>

                    de

                    <strong>
                        {{ $requerimientos->total() }}
                    </strong>

                    requerimientos

                </div>


                <div class="paginacion">

                    @if ($requerimientos->onFirstPage())

                        <span class="pagina-deshabilitada">
                            Anterior
                        </span>

                    @else

                        <a
                            href="{{ $requerimientos->previousPageUrl() }}"
                            class="pagina-enlace"
                        >
                            Anterior
                        </a>

                    @endif


                    @for (
                        $pagina = 1;
                        $pagina <= $requerimientos->lastPage();
                        $pagina++
                    )

                        @if (
                            $pagina ===
                            $requerimientos->currentPage()
                        )

                            <span class="pagina-enlace pagina-activa">
                                {{ $pagina }}
                            </span>

                        @else

                            <a
                                href="{{ $requerimientos->url($pagina) }}"
                                class="pagina-enlace"
                            >
                                {{ $pagina }}
                            </a>

                        @endif

                    @endfor


                    @if ($requerimientos->hasMorePages())

                        <a
                            href="{{ $requerimientos->nextPageUrl() }}"
                            class="pagina-enlace"
                        >
                            Siguiente
                        </a>

                    @else

                        <span class="pagina-deshabilitada">
                            Siguiente
                        </span>

                    @endif

                </div>

            </div>


        @else

            <div class="paginacion-contenedor">

                <div class="paginacion-info">

                    Total:

                    <strong>
                        {{ $requerimientos->total() }}
                    </strong>

                    requerimientos

                </div>

            </div>

        @endif

    </div>

</div>

@endsection