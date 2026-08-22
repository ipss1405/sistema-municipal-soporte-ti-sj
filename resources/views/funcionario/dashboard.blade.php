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
    }

    /* =========================================================
       CONTENEDOR GENERAL
       ========================================================= */

    .funcionario-wrapper {
        margin-top: 24px;
        margin-bottom: 28px;
    }

    /* =========================================================
       CABECERA
       ========================================================= */

    .funcionario-hero {
        position: relative;
        overflow: hidden;

        padding: 27px 30px;
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

    .funcionario-hero::after {
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

    .hero-etiqueta {
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

    .funcionario-hero h1 {
        position: relative;
        z-index: 1;

        margin: 0 0 7px;

        color: #ffffff;

        font-size: 2rem;
        font-weight: 800;
    }

    .funcionario-hero p {
        position: relative;
        z-index: 1;

        max-width: 750px;

        margin: 0;

        color:
            rgba(255, 255, 255, 0.88);

        font-size: 0.93rem;
        line-height: 1.5;
    }

    /* =========================================================
       ACCIONES PRINCIPALES
       ========================================================= */

    .acciones-funcionario {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 18px;
    }

    .accion-card {
        position: relative;

        display: flex;
        flex-direction: column;

        min-height: 230px;

        padding: 24px;

        overflow: hidden;

        border: 1px solid #ECEEF2;
        border-top: 5px solid var(--sj-verde);
        border-radius: 16px;

        background: #ffffff;

        box-shadow:
            0 8px 22px rgba(91, 63, 149, 0.07);

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            border-top-color 0.2s ease;
    }

    .accion-card:hover {
        transform: translateY(-3px);

        border-top-color:
            var(--sj-morado);

        box-shadow:
            0 13px 27px rgba(91, 63, 149, 0.13);
    }

    .accion-card::after {
        content: "";

        position: absolute;

        width: 105px;
        height: 105px;

        right: -38px;
        top: -42px;

        border-radius: 50%;

        background:
            rgba(120, 190, 32, 0.08);
    }

    /* =========================================================
       INDICADOR DE LA TARJETA
       ========================================================= */

    .accion-indicador {
        width: 42px;
        height: 42px;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-bottom: 17px;

        border-radius: 11px;

        background:
            rgba(91, 63, 149, 0.09);

        color: var(--sj-morado);
    }

    .accion-indicador svg {
        width: 23px;
        height: 23px;

        stroke: currentColor;
        stroke-width: 2;

        fill: none;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .accion-card h2 {
        margin: 0 0 8px;

        color: var(--sj-morado);

        font-size: 1.35rem;
        font-weight: 800;
    }

    .accion-card p {
        margin: 0 0 20px;

        color: var(--sj-texto-suave);

        font-size: 0.90rem;
        line-height: 1.55;
    }

    /* =========================================================
       BOTONES
       ========================================================= */

    .accion-boton-contenedor {
        margin-top: auto;
    }

    .btn-funcionario {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 42px;

        padding: 9px 17px;

        border: 0;
        border-radius: 9px;

        background:
            var(--sj-morado);

        color: #ffffff;

        text-decoration: none;

        font-size: 0.87rem;
        font-weight: 700;

        transition:
            background 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .btn-funcionario:hover,
    .btn-funcionario:focus {
        background:
            var(--sj-verde);

        color: #ffffff;

        transform: translateY(-1px);

        box-shadow:
            0 7px 16px rgba(120, 190, 32, 0.20);
    }

    /* =========================================================
       NOTA ÚTIL
       ========================================================= */

    .nota-prioridad {
        display: flex;
        align-items: center;

        gap: 9px;

        margin-top: 18px;

        padding: 12px 15px;

        border-left:
            4px solid var(--sj-verde);

        border-radius: 9px;

        background: #F8FBF5;

        color: #56606D;

        font-size: 0.82rem;
        line-height: 1.45;
    }

    .nota-punto {
        width: 8px;
        height: 8px;

        flex-shrink: 0;

        border-radius: 50%;

        background:
            var(--sj-verde);
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 767px) {

        .funcionario-wrapper {
            margin-top: 16px;
            margin-bottom: 20px;
        }

        .funcionario-hero {
            padding: 22px;
        }

        .funcionario-hero h1 {
            font-size: 1.7rem;
        }

        .acciones-funcionario {
            grid-template-columns: 1fr;
        }

        .accion-card {
            min-height: auto;
            padding: 20px;
        }

        .btn-funcionario {
            width: 100%;
        }
    }
</style>


<div class="container funcionario-wrapper">

    {{-- =====================================================
         CABECERA
         ===================================================== --}}

    <div class="funcionario-hero">

        <span class="hero-etiqueta">
            MesaTI Municipal
        </span>

        <h1>
            Panel funcionario
        </h1>

        <p>
            Registre solicitudes de soporte informático
            y consulte el estado y seguimiento de sus requerimientos.
        </p>

    </div>


    {{-- =====================================================
         ACCIONES PRINCIPALES
         ===================================================== --}}

    <div class="acciones-funcionario">

        {{-- CREAR REQUERIMIENTO --}}
        <div class="accion-card">

            <div class="accion-indicador">

                <svg viewBox="0 0 24 24">
                    <path d="M12 20h9"></path>
                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L8 18l-4 1 1-4Z"></path>
                </svg>

            </div>

            <h2>
                Crear requerimiento
            </h2>

            <p>
                Registre una nueva solicitud indicando
                la categoría, el título y la descripción
                del problema.
            </p>

            <div class="accion-boton-contenedor">

                <a
                    href="{{ route('requerimientos.create') }}"
                    class="btn-funcionario"
                >
                    Crear solicitud
                </a>

            </div>

        </div>


        {{-- MIS REQUERIMIENTOS --}}
        <div class="accion-card">

            <div class="accion-indicador">

                <svg viewBox="0 0 24 24">
                    <path d="M9 5h6"></path>
                    <path d="M9 9h6"></path>
                    <path d="M9 13h4"></path>
                    <path d="M5 3h14v18H5z"></path>
                </svg>

            </div>

            <h2>
                Mis requerimientos
            </h2>

            <p>
                Consulte las solicitudes registradas,
                su prioridad, estado y el seguimiento
                realizado por el área de Informática.
            </p>

            <div class="accion-boton-contenedor">

                <a
                    href="{{ route('requerimientos.index') }}"
                    class="btn-funcionario"
                >
                    Ver solicitudes
                </a>

            </div>

        </div>

    </div>


    {{-- =====================================================
         INFORMACIÓN ÚTIL
         ===================================================== --}}

    <div class="nota-prioridad">

        <span class="nota-punto"></span>

        La prioridad de cada requerimiento es asignada
        por el área de Informática después de revisar la solicitud.

    </div>

</div>

@endsection