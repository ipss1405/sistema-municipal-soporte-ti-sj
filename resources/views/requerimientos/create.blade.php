@extends('layout')

@section('content')

<div class="card" style="max-width: 800px; margin: 0 auto;">
    <h1>Registrar nuevo requerimiento</h1>

    <p>
        Complete el siguiente formulario para ingresar una solicitud de soporte informático.
        El requerimiento quedará registrado con estado inicial <strong>Pendiente</strong>.
    </p>

    @if ($errors->any())
        <div style="
            background: #FEE2E2;
            color: #991B1B;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        ">
            <strong>Revisa los datos ingresados:</strong>

            <ul style="margin-bottom: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('requerimientos.store') }}" method="POST">
        @csrf

        <label for="categoria">Categoría del requerimiento</label>
        <select name="categoria" id="categoria" required>
            <option value="">Seleccione una categoría</option>
            <option value="computador" {{ old('categoria') == 'computador' ? 'selected' : '' }}>Computador</option>
            <option value="correo" {{ old('categoria') == 'correo' ? 'selected' : '' }}>Correo institucional</option>
            <option value="internet" {{ old('categoria') == 'internet' ? 'selected' : '' }}>Internet / Red</option>
            <option value="impresora" {{ old('categoria') == 'impresora' ? 'selected' : '' }}>Impresora</option>
            <option value="sistema" {{ old('categoria') == 'sistema' ? 'selected' : '' }}>Sistema municipal</option>
            <option value="firma" {{ old('categoria') == 'firma' ? 'selected' : '' }}>Firma electrónica</option>
            <option value="usuario" {{ old('categoria') == 'usuario' ? 'selected' : '' }}>Usuario y contraseña</option>
            <option value="otro" {{ old('categoria') == 'otro' ? 'selected' : '' }}>Otro</option>
        </select>

        <label for="titulo">Título del requerimiento</label>
        <input
            type="text"
            name="titulo"
            id="titulo"
            value="{{ old('titulo') }}"
            placeholder="Ejemplo: Problema para acceder al correo"
            required
        >

        <label for="descripcion">Descripción del problema o solicitud</label>
        <textarea
            name="descripcion"
            id="descripcion"
            rows="5"
            placeholder="Describa con detalle el requerimiento informático"
            required
        >{{ old('descripcion') }}</textarea>

        <label for="prioridad">Prioridad</label>
        <select name="prioridad" id="prioridad" required>
            <option value="">Seleccione prioridad</option>
            <option value="baja" {{ old('prioridad') == 'baja' ? 'selected' : '' }}>Baja</option>
            <option value="media" {{ old('prioridad') == 'media' ? 'selected' : '' }}>Media</option>
            <option value="alta" {{ old('prioridad') == 'alta' ? 'selected' : '' }}>Alta</option>
            <option value="urgente" {{ old('prioridad') == 'urgente' ? 'selected' : '' }}>Urgente</option>
        </select>

        <button type="submit" class="btn">
            Registrar requerimiento
        </button>

        <a href="/funcionario" class="btn" style="background: #6B7280; margin-left: 10px;">
            Volver al panel
        </a>
    </form>
</div>

@endsection
