@extends('layout')

@section('content')

<style>
    .dashboard-wrapper {
        margin-top: 35px;
        margin-bottom: 35px;
    }

    .dashboard-hero {
        background: linear-gradient(135deg, #5B3F95 0%, #EF3E24 55%, #F26B21 100%);
        color: #ffffff;
        border-radius: 18px;
        padding: 40px;
        border-top: 6px solid #78BE20;
        box-shadow: 0 10px 25px rgba(91, 63, 149, 0.18);
    }

    .dashboard-hero h1 {
        font-weight: 800;
        margin-bottom: 12px;
    }

    .dashboard-hero p {
        margin-bottom: 0;
        font-size: 1.1rem;
    }

    .card-funcionario {
        background: #ffffff;
        border: none;
        border-top: 6px solid #78BE20;
        border-radius: 18px;
        padding: 28px;
        height: 100%;
        box-shadow: 0 8px 20px rgba(91, 63, 149, 0.10);
        transition: box-shadow 0.25s ease, border-top-color 0.25s ease, background 0.25s ease;
    }

    .card-funcionario:hover {
        background: #F6FFF1;
        border-top-color: #5B3F95;
        box-shadow: 0 14px 30px rgba(91, 63, 149, 0.18);
    }

    .card-funcionario .icono {
        font-size: 2.2rem;
        margin-bottom: 14px;
    }

    .card-funcionario h3 {
        color: #5B3F95;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .card-funcionario p {
        color: #4B5563;
        min-height: 70px;
    }

    .btn-funcionario {
        background: #5B3F95;
        color: #ffffff;
        border: none;
        font-weight: 700;
        border-radius: 8px;
        padding: 12px 18px;
        text-decoration: none;
        display: inline-block;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .btn-funcionario:hover,
    .btn-funcionario:focus,
    .btn-funcionario:active {
        background: #78BE20;
        color: #ffffff;
    }

    .info-panel {
        background: #ffffff;
        border-radius: 18px;
        padding: 28px;
        border-left: 6px solid #5B3F95;
        box-shadow: 0 8px 20px rgba(91, 63, 149, 0.10);
    }

    .info-panel h4 {
        color: #5B3F95;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .info-panel p {
        color: #374151;
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .dashboard-hero {
            padding: 25px;
        }

        .dashboard-hero h1 {
            font-size: 2rem;
        }

        .btn-funcionario {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="container dashboard-wrapper">

    <div class="dashboard-hero mb-4">
        <h1>Panel funcionario</h1>

        <p>
            Desde este panel el funcionario puede registrar requerimientos informáticos
            y revisar el estado de sus solicitudes.
        </p>
    </div>

    <div class="row g-4">

        <div class="col-md-6">
            <div class="card-funcionario">
                <div class="icono">📝</div>

                <h3>Crear requerimiento</h3>

                <p>
                    Permite ingresar una nueva solicitud de soporte informático,
                    indicando categoría, prioridad, título y descripción del problema.
                </p>

                <a href="/requerimientos/crear" class="btn-funcionario">
                    Crear solicitud
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-funcionario">
                <div class="icono">📋</div>

                <h3>Mis requerimientos</h3>

                <p>
                    Permite revisar las solicitudes registradas, consultar su estado
                    y acceder al detalle de cada requerimiento.
                </p>

                <a href="/mis-requerimientos" class="btn-funcionario">
                    Ver solicitudes
                </a>
            </div>
        </div>

    </div>

    <div class="info-panel mt-4">
        <h4>Uso del sistema</h4>

        <p>
            Este módulo está orientado a funcionarios municipales que requieren apoyo
            del área de informática. Las solicitudes ingresadas quedan disponibles para
            su revisión y gestión administrativa.
        </p>
    </div>

</div>

@endsection