@extends('layout')

@section('content')

<style>
    .login-wrapper {
        margin-top: 35px;
        margin-bottom: 35px;
    }

    .login-card {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 12px 30px rgba(91, 63, 149, 0.15);
        overflow: hidden;
        border-top: 6px solid #78BE20;
    }

    .login-lado-info {
        background: linear-gradient(135deg, #5B3F95 0%, #EF3E24 60%, #F26B21 100%);
        color: #ffffff;
        padding: 45px;
        height: 100%;
    }

    .login-lado-info h1 {
        font-weight: 800;
        margin-bottom: 18px;
    }

    .login-lado-info p {
        font-size: 1.05rem;
        margin-bottom: 18px;
    }

    .login-badge {
        display: inline-block;
        background: #78BE20;
        color: #ffffff;
        padding: 10px 18px;
        border-radius: 999px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .login-formulario {
        padding: 45px;
    }

    .login-formulario h2 {
        color: #5B3F95;
        font-weight: 800;
        margin-bottom: 12px;
    }

    .login-formulario p {
        color: #4B5563;
        margin-bottom: 24px;
    }

    .form-label {
        font-weight: 700;
        color: #1F2937;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px;
        border: 1px solid #D1D5DB;
    }

    .form-control:focus {
        border-color: #5B3F95;
        box-shadow: 0 0 0 0.2rem rgba(91, 63, 149, 0.15);
    }

    .password-wrapper {
        position: relative;
    }

    .password-wrapper .form-control {
        padding-right: 50px;
    }

    .btn-ojo {
        position: absolute;
        top: 50%;
        right: 12px;
        transform: translateY(-50%);
        border: none;
        background: transparent;
        color: #5B3F95;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 4px;
    }

    .btn-ojo:hover {
        color: #78BE20;
    }

    .btn-login {
        background: #5B3F95;
        color: #ffffff;
        border: none;
        font-weight: 700;
        border-radius: 10px;
        padding: 12px 20px;
        text-decoration: none;
        display: inline-block;
        width: 100%;
        text-align: center;
        transition: background 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-login:hover,
    .btn-login:focus,
    .btn-login:active {
        background: #78BE20;
        color: #ffffff;
        box-shadow: 0 8px 18px rgba(120, 190, 32, 0.25);
    }

    .btn-registro {
        background: #ffffff;
        color: #5B3F95;
        border: 2px solid #5B3F95;
        font-weight: 700;
        border-radius: 10px;
        padding: 10px 18px;
        text-decoration: none;
        display: inline-block;
        width: 100%;
        text-align: center;
        transition: background 0.2s ease, color 0.2s ease;
    }

    .btn-registro:hover,
    .btn-registro:focus,
    .btn-registro:active {
        background: #5B3F95;
        color: #ffffff;
    }

    .login-acceso {
        background: rgba(255, 255, 255, 0.12);
        border-radius: 14px;
        padding: 18px;
        margin-top: 25px;
    }

    .login-acceso strong {
        display: block;
        margin-bottom: 8px;
    }

    .mensaje-error {
        background: #FEE2E2;
        color: #991B1B;
        border-left: 5px solid #EF3E24;
        padding: 14px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .texto-error {
        color: #EF3E24;
        font-size: 0.9rem;
        margin-top: 6px;
        display: block;
    }

    @media (max-width: 768px) {
        .login-lado-info,
        .login-formulario {
            padding: 28px;
        }

        .login-lado-info h1 {
            font-size: 2rem;
        }
    }
</style>

<div class="container login-wrapper">

    <div class="login-card">

        <div class="row g-0">

            {{-- Lado izquierdo informativo --}}
            <div class="col-lg-5">

                <div class="login-lado-info">

                    <span class="login-badge">
                        Acceso funcionario
                    </span>

                    <h1>
                        Sistema Municipal de Soporte TI
                    </h1>

                    <p>
                        Ingrese con sus credenciales institucionales para acceder
                        al panel funcionario.
                    </p>

                    <p>
                        Desde el panel podrá crear solicitudes de soporte informático
                        y revisar el estado de sus requerimientos.
                    </p>

                    <div class="login-acceso">
                        <strong>Flujo del sistema</strong>
                        Login → Panel funcionario → Crear o revisar requerimientos
                    </div>

                </div>

            </div>

            {{-- Lado derecho formulario --}}
            <div class="col-lg-7">

                <div class="login-formulario">

                    <h2>Login</h2>

                    <p>
                        Acceda al sistema utilizando su correo institucional y contraseña.
                    </p>

                    @if ($errors->any())
                        <div class="mensaje-error">
                            Revise los datos ingresados e intente nuevamente.
                        </div>
                    @endif

                    <form action="{{ route('login.procesar') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Correo institucional
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="form-control"
                                placeholder="nombre.apellido@sanjoaquin.cl"
                                value="{{ old('email') }}"
                            >

                            @error('email')
                                <span class="texto-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Contraseña
                            </label>

                            <div class="password-wrapper">
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Ingrese su contraseña"
                                >

                                <button
                                    type="button"
                                    class="btn-ojo"
                                    onclick="mostrarPassword()"
                                    aria-label="Mostrar u ocultar contraseña"
                                >
                                    👁️
                                </button>
                            </div>

                            @error('password')
                                <span class="texto-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input
                                type="checkbox"
                                class="form-check-input"
                                id="recordar"
                                name="recordar"
                            >

                            <label class="form-check-label" for="recordar">
                                Recordar sesión
                            </label>
                        </div>

                        <button type="submit" class="btn-login">
                            Ingresar
                        </button>

                    </form>

                    <div class="mt-4">
                        <a href="/registro" class="btn-registro">
                            Crear una cuenta
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    function mostrarPassword() {
        const password = document.getElementById('password');

        if (password.type === 'password') {
            password.type = 'text';
        } else {
            password.type = 'password';
        }
    }
</script>

@endsection