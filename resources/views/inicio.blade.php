@extends('layout')

@section('content')

{{-- Tabler UI: aplicado solo a la página principal --}}
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
    }

    /* =========================================================
       CONTENEDOR GENERAL
       ========================================================= */

    .inicio-sj {
        margin-top: 24px;
        margin-bottom: 24px;
    }

    .inicio-card {
        border: 0;
        border-radius: 18px;
        overflow: hidden;
        background: #ffffff;

        box-shadow:
            0 12px 32px rgba(91, 63, 149, 0.12);
    }


    /* =========================================================
       COLUMNA IZQUIERDA
       ========================================================= */

    .inicio-lateral {
        background:
            linear-gradient(
                160deg,
                #5B3F95 0%,
                #513687 100%
            );

        color: #ffffff;

        min-height: 100%;
        padding: 28px;
    }

    .titulo-acceso {
        color: #ffffff;
        font-size: 1.12rem;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .texto-acceso {
        color: rgba(255, 255, 255, 0.78);
        font-size: 0.90rem;
        line-height: 1.5;
        margin-bottom: 20px;
    }


    /* =========================================================
       BOTONES DE ACCESO
       ========================================================= */

    .btn-sj-acceso {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 100%;
        min-height: 44px;

        padding: 10px 16px;
        margin-bottom: 10px;

        border:
            1px solid rgba(255, 255, 255, 0.22);

        border-radius: 9px;

        background: var(--sj-morado-claro);
        color: #ffffff;

        font-weight: 700;
        text-decoration: none;

        transition:
            background 0.20s ease,
            color 0.20s ease,
            border-color 0.20s ease,
            transform 0.20s ease;
    }

    .btn-sj-acceso:hover,
    .btn-sj-acceso:focus {
        background: var(--sj-verde);
        border-color: var(--sj-verde);
        color: #ffffff;

        transform: translateY(-1px);
    }

    .btn-sj-secundario {
        background: transparent;

        border:
            1px solid rgba(255, 255, 255, 0.55);
    }

    .btn-sj-secundario:hover,
    .btn-sj-secundario:focus {
        background: #ffffff;
        border-color: #ffffff;
        color: var(--sj-morado);
    }


    /* =========================================================
       INFORMACIÓN DEL SERVICIO
       ========================================================= */

    .servicio-lateral {
        margin-top: 24px;
        padding-top: 20px;

        border-top:
            1px solid rgba(255, 255, 255, 0.18);
    }

    .servicio-lateral h3 {
        color: #ffffff;
        font-size: 1rem;
        font-weight: 800;
        margin-bottom: 15px;
    }

    .dato-servicio {
        margin-bottom: 11px;
    }

    .dato-servicio:last-child {
        margin-bottom: 0;
    }

    .dato-servicio strong {
        display: block;

        color:
            rgba(255, 255, 255, 0.66);

        font-size: 0.72rem;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 0.045em;

        margin-bottom: 2px;
    }

    .dato-servicio span {
        display: block;

        color: #ffffff;

        font-size: 0.86rem;
        line-height: 1.35;

        overflow-wrap: anywhere;
    }


    /* =========================================================
       COLUMNA DERECHA
       ========================================================= */

    .inicio-principal {
        position: relative;

        min-height: 100%;

        padding:
            36px 42px 27px;

        display: flex;
        flex-direction: column;

        background:
            linear-gradient(
                145deg,
                #ffffff 0%,
                #ffffff 62%,
                #f8f6fc 100%
            );

        overflow: hidden;
    }

    /* Detalle decorativo muy suave */
    .inicio-principal::after {
        content: "";

        position: absolute;

        width: 170px;
        height: 170px;

        right: -65px;
        bottom: -80px;

        border-radius: 50%;

        background:
            rgba(120, 190, 32, 0.09);

        pointer-events: none;
    }


    /* =========================================================
       IDENTIDAD MESA TI
       ========================================================= */

    .marca-sj {
        display: inline-flex;
        align-items: center;

        align-self: flex-start;

        gap: 9px;

        padding: 9px 17px;

        border-radius: 999px;

        background:
            rgba(120, 190, 32, 0.13);

        color: #4D8115;

        font-size: 1.02rem;
        font-weight: 800;

        letter-spacing: 0.01em;
    }

    .marca-sj-punto {
        width: 9px;
        height: 9px;

        border-radius: 50%;

        background: var(--sj-verde);
    }


    /* =========================================================
       NOMBRE DEL SISTEMA
       ========================================================= */

    .bloque-identidad {
        margin-top: 38px;
        position: relative;
        z-index: 1;
    }

    .titulo-sistema {
        color: var(--sj-morado);

        font-weight: 800;

        font-size:
            clamp(2rem, 4vw, 3rem);

        line-height: 1.08;

        margin:
            0 0 13px;
    }

    .subtitulo-sistema {
        color: var(--sj-texto);

        font-size: 1.08rem;
        font-weight: 600;

        margin-bottom: 15px;
    }

    .descripcion-sistema {
        color: var(--sj-texto-suave);

        font-size: 0.96rem;
        line-height: 1.65;

        max-width: 650px;

        margin-bottom: 0;
    }


    /* =========================================================
       LÍNEA INSTITUCIONAL
       ========================================================= */

    .cierre-institucional {
        margin-top: auto;

        padding-top: 38px;

        position: relative;
        z-index: 1;
    }

    .linea-institucional {
        display: flex;

        width: 100%;
        height: 5px;

        border-radius: 999px;

        overflow: hidden;
    }

    .linea-institucional span:nth-child(1) {
        width: 50%;
        background: var(--sj-morado);
    }

    .linea-institucional span:nth-child(2) {
        width: 25%;
        background: var(--sj-verde);
    }

    .linea-institucional span:nth-child(3) {
        width: 25%;

        background:
            linear-gradient(
                90deg,
                var(--sj-rojo),
                var(--sj-naranjo)
            );
    }

    .pie-portada {
        margin-top: 13px;

        color: #7A8493;

        font-size: 0.82rem;
        font-weight: 500;
    }


    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 991px) {

        .inicio-lateral {
            padding: 24px;
        }

        .inicio-principal {
            padding: 30px;
        }

        .bloque-identidad {
            margin-top: 30px;
        }

        .cierre-institucional {
            padding-top: 35px;
        }
    }


    @media (max-width: 767px) {

        .inicio-sj {
            margin-top: 16px;
            margin-bottom: 16px;
        }

        .inicio-card {
            border-radius: 14px;
        }

        .inicio-lateral {
            padding: 22px;
        }

        .inicio-principal {
            padding: 26px 22px;
        }

        .marca-sj {
            font-size: 0.94rem;
        }

        .bloque-identidad {
            margin-top: 28px;
        }

        .titulo-sistema {
            font-size: 2rem;
        }

        .cierre-institucional {
            padding-top: 32px;
        }
    }

