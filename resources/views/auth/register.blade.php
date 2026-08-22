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
        --sj-borde: #DDE2EA;
    }

    /* =========================================================
       CONTENEDOR
       ========================================================= */

    .registro-wrapper {
        margin-top: 24px;
        margin-bottom: 24px;
    }

    .registro-card {
        border: 0;
        border-radius: 18px;
        overflow: hidden;

        box-shadow:
            0 12px 32px rgba(91, 63, 149, 0.12);
    }


    /* =========================================================
       COLUMNA IZQUIERDA
       ========================================================= */

    .registro-identidad {
        min-height: 100%;

        padding: 32px 30px;

        display: flex;
        flex-direction: column;

        background:
            linear-gradient(
                160deg,
                #5B3F95 0%,
                #5B3F95 58%,
                #673E8E 100%
            );

        color: #ffffff;
    }

    .registro-marca {
        display: inline-flex;
        align-items: center;
        align-self: flex-start;

        gap: 8px;

        padding: 8px 15px;

        border-radius: 999px;

        background:
            rgba(120, 190, 32, 0.18);

        color: #ffffff;

        font-size: 0.94rem;
        font-weight: 800;

        margin-bottom: 34px;
    }

    .registro-marca-punto {
        width: 9px;
        height: 9px;

        border-radius: 50%;

        background: var(--sj-verde);
    }

    .registro-identidad h1 {
        color: #ffffff;

        font-size:
            clamp(1.8rem, 3vw, 2.45rem);

        line-height: 1.12;
        font-weight: 800;

        margin: 0 0 15px;
    }

    .registro-identidad p {
        color:
            rgba(255, 255, 255, 0.82);

        font-size: 0.95rem;
        line-height: 1.6;

        margin: 0;

        max-width: 390px;
    }


    /* =========================================================
       CIERRE INSTITUCIONAL
       ========================================================= */

    .registro-institucional {
        margin-top: auto;
        padding-top: 45px;
    }

    .registro-linea {
        display: flex;

        width: 100%;
        height: 5px;

        border-radius: 999px;

        overflow: hidden;

        margin-bottom: 14px;
    }

    .registro-linea span:nth-child(1) {
        width: 45%;
        background: #ffffff;
    }

    .registro-linea span:nth-child(2) {
        width: 25%;
        background: var(--sj-verde);
    }

    .registro-linea span:nth-child(3) {
        width: 30%;

        background:
            linear-gradient(
                90deg,
                var(--sj-rojo),
                var(--sj-naranjo)
            );
    }

    .registro-municipalidad {
        color:
            rgba(255, 255, 255, 0.76);

        font-size: 0.78rem;
    }


    /* =========================================================
       FORMULARIO TABLER
       ========================================================= */

    .registro-formulario {
        min-height: 100%;

        padding: 34px 42px;

        background:
            linear-gradient(
                145deg,
                #ffffff 0%,
                #ffffff 75%,
                #faf9fc 100%
            );
    }

    .registro-titulo {
        color: var(--sj-morado);

        font-size: 2rem;
        font-weight: 800;

        margin-bottom: 5px;
    }

    .registro-subtitulo {
        color: var(--sj-texto-suave);

        font-size: 0.92rem;

        margin-bottom: 23px;
    }

    /*
     * Estos campos utilizan las clases
     * form-label y form-control de Tabler.
     */

    .registro-formulario .form-label {
        color: var(--sj-texto);

        font-size: 0.88rem;
        font-weight: 700;

        margin-bottom: 6px;
    }

    .registro-formulario .form-control {
        min-height: 44px;

        border-radius: 9px;

        border:
            1px solid var(--sj-borde);

        font-size: 0.92rem;

        padding:
            9px 12px;
    }

    .registro-formulario .form-control:focus {
        border-color: var(--sj-morado);

        box-shadow:
            0 0 0 3px
            rgba(91, 63, 149, 0.11);
    }

    .campo-registro {
        margin-bottom: 16px;
    }


    /* =========================================================
       CONTRASEÑA
       ========================================================= */

    .password-wrapper {
        position: relative;
    }

    .password-wrapper .form-control {
        padding-right: 76px;
    }

    .btn-password {
        position: absolute;

        right: 10px;
        top: 50%;

        transform:
            translateY(-50%);

        border: 0;
        background: transparent;

        color: var(--sj-morado);

        font-size: 0.77rem;
        font-weight: 700;

        cursor: pointer;
    }

    .btn-password:hover {
        color: var(--sj-verde);
    }


    /* =========================================================
       BOTONES
       Aquí seguimos usando estructura de botón de Tabler,
       pero con colores institucionales.
       ========================================================= */

    .btn-sj-principal {
        width: 100%;

        min-height: 45px;

        border: 0;

        background:
            var(--sj-morado);

        color: #ffffff;

        font-weight: 700;

        border-radius: 9px;

        transition:
            background 0.2s ease,
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .btn-sj-principal:hover,
    .btn-sj-principal:focus {
        background:
            var(--sj-verde);

        color: #ffffff;

        transform:
            translateY(-1px);

        box-shadow:
            0 8px 18px
            rgba(120, 190, 32, 0.20);
    }

    .btn-sj-secundario {
        width: 100%;

        min-height: 43px;

        margin-top: 12px;

        border:
            1px solid var(--sj-morado);

        background: #ffffff;

        color: var(--sj-morado);

        font-weight: 700;

        border-radius: 9px;
    }

    .btn-sj-secundario:hover {
        background: #F4F0FA;

        color: var(--sj-morado);

        border-color:
            var(--sj-morado);
    }


    /* =========================================================
       ERRORES
       ========================================================= */

    .mensaje-error {
        margin-bottom: 18px;

        padding: 11px 13px;

        border-left:
            4px solid var(--sj-rojo);

        border-radius: 8px;

        background: #FFF2F0;

        color: #9B2C1F;

        font-size: 0.87rem;
    }

    .texto-error {
        display: block;

        margin-top: 5px;

        color: var(--sj-rojo);

        font-size: 0.80rem;
    }


    /* =========================================================
       VOLVER
       ========================================================= */

    .volver-mesati {
        display: inline-block;

        margin-top: 19px;

        color: var(--sj-morado);

        font-size: 0.90rem;
        font-weight: 800;

        text-decoration: none;

        transition:
            color 0.2s ease,
            transform 0.2s ease;
    }

    .volver-mesati:hover {
        color: var(--sj-verde);

        transform:
            translateX(-2px);
    }


    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 991px) {

        .registro-identidad {
            padding: 26px;
        }

        .registro-formulario {
            padding: 30px;
        }

        .registro-institucional {
            padding-top: 32px;
        }
    }

    @media (max-width: 767px) {

        .registro-wrapper {
            margin-top: 16px;
            margin-bottom: 16px;
        }

        .registro-card {
            border-radius: 14px;
        }

        .registro-identidad {
            padding: 24px;
        }

        .registro-marca {
            margin-bottom: 25px;
        }

        .registro-identidad h1 {
            font-size: 1.9rem;
        }

        .registro-formulario {
            padding: 27px 23px;
        }

        .registro-titulo {
            font-size: 1.7rem;
        }
    }
