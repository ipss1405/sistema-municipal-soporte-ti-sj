@extends('layout')

@section('content')

<style>
    .inicio-wrapper {
        margin-top: 35px;
        margin-bottom: 35px;
    }

    /* Columna izquierda */

    .columna-lateral {
        display: flex;
        flex-direction: column;
        gap: 22px;
    }

    .panel-accesos-moderno {
        background: #5B3F95;
        color: #ffffff;
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 10px 25px rgba(91, 63, 149, 0.18);

        transition:
            background 0.25s ease,
            box-shadow 0.25s ease;
    }

    .panel-accesos-moderno:hover {
        background: linear-gradient(
            135deg,
            #5B3F95 0%,
            #6B4BB0 100%
        );

        box-shadow: 0 16px 35px rgba(91, 63, 149, 0.28);
    }

    .panel-accesos-moderno h2 {
        font-weight: 800;
        margin-bottom: 22px;
    }

    .btn-acceso {
        display: block;
        width: 100%;
        background: #6B4BB0;
        color: #ffffff;
        text-decoration: none;
        padding: 13px 16px;
        border-radius: 8px;
        font-weight: 700;
        margin-bottom: 11px;

        transition:
            background 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .btn-acceso:last-child {
        margin-bottom: 0;
    }

    .btn-acceso:hover,
    .btn-acceso:focus,
    .btn-acceso:active {
        background: #78BE20;
        color: #ffffff;
        transform: translateX(4px);
    }

    /* Información compacta del servicio */

    .info-servicio-compacta {
        background: #ffffff;
        border-top: 6px solid #78BE20;
        border-radius: 18px;
        padding: 24px;
        box-shadow: 0 10px 25px rgba(91, 63, 149, 0.12);

        transition:
            box-shadow 0.25s ease,
            border-top-color 0.25s ease;
    }

    .info-servicio-compacta:hover {
        border-top-color: #5B3F95;
        box-shadow: 0 16px 35px rgba(91, 63, 149, 0.18);
    }

    .info-servicio-compacta h3 {
        color: #5B3F95;
        font-weight: 800;
        font-size: 1.35rem;
        margin-bottom: 20px;
    }

    .info-compacta-item {
        border-left: 4px solid #5B3F95;
        padding: 8px 0 8px 12px;
        margin-bottom: 13px;
        border-radius: 6px;

        transition:
            background 0.2s ease,
            border-left-color 0.2s ease;
    }

    .info-compacta-item:last-child {
        margin-bottom: 0;
    }

    .info-compacta-item:hover {
        background: #EAF7E3;
        border-left-color: #78BE20;
    }

    .info-compacta-item strong {
        display: block;
        color: #1F2937;
        font-size: 0.93rem;
        margin-bottom: 3px;
    }

    .info-compacta-item span {
        display: block;
        color: #4B5563;
        font-size: 0.9rem;
        line-height: 1.4;
        overflow-wrap: anywhere;
    }

    /* Columna derecha */

    .hero-municipal {
        background: linear-gradient(
            135deg,
            #5B3F95 0%,
            #EF3E24 55%,
            #F26B21 100%
        );

        color: #ffffff;
        border-radius: 18px 18px 0 0;
        padding: 45px;
        border-top: 6px solid #78BE20;
    }

    .badge-area {
        background: #78BE20;
        color: #ffffff;
        font-weight: 700;
        padding: 10px 18px;
        border-radius: 999px;
        display: inline-block;
        margin-bottom: 20px;
    }

    .hero-contenido {
        background: #ffffff;
        color: #1F2937;
        padding: 32px 38px;
        border-radius: 0 0 18px 18px;
        box-shadow: 0 10px 25px rgba(91, 63, 149, 0.12);
    }

    .hero-contenido p {
        margin-bottom: 14px;
    }

    .texto-principal-resumido {
        font-size: 1.05rem;
        color: #374151;
    }

    /* Tarjetas informativas */

    .card-opcion-integrada {
        background: #ffffff;
        border: none;
        border-top: 5px solid #78BE20;
        border-radius: 16px;
        padding: 18px 14px;
        min-height: 115px;
        text-align: center;
        box-shadow: 0 8px 20px rgba(91, 63, 149, 0.10);
        position: relative;
        overflow: hidden;

        transition:
            box-shadow 0.25s ease,
            border-top-color 0.25s ease,
            background 0.25s ease;
    }

    .card-opcion-integrada::before {
        content: "";
        position: absolute;
        width: 65px;
        height: 65px;
        background: rgba(120, 190, 32, 0.12);
        border-radius: 50%;
        top: -25px;
        right: -25px;

        transition:
            background 0.25s ease,
            transform 0.25s ease;
    }

    .card-opcion-integrada:hover {
        background: #F6FFF1;
        border-top-color: #5B3F95;
        box-shadow: 0 14px 30px rgba(91, 63, 149, 0.18);
    }

    .card-opcion-integrada:hover::before {
        background: rgba(91, 63, 149, 0.15);
        transform: scale(1.2);
    }

    .card-opcion-integrada .icono {
        font-size: 1.7rem;
        margin-bottom: 8px;
        position: relative;
        z-index: 1;
    }

    .card-opcion-integrada h5 {
        color: #5B3F95;
        font-weight: 800;
        font-size: 0.98rem;
        margin-bottom: 0;
        position: relative;
        z-index: 1;
    }

    /* Diseño adaptable */

    @media (max-width: 991px) {
        .columna-lateral {
            margin-bottom: 5px;
        }
    }

    @media (max-width: 768px) {
        .hero-municipal,
        .hero-contenido {
            padding: 25px;
        }

        .hero-municipal h1 {
            font-size: 2rem;
        }

        .panel-accesos-moderno,
        .info-servicio-compacta {
            padding: 22px;
        }

        .card-opcion-integrada {
            min-height: 105px;
        }
    }
</style>

<div class="container inicio-wrapper">

    <div class="row g-4 align-items-start">

        {{-- Columna izquierda --}}
        <div class="col-lg-4">

            <div class="columna-lateral">

                {{-- Accesos rápidos --}}
                <div class="panel-accesos-moderno">

                    <h2>Accesos rápidos</h2>

                    {{-- Usuario sin sesión iniciada --}}
                    @guest

                        <a
                            href="{{ route('login') }}"
                            class="btn-acceso"
                        >
                            Login
                        </a>

                        <a
                            href="{{ route('registro') }}"
                            class="btn-acceso"
                        >
                            Registro
                        </a>

                    @endguest


                    {{-- Usuario con sesión iniciada --}}
                    @auth

                        <a
                            href="{{ route('funcionario.dashboard') }}"
                            class="btn-acceso"
                        >
                            Panel funcionario
                        </a>

                        <a
                            href="{{ route('requerimientos.create') }}"
                            class="btn-acceso"
                        >
                            Crear requerimiento
                        </a>

                        <a
                            href="{{ route('requerimientos.index') }}"
                            class="btn-acceso"
                        >
                            Mis requerimientos
                        </a>

                        {{-- Solo administradores --}}
                        @if (auth()->user()->rol === 'administrador')

                            <a
                                href="{{ route('admin.requerimientos.index') }}"
                                class="btn-acceso"
                            >
                                Administración
                            </a>

                        @endif

                    @endauth

                </div>

                {{-- Información compacta del servicio --}}
                <div class="info-servicio-compacta">

                    <h3>Información del servicio</h3>

                    <div class="info-compacta-item">
                        <strong>Unidad responsable</strong>
                        <span>Depto. Informática</span>
                    </div>

                    <div class="info-compacta-item">
                        <strong>Dirección</strong>
                        <span>
                            Dirección Administración y Finanzas
                        </span>
                    </div>

                    <div class="info-compacta-item">
                        <strong>Teléfono / Anexo</strong>
                        <span>
                            9 5343 8487<br>
                            Anexos 8374 - 8487
                        </span>
                    </div>

                    <div class="info-compacta-item">
                        <strong>Correo</strong>
                        <span>
                            informatica@sanjoaquin.cl
                        </span>
                    </div>

                    <div class="info-compacta-item">
                        <strong>Horario de atención</strong>
                        <span>
                            Lunes a viernes, horario administrativo
                        </span>
                    </div>

                    <div class="info-compacta-item">
                        <strong>Tipo de atención</strong>
                        <span>
                            Soporte informático municipal
                        </span>
                    </div>

                </div>

            </div>

        </div>

        {{-- Columna derecha --}}
        <div class="col-lg-8">

            <div class="hero-municipal">

                <span class="badge-area">
                    Área de Informática Municipal
                </span>

                <h1 class="display-5 fw-bold">
                    Sistema Municipal de Soporte TI
                </h1>

                <p class="lead mt-3">
                    Plataforma interna de gestión de requerimientos informáticos
                </p>

            </div>

            <div class="hero-contenido">

                <p class="texto-principal-resumido">
                    Este sistema permite a los funcionarios municipales
                    registrar solicitudes de soporte informático, revisar
                    sus estados, recibir notificaciones y consultar las
                    respuestas entregadas por el área de Informática.
                </p>

                <p>
                    Su objetivo es centralizar la atención, mejorar la
                    trazabilidad y apoyar la gestión del soporte técnico
                    municipal.
                </p>

                <div class="row g-3 mt-3">

                    <div class="col-md-4">

                        <div class="card-opcion-integrada">

                            <div class="icono">
                                📌
                            </div>

                            <h5>
                                Atención centralizada
                            </h5>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="card-opcion-integrada">

                            <div class="icono">
                                🔎
                            </div>

                            <h5>
                                Trazabilidad
                            </h5>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="card-opcion-integrada">

                            <div class="icono">
                                🛠️
                            </div>

                            <h5>
                                Gestión TI
                            </h5>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection