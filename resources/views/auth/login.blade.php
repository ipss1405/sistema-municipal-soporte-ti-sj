@extends('layout')

@section('content')

{{-- Tabler UI: mismo estilo utilizado en la portada --}}
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
       CONTENEDOR GENERAL
       ========================================================= */

    .login-wrapper {
        margin-top: 24px;
        margin-bottom: 24px;
    }

    .login-card {
        background: #ffffff;
        border: 0;
        border-radius: 18px;
        overflow: hidden;

        box-shadow:
            0 12px 32px rgba(91, 63, 149, 0.12);
    }

    /* =========================================================
       COLUMNA IZQUIERDA
       ========================================================= */

    .login-identidad {
        min-height: 100%;
        padding: 32px 30px;

        display: flex;
        flex-direction: column;

        color: #ffffff;

        background:
            linear-gradient(
                160deg,
                #5B3F95 0%,
                #5B3F95 58%,
                #673E8E 100%
            );
    }

    .login-marca {
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

    .login-marca-punto {
        width: 9px;
        height: 9px;

        background: var(--sj-verde);

        border-radius: 50%;
    }

    .login-identidad h1 {
        color: #ffffff;

        font-size:
            clamp(1.8rem, 3vw, 2.45rem);

        line-height: 1.12;
        font-weight: 800;

        margin: 0 0 15px;
    }

    .login-identidad p {
        color:
            rgba(255, 255, 255, 0.82);

        font-size: 0.95rem;
        line-height: 1.6;

        margin: 0;

        max-width: 390px;
    }

    /* =========================================================
       CIERRE INSTITUCIONAL IZQUIERDO
       ========================================================= */

    .login-institucional {
        margin-top: auto;
        padding-top: 45px;
    }

    .login-linea {
        display: flex;

        width: 100%;
        height: 5px;

        border-radius: 999px;

        overflow: hidden;

        margin-bottom: 14px;
    }

    .login-linea span:nth-child(1) {
        width: 45%;
        background: #ffffff;
    }

    .login-linea span:nth-child(2) {
        width: 25%;
        background: var(--sj-verde);
    }

    .login-linea span:nth-child(3) {
        width: 30%;

        background:
            linear-gradient(
                90deg,
                var(--sj-rojo),
                var(--sj-naranjo)
            );
    }

    .login-municipalidad {
        color:
            rgba(255, 255, 255, 0.76);

        font-size: 0.78rem;
        font-weight: 500;
    }

    /* =========================================================
       FORMULARIO
       ========================================================= */

    .login-formulario {
        min-height: 100%;

        padding: 38px 42px;

        background:
            linear-gradient(
                145deg,
                #ffffff 0%,
                #ffffff 75%,
                #faf9fc 100%
            );
    }

    .login-titulo {
        color: var(--sj-morado);

        font-size: 2rem;
        font-weight: 800;

        margin-bottom: 7px;
    }

    .login-subtitulo {
        color: var(--sj-texto-suave);

        font-size: 0.94rem;
        line-height: 1.5;

        margin-bottom: 26px;
    }

    /* =========================================================
       CAMPOS
       ========================================================= */

    .campo-login {
        margin-bottom: 18px;
    }

    .campo-login label {
        display: block;

        color: var(--sj-texto);

        font-size: 0.89rem;
        font-weight: 700;

        margin-bottom: 7px;
    }

    .campo-login .form-control {
        width: 100%;

        min-height: 46px;

        padding: 10px 13px;

        background: #ffffff;

        border:
            1px solid var(--sj-borde);

        border-radius: 9px;

        color: var(--sj-texto);

        font-size: 0.94rem;

        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .campo-login .form-control:focus {
        border-color: var(--sj-morado);

        box-shadow:
            0 0 0 3px
            rgba(91, 63, 149, 0.11);
    }

    /* =========================================================
       CONTRASEÑA
       ========================================================= */

    .password-wrapper {
        position: relative;
    }

    .password-wrapper .form-control {
        padding-right: 78px;
    }

    .btn-password {
        position: absolute;

        top: 50%;
        right: 12px;

        transform: translateY(-50%);

        border: 0;
        background: transparent;

        color: var(--sj-morado);

        font-size: 0.78rem;
        font-weight: 700;

        cursor: pointer;

        padding: 5px 7px;
    }

    .btn-password:hover {
        color: var(--sj-verde);
    }

    /* =========================================================
       RECORDAR SESIÓN
       ========================================================= */

    .recordar-login {
        display: flex;
        align-items: center;

        gap: 8px;

        margin: 2px 0 22px;

        color: var(--sj-texto);

        font-size: 0.88rem;
    }

    .recordar-login input {
        width: 17px;
        height: 17px;

        accent-color: var(--sj-morado);
    }

    /* =========================================================
       BOTONES
       ========================================================= */

    .btn-login {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 100%;
        min-height: 46px;

        border: 0;
        border-radius: 9px;

        background: var(--sj-morado);

        color: #ffffff;

        font-size: 0.94rem;
        font-weight: 700;

        cursor: pointer;

        transition:
            background 0.2s ease,
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .btn-login:hover,
    .btn-login:focus {
        background: var(--sj-verde);

        color: #ffffff;

        transform: translateY(-1px);

        box-shadow:
            0 8px 18px
            rgba(120, 190, 32, 0.20);
    }

    .btn-registro {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 100%;
        min-height: 44px;

        margin-top: 12px;

        border:
            1px solid var(--sj-morado);

        border-radius: 9px;

        background: #ffffff;

        color: var(--sj-morado);

        text-decoration: none;

        font-size: 0.92rem;
        font-weight: 700;

        transition:
            background 0.2s ease,
            color 0.2s ease;
    }

    .btn-registro:hover,
    .btn-registro:focus {
        background: #F4F0FA;
        color: var(--sj-morado);
    }

    /* =========================================================
       ERRORES
       ========================================================= */

    .mensaje-error {
        background: #FFF2F0;

        color: #9B2C1F;

        border-left:
            4px solid var(--sj-rojo);

        border-radius: 8px;

        padding: 11px 13px;

        margin-bottom: 20px;

        font-size: 0.88rem;
    }

    .texto-error {
        display: block;

        color: var(--sj-rojo);

        font-size: 0.80rem;

        margin-top: 5px;
    }

    /* =========================================================
       VOLVER A MESA TI
       ========================================================= */

    .volver-inicio {
        display: inline-block;

        margin-top: 20px;

        color: var(--sj-morado);

        font-size: 0.90rem;
        font-weight: 800;

        text-decoration: none;

        transition:
            color 0.2s ease,
            transform 0.2s ease;
    }

    .volver-inicio:hover,
    .volver-inicio:focus {
        color: var(--sj-verde);

        transform: translateX(-2px);
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 991px) {

        .login-identidad {
            padding: 26px;
        }

        .login-formulario {
            padding: 30px;
        }

        .login-institucional {
            padding-top: 32px;
        }
    }

    @media (max-width: 767px) {

        .login-wrapper {
            margin-top: 16px;
            margin-bottom: 16px;
        }

        .login-card {
            border-radius: 14px;
        }

        .login-identidad {
            padding: 24px;
        }

        .login-marca {
            margin-bottom: 25px;
        }

        .login-identidad h1 {
            font-size: 1.9rem;
        }

        .login-institucional {
            padding-top: 28px;
        }

        .login-formulario {
            padding: 27px 23px;
        }

        .login-titulo {
            font-size: 1.7rem;
        }
    }
</style>


<div class="container login-wrapper">

    <div class="login-card">

        <div class="row g-0">

            {{-- =====================================================
                 COLUMNA IZQUIERDA
                 ===================================================== --}}
            <div class="col-lg-4">

                <div class="login-identidad">

                    <div class="login-marca">

                        <span class="login-marca-punto"></span>

                        MesaTI Municipal

                    </div>

                    <h1>
                        Sistema Municipal de Soporte TI
                    </h1>

                    <p>
                        Acceso a la plataforma interna para la gestión
                        y seguimiento de requerimientos informáticos.
                    </p>

                    <div class="login-institucional">

                        <div class="login-linea">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                        <div class="login-municipalidad">
                            Municipalidad de San Joaquín · Área de Informática
                        </div>

                    </div>

                </div>

            </div>

            {{-- =====================================================
                 COLUMNA DERECHA
                 ===================================================== --}}
            <div class="col-lg-8">

                <div class="login-formulario">

                    <h2 class="login-titulo">
                        Iniciar sesión
                    </h2>

                    <div class="login-subtitulo">
                        Ingrese su correo institucional y contraseña
                        para acceder a MesaTI.
                    </div>

                    @if ($errors->any())

                        <div class="mensaje-error">
                            Revise los datos ingresados
                            e intente nuevamente.
                        </div>

                    @endif

                    <form
                        action="{{ route('login.procesar') }}"
                        method="POST"
                    >

                        @csrf

                        <div class="campo-login">

                            <label for="email">
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

                        <div class="campo-login">

                            <label for="password">
                                Contraseña
                            </label>

                            <div class="password-wrapper">

                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Ingrese su contraseña"
                                    autocomplete="current-password"
                                >

                                <button
                                    type="button"
                                    id="btnPassword"
                                    class="btn-password"
                                    onclick="mostrarPassword()"
                                    aria-label="Mostrar u ocultar contraseña"
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

                        <label class="recordar-login">

                            <input
                                type="checkbox"
                                id="recordar"
                                name="recordar"
                                {{ old('recordar') ? 'checked' : '' }}
                            >

                            <span>
                                Recordar sesión
                            </span>

                        </label>

                        <button
                            type="submit"
                            class="btn-login"
                        >
                            Ingresar
                        </button>

                    </form>

                    <a
                        href="{{ route('registro') }}"
                        class="btn-registro"
                    >
                        Crear una cuenta
                    </a>

                    <a
                        href="{{ url('/') }}"
                        class="volver-inicio"
                    >
                        ← Volver a MesaTI
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


<script>
    function mostrarPassword() {

        const password =
            document.getElementById('password');

        const boton =
            document.getElementById('btnPassword');

        if (password.type === 'password') {

            password.type = 'text';
            boton.textContent = 'Ocultar';

        } else {

            password.type = 'password';
            boton.textContent = 'Mostrar';

        }
    }
</script>

@endsection