</style>


<div class="container registro-wrapper">

    {{-- CARD DE TABLER --}}
    <div class="card registro-card">

        <div class="row g-0">


            {{-- =====================================================
                 IDENTIDAD
                 ===================================================== --}}
            <div class="col-lg-4">

                <div class="registro-identidad">

                    <div class="registro-marca">

                        <span class="registro-marca-punto"></span>

                        MesaTI Municipal

                    </div>

                    <h1>
                        Crear cuenta de acceso
                    </h1>

                    <p>
                        Registro de funcionarios para acceder
                        a la plataforma de gestión de
                        requerimientos informáticos.
                    </p>


                    <div class="registro-institucional">

                        <div class="registro-linea">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                        <div class="registro-municipalidad">
                            Municipalidad de San Joaquín · Área de Informática
                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 FORMULARIO
                 ===================================================== --}}
            <div class="col-lg-8">

                <div class="registro-formulario">

                    <h2 class="registro-titulo">
                        Crear cuenta
                    </h2>

                    <div class="registro-subtitulo">
                        Complete sus datos para registrarse
                        como funcionario en MesaTI.
                    </div>


                    {{-- ERRORES --}}
                    @if ($errors->any())

                        <div class="mensaje-error">
                            Revise los datos ingresados
                            e intente nuevamente.
                        </div>

                    @endif


                    <form
                        action="{{ route('registro.procesar') }}"
                        method="POST"
                    >

                        @csrf


                        {{-- NOMBRE --}}
                        <div class="campo-registro">

                            <label
                                for="name"
                                class="form-label"
                            >
                                Nombre completo
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                placeholder="Ingrese su nombre completo"
                                value="{{ old('name') }}"
                                autocomplete="name"
                            >

                            @error('name')

                                <span class="texto-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>


                        {{-- CORREO --}}
                        <div class="campo-registro">

                            <label
                                for="email"
                                class="form-label"
                            >
                                Correo institucional
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                placeholder="nombre.apellido@sanjoaquin.cl"
                                value="{{ old('email') }}"
                                autocomplete="email"
                            >

                            @error('email')

                                <span class="texto-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>


                        {{-- CONTRASEÑA --}}
                        <div class="campo-registro">

                            <label
                                for="password"
                                class="form-label"
                            >
                                Contraseña
                            </label>

                            <div class="password-wrapper">

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Mínimo 6 caracteres"
                                    autocomplete="new-password"
                                >

                                <button
                                    type="button"
                                    id="btnPassword"
                                    class="btn-password"
                                    onclick="mostrarPassword(
                                        'password',
                                        'btnPassword'
                                    )"
                                >
                                    Mostrar
                                </button>

                            </div>

                            @error('password')

                                <span class="texto-error">
                                    {{ $message }}
                                </span>

                            @enderror

                        </div>


                        {{-- CONFIRMAR CONTRASEÑA --}}
                        <div class="campo-registro">

                            <label
                                for="password_confirmation"
                                class="form-label"
                            >
                                Confirmar contraseña
                            </label>

                            <div class="password-wrapper">

                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Repita su contraseña"
                                    autocomplete="new-password"
                                >

                                <button
                                    type="button"
                                    id="btnPasswordConfirmacion"
                                    class="btn-password"
                                    onclick="mostrarPassword(
                                        'password_confirmation',
                                        'btnPasswordConfirmacion'
                                    )"
                                >
                                    Mostrar
                                </button>

                            </div>

                        </div>


                        {{-- CREAR CUENTA --}}
                        <button
                            type="submit"
                            class="btn btn-sj-principal"
                        >
                            Crear cuenta
                        </button>

                    </form>


                    {{-- YA TENGO CUENTA --}}
                    <a
                        href="{{ route('login') }}"
                        class="btn btn-sj-secundario"
                    >
                        Ya tengo una cuenta
                    </a>


                    {{-- VOLVER --}}
                    <a
                        href="{{ url('/') }}"
                        class="volver-mesati"
                    >
                        ← Volver a MesaTI
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


<script>
    function mostrarPassword(campoId, botonId) {

        const campo =
            document.getElementById(campoId);

        const boton =
            document.getElementById(botonId);

        if (campo.type === 'password') {

            campo.type = 'text';
            boton.textContent = 'Ocultar';

        } else {

            campo.type = 'password';
            boton.textContent = 'Mostrar';

        }
    }
</script>

@endsection