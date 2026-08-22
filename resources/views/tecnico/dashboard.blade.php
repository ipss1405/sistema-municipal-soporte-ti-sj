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

    /* =========================================================
       CONTENEDOR
       ========================================================= */

    .tecnico-wrapper {
        margin-top: 24px;
        margin-bottom: 28px;
    }

    /* =========================================================
       CABECERA
       ========================================================= */

    .tecnico-hero {
        position: relative;
        overflow: hidden;

        padding: 26px 30px;
        margin-bottom: 19px;

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

    .tecnico-hero::after {
        content: "";

        position: absolute;

        width: 190px;
        height: 190px;

        right: -70px;
        bottom: -110px;

        border-radius: 50%;

        background:
            rgba(255, 255, 255, 0.08);
    }

    .tecnico-etiqueta {
        position: relative;
        z-index: 1;

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

    .tecnico-hero h1 {
        position: relative;
        z-index: 1;

        margin: 0 0 7px;

        color: #ffffff;

        font-size: 1.95rem;
        font-weight: 800;
    }

    .tecnico-hero p {
        position: relative;
        z-index: 1;

        margin: 0;

        max-width: 780px;

        color:
            rgba(255, 255, 255, 0.90);

        font-size: 0.91rem;
        line-height: 1.5;
    }

    .tecnico-hero strong {
        color: #ffffff;
    }

    /* =========================================================
       INDICADORES
       ========================================================= */

    .indicadores-tecnico {
        display: grid;

        grid-template-columns:
            repeat(5, minmax(0, 1fr));

        gap: 12px;

        margin-bottom: 19px;
    }

    .indicador-card {
        position: relative;
        overflow: hidden;

        min-height: 105px;

        padding: 16px 17px;

        border: 1px solid #ECEEF2;
        border-top: 4px solid var(--sj-verde);
        border-radius: 13px;

        background: #ffffff;

        box-shadow:
            0 6px 17px rgba(91, 63, 149, 0.07);

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            border-top-color 0.2s ease;
    }

    .indicador-card:hover {
        transform: translateY(-2px);

        border-top-color: var(--sj-morado);

        box-shadow:
            0 9px 20px rgba(91, 63, 149, 0.12);
    }

    .indicador-label {
        margin-bottom: 7px;

        color: var(--sj-texto-suave);

        font-size: 0.79rem;
        font-weight: 700;
    }

    .indicador-numero {
        color: var(--sj-morado);

        font-size: 1.65rem;
        line-height: 1;
        font-weight: 800;
    }

    /* =========================================================
       CONTENEDOR TABLA
       ========================================================= */

    .tabla-card-tecnico {
        overflow: hidden;

        border: 1px solid #ECEEF2;
        border-radius: 16px;

        background: #ffffff;

        box-shadow:
            0 8px 22px rgba(91, 63, 149, 0.07);
    }

    .tabla-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 15px;

        padding: 17px 19px;

        border-bottom: 1px solid #ECEEF2;
    }

    .tabla-card-header h2 {
        margin: 0;

        color: var(--sj-morado);

        font-size: 1.18rem;
        font-weight: 800;
    }

    .total-asignados {
        padding: 6px 11px;

        border-radius: 999px;

        background:
            rgba(120, 190, 32, 0.12);

        color: #4E7F18;

        font-size: 0.77rem;
        font-weight: 700;

        white-space: nowrap;
    }

    .tabla-scroll {
        width: 100%;
        overflow-x: auto;
    }

    /* =========================================================
       TABLA
       ========================================================= */

    .tabla-tecnico {
        width: 100%;
        margin: 0;

        border-collapse: collapse;
    }

    .tabla-tecnico thead th {
        padding: 13px 11px;

        background: #F5F3F8;

        color: var(--sj-morado);

        border-bottom: 1px solid #E5E7EB;

        font-size: 0.79rem;
        font-weight: 800;

        white-space: nowrap;
    }

    .tabla-tecnico tbody td {
        padding: 13px 11px;

        border-bottom: 1px solid #ECEEF2;

        color: #374151;

        font-size: 0.84rem;

        vertical-align: middle;
    }

    .tabla-tecnico tbody tr {
        transition:
            background 0.18s ease;
    }

    .tabla-tecnico tbody tr:hover {
        background: #FBFAFD;
    }

    .tabla-tecnico tbody tr:last-child td {
        border-bottom: 0;
    }

    .numero-requerimiento {
        color: var(--sj-morado);

        font-weight: 800;
    }

    .funcionario-nombre {
        min-width: 120px;

        font-weight: 600;

        color: var(--sj-texto);
    }

    .titulo-requerimiento {
        min-width: 150px;

        color: var(--sj-texto);

        font-weight: 600;
    }

    /* =========================================================
       PRIORIDADES
       ========================================================= */

    .badge-prioridad {
        display: inline-flex;
        align-items: center;

        padding: 5px 10px;

        border-radius: 999px;

        font-size: 0.74rem;
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

    .fecha-asignacion {
        min-width: 103px;

        white-space: nowrap;

        color: #667085;
    }

    .fecha-asignacion .hora {
        display: block;

        margin-top: 2px;

        color: #98A0AC;

        font-size: 0.75rem;
    }

    /* =========================================================
       ACCIONES
       ========================================================= */

    .acciones-tecnico {
        display: flex;
        align-items: center;

        gap: 6px;

        min-width: 210px;
    }

    .btn-tecnico {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 35px;

        padding: 7px 11px;

        border: 0;
        border-radius: 8px;

        color: #ffffff;

        text-decoration: none;

        font-size: 0.76rem;
        font-weight: 700;

        white-space: nowrap;

        transition:
            background 0.2s ease,
            transform 0.2s ease;
    }

    .btn-ver-tecnico {
        background: #6B7280;
    }

    .btn-ver-tecnico:hover {
        background: #4B5563;

        color: #ffffff;

        transform: translateY(-1px);
    }

    .btn-gestionar-tecnico {
        background: var(--sj-morado);
    }

    .btn-gestionar-tecnico:hover {
        background: var(--sj-verde);

        color: #ffffff;

        transform: translateY(-1px);
    }

    /* =========================================================
       SIN REQUERIMIENTOS
       ========================================================= */

    .sin-requerimientos {
        padding: 35px 20px;

        text-align: center;

        color: #697386;

        font-size: 0.88rem;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 1100px) {
        .indicadores-tecnico {
            grid-template-columns:
                repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 767px) {

        .tecnico-wrapper {
            margin-top: 16px;
        }

        .tecnico-hero {
            padding: 22px;
        }

        .tecnico-hero h1 {
            font-size: 1.65rem;
        }

        .indicadores-tecnico {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

        .tabla-card-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 500px) {

        .indicadores-tecnico {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="container tecnico-wrapper">

    {{-- =====================================================
         CABECERA
         ===================================================== --}}

    <div class="tecnico-hero">

        <span class="tecnico-etiqueta">
            Área de Informática
        </span>

        <h1>
            Panel Técnico TI
        </h1>

        <p>
            Bienvenido,
            <strong>{{ $tecnico->name }}</strong>.
            Revise y gestione los requerimientos
            derivados a su atención.
        </p>

    </div>


    {{-- =====================================================
         INDICADORES
         ===================================================== --}}

    <div class="indicadores-tecnico">

        <div class="indicador-card">

            <div class="indicador-label">
                Total asignados
            </div>

            <div class="indicador-numero">
                {{ $total }}
            </div>

        </div>


        <div class="indicador-card">

            <div class="indicador-label">
                Pendientes
            </div>

            <div class="indicador-numero">
                {{ $pendientes }}
            </div>

        </div>


        <div class="indicador-card">

            <div class="indicador-label">
                En revisión
            </div>

            <div class="indicador-numero">
                {{ $enRevision }}
            </div>

        </div>


        <div class="indicador-card">

            <div class="indicador-label">
                En proceso / espera
            </div>

            <div class="indicador-numero">
                {{ $enProceso }}
            </div>

        </div>


        <div class="indicador-card">

            <div class="indicador-label">
                Resueltos
            </div>

            <div class="indicador-numero">
                {{ $resueltos }}
            </div>

        </div>

    </div>


    {{-- =====================================================
         REQUERIMIENTOS ASIGNADOS
         ===================================================== --}}

    <div class="tabla-card-tecnico">

        <div class="tabla-card-header">

            <h2>
                Mis requerimientos asignados
            </h2>


            <span class="total-asignados">

                {{ $total }}

                {{ $total === 1
                    ? 'asignado'
                    : 'asignados'
                }}

            </span>

        </div>


        @if ($requerimientos->count() > 0)

            <div class="tabla-scroll">

                <table class="table table-vcenter tabla-tecnico">

                    <thead>

                        <tr>
                            <th>N.º</th>
                            <th>Funcionario</th>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Prioridad</th>
                            <th>Estado</th>
                            <th>Asignado</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>


                    <tbody>

                        @foreach ($requerimientos as $requerimiento)

                            <tr>

                                <td>

                                    <span class="numero-requerimiento">
                                        #{{ $requerimiento->id }}
                                    </span>

                                </td>


                                <td class="funcionario-nombre">

                                    {{ $requerimiento->usuario?->name
                                        ?? 'Usuario no disponible'
                                    }}

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

                                    <x-estado
                                        :estado="$requerimiento->estado"
                                    />

                                </td>


                                <td class="fecha-asignacion">

                                    @if ($requerimiento->fecha_asignacion)

                                        {{ $requerimiento
                                            ->fecha_asignacion
                                            ->format('d-m-Y')
                                        }}

                                        <span class="hora">

                                            {{ $requerimiento
                                                ->fecha_asignacion
                                                ->format('H:i')
                                            }}

                                        </span>

                                    @else

                                        Sin fecha

                                    @endif

                                </td>


                                <td>

                                    <div class="acciones-tecnico">

                                        <a
                                            href="{{ route(
                                                'requerimientos.show',
                                                $requerimiento
                                            ) }}"
                                            class="btn-tecnico btn-ver-tecnico"
                                        >
                                            Ver requerimiento
                                        </a>


                                        <a
                                            href="{{ route(
                                                'tecnico.requerimientos.gestionar',
                                                $requerimiento
                                            ) }}"
                                            class="btn-tecnico btn-gestionar-tecnico"
                                        >
                                            Gestionar atención
                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="sin-requerimientos">

                Actualmente no tiene
                requerimientos asignados.

            </div>

        @endif

    </div>

</div>

@endsection