@extends('layout')

@section('content')

<div class="card" style="max-width: 650px; margin: auto;">
    <h1>Registro de funcionario</h1>

    <p>
        Completa tus datos para crear una cuenta de acceso a la plataforma.
    </p>

    <form action="#" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="name" style="display: block; font-weight: bold; margin-bottom: 6px;">
                Nombre completo
            </label>

            <input 
                type="text" 
                id="name" 
                name="name" 
                placeholder="Ejemplo: Rosa Figueroa"
                style="width: 100%; padding: 10px;"
            >
        </div>

        <div style="margin-bottom: 15px;">
            <label for="email" style="display: block; font-weight: bold; margin-bottom: 6px;">
                Correo institucional
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
            <label for="unidad" style="display: block; font-weight: bold; margin-bottom: 6px;">
                Unidad municipal
            </label>

            <input 
                type="text" 
                id="unidad" 
                name="unidad" 
                placeholder="Ejemplo: Informática"
                style="width: 100%; padding: 10px;"
            >
        </div>

        <div style="margin-bottom: 15px;">
            <label for="cargo" style="display: block; font-weight: bold; margin-bottom: 6px;">
                Cargo
            </label>

            <input 
                type="text" 
                id="cargo" 
                name="cargo" 
                placeholder="Ejemplo: Administrativo"
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
                placeholder="Crea una contraseña"
                style="width: 100%; padding: 10px;"
            >
        </div>

        <div style="margin-bottom: 15px;">
            <label for="password_confirmation" style="display: block; font-weight: bold; margin-bottom: 6px;">
                Confirmar contraseña
            </label>

            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation" 
                placeholder="Repite la contraseña"
                style="width: 100%; padding: 10px;"
            >
        </div>

        <button type="submit" class="btn">
            Crear cuenta
        </button>

        <a href="/login" class="btn" style="background: #6B7280; margin-left: 10px;">
            Volver al login
        </a>
    </form>
</div>

@endsection