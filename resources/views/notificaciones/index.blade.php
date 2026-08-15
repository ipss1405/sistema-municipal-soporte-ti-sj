@extends('layout')

@section('content')

<style>
    .notificaciones-wrapper {
        margin-top: 35px;
        margin-bottom: 35px;
    }

    .notificaciones-card {
        background: #ffffff;
        border-radius: 18px;
        border-top: 6px solid #78BE20;
        box-shadow: 0 10px 25px rgba(91, 63, 149, 0.12);
        padding: 35px;
    }

    .notificaciones-card h1 {
        color: #5B3F95;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .acciones-superiores {
        margin-top: 18px;
        margin-bottom: 25px;
    }

    .notificacion-item {
        background: #F9FAFB;
        border-left: 6px solid #5B3F95;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 16px;
        transition: background 0.2s ease, box-shadow 0.2s ease;
    }

    .notificacion-item:hover {
        background: #F6FFF1;
        box-shadow: 0 8px 18px rgba(91, 63, 149, 0.12);
    }

    .notificacion-nueva {
        border-left-color: #78BE20;
        background: #F6FFF1;
    }

    .notificacion-titulo {
        color: #5B3F95;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .notificacion-mensaje {
        color: #374151;
        margin-bottom: 8px;
    }

    .notificacion-fecha {
        color: #6B7280;
        font-size: 0.9rem;
    }

    .badge-nueva {
        background: #78BE20;
        color: #ffffff;
        border-radius: 999px;
        padding: 5px 12px;
        font-size: 0.8rem;
        font-weight: 700;
        margin-left: 8px;
    }

    .sin-notificaciones {
        background: #EAF7E3;
        border-radius: 14px;
        padding: 24px;
        color: #374151;
        text-align: center;
    }

    .btn-volver {
        background: #5B3F95;
        color: #ffffff;
        border: none;
        font-weight: 700;
        border-radius: 10px;
        padding: 12px 20px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-volver:hover {
        background: #78BE20;
        color: #ffffff;
    }

    .btn-requerimiento {
        background: #5B3F95;
        color: #ffffff;
        border: none;
        font-weight: 700;
        border-radius: 10px;
        padding: 10px 18px;
        text-decoration: none;
        display: inline-block;
        margin-top: 12px;
    }

    .btn-requerimiento:hover {
        background: #78BE20;
        color: #ffffff;
    }
</style>

<div class="container notificaciones-wrapper">

    <div class="notificaciones-card">

        <h1>Notificaciones</h1>

        @if (auth()->user()->rol === 'administrador')
            <p>
                Aquí se muestran los nuevos requerimientos registrados
                por los funcionarios municipales.
            </p>
        @else
            <p>
                Aquí se muestran las actualizaciones de prioridad,
                estado y gestión de sus requerimientos informáticos.
            </p>
        @endif

        {{-- Botón de regreso según el rol --}}
        <div class="acciones-superiores">

            @if (auth()->user()->rol === 'administrador')

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="btn-volver"
                >
                    Volver al panel de administración
                </a>

            @else

                <a
                    href="{{ route('funcionario.dashboard') }}"
                    class="btn-volver"
                >
                    Volver al panel funcionario
                </a>

            @endif

        </div>

        <hr>

        @forelse ($notificaciones as $notificacion)

            <div
                class="notificacion-item
                {{ !$notificacion->leida ? 'notificacion-nueva' : '' }}"
            >

                <div class="notificacion-titulo">

                    🔔 {{ $notificacion->titulo }}

                    @if (!$notificacion->leida)

                        <span class="badge-nueva">
                            Nueva
                        </span>

                    @endif

                </div>

                <div class="notificacion-mensaje">
                    {{ $notificacion->mensaje }}
                </div>

                <div class="notificacion-fecha">

                    Recibida el

                    {{ $notificacion->created_at->format('d-m-Y H:i') }}

                </div>

                @if ($notificacion->requerimiento_id)

                    <div>

                        <a
                            href="{{ route(
                                'requerimientos.show',
                                $notificacion->requerimiento_id
                            ) }}"
                            class="btn-requerimiento"
                        >
                            Ver requerimiento
                        </a>

                    </div>

                @endif

            </div>

        @empty

            <div class="sin-notificaciones">
                No tienes notificaciones por el momento.
            </div>

        @endforelse

    </div>

</div>

@endsection