</style>


<div class="container inicio-sj">

    <div class="card inicio-card">

        <div class="row g-0">

            {{-- =====================================================
                 COLUMNA IZQUIERDA
                 ===================================================== --}}
            <div class="col-lg-4">

                <div class="inicio-lateral">

                    <div class="titulo-acceso">
                        Acceso al sistema
                    </div>


                    {{-- =================================================
                         USUARIO SIN SESIÓN
                         ================================================= --}}
                    @guest

                        <div class="texto-acceso">
                            Ingrese con sus credenciales municipales
                            o cree una cuenta de funcionario.
                        </div>

                        <a
                            href="{{ route('login') }}"
                            class="btn-sj-acceso"
                        >
                            Iniciar sesión
                        </a>

                        <a
                            href="{{ route('registro') }}"
                            class="btn-sj-acceso btn-sj-secundario"
                        >
                            Registrarse
                        </a>

                    @endguest


                    {{-- =================================================
                         USUARIO CON SESIÓN
                         ================================================= --}}
                    @auth

                        <div class="texto-acceso">
                            Acceda a las opciones disponibles
                            según su perfil de usuario.
                        </div>


                        {{-- ADMINISTRADOR --}}
                        @if(auth()->user()->rol === 'administrador')

                            <a
                                href="{{ route('admin.dashboard') }}"
                                class="btn-sj-acceso"
                            >
                                Panel de administración
                            </a>

                            <a
                                href="{{ route('admin.requerimientos.index') }}"
                                class="btn-sj-acceso btn-sj-secundario"
                            >
                                Ver requerimientos
                            </a>


                        {{-- TÉCNICO --}}
                        @elseif(auth()->user()->rol === 'tecnico')

                            <a
                                href="{{ route('tecnico.dashboard') }}"
                                class="btn-sj-acceso"
                            >
                                Panel técnico
                            </a>


                        {{-- FUNCIONARIO --}}
                        @else

                            <a
                                href="{{ route('funcionario.dashboard') }}"
                                class="btn-sj-acceso"
                            >
                                Panel funcionario
                            </a>

                            <a
                                href="{{ route('requerimientos.create') }}"
                                class="btn-sj-acceso btn-sj-secundario"
                            >
                                Crear requerimiento
                            </a>

                            <a
                                href="{{ route('requerimientos.index') }}"
                                class="btn-sj-acceso btn-sj-secundario"
                            >
                                Mis requerimientos
                            </a>

                        @endif

                    @endauth


                    {{-- =================================================
                         INFORMACIÓN DEL SERVICIO
                         ================================================= --}}
                    <div class="servicio-lateral">

                        <h3>
                            Información del servicio
                        </h3>

                        <div class="dato-servicio">

                            <strong>
                                Unidad responsable
                            </strong>

                            <span>
                                Depto. Informática
                            </span>

                        </div>

                        <div class="dato-servicio">

                            <strong>
                                Dirección
                            </strong>

                            <span>
                                Dirección Administración y Finanzas
                            </span>

                        </div>

                        <div class="dato-servicio">

                            <strong>
                                Teléfono / Anexos
                            </strong>

                            <span>
                                9 5343 8487 · 8374 · 8487
                            </span>

                        </div>

                        <div class="dato-servicio">

                            <strong>
                                Correo
                            </strong>

                            <span>
                                informatica@sanjoaquin.cl
                            </span>

                        </div>

                        <div class="dato-servicio">

                            <strong>
                                Horario
                            </strong>

                            <span>
                                Lunes a viernes · horario administrativo
                            </span>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 COLUMNA DERECHA
                 ===================================================== --}}
            <div class="col-lg-8">

                <div class="inicio-principal">

                    {{-- Nombre corto del sistema --}}
                    <div class="marca-sj">

                        <span class="marca-sj-punto"></span>

                        MesaTI Municipal

                    </div>


                    {{-- Nombre formal --}}
                    <div class="bloque-identidad">

                        <h1 class="titulo-sistema">
                            Sistema Municipal de Soporte TI
                        </h1>

                        <div class="subtitulo-sistema">
                            Gestión interna de requerimientos informáticos
                        </div>

                        <p class="descripcion-sistema">
                            Plataforma municipal para registrar,
                            gestionar y realizar seguimiento a solicitudes
                            de soporte informático.
                        </p>

                    </div>


                    {{-- Cierre inferior --}}
                    <div class="cierre-institucional">

                        <div class="linea-institucional">

                            <span></span>
                            <span></span>
                            <span></span>

                        </div>

                        <div class="pie-portada">
                            Municipalidad de San Joaquín · Área de Informática
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection