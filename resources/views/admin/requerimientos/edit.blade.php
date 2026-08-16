@extends('layout')

@section('content')

<style>
    .seccion-derivacion {
        background: #F9FAFB;
        border: 1px solid #E5E7EB;
        border-left: 5px solid #5B3F95;
        border-radius: 10px;
        padding: 20px;
        margin: 20px 0;
    }

    .seccion-derivacion h2 {
        color: #5B3F95;
        font-size: 22px;
        margin-top: 0;
        margin-bottom: 8px;
    }

    .seccion-derivacion p {
        margin-bottom: 15px;
    }

    .datos-derivacion {
        background: #EEF7E8;
        border-radius: 8px;
        padding: 15px;
        margin: 10px 0 20px 0;
        border-left: 4px solid #78BE20;
    }

    .datos-derivacion p {
        margin: 5px 0;
    }

    .sin-derivacion {
        display: inline-block;
        background: #FEF3C7;
        color: #92400E;
        padding: 9px 14px;
        border-radius: 8px;
        margin: 10px 0 20px 0;
        font-size: 14px;
        font-weight: 600;
        border-left: 4px solid #F59E0B;
    }

    .ayuda-campo {
        color: #6B7280;
        font-size: 13px;
        margin-top: -10px;
        margin-bottom: 15px;
    }
</style>

<div class="card" style="max-width: 900px; margin: 0 auto;">

    <h1>Gestionar requerimiento</h1>

    <p>
        En esta sección el área de Informática puede asignar la prioridad,
        actualizar el estado, derivar el requerimiento a un responsable TI
        y registrar una respuesta para el funcionario.
    </p>

    {{-- DATOS DEL REQUERIMIENTO --}}
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
            <strong>Prioridad actual:</strong>

            @if ($requerimiento->prioridad === 'sin_asignar')

                <span style="
                    background: #FEF3C7;
                    color: #92400E;
                    padding: 5px 10px;
                    border-radius: 20px;
                    font-weight: bold;
                ">
                    Sin asignar
                </span>

            @else

                {{ ucfirst($requerimiento->prioridad) }}

            @endif
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

    {{-- ERRORES --}}
    @if ($errors->any())

        <div style="
            background: #FEE2E2;
            color: #991B1B;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        ">

            <strong>
                Revisa los datos ingresados:
            </strong>

            <ul style="margin-bottom: 0;">

                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
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

        {{-- PRIORIDAD --}}
        <label for="prioridad">
            Prioridad del requerimiento
        </label>

        <select
            name="prioridad"
            id="prioridad"
            required
        >

            <option
                value="sin_asignar"
                {{ old('prioridad', $requerimiento->prioridad) === 'sin_asignar' ? 'selected' : '' }}
            >
                Sin asignar
            </option>

            <option
                value="baja"
                {{ old('prioridad', $requerimiento->prioridad) === 'baja' ? 'selected' : '' }}
            >
                Baja
            </option>

            <option
                value="media"
                {{ old('prioridad', $requerimiento->prioridad) === 'media' ? 'selected' : '' }}
            >
                Media
            </option>

            <option
                value="alta"
                {{ old('prioridad', $requerimiento->prioridad) === 'alta' ? 'selected' : '' }}
            >
                Alta
            </option>

            <option
                value="urgente"
                {{ old('prioridad', $requerimiento->prioridad) === 'urgente' ? 'selected' : '' }}
            >
                Urgente
            </option>

        </select>

        @error('prioridad')
            <div style="
                color: #B91C1C;
                font-size: 14px;
                margin-top: 5px;
                margin-bottom: 10px;
            ">
                {{ $message }}
            </div>
        @enderror

        {{-- ESTADO --}}
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

        {{-- DERIVACIÓN A TI --}}
        <div class="seccion-derivacion">

            <h2>
                Derivación a responsable TI
            </h2>

            <p>
                Asigne el requerimiento a un técnico e indique
                la tarea o acción que deberá realizar.
            </p>

            {{-- SI YA TIENE TÉCNICO --}}
            @if ($requerimiento->tecnico)

                <div class="datos-derivacion">

                    <p>
                        <strong>Responsable actual:</strong>
                        {{ $requerimiento->tecnico->name }}
                    </p>

                    @if ($requerimiento->asignadoPor)

                        <p>
                            <strong>Asignado por:</strong>
                            {{ $requerimiento->asignadoPor->name }}
                        </p>

                    @endif

                    @if ($requerimiento->fecha_asignacion)

                        <p>
                            <strong>Fecha y hora de asignación:</strong>
                            {{ $requerimiento->fecha_asignacion->format('d-m-Y H:i') }}
                        </p>

                    @endif

                </div>

            @else

                {{-- ESTE AVISO DESAPARECE CUANDO SE ASIGNA UN TÉCNICO --}}
                <div class="sin-derivacion">
                    ⚠️ Sin responsable TI asignado
                </div>

            @endif

            {{-- RESPONSABLE TI --}}
            <label for="tecnico_id">
                Responsable TI
            </label>

            <select
                name="tecnico_id"
                id="tecnico_id"
            >

                <option value="">
                    Sin técnico asignado
                </option>

                @foreach ($tecnicos as $tecnico)

                    <option
                        value="{{ $tecnico->id }}"
                        {{ (string) old('tecnico_id', $requerimiento->tecnico_id) === (string) $tecnico->id ? 'selected' : '' }}
                    >
                        {{ $tecnico->name }}
                    </option>

                @endforeach

            </select>

            @error('tecnico_id')
                <div style="
                    color: #B91C1C;
                    font-size: 14px;
                    margin-top: 5px;
                    margin-bottom: 10px;
                ">
                    {{ $message }}
                </div>
            @enderror

            <div class="ayuda-campo">
                La fecha y hora de asignación serán registradas
                automáticamente al guardar.
            </div>

            {{-- TAREA --}}
            <label for="tarea_asignada">
                Tarea o acción a realizar
            </label>

            <textarea
                name="tarea_asignada"
                id="tarea_asignada"
                rows="4"
                maxlength="2000"
                placeholder="Ejemplo: Revisar conectividad, validar punto de red y comprobar el cableado del equipo."
            >{{ old('tarea_asignada', $requerimiento->tarea_asignada) }}</textarea>

            @error('tarea_asignada')
                <div style="
                    color: #B91C1C;
                    font-size: 14px;
                    margin-top: 5px;
                    margin-bottom: 10px;
                ">
                    {{ $message }}
                </div>
            @enderror

        </div>

        {{-- RESPUESTA ADMINISTRATIVA --}}
        <label for="respuesta_admin">
            Respuesta para el funcionario
        </label>

        <textarea
            name="respuesta_admin"
            id="respuesta_admin"
            rows="5"
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

        {{-- BOTONES --}}
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