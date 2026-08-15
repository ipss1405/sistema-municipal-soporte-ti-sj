@extends('layout')

@section('content')

<style>
    .dashboard-wrapper {
        margin-top: 20px;
        margin-bottom: 25px;
    }

    /* =========================
       ENCABEZADO
       ========================= */

    .dashboard-hero {
        background: linear-gradient(
            135deg,
            #5B3F95 0%,
            #EF3E24 55%,
            #F26B21 100%
        );
        color: #ffffff;
        border-radius: 16px;
        padding: 24px 30px;
        border-top: 5px solid #78BE20;
        box-shadow: 0 8px 20px rgba(91, 63, 149, 0.16);
    }

    .dashboard-hero h1 {
        font-weight: 800;
        font-size: 30px;
        margin-top: 0;
        margin-bottom: 8px;
    }

    .dashboard-hero p {
        margin-bottom: 0;
        font-size: 16px;
    }

    /* =========================
       TARJETAS
       ========================= */

    .tarjetas-funcionario {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
        margin-top: 20px;
    }

    .card-funcionario {
        background: #ffffff;
        border-top: 5px solid #78BE20;
        border-radius: 14px;
        padding: 20px;
        box-shadow: 0 6px 16px rgba(91, 63, 149, 0.10);
        transition:
            box-shadow 0.25s ease,
            border-top-color 0.25s ease,
            background 0.25s ease,
            transform 0.25s ease;
    }

    .card-funcionario:hover {
        background: #F6FFF1;
        border-top-color: #5B3F95;
        box-shadow: 0 10px 22px rgba(91, 63, 149, 0.16);
        transform: translateY(-2px);
    }

    .card-funcionario .icono {
        font-size: 1.8rem;
        margin-bottom: 8px;
    }

    .card-funcionario h3 {
        color: #5B3F95;
        font-weight: 800;
        font-size: 24px;
        margin-top: 0;
        margin-bottom: 8px;
    }

    .card-funcionario p {
        color: #4B5563;
        margin-bottom: 16px;
        line-height: 1.5;
    }

    /* =========================
       BOTONES
       ========================= */

    .btn-funcionario {
        background: #5B3F95;
        color: #ffffff;
        border: none;
        font-weight: 700;
        border-radius: 7px;
        padding: 10px 16px;
        text-decoration: none;
        display: inline-block;
        transition:
            background 0.2s ease,
            transform 0.2s ease;
    }

    .btn-funcionario:hover,
    .btn-funcionario:focus,
    .btn-funcionario:active {
        background: #78BE20;
        color: #ffffff;
        transform: translateY(-1px);
    }

    /* =========================
       INFORMACIÓN
       ========================= */

    .info-panel {
        background: #ffffff;
        border-radius: 14px;
        padding: 18px 22px;
        border-left: 5px solid #5B3F95;
        box-shadow: 0 6px 16px rgba(91, 63, 149, 0.08);
        margin-top: 20px;
    }

    .info-panel h4 {
        color: #5B3F95;
        font-weight: 800;
        font-size: 20px;
        margin-top: 0;
        margin-bottom: 6px;
    }

    .info-panel p {
        color: #374151;
        margin-bottom: 0;
        line-height: 1.5;
    }

    /* =========================
       RESPONSIVE
       ========================= */

    @media (max-width: 768px) {
        .dashboard-wrapper {
            margin-top: 15px;
        }

        .dashboard-hero {
            padding: 20px;
        }

        .dashboard-hero h1 {
            font-size: 26px;
        }

        .tarjetas-funcionario {
            grid-template-columns: 1fr;
        }

        .btn-funcionario {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container dashboard-wrapper">

    {{-- Encabezado --}}
    <div class="dashboard-hero">

        <h1>Panel funcionario</h1>

        <p>
            Registre solicitudes de soporte informático
            y consulte el estado de sus requerimientos.
        </p>

    </div>

    {{-- Accesos principales --}}
    <div class="tarjetas-funcionario">

        <div class="card-funcionario">

            <div class="icono">
                📝
            </div>

            <h3>
                Crear requerimiento
            </h3>

            <p>
                Ingrese una nueva solicitud indicando
                categoría, título y descripción del problema.
                La prioridad será asignada por el área de Informática.
            </p>

            <a
                href="{{ route('requerimientos.create') }}"
                class="btn-funcionario"
            >
                Crear solicitud
            </a>

        </div>

        <div class="card-funcionario">

            <div class="icono">
                📋
            </div>

            <h3>
                Mis requerimientos
            </h3>

            <p>
                Revise sus solicitudes registradas,
                consulte su prioridad, estado
                y acceda al detalle de cada requerimiento.
            </p>

            <a
                href="{{ route('requerimientos.index') }}"
                class="btn-funcionario"
            >
                Ver solicitudes
            </a>

        </div>

    </div>

    {{-- Información --}}
    <div class="info-panel">

        <h4>
            Uso del sistema
        </h4>

        <p>
            Las solicitudes ingresadas son revisadas por el área de Informática,
            que asigna su prioridad y realiza el seguimiento correspondiente.
        </p>

    </div>

</div>

@endsection