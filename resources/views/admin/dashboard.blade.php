@extends('layout')

@section('content')

<style>
    .admin-dashboard {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* =========================
       TARJETAS DE INDICADORES
       ========================= */

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin: 22px 0;
    }

    .dashboard-card {
        background: #ffffff;
        border-radius: 10px;
        padding: 18px 20px;
        border-top: 5px solid #78BE20;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        min-height: 100px;
    }

    .dashboard-card h3 {
        margin: 0;
        color: #5B3FA3;
        font-size: 16px;
        font-weight: 600;
    }

    .dashboard-numero {
        margin: 10px 0 0;
        font-size: 31px;
        font-weight: bold;
        color: #222222;
    }

    /* =========================
       GRÁFICO COMPACTO
       ========================= */

    .grafico-contenedor {
        margin-top: 24px;
        background: #ffffff;
        padding: 22px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .grafico-contenedor h2 {
        color: #5B3FA3;
        margin-top: 0;
        margin-bottom: 6px;
    }

    .grafico-descripcion {
        margin-top: 0;
        margin-bottom: 22px;
        color: #444444;
    }

    .categorias-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px 30px;
    }

    .categoria-item {
        width: 100%;
    }

    .categoria-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 6px;
        font-weight: 600;
    }

    .categoria-nombre {
        color: #222222;
    }

    .categoria-total {
        color: #5B3FA3;
        font-weight: bold;
    }

    .barra-fondo {
        width: 100%;
        height: 16px;
        background: #E5E7EB;
        border-radius: 20px;
        overflow: hidden;
    }

    .barra {
        height: 100%;
        background: linear-gradient(
            90deg,
            #5B3FA3,
            #78BE20
        );
        border-radius: 20px;
        min-width: 4px;
    }

    /* =========================
       BOTONES
       ========================= */

    .acciones-dashboard {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 24px;
    }

    /* =========================
       RESPONSIVE
       ========================= */

    @media (max-width: 900px) {
        .dashboard-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .categorias-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-card {
            min-height: auto;
        }

        .acciones-dashboard {
            flex-direction: column;
        }

        .acciones-dashboard .btn {
            text-align: center;
        }
    }
</style>

<div class="card admin-dashboard">

    <h1>Panel de administración</h1>

    <p>
        Resumen general de la gestión de soporte informático municipal.
        Los indicadores se calculan automáticamente a partir de los datos
        registrados en el sistema.
    </p>

    {{-- =========================
         INDICADORES
         ========================= --}}

    <div class="dashboard-grid">

        <div class="dashboard-card">
            <h3>👥 Usuarios registrados</h3>

            <p class="dashboard-numero">
                {{ $totalUsuarios }}
            </p>
        </div>

        <div class="dashboard-card">
            <h3>📋 Total requerimientos</h3>

            <p class="dashboard-numero">
                {{ $totalRequerimientos }}
            </p>
        </div>

        <div class="dashboard-card">
            <h3>🕐 Pendientes</h3>

            <p class="dashboard-numero">
                {{ $totalPendientes }}
            </p>
        </div>

        <div class="dashboard-card">
            <h3>🔧 En proceso</h3>

            <p class="dashboard-numero">
                {{ $totalEnProceso }}
            </p>
        </div>

        <div class="dashboard-card">
            <h3>✅ Resueltos</h3>

            <p class="dashboard-numero">
                {{ $totalResueltos }}
            </p>
        </div>

        <div class="dashboard-card">
            <h3>🚨 Prioridad urgente</h3>

            <p class="dashboard-numero">
                {{ $totalUrgentes }}
            </p>
        </div>

    </div>

    {{-- =========================
         REQUERIMIENTOS POR CATEGORÍA
         ========================= --}}

    <div class="grafico-contenedor">

        <h2>Requerimientos por categoría</h2>

        <p class="grafico-descripcion">
            Distribución de los requerimientos registrados según
            el tipo de problema o solicitud.
        </p>

        @php
            $maximoCategoria =
                $requerimientosPorCategoria->max('total') ?: 1;
        @endphp

        <div class="categorias-grid">

            @forelse ($requerimientosPorCategoria as $categoria)

                @php
                    $porcentaje =
                        ($categoria->total / $maximoCategoria) * 100;
                @endphp

                <div class="categoria-item">

                    <div class="categoria-info">

                        <span class="categoria-nombre">
                            {{ ucfirst($categoria->categoria) }}
                        </span>

                        <span class="categoria-total">
                            {{ $categoria->total }}
                        </span>

                    </div>

                    <div class="barra-fondo">

                        <div
                            class="barra"
                            style="width: {{ $porcentaje }}%;"
                        >
                        </div>

                    </div>

                </div>

            @empty

                <p>
                    No existen requerimientos registrados
                    para generar estadísticas.
                </p>

            @endforelse

        </div>

    </div>

    {{-- =========================
         ACCIONES
         ========================= --}}

    <div class="acciones-dashboard">

        <a
            href="{{ route('admin.requerimientos.index') }}"
            class="btn"
        >
            Ver requerimientos
        </a>

        <a
            href="{{ route('notificaciones.index') }}"
            class="btn"
        >
            Ver notificaciones
        </a>


    </div>

</div>

@endsection