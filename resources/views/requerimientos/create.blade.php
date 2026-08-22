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

    .crear-wrapper {
        max-width: 900px;
        margin: 24px auto 30px;
    }

    /* =========================================================
       CABECERA
       ========================================================= */

    .crear-hero {
        position: relative;
        overflow: hidden;

        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 24px;

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

    .crear-hero::after {
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

    .crear-hero-contenido {
        position: relative;
        z-index: 1;
    }

    .crear-etiqueta {
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

    .crear-hero h1 {
        margin: 0 0 7px;

        color: #ffffff;

        font-size: 1.9rem;
        font-weight: 800;
    }

    .crear-hero p {
        margin: 0;

        color:
            rgba(255, 255, 255, 0.88);

        font-size: 0.91rem;
        line-height: 1.5;

        max-width: 620px;
    }

    /* =========================================================
       VOLVER
       ========================================================= */

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
            1px solid rgba(255, 255, 255, 0.60);

        border-radius: 9px;

        background:
            rgba(255, 255, 255, 0.12);

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
       FORMULARIO
       ========================================================= */

    .crear-card {
        padding: 23px;

        border:
            1px solid #ECEEF2;

        border-radius: 16px;

        background: #ffffff;

        box-shadow:
            0 8px 22px rgba(91, 63, 149, 0.07);
    }

    /* =========================================================
       AVISO PRIORIDAD
       ========================================================= */

    .aviso-prioridad {
        display: flex;
        align-items: flex-start;

        gap: 10px;

        padding: 13px 15px;
        margin-bottom: 21px;

        border-left:
            4px solid var(--sj-verde);

        border-radius: 9px;

        background: #F7FBF4;

        color: #4D5968;

        font-size: 0.85rem;
        line-height: 1.5;
    }

    .aviso-punto {
        width: 9px;
        height: 9px;

        flex-shrink: 0;

        margin-top: 5px;

        border-radius: 50%;

        background: var(--sj-verde);
    }

    .aviso-prioridad strong {
        color: var(--sj-morado);
    }

    /* =========================================================
       CAMPOS
       ========================================================= */

    .campo-form {
        margin-bottom: 18px;
    }

    .campo-form label {
        display: block;

        margin-bottom: 7px;

        color: var(--sj-texto);

        font-size: 0.87rem;
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

        font-size: 0.90rem;

        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .campo-form .form-select {
        min-height: 44px;
    }

    .campo-form .form-control {
        padding: 10px 13px;
    }

    .campo-form .form-select:focus,
    .campo-form .form-control:focus {
        border-color: var(--sj-morado);

        box-shadow:
            0 0 0 3px
            rgba(91, 63, 149, 0.10);
    }

    .descripcion-textarea {
        min-height: 125px;

        resize: vertical;
    }

    /* =========================================================
       ERRORES
       ========================================================= */

    .errores-card {
        padding: 13px 15px;

        margin-bottom: 20px;

        border-left:
            4px solid var(--sj-rojo);

        border-radius: 9px;

        background: #FFF2F0;

        color: #991B1B;

        font-size: 0.84rem;
    }

    .errores-card strong {
        display: block;

        margin-bottom: 6px;
    }

    .errores-card ul {
        margin: 0;
        padding-left: 20px;
    }

    .texto-error {
        display: block;

        margin-top: 5px;

        color: #B42318;

        font-size: 0.78rem;
        font-weight: 600;
    }

    /* =========================================================
       BOTÓN PRINCIPAL
       ========================================================= */

    .acciones-formulario {
        display: flex;
        align-items: center;

        gap: 10px;

        margin-top: 4px;
    }

    .btn-registrar {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 43px;

        padding: 9px 18px;

        border: 0;
        border-radius: 9px;

        background: var(--sj-morado);

        color: #ffffff;

        font-size: 0.87rem;
        font-weight: 700;

        cursor: pointer;

        transition:
            background 0.2s ease,
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }

    .btn-registrar:hover,
    .btn-registrar:focus {
        background: var(--sj-verde);

        color: #ffffff;

        transform: translateY(-1px);

        box-shadow:
            0 7px 16px rgba(120, 190, 32, 0.20);
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 767px) {

        .crear-wrapper {
            margin-top: 16px;
            margin-bottom: 20px;
        }

        .crear-hero {
            flex-direction: column;
            align-items: flex-start;

            padding: 22px;
        }

        .crear-hero h1 {
            font-size: 1.65rem;
        }

        .btn-volver-panel {
            width: 100%;
        }

        .crear-card {
            padding: 18px;
        }

        .btn-registrar {
            width: 100%;
        }
    }
</style>


<div class="container crear-wrapper">

    {{-- =====================================================
         CABECERA
         ===================================================== --}}

    <div class="crear-hero">

        <div class="crear-hero-contenido">

            <span class="crear-etiqueta">
                Nueva solicitud
            </span>

            <h1>
                Registrar requerimiento
            </h1>

            <p>
                Complete los antecedentes necesarios para
                solicitar atención al área de Informática.
            </p>

        </div>


        <a
            href="{{ route('funcionario.dashboard') }}"
            class="btn-volver-panel"
        >
            ← Volver al panel
        </a>

    </div>


    {{-- =====================================================
         FORMULARIO
         ===================================================== --}}

    <div class="crear-card">

        {{-- AVISO DE PRIORIDAD --}}

        <div class="aviso-prioridad">

            <span class="aviso-punto"></span>

            <div>

                <strong>
                    Prioridad del requerimiento:
                </strong>

                será evaluada y asignada por el área
                de Informática después de revisar la solicitud.

            </div>

        </div>


        {{-- ERRORES --}}

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


        <form
            action="{{ route('requerimientos.store') }}"
            method="POST"
        >

            @csrf


            {{-- =================================================
                 CATEGORÍA
                 ================================================= --}}

            <div class="campo-form">

                <label for="categoria">
                    Categoría
                </label>

                <select
                    name="categoria"
                    id="categoria"
                    class="form-select"
                    required
                >

                    <option value="">
                        Seleccione una categoría
                    </option>

                    <option
                        value="computador"
                        {{ old('categoria') === 'computador'
                            ? 'selected'
                            : ''
                        }}
                    >
                        Computador
                    </option>

                    <option
                        value="correo"
                        {{ old('categoria') === 'correo'
                            ? 'selected'
                            : ''
                        }}
                    >
                        Correo institucional
                    </option>

                    <option
                        value="internet"
                        {{ old('categoria') === 'internet'
                            ? 'selected'
                            : ''
                        }}
                    >
                        Internet / Red
                    </option>

                    <option
                        value="impresora"
                        {{ old('categoria') === 'impresora'
                            ? 'selected'
                            : ''
                        }}
                    >
                        Impresora
                    </option>

                    <option
                        value="sistema"
                        {{ old('categoria') === 'sistema'
                            ? 'selected'
                            : ''
                        }}
                    >
                        Sistema municipal
                    </option>

                    <option
                        value="firma"
                        {{ old('categoria') === 'firma'
                            ? 'selected'
                            : ''
                        }}
                    >
                        Firma electrónica
                    </option>

                    <option
                        value="usuario"
                        {{ old('categoria') === 'usuario'
                            ? 'selected'
                            : ''
                        }}
                    >
                        Usuario y contraseña
                    </option>

                    <option
                        value="otro"
                        {{ old('categoria') === 'otro'
                            ? 'selected'
                            : ''
                        }}
                    >
                        Otro
                    </option>

                </select>


                @error('categoria')

                    <span class="texto-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- =================================================
                 TÍTULO
                 ================================================= --}}

            <div class="campo-form">

                <label for="titulo">
                    Título del requerimiento
                </label>

                <input
                    type="text"
                    name="titulo"
                    id="titulo"
                    class="form-control"
                    value="{{ old('titulo') }}"
                    placeholder="Ejemplo: Problema para acceder al correo"
                    maxlength="255"
                    required
                >


                @error('titulo')

                    <span class="texto-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- =================================================
                 DESCRIPCIÓN
                 ================================================= --}}

            <div class="campo-form">

                <label for="descripcion">
                    Descripción del problema o solicitud
                </label>

                <textarea
                    name="descripcion"
                    id="descripcion"
                    class="form-control descripcion-textarea"
                    placeholder="Describa con detalle el requerimiento informático"
                    required
                >{{ old('descripcion') }}</textarea>


                @error('descripcion')

                    <span class="texto-error">
                        {{ $message }}
                    </span>

                @enderror

            </div>


            {{-- =================================================
                 GUARDAR
                 ================================================= --}}

            <div class="acciones-formulario">

                <button
                    type="submit"
                    class="btn-registrar"
                >
                    Registrar requerimiento
                </button>

            </div>

        </form>

    </div>

</div>

@endsection