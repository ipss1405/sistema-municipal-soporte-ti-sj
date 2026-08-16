@extends('layout')

@section('content')

<style>
    .gestion-card {
        max-width: 1050px;
        margin: 0 auto;
    }

    .gestion-card h1 {
        margin-bottom: 6px;
    }

    .subtitulo-gestion {
        color: #6B7280;
        margin-bottom: 20px;
    }

    .datos-caso {
        background: #F9FAFB;
        border-left: 5px solid #78BE20;
        padding: 15px 18px;
        border-radius: 8px;
        margin-bottom: 18px;
    }

    .datos-caso h2 {
        color: #5B3F95;
        font-size: 21px;
        margin: 0 0 10px 0;
    }

    .datos-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px 20px;
    }

    .dato-item {
        margin: 0;
    }

    .dato-item strong {
        display: block;
        font-size: 13px;
        color: #4B5563;
        margin-bottom: 2px;
    }

    .tarea-asignada {
        background: #F3E8FF;
        border-left: 4px solid #5B3F95;
        padding: 10px 13px;
        border-radius: 6px;
        margin-top: 12px;
    }

    .tarea-asignada strong {
        color: #5B3F95;
    }

    .bloque-gestion {
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        border-radius: 8px;
        padding: 18px;
    }

    .bloque-gestion h2 {
        color: #5B3F95;
        font-size: 23px;
        margin: 0 0 16px 0;
    }

    .fila-doble {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
    }

    .campo {
        margin-bottom: 12px;
    }

    .campo label {
        display: block;
        margin-bottom: 4px;
    }

    .campo input,
    .campo select,
    .campo textarea {
        margin-top: 0;
        margin-bottom: 4px;
    }

    .campo select,
    .campo input {
        height: 42px;
    }

    .campo textarea {
        resize: vertical;
        min-height: 78px;
    }

    .ayuda {
        display: block;
        color: #6B7280;
        font-size: 12px;
        line-height: 1.35;
        margin-top: 2px;
    }

    .materiales-contenedor {
        background: #FFF7ED;
        border-left: 4px solid #F26B21;
        padding: 12px;
        border-radius: 7px;
        margin-bottom: 12px;
    }

    .respuesta-funcionario {
        background: #EEF7E8;
        border-left: 4px solid #78BE20;
        padding: 12px;
        border-radius: 7px;
        margin-top: 4px;
    }

    .acciones-gestion {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 16px;
    }

    .errores {
        background: #FEE2E2;
        color: #991B1B;
        padding: 12px 15px;
        border-radius: 8px;
        border-left: 5px solid #DC2626;
        margin-bottom: 15px;
    }

    .errores ul {
        margin: 7px 0 0 0;
    }

    @media (max-width: 900px) {
        .datos-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 700px) {
        .fila-doble {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .datos-grid {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="card gestion-card">

    <h1>Gestionar atención técnica</h1>

    <p class="subtitulo-gestion">
        Registre el avance, estado y antecedentes necesarios
        para mantener informado al funcionario.
    </p>


    {{-- DATOS PRINCIPALES DEL REQUERIMIENTO --}}
    <div class="datos-caso">

        <h2>Requerimiento N.º {{ $requerimiento->id }}</h2>

        <div class="datos-grid">

            <p class="dato-item">
                <strong>Funcionario</strong>
                {{ $requerimiento->usuario?->name ?? 'No disponible' }}
            </p>

            <p class="dato-item">
                <strong>Título</strong>
                {{ $requerimiento->titulo }}
            </p>

            <p class="dato-item">
                <strong>Categoría</strong>
                {{ ucfirst($requerimiento->categoria) }}
            </p>

            <p class="dato-item">
                <strong>Prioridad</strong>

                @if ($requerimiento->prioridad === 'sin_asignar')
                    Sin asignar
                @else
                    {{ ucfirst($requerimiento->prioridad) }}
                @endif
            </p>

            <p class="dato-item">
                <strong>Estado actual</strong>
                <x-estado :estado="$requerimiento->estado" />
            </p>

            <p class="dato-item">
                <strong>Responsable TI</strong>
                {{ $requerimiento->tecnico?->name ?? 'Sin asignar' }}
            </p>

            <p class="dato-item">
                <strong>Fecha de asignación</strong>

                @if ($requerimiento->fecha_asignacion)
                    {{ $requerimiento->fecha_asignacion->format('d-m-Y H:i') }}
                @else
                    Sin fecha
                @endif
            </p>

        </div>


        @if ($requerimiento->tarea_asignada)

            <div class="tarea-asignada">

                <strong>Tarea asignada:</strong>

                {{ $requerimiento->tarea_asignada }}

            </div>

        @endif

    </div>


    {{-- ERRORES --}}
    @if ($errors->any())

        <div class="errores">

            <strong>
                Revise los siguientes datos:
            </strong>

            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    {{-- FORMULARIO --}}
    <form
        action="{{ route('tecnico.requerimientos.update', $requerimiento) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div class="bloque-gestion">

            <h2>Gestión de la atención</h2>


            {{-- ESTADO + MATERIALES --}}
            <div class="fila-doble">

                <div class="campo">

                    <label for="estado">
                        Estado de atención
                    </label>

                    <select
                        name="estado"
                        id="estado"
                        required
                    >

                        <option value="">
                            Seleccione el estado
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
                            value="en_espera_materiales"
                            {{ old('estado', $requerimiento->estado) === 'en_espera_materiales' ? 'selected' : '' }}
                        >
                            En espera de materiales
                        </option>

                        <option
                            value="en_espera_funcionario"
                            {{ old('estado', $requerimiento->estado) === 'en_espera_funcionario' ? 'selected' : '' }}
                        >
                            En espera del funcionario
                        </option>

                        <option
                            value="resuelto"
                            {{ old('estado', $requerimiento->estado) === 'resuelto' ? 'selected' : '' }}
                        >
                            Resuelto
                        </option>

                    </select>

                    <span class="ayuda">
                        El técnico puede llegar hasta Resuelto.
                        El administrador realiza el cierre definitivo.
                    </span>

                </div>


                <div class="campo">

                    <label for="requiere_materiales">
                        ¿Requiere materiales o repuestos?
                    </label>

                    <select
                        name="requiere_materiales"
                        id="requiere_materiales"
                        required
                    >

                        <option
                            value="0"
                            {{ old(
                                'requiere_materiales',
                                $requerimiento->requiere_materiales ? '1' : '0'
                            ) === '0' ? 'selected' : '' }}
                        >
                            No
                        </option>

                        <option
                            value="1"
                            {{ old(
                                'requiere_materiales',
                                $requerimiento->requiere_materiales ? '1' : '0'
                            ) === '1' ? 'selected' : '' }}
                        >
                            Sí
                        </option>

                    </select>

                    <span class="ayuda">
                        Si selecciona Sí, aparecerá el detalle de materiales.
                    </span>

                </div>

            </div>


            {{-- AVANCE --}}
            <div class="campo">

                <label for="avance_tecnico">
                    Avance o trabajo realizado
                </label>

                <textarea
                    name="avance_tecnico"
                    id="avance_tecnico"
                    rows="3"
                    placeholder="Ejemplo: Se revisó el equipo y se detectó una falla en la fuente de poder."
                    required
                >{{ old('avance_tecnico', $requerimiento->avance_tecnico) }}</textarea>

                <span class="ayuda">
                    Registre el diagnóstico, revisión o trabajo realizado.
                </span>

            </div>


            {{-- BLOQUE DE MATERIALES --}}
            <div
                id="bloque-materiales"
                class="materiales-contenedor"
            >

                <div class="fila-doble">

                    <div class="campo">

                        <label for="materiales_requeridos">
                            Materiales o repuestos requeridos
                        </label>

                        <textarea
                            name="materiales_requeridos"
                            id="materiales_requeridos"
                            rows="2"
                            placeholder="Ejemplo: Fuente de poder ATX 500W"
                        >{{ old('materiales_requeridos', $requerimiento->materiales_requeridos) }}</textarea>

                    </div>


                    <div class="campo">

                        <label for="tiempo_estimado_material">
                            Tiempo estimado
                        </label>

                        <input
                            type="text"
                            name="tiempo_estimado"
                            id="tiempo_estimado_material"
                            value="{{ old('tiempo_estimado', $requerimiento->tiempo_estimado) }}"
                            placeholder="Ejemplo: 2 días hábiles"
                            maxlength="255"
                        >

                        <span class="ayuda">
                            Indique un plazo aproximado.
                        </span>

                    </div>

                </div>

            </div>


            {{-- TIEMPO CUANDO NO HAY MATERIALES --}}
            <div
                class="campo"
                id="bloque-tiempo-general"
            >

                <label for="tiempo_estimado_general">
                    Tiempo estimado
                </label>

                <input
                    type="text"
                    id="tiempo_estimado_general"
                    value="{{ old('tiempo_estimado', $requerimiento->tiempo_estimado) }}"
                    placeholder="Ejemplo: Durante la tarde"
                    maxlength="255"
                >

                <span class="ayuda">
                    Ejemplo: 2 horas, durante la tarde o 1 día hábil.
                </span>

            </div>


            {{-- INFORMACIÓN PARA EL FUNCIONARIO --}}
            <div class="respuesta-funcionario">

                <div class="campo" style="margin-bottom: 0;">

                    <label for="respuesta_admin">
                        Información para el funcionario
                    </label>

                    <textarea
                        name="respuesta_admin"
                        id="respuesta_admin"
                        rows="3"
                        placeholder="Ejemplo: Su equipo está siendo revisado. Estamos a la espera de un repuesto."
                    >{{ old('respuesta_admin', $requerimiento->respuesta_admin) }}</textarea>

                    <span class="ayuda">
                        Este mensaje será visible para el funcionario.
                    </span>

                </div>

            </div>


            <div class="acciones-gestion">

                <button
                    type="submit"
                    class="btn"
                >
                    Guardar gestión
                </button>

                <a
                    href="{{ route('requerimientos.show', $requerimiento) }}"
                    class="btn"
                    style="background: #6B7280;"
                >
                    Volver al requerimiento
                </a>

            </div>

        </div>

    </form>

</div>

@endsection


@section('scripts')

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function () {

            const requiereMateriales =
                document.getElementById(
                    'requiere_materiales'
                );

            const bloqueMateriales =
                document.getElementById(
                    'bloque-materiales'
                );

            const bloqueTiempoGeneral =
                document.getElementById(
                    'bloque-tiempo-general'
                );

            const tiempoMaterial =
                document.getElementById(
                    'tiempo_estimado_material'
                );

            const tiempoGeneral =
                document.getElementById(
                    'tiempo_estimado_general'
                );


            function actualizarFormulario() {

                if (requiereMateriales.value === '1') {

                    bloqueMateriales.style.display =
                        'block';

                    bloqueTiempoGeneral.style.display =
                        'none';

                    tiempoMaterial.name =
                        'tiempo_estimado';

                    tiempoGeneral.removeAttribute(
                        'name'
                    );

                } else {

                    bloqueMateriales.style.display =
                        'none';

                    bloqueTiempoGeneral.style.display =
                        'block';

                    tiempoGeneral.name =
                        'tiempo_estimado';

                    tiempoMaterial.removeAttribute(
                        'name'
                    );
                }
            }


            /*
             * Mantener sincronizado el tiempo estimado
             * si el usuario cambia entre Sí y No.
             */
            requiereMateriales.addEventListener(
                'change',
                function () {

                    if (
                        requiereMateriales.value === '1' &&
                        tiempoMaterial.value === ''
                    ) {
                        tiempoMaterial.value =
                            tiempoGeneral.value;
                    }

                    if (
                        requiereMateriales.value === '0' &&
                        tiempoGeneral.value === ''
                    ) {
                        tiempoGeneral.value =
                            tiempoMaterial.value;
                    }

                    actualizarFormulario();
                }
            );


            actualizarFormulario();

        }
    );
</script>

@endsection