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
        --sj-verde: #78BE20;
        --sj-rojo: #EF3E24;
        --sj-naranjo: #F26B21;

        --sj-texto: #1F2937;
        --sj-texto-suave: #667085;
        --sj-borde: #E5E7EB;
    }

    /* =========================================================
       CONTENEDOR
       ========================================================= */

    .gestion-wrapper {
        max-width: 1050px;
        margin: 24px auto 30px;
    }

    /* =========================================================
       CABECERA
       ========================================================= */

    .gestion-hero {
        position: relative;
        overflow: hidden;

        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 20px;

        padding: 25px 28px;
        margin-bottom: 18px;

        border-top: 6px solid var(--sj-verde);
        border-radius: 18px;

        background:
            linear-gradient(
                135deg,
                #5B3F95 0%,
                #A43D70 45%,
                #EF3E24 78%,
                #F26B21 100%
            );

        color: #ffffff;

        box-shadow:
            0 11px 28px rgba(91, 63, 149, 0.14);
    }

    .gestion-hero::after {
        content: "";

        position: absolute;

        width: 190px;
        height: 190px;

        right: -75px;
        bottom: -110px;

        border-radius: 50%;

        background:
            rgba(255, 255, 255, 0.08);
    }

    .gestion-hero-contenido {
        position: relative;
        z-index: 1;
    }

    .gestion-etiqueta {
        display: inline-flex;
        align-items: center;

        padding: 6px 14px;
        margin-bottom: 10px;

        border-radius: 999px;

        background: var(--sj-verde);

        color: #ffffff;

        font-size: 0.82rem;
        font-weight: 700;
    }

    .gestion-hero h1 {
        margin: 0 0 7px;

        color: #ffffff;

        font-size: 1.9rem;
        font-weight: 800;
    }

    .gestion-hero p {
        margin: 0;

        max-width: 680px;

        color:
            rgba(255, 255, 255, 0.89);

        font-size: 0.90rem;
        line-height: 1.5;
    }

    .btn-volver-requerimiento {
        position: relative;
        z-index: 1;

        flex-shrink: 0;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 40px;

        padding: 8px 14px;

        border:
            1px solid rgba(255,255,255,0.60);

        border-radius: 9px;

        background:
            rgba(255,255,255,0.12);

        color: #ffffff;

        text-decoration: none;

        font-size: 0.82rem;
        font-weight: 700;

        transition:
            background 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .btn-volver-requerimiento:hover {
        background: #ffffff;

        color: var(--sj-morado);

        transform: translateY(-1px);
    }

    /* =========================================================
       RESUMEN DEL REQUERIMIENTO
       ========================================================= */

    .resumen-card {
        padding: 20px;

        margin-bottom: 18px;

        border:
            1px solid #ECEEF2;

        border-top:
            4px solid var(--sj-verde);

        border-radius: 15px;

        background: #ffffff;

        box-shadow:
            0 7px 20px rgba(91, 63, 149, 0.07);
    }

    .resumen-superior {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        margin-bottom: 16px;
    }

    .resumen-superior h2 {
        margin: 0;

        color: var(--sj-morado);

        font-size: 1.2rem;
        font-weight: 800;
    }

    .numero-caso {
        padding: 6px 11px;

        border-radius: 999px;

        background:
            rgba(91, 63, 149, 0.09);

        color: var(--sj-morado);

        font-size: 0.78rem;
        font-weight: 800;
    }

    .datos-grid {
        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 15px 22px;
    }

    .dato-item {
        min-width: 0;
    }

    .dato-label {
        display: block;

        margin-bottom: 4px;

        color: #7A8493;

        font-size: 0.75rem;
        font-weight: 700;
    }

    .dato-valor {
        color: var(--sj-texto);

        font-size: 0.88rem;
        font-weight: 600;

        word-break: break-word;
    }

    /* =========================================================
       PRIORIDAD
       ========================================================= */

    .badge-prioridad {
        display: inline-flex;
        align-items: center;

        padding: 5px 10px;

        border-radius: 999px;

        font-size: 0.74rem;
        font-weight: 700;
    }

    .prioridad-sin-asignar {
        background: #FEF3C7;
        color: #92400E;
    }

    .prioridad-baja {
        background: #DCFCE7;
        color: #166534;
    }

    .prioridad-media {
        background: #E0E7FF;
        color: #3730A3;
    }

    .prioridad-alta {
        background: #FFEDD5;
        color: #9A3412;
    }

    .prioridad-urgente {
        background: #FEE2E2;
        color: #991B1B;
    }

    /* =========================================================
       TAREA ASIGNADA
       ========================================================= */

    .tarea-asignada {
        display: flex;
        gap: 9px;

        margin-top: 17px;

        padding: 12px 14px;

        border-left:
            4px solid var(--sj-morado);

        border-radius: 9px;

        background: #F7F3FC;

        color: #4B5563;

        font-size: 0.84rem;
        line-height: 1.5;
    }

    .tarea-asignada strong {
        color: var(--sj-morado);
    }

    /* =========================================================
       ERRORES
       ========================================================= */

    .errores {
        padding: 13px 15px;

        margin-bottom: 18px;

        border-left:
            4px solid var(--sj-rojo);

        border-radius: 9px;

        background: #FFF1EF;

        color: #991B1B;

        font-size: 0.84rem;
    }

    .errores strong {
        display: block;

        margin-bottom: 5px;
    }

    .errores ul {
        margin: 0;
        padding-left: 20px;
    }

    /* =========================================================
       FORMULARIO
       ========================================================= */

    .gestion-card {
        padding: 21px;

        border:
            1px solid #ECEEF2;

        border-radius: 15px;

        background: #ffffff;

        box-shadow:
            0 7px 20px rgba(91, 63, 149, 0.07);
    }

    .gestion-card-header {
        margin-bottom: 19px;
    }

    .gestion-card-header h2 {
        margin: 0 0 5px;

        color: var(--sj-morado);

        font-size: 1.2rem;
        font-weight: 800;
    }

    .gestion-card-header p {
        margin: 0;

        color: var(--sj-texto-suave);

        font-size: 0.82rem;
    }

    .fila-doble {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 17px;
    }

    .campo {
        margin-bottom: 17px;
    }

    .campo label {
        display: block;

        margin-bottom: 7px;

        color: var(--sj-texto);

        font-size: 0.86rem;
        font-weight: 700;
    }

    .campo .form-control,
    .campo .form-select {
        width: 100%;

        border:
            1px solid var(--sj-borde);

        border-radius: 9px;

        background: #ffffff;

        color: var(--sj-texto);

        font-size: 0.88rem;

        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .campo .form-control {
        padding: 10px 12px;
    }

    .campo .form-select {
        min-height: 43px;
    }

    .campo .form-control:focus,
    .campo .form-select:focus {
        border-color: var(--sj-morado);

        box-shadow:
            0 0 0 3px
            rgba(91, 63, 149, 0.10);
    }

    .campo textarea.form-control {
        min-height: 90px;

        resize: vertical;
    }

    .ayuda {
        display: block;

        margin-top: 5px;

        color: #808896;

        font-size: 0.74rem;
        line-height: 1.4;
    }

    /* =========================================================
       AVISO RESPONSABILIDAD TÉCNICA
       ========================================================= */

    .aviso-cierre {
        display: flex;
        align-items: flex-start;

        gap: 8px;

        margin-top: 7px;

        padding: 9px 11px;

        border-left:
            3px solid var(--sj-verde);

        border-radius: 7px;

        background: #F6FAF3;

        color: #5F6875;

        font-size: 0.75rem;
        line-height: 1.4;
    }

    .aviso-punto {
        width: 7px;
        height: 7px;

        flex-shrink: 0;

        margin-top: 4px;

        border-radius: 50%;

        background: var(--sj-verde);
    }

    /* =========================================================
       MATERIALES
       ========================================================= */

    .materiales-contenedor {
        padding: 15px;

        margin-bottom: 17px;

        border-left:
            4px solid var(--sj-naranjo);

        border-radius: 10px;

        background: #FFF8F2;
    }

    .materiales-titulo {
        margin-bottom: 12px;

        color: #A64517;

        font-size: 0.83rem;
        font-weight: 800;
    }

    /* =========================================================
       INFORMACIÓN FUNCIONARIO
       ========================================================= */

    .respuesta-funcionario {
        padding: 15px;

        margin-top: 3px;

        border-left:
            4px solid var(--sj-verde);

        border-radius: 10px;

        background: #F4FAF0;
    }

    .respuesta-funcionario .campo {
        margin-bottom: 0;
    }

    .respuesta-funcionario label {
        color: #426B19;
    }

    /* =========================================================
       BOTÓN GUARDAR
       ========================================================= */

    .acciones-gestion {
        display: flex;
        align-items: center;

        margin-top: 18px;
    }

    .btn-guardar-gestion {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 43px;

        padding: 9px 18px;

        border: 0;
        border-radius: 9px;

        background: var(--sj-morado);

        color: #ffffff;

        font-size: 0.86rem;
        font-weight: 700;

        cursor: pointer;

        transition:
            background 0.2s ease,
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .btn-guardar-gestion:hover,
    .btn-guardar-gestion:focus {
        background: var(--sj-verde);

        color: #ffffff;

        transform: translateY(-1px);

        box-shadow:
            0 7px 16px rgba(120,190,32,0.20);
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 900px) {

        .datos-grid {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 700px) {

        .gestion-wrapper {
            margin-top: 16px;
        }

        .gestion-hero {
            flex-direction: column;
            align-items: flex-start;

            padding: 22px;
        }

        .gestion-hero h1 {
            font-size: 1.65rem;
        }

        .btn-volver-requerimiento {
            width: 100%;
        }

        .fila-doble {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .datos-grid {
            grid-template-columns: 1fr;
        }

        .gestion-card {
            padding: 18px;
        }

        .btn-guardar-gestion {
            width: 100%;
        }
    }
</style>


<div class="container gestion-wrapper">

    {{-- =====================================================
         CABECERA
         ===================================================== --}}

    <div class="gestion-hero">

        <div class="gestion-hero-contenido">

            <span class="gestion-etiqueta">
                Gestión técnica
            </span>

            <h1>
                Gestionar atención
            </h1>

            <p>
                Registre el avance, estado y antecedentes
                de la atención del requerimiento.
            </p>

        </div>


        <a
            href="{{ route('requerimientos.show', $requerimiento) }}"
            class="btn-volver-requerimiento"
        >
            ← Volver al requerimiento
        </a>

    </div>


    {{-- =====================================================
         RESUMEN DEL REQUERIMIENTO
         ===================================================== --}}

    <div class="resumen-card">

        <div class="resumen-superior">

            <h2>
                {{ $requerimiento->titulo }}
            </h2>

            <span class="numero-caso">
                Requerimiento #{{ $requerimiento->id }}
            </span>

        </div>


        <div class="datos-grid">

            <div class="dato-item">

                <span class="dato-label">
                    Funcionario
                </span>

                <span class="dato-valor">
                    {{ $requerimiento->usuario?->name ?? 'No disponible' }}
                </span>

            </div>


            <div class="dato-item">

                <span class="dato-label">
                    Categoría
                </span>

                <span class="dato-valor">
                    {{ ucfirst($requerimiento->categoria) }}
                </span>

            </div>


            <div class="dato-item">

                <span class="dato-label">
                    Prioridad
                </span>


                @switch($requerimiento->prioridad)

                    @case('sin_asignar')

                        <span class="badge-prioridad prioridad-sin-asignar">
                            Sin asignar
                        </span>

                        @break


                    @case('baja')

                        <span class="badge-prioridad prioridad-baja">
                            Baja
                        </span>

                        @break


                    @case('media')

                        <span class="badge-prioridad prioridad-media">
                            Media
                        </span>

                        @break


                    @case('alta')

                        <span class="badge-prioridad prioridad-alta">
                            Alta
                        </span>

                        @break


                    @case('urgente')

                        <span class="badge-prioridad prioridad-urgente">
                            Urgente
                        </span>

                        @break


                    @default

                        <span class="dato-valor">
                            {{ ucfirst($requerimiento->prioridad) }}
                        </span>

                @endswitch

            </div>


            <div class="dato-item">

                <span class="dato-label">
                    Estado actual
                </span>

                <x-estado :estado="$requerimiento->estado" />

            </div>


            <div class="dato-item">

                <span class="dato-label">
                    Responsable TI
                </span>

                <span class="dato-valor">
                    {{ $requerimiento->tecnico?->name ?? 'Sin asignar' }}
                </span>

            </div>


            <div class="dato-item">

                <span class="dato-label">
                    Fecha de asignación
                </span>

                <span class="dato-valor">

                    @if ($requerimiento->fecha_asignacion)

                        {{ $requerimiento
                            ->fecha_asignacion
                            ->format('d-m-Y H:i')
                        }}

                    @else

                        Sin fecha

                    @endif

                </span>

            </div>

        </div>


        @if ($requerimiento->tarea_asignada)

            <div class="tarea-asignada">

                <div>

                    <strong>
                        Tarea asignada:
                    </strong>

                    {{ $requerimiento->tarea_asignada }}

                </div>

            </div>

        @endif

    </div>


    {{-- =====================================================
         ERRORES
         ===================================================== --}}

    @if ($errors->any())

        <div class="errores">

            <strong>
                Revise los siguientes datos:
            </strong>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =====================================================
         FORMULARIO
         ===================================================== --}}

    <form
        action="{{ route(
            'tecnico.requerimientos.update',
            $requerimiento
        ) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        <div class="gestion-card">

            <div class="gestion-card-header">

                <h2>
                    Gestión de la atención
                </h2>

                <p>
                    Actualice la información según
                    el trabajo realizado.
                </p>

            </div>


            {{-- =================================================
                 ESTADO + MATERIALES
                 ================================================= --}}

            <div class="fila-doble">

                <div class="campo">

                    <label for="estado">
                        Estado de atención
                    </label>


                    <select
                        name="estado"
                        id="estado"
                        class="form-select"
                        required
                    >

                        <option value="">
                            Seleccione el estado
                        </option>


                        <option
                            value="en_revision"
                            {{ old(
                                'estado',
                                $requerimiento->estado
                            ) === 'en_revision'
                                ? 'selected'
                                : ''
                            }}
                        >
                            En revisión
                        </option>


                        <option
                            value="en_proceso"
                            {{ old(
                                'estado',
                                $requerimiento->estado
                            ) === 'en_proceso'
                                ? 'selected'
                                : ''
                            }}
                        >
                            En proceso
                        </option>


                        <option
                            value="en_espera_materiales"
                            {{ old(
                                'estado',
                                $requerimiento->estado
                            ) === 'en_espera_materiales'
                                ? 'selected'
                                : ''
                            }}
                        >
                            En espera de materiales
                        </option>


                        <option
                            value="en_espera_funcionario"
                            {{ old(
                                'estado',
                                $requerimiento->estado
                            ) === 'en_espera_funcionario'
                                ? 'selected'
                                : ''
                            }}
                        >
                            En espera del funcionario
                        </option>


                        <option
                            value="resuelto"
                            {{ old(
                                'estado',
                                $requerimiento->estado
                            ) === 'resuelto'
                                ? 'selected'
                                : ''
                            }}
                        >
                            Resuelto
                        </option>

                    </select>


                    <div class="aviso-cierre">

                        <span class="aviso-punto"></span>

                        <span>
                            El técnico puede llegar hasta
                            <strong>Resuelto</strong>.
                            El administrador realiza el cierre definitivo.
                        </span>

                    </div>

                </div>


                <div class="campo">

                    <label for="requiere_materiales">
                        ¿Requiere materiales o repuestos?
                    </label>


                    <select
                        name="requiere_materiales"
                        id="requiere_materiales"
                        class="form-select"
                        required
                    >

                        <option
                            value="0"
                            {{ old(
                                'requiere_materiales',
                                $requerimiento->requiere_materiales
                                    ? '1'
                                    : '0'
                            ) === '0'
                                ? 'selected'
                                : ''
                            }}
                        >
                            No
                        </option>


                        <option
                            value="1"
                            {{ old(
                                'requiere_materiales',
                                $requerimiento->requiere_materiales
                                    ? '1'
                                    : '0'
                            ) === '1'
                                ? 'selected'
                                : ''
                            }}
                        >
                            Sí
                        </option>

                    </select>


                    <span class="ayuda">
                        Si selecciona Sí, aparecerá
                        el detalle de materiales.
                    </span>

                </div>

            </div>


            {{-- =================================================
                 AVANCE
                 ================================================= --}}

            <div class="campo">

                <label for="avance_tecnico">
                    Avance o trabajo realizado
                </label>


                <textarea
                    name="avance_tecnico"
                    id="avance_tecnico"
                    class="form-control"
                    rows="3"
                    placeholder="Ejemplo: Se revisó el equipo y se detectó una falla en la fuente de poder."
                    required
                >{{ old(
                    'avance_tecnico',
                    $requerimiento->avance_tecnico
                ) }}</textarea>


                <span class="ayuda">
                    Registre el diagnóstico,
                    revisión o trabajo realizado.
                </span>

            </div>


            {{-- =================================================
                 MATERIALES
                 ================================================= --}}

            <div
                id="bloque-materiales"
                class="materiales-contenedor"
            >

                <div class="materiales-titulo">
                    Materiales o repuestos
                </div>


                <div class="fila-doble">

                    <div class="campo">

                        <label for="materiales_requeridos">
                            Materiales o repuestos requeridos
                        </label>


                        <textarea
                            name="materiales_requeridos"
                            id="materiales_requeridos"
                            class="form-control"
                            rows="2"
                            placeholder="Ejemplo: Fuente de poder ATX 500W"
                        >{{ old(
                            'materiales_requeridos',
                            $requerimiento->materiales_requeridos
                        ) }}</textarea>

                    </div>


                    <div class="campo">

                        <label for="tiempo_estimado_material">
                            Tiempo estimado
                        </label>


                        <input
                            type="text"
                            name="tiempo_estimado"
                            id="tiempo_estimado_material"
                            class="form-control"
                            value="{{ old(
                                'tiempo_estimado',
                                $requerimiento->tiempo_estimado
                            ) }}"
                            placeholder="Ejemplo: 2 días hábiles"
                            maxlength="255"
                        >


                        <span class="ayuda">
                            Indique un plazo aproximado.
                        </span>

                    </div>

                </div>

            </div>


            {{-- =================================================
                 TIEMPO SIN MATERIALES
                 ================================================= --}}

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
                    class="form-control"
                    value="{{ old(
                        'tiempo_estimado',
                        $requerimiento->tiempo_estimado
                    ) }}"
                    placeholder="Ejemplo: Durante la tarde"
                    maxlength="255"
                >


                <span class="ayuda">
                    Ejemplo: 2 horas, durante la tarde
                    o 1 día hábil.
                </span>

            </div>


            {{-- =================================================
                 INFORMACIÓN FUNCIONARIO
                 ================================================= --}}

            <div class="respuesta-funcionario">

                <div class="campo">

                    <label for="respuesta_admin">
                        Información para el funcionario
                    </label>


                    <textarea
                        name="respuesta_admin"
                        id="respuesta_admin"
                        class="form-control"
                        rows="3"
                        placeholder="Ejemplo: Su equipo está siendo revisado. Estamos a la espera de un repuesto."
                    >{{ old(
                        'respuesta_admin',
                        $requerimiento->respuesta_admin
                    ) }}</textarea>


                    <span class="ayuda">
                        Este mensaje será visible
                        para el funcionario.
                    </span>

                </div>

            </div>


            {{-- =================================================
                 GUARDAR
                 ================================================= --}}

            <div class="acciones-gestion">

                <button
                    type="submit"
                    class="btn-guardar-gestion"
                >
                    Guardar gestión
                </button>

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
             * cuando se cambia entre Sí y No.
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