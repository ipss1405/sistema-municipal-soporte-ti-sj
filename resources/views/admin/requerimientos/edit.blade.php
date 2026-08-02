@extends('layout')

@section('content')

<div class="card" style="max-width: 900px; margin: 0 auto;">
    <h1>Gestionar requerimiento</h1>

    <p>
        En esta sección el área de informática puede actualizar el estado del requerimiento
        y registrar una respuesta para el funcionario.
    </p>

    <div style="
        background: #F9FAFB;
        padding: 18px;
        border-radius: 6px;
        border-left: 5px solid #78BE20;
        margin-bottom: 25px;
    ">
        <p>
            <strong>N° de requerimiento:</strong>
            {{ $requerimiento->id }}
        </p>

        <p>
            <strong>Título:</strong>
            {{ $requerimiento->titulo }}
        </p>

        <p>
            <strong>Categoría:</strong>
            {{ ucfirst($requerimiento->categoria) }}
        </p>

        <p>
            <strong>Prioridad:</strong>
            {{ ucfirst($requerimiento->prioridad) }}
        </p>

        <p>
            <strong>Estado actual:</strong>
            <x-estado :estado="$requerimiento->estado" />
        </p>

        <p>
            <strong>Descripción del funcionario:</strong>
        </p>

        <p>
            {{ $requerimiento->descripcion }}
        </p>
    </div>

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

    <form
        action="{{ route('admin.requerimientos.update', $requerimiento) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        {{-- Estado --}}
        <label for="estado">
            Estado del requerimiento
        </label>

        <select
            name="estado"
            id="estado"
            required
        >
            <option
                value="pendiente"
                {{ old('estado', $requerimiento->estado) === 'pendiente' ? 'selected' : '' }}
            >
                Pendiente
            </option>

            <option
                value="en_revision"
                {{ old('estado', $requerimiento->estado) === 'en_revision' ? 'selected' : '' }}
            >
                En revisión
            </option>

            <option
                value="en_proceso"
                {{ old('estado', $requerimiento->estado) === 'en_proceso' ? 'selected' : '' }}
            >
                En proceso
            </option>

            <option
                value="resuelto"
                {{ old('estado', $requerimiento->estado) === 'resuelto' ? 'selected' : '' }}
            >
                Resuelto
            </option>

            <option
                value="cerrado"
                {{ old('estado', $requerimiento->estado) === 'cerrado' ? 'selected' : '' }}
            >
                Cerrado
            </option>

            <option
                value="rechazado"
                {{ old('estado', $requerimiento->estado) === 'rechazado' ? 'selected' : '' }}
            >
                Rechazado
            </option>
        </select>

        @error('estado')
            <div style="
                color: #B91C1C;
                font-size: 14px;
                margin-top: 5px;
                margin-bottom: 10px;
            ">
                {{ $message }}
            </div>
        @enderror

        {{-- Respuesta administrativa --}}
        <label for="respuesta_admin">
            Respuesta del área informática
        </label>

        <textarea
            name="respuesta_admin"
            id="respuesta_admin"
            rows="6"
            placeholder="Ingrese la respuesta o gestión realizada para este requerimiento"
        >{{ old('respuesta_admin', $requerimiento->respuesta_admin) }}</textarea>

        @error('respuesta_admin')
            <div style="
                color: #B91C1C;
                font-size: 14px;
                margin-top: 5px;
                margin-bottom: 10px;
            ">
                {{ $message }}
            </div>
        @enderror

        <button
            type="submit"
            class="btn"
        >
            Guardar actualización
        </button>

        <a
            href="{{ route('admin.requerimientos.index') }}"
            class="btn"
            style="
                background: #6B7280;
                margin-left: 10px;
            "
        >
            Volver a administración
        </a>
    </form>
</div>

@endsection