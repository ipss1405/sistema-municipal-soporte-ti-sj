@extends('layout')

@section('content')

<div class="card" style="max-width: 750px; margin: auto;">
    <h1>Nuevo requerimiento informático</h1>

    <p>
        Completa el siguiente formulario para registrar una solicitud de soporte
        o requerimiento informático dirigido al área de informática municipal.
    </p>

    <form action="#" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label for="categoria" style="display: block; font-weight: bold; margin-bottom: 6px;">
                Categoría del requerimiento
            </label>

            <select id="categoria" name="categoria" style="width: 100%; padding: 10px;">
                <option value="">Seleccione una categoría</option>
                <option value="computador">Computador / Notebook</option>
                <option value="correo">Correo institucional</option>
                <option value="internet">Internet / Red</option>
                <option value="impresora">Impresora</option>
                <option value="sistema">Sistema municipal</option>
                <option value="firma">Firma digital</option>
                <option value="usuario">Usuario y contraseña</option>
                <option value="otro">Otro</option>
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="titulo" style="display: block; font-weight: bold; margin-bottom: 6px;">
                Título del requerimiento
            </label>

            <input 
                type="text" 
                id="titulo" 
                name="titulo" 
                placeholder="Ejemplo: No puedo acceder al correo institucional"
                style="width: 100%; padding: 10px;"
            >
        </div>

        <div style="margin-bottom: 15px;">
            <label for="descripcion" style="display: block; font-weight: bold; margin-bottom: 6px;">
                Descripción del problema
            </label>

            <textarea 
                id="descripcion" 
                name="descripcion" 
                rows="5" 
                placeholder="Describe el problema o solicitud con el mayor detalle posible"
                style="width: 100%; padding: 10px;"
            ></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="prioridad" style="display: block; font-weight: bold; margin-bottom: 6px;">
                Prioridad
            </label>

            <select id="prioridad" name="prioridad" style="width: 100%; padding: 10px;">
                <option value="">Seleccione prioridad</option>
                <option value="baja">Baja</option>
                <option value="media">Media</option>
                <option value="alta">Alta</option>
                <option value="urgente">Urgente</option>
            </select>
        </div>

        <button type="submit" class="btn">
            Registrar requerimiento
        </button>

        <a href="/funcionario" class="btn" style="background: #6B7280; margin-left: 10px;">
            Volver al panel
        </a>
    </form>
</div>

@endsection