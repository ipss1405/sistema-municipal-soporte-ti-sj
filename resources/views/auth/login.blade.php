@extends('layout')

@section('content')

<div class="card" style="max-width: 500px; margin: auto;">
    <h1>Iniciar sesión</h1>

    <p>
        Ingresa tus credenciales para acceder a la plataforma de requerimientos informáticos.
    </p>

    <form action="#" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; font-weight: bold; margin-bottom: 6px;">
                Correo electrónico
            </label>

            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="correo@municipalidad.cl"
                style="width: 100%; padding: 10px;"
            >
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password" style="display: block; font-weight: bold; margin-bottom: 6px;">
                Contraseña
            </label>

            <input 
                type="password" 
                id="password" 
                name="password" 
                placeholder="Ingresa tu contraseña"
                style="width: 100%; padding: 10px;"
            >
        </div>

        <button type="submit" class="btn">
            Ingresar
        </button>

        <a href="/registro" class="btn" style="background: #6B7280; margin-left: 10px;">
            Crear cuenta
        </a>
    </form>
</div>

@endsection