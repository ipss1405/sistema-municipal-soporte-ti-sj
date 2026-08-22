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
        --sj-morado-claro: #6B4BB0;
        --sj-verde: #78BE20;
        --sj-rojo: #EF3E24;
        --sj-naranjo: #F26B21;

        --sj-texto: #1F2937;
        --sj-texto-suave: #667085;
        --sj-borde: #E5E7EB;
        --sj-fondo: #F8F9FB;
    }

    /* =========================================================
       CONTENEDOR
       ========================================================= */

    .gestion-wrapper {
        max-width: 1100px;
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

        gap: 24px;

        padding: 26px 30px;
        margin-bottom: 20px;

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

        width: 180px;
        height: 180px;

        right: -70px;
        bottom: -105px;

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

        font-size: 2rem;
        font-weight: 800;
    }

    .gestion-hero p {
        max-width: 720px;

        margin: 0;

        color:
            rgba(255, 255, 255, 0.88);

        font-size: 0.92rem;
        line-height: 1.5;
    }

    .btn-volver-panel {
        position: relative;
        z-index: 1;

        flex-shrink: 0;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 40px;

        padding: 8px 15px;

        border:
            1px solid rgba(255,255,255,0.60);

        border-radius: 9px;

        background:
            rgba(255,255,255,0.12);

        color: #ffffff;

        text-decoration: none;

        font-size: 0.84rem;
        font-weight: 700;

        transition:
            background 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .btn-volver-panel:hover {
        background: #ffffff;
        color: var(--sj-morado);

        transform: translateY(-1px);
    }

    /* =========================================================
       RESUMEN DEL REQUERIMIENTO
       ========================================================= */

    .resumen-card {
        padding: 21px;

        margin-bottom: 18px;

        border: 1px solid #ECEEF2;
        border-left: 5px solid var(--sj-verde);
        border-radius: 15px;

        background: #ffffff;

        box-shadow:
            0 7px 20px rgba(91, 63, 149, 0.06);
    }

    .resumen-card h2 {
        margin: 0 0 16px;

        color: var(--sj-morado);

        font-size: 1.25rem;
        font-weight: 800;
    }

    .resumen-grid {
        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 15px;
    }

    .resumen-item {
        min-width: 0;

        padding: 13px 14px;

        border-radius: 10px;

        background: var(--sj-fondo);
    }

    .resumen-label {
        display: block;

        margin-bottom: 5px;

        color: var(--sj-texto-suave);

        font-size: 0.74rem;
        font-weight: 700;

        text-transform: uppercase;
        letter-spacing: 0.035em;
    }

    .resumen-valor {
        color: var(--sj-texto);

        font-size: 0.89rem;
        font-weight: 700;

        line-height: 1.4;
    }

    .descripcion-funcionario {
        margin-top: 15px;

        padding: 14px 16px;

        border-left: 4px solid var(--sj-verde);
        border-radius: 9px;

        background: #F8FAF7;
    }

    .descripcion-funcionario strong {
        display: block;

        margin-bottom: 6px;

        color: var(--sj-morado);

        font-size: 0.84rem;
    }

    .descripcion-funcionario div {
        color: #374151;

        font-size: 0.89rem;
        line-height: 1.55;
    }

    /* =========================================================
       ERRORES
       ========================================================= */

    .errores-card {
        padding: 14px 16px;

        margin-bottom: 18px;

        border-left: 5px solid var(--sj-rojo);
        border-radius: 10px;

        background: #FFF2F0;

        color: #991B1B;

        font-size: 0.86rem;
    }

    .errores-card strong {
        display: block;
        margin-bottom: 7px;
    }

    .errores-card ul {
        margin: 0;
        padding-left: 20px;
    }

    /* =========================================================
       SECCIÓN GENERAL DEL FORMULARIO
       ========================================================= */

    .form-card {
        padding: 22px;

        margin-bottom: 18px;

        border: 1px solid #ECEEF2;
        border-radius: 15px;

        background: #ffffff;

        box-shadow:
            0 7px 20px rgba(91, 63, 149, 0.06);
    }

    .form-card h2 {
        margin: 0 0 6px;

        color: var(--sj-morado);

        font-size: 1.25rem;
        font-weight: 800;
    }

    .form-card .subtexto {
        margin-bottom: 18px;

        color: var(--sj-texto-suave);

        font-size: 0.86rem;
    }

    /* =========================================================
       PRIORIDAD Y ESTADO
       ========================================================= */

    .clasificacion-grid {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 18px;
    }

    .campo-form label {
        display: block;

        margin-bottom: 7px;

        color: var(--sj-texto);

        font-size: 0.86rem;
        font-weight: 700;
    }

    .campo-form .form-select,
    .campo-form .form-control {
        width: 100%;

        border:
            1px solid var(--sj-borde);

        border-radius: 9px;

        background: #ffffff;

        color: var(--sj-texto);

        font-size: 0.89rem;

        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .campo-form .form-select {
        min-height: 44px;
    }

    .campo-form .form-control {
        padding: 11px 13px;
    }

    .campo-form .form-select:focus,
    .campo-form .form-control:focus {
        border-color:
            var(--sj-morado);

        box-shadow:
            0 0 0 3px
            rgba(91, 63, 149, 0.10);
    }

    .texto-error {
        display: block;

        margin-top: 6px;

        color: #B42318;

        font-size: 0.78rem;
        font-weight: 600;
    }

    /* =========================================================
       DERIVACIÓN TI
       ========================================================= */

    .derivacion-card {
        border-left:
            5px solid var(--sj-morado);
    }

    .datos-derivacion {
        display: grid;

        grid-template-columns:
            repeat(3, minmax(0, 1fr));

        gap: 14px;

        margin-bottom: 18px;
    }

    .dato-derivacion {
        padding: 13px 14px;

        border-radius: 10px;

        background: #F6FBF2;
    }

    .dato-derivacion strong {
        display: block;

        margin-bottom: 4px;

        color: #4B6F25;

        font-size: 0.75rem;
        font-weight: 700;
    }

    .dato-derivacion span {
        color: var(--sj-texto);

        font-size: 0.87rem;
        font-weight: 600;
    }

    .sin-derivacion {
        display: inline-flex;
        align-items: center;

        padding: 8px 12px;

        margin-bottom: 18px;

        border-left:
            4px solid #F59E0B;

        border-radius: 8px;

        background: #FEF3C7;

        color: #92400E;

        font-size: 0.82rem;
        font-weight: 700;
    }

    .ayuda-campo {
        margin-top: 6px;
        margin-bottom: 16px;

        color: #7A8493;

        font-size: 0.76rem;
    }

    .textarea-tarea {
        min-height: 105px;
        resize: vertical;
    }

    /* =========================================================
       RESPUESTA AL FUNCIONARIO
       ========================================================= */

    .respuesta-card {
        border-left:
            5px solid var(--sj-verde);
    }

    .respuesta-card textarea {
        min-height: 120px;
        resize: vertical;
    }

    /* =========================================================
       BOTONES
       ========================================================= */

    .acciones-formulario {
        display: flex;
        align-items: center;

        gap: 10px;

        flex-wrap: wrap;
    }

    .btn-guardar,
    .btn-cancelar {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 43px;

        padding: 9px 18px;

        border-radius: 9px;

        font-size: 0.87rem;
        font-weight: 700;

        text-decoration: none;

        transition:
            background 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .btn-guardar {
        border: 0;

        background:
            var(--sj-morado);

        color: #ffffff;

        cursor: pointer;
    }

    .btn-guardar:hover {
        background:
            var(--sj-verde);

        color: #ffffff;

        transform: translateY(-1px);
    }

    .btn-cancelar {
        border: 0;

        background: #6B7280;

        color: #ffffff;
    }

    .btn-cancelar:hover {
        background: #4B5563;

        color: #ffffff;

        transform: translateY(-1px);
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 991px) {

        .resumen-grid {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }

        .datos-derivacion {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 767px) {

        .gestion-wrapper {
            margin-top: 16px;
            margin-bottom: 22px;
        }

        .gestion-hero {
            flex-direction: column;
            align-items: flex-start;

            padding: 22px;
        }

        .gestion-hero h1 {
            font-size: 1.65rem;
        }

        .btn-volver-panel {
            width: 100%;
        }

        .resumen-grid,
        .clasificacion-grid,
        .datos-derivacion {
            grid-template-columns: 1fr;
        }

        .form-card,
        .resumen-card {
            padding: 18px;
        }

        .acciones-formulario {
            flex-direction: column;
        }

        .btn-guardar,
        .btn-cancelar {
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
                Gestión administrativa
            </span>

            <h1>
                Requerimiento #{{ $requerimiento->id }}
                · {{ $requerimiento->titulo }}
            </h1>

            <p>
                Asigne prioridad, actualice el estado,
                derive la atención a un responsable TI
                y registre información para el funcionario.
            </p>

        </div>


        <a
            href="{{ route('admin.requerimientos.index') }}"
            class="btn-volver-panel"
        >
            ← Volver a administración
        </a>

    </div>


    {{-- =====================================================
         RESUMEN DE LA SOLICITUD
         ===================================================== --}}

    <div class="resumen-card">

        <h2>
            Resumen de la solicitud
        </h2>


        <div class="resumen-grid">

            <div class="resumen-item">

                <span class="resumen-label">
                    N.º requerimiento
                </span>

                <div class="resumen-valor">
                    #{{ $requerimiento->id }}
                </div>

            </div>


            <div class="resumen-item">

                <span class="resumen-label">
                    Categoría
                </span>

                <div class="resumen-valor">
                    {{ ucfirst($requerimiento->categoria) }}
                </div>

            </div>


            <div class="resumen-item">

                <span class="resumen-label">
                    Prioridad actual
                </span>

                <div class="resumen-valor">

                    @if ($requerimiento->prioridad === 'sin_asignar')

                        Sin asignar

                    @else

                        {{ ucfirst($requerimiento->prioridad) }}

                    @endif

                </div>

            </div>


            <div class="resumen-item">

                <span class="resumen-label">
                    Estado actual
                </span>

                <div class="resumen-valor">
                    <x-estado :estado="$requerimiento->estado" />
                </div>

            </div>

        </div>


        <div class="descripcion-funcionario">

            <strong>
                Descripción del funcionario
            </strong>

            <div>
                {{ $requerimiento->descripcion }}
            </div>

        </div>

    </div>


    {{-- =====================================================
         ERRORES
         ===================================================== --}}

    @if ($errors->any())

        <div class="errores-card">

            <strong>
                Revise los datos ingresados:
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
            'admin.requerimientos.update',
            $requerimiento
        ) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        {{-- =================================================
             CLASIFICACIÓN
             ================================================= --}}

        <div class="form-card">

            <h2>
                Clasificación del requerimiento
            </h2>

            <div class="subtexto">
                Defina la prioridad y el estado actual
                de la solicitud.
            </div>


            <div class="clasificacion-grid">

                {{-- PRIORIDAD --}}
                <div class="campo-form">

                    <label for="prioridad">
                        Prioridad
                    </label>

                    <select
                        name="prioridad"
                        id="prioridad"
                        class="form-select"
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

                        <span class="texto-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                {{-- ESTADO --}}
                <div class="campo-form">

                    <label for="estado">
                        Estado
                    </label>

                    <select
                        name="estado"
                        id="estado"
                        class="form-select"
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

                        <span class="texto-error">
                            {{ $message }}
                        </span>

                    @enderror

                </div>

            </div>

        </div>


        {{-- =================================================
             DERIVACIÓN TI
             ================================================= --}}

        <div class="form-card derivacion-card">

            <h2>
                Derivación a responsable TI
            </h2>

            <div class="subtexto">
                Asigne el requerimiento a un técnico
                e indique la tarea o acción que deberá realizar.
            </div>


            {{-- INFORMACIÓN ACTUAL --}}
            @if ($requerimiento->tecnico)

                <div class="datos-derivacion">

                    <div class="dato-derivacion">

                        <strong>
                            Responsable actual
                        </strong>

                        <span>
                            {{ $requerimiento->tecnico->name }}
                        </span>

                    </div>


                    <div class="dato-derivacion">

                        <strong>
                            Asignado por
                        </strong>

                        <span>
                            {{ $requerimiento->asignadoPor?->name
                                ?? 'No informado'
                            }}
                        </span>

                    </div>


                    <div class="dato-derivacion">

                        <strong>
                            Fecha de asignación
                        </strong>

                        <span>

                            @if ($requerimiento->fecha_asignacion)

                                {{ $requerimiento->fecha_asignacion->format('d-m-Y H:i') }}

                            @else

                                No registrada

                            @endif

                        </span>

                    </div>

                </div>


            @else

                <div class="sin-derivacion">
                    Responsable TI pendiente de asignación
                </div>

            @endif


            {{-- RESPONSABLE --}}
            <div class="campo-form">

                <label for="tecnico_id">
                    Responsable TI
                </label>

                <select
                    name="tecnico_id"
                    id="tecnico_id"
                    class="form-select"
                >

                    <option value="">
                        Sin técnico asignado
                    </option>


                    @foreach ($tecnicos as $tecnico)

                        <option
                            value="{{ $tecnico->id }}"
                            {{ (string) old(
                                'tecnico_id',
                                $requerimiento->tecnico_id
                            ) === (string) $tecnico->id
                                ? 'selected'
                                : ''
                            }}
                        >
                            {{ $tecnico->name }}
                        </option>

                    @endforeach

                </select>


                @error('tecnico_id')

                    <span class="texto-error">
                        {{ $message }}
                    </span>

                @enderror


                <div class="ayuda-campo">
                    La fecha y hora de asignación se registrarán
                    automáticamente al guardar.
                </div>

            </div>


            {{-- TAREA --}}
            <div class="campo-form">

                <label for="tarea_asignada">
                    Tarea o acción a realizar
                </label>

                <textarea
                    name="tarea_asignada"
                    id="tarea_asignada"
                    class="form-control textarea-tarea"
                    maxlength="2000"
                    placeholder="Ejemplo: Revisar conectividad, validar punto de red y comprobar cableado."
                >{{ old(
                    'tarea_asignada',
                    $requerimiento->tarea_asignada
                ) }}</textarea>


                @error('tarea_asignada')

                    <span class="texto-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>

        </div>


        {{-- =================================================
             INFORMACIÓN PARA FUNCIONARIO
             ================================================= --}}

        <div class="form-card respuesta-card">

            <h2>
                Información para el funcionario
            </h2>

            <div class="subtexto">
                Registre la información que será visible
                para el funcionario respecto de la atención
                de su requerimiento.
            </div>


            <div class="campo-form">

                <label for="respuesta_admin">
                    Respuesta
                </label>

                <textarea
                    name="respuesta_admin"
                    id="respuesta_admin"
                    class="form-control"
                    placeholder="Ingrese la respuesta o gestión que será informada al funcionario."
                >{{ old(
                    'respuesta_admin',
                    $requerimiento->respuesta_admin
                ) }}</textarea>


                @error('respuesta_admin')

                    <span class="texto-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>

        </div>


        {{-- =================================================
             ACCIONES
             ================================================= --}}

        <div class="acciones-formulario">

            <button
                type="submit"
                class="btn-guardar"
            >
                Guardar actualización
            </button>


            <a
                href="{{ route(
                    'admin.requerimientos.index'
                ) }}"
                class="btn-cancelar"
            >
                Cancelar y volver
            </a>

        </div>

    </form>

</div>

@endsection