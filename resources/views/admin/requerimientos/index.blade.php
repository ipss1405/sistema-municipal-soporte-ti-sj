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
        --sj-fondo-suave: #F8F9FB;
    }

    /* =========================================================
       CONTENEDOR GENERAL
       ========================================================= */

    .admin-requerimientos-wrapper {
        margin-top: 24px;
        margin-bottom: 28px;
    }


    /* =========================================================
       CABECERA
       ========================================================= */

    .requerimientos-hero {
        position: relative;
        overflow: hidden;

        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 25px;

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

    .requerimientos-hero::after {
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

    .hero-contenido-admin {
        position: relative;
        z-index: 1;
    }

    .hero-etiqueta {
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

    .requerimientos-hero h1 {
        margin: 0 0 7px;

        color: #ffffff;

        font-size: 2rem;
        font-weight: 800;
    }

    .requerimientos-hero p {
        max-width: 760px;

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
       FILTROS
       ========================================================= */

    .filtros-card {
        margin-bottom: 20px;

        padding: 21px;

        border: 1px solid #ECEEF2;
        border-left: 5px solid var(--sj-morado);
        border-radius: 15px;

        background: #ffffff;

        box-shadow:
            0 7px 20px rgba(91, 63, 149, 0.07);
    }

    .filtros-cabecera {
        display: flex;
        align-items: center;
        justify-content: space-between;

        gap: 15px;

        margin-bottom: 16px;
    }

    .filtros-cabecera h2 {
        margin: 0;

        color: var(--sj-morado);

        font-size: 1.25rem;
        font-weight: 800;
    }

    .contador-resultados {
        display: inline-flex;
        align-items: center;

        padding: 6px 12px;

        border-radius: 999px;

        background:
            rgba(120, 190, 32, 0.12);

        color: #4E7F18;

        font-size: 0.82rem;
        font-weight: 700;
    }

    .filtros-grid {
        display: grid;

        grid-template-columns:
            repeat(4, minmax(0, 1fr));

        gap: 14px;
    }

    .filtro-campo label {
        display: block;

        margin-bottom: 6px;

        color: var(--sj-texto);

        font-size: 0.84rem;
        font-weight: 700;
    }

    .filtro-campo .form-select {
        min-height: 42px;

        border:
            1px solid var(--sj-borde);

        border-radius: 8px;

        color: var(--sj-texto);

        font-size: 0.88rem;
    }

    .filtro-campo .form-select:focus {
        border-color:
            var(--sj-morado);

        box-shadow:
            0 0 0 3px
            rgba(91, 63, 149, 0.10);
    }

    .filtros-acciones {
        display: flex;
        align-items: center;

        gap: 9px;

        margin-top: 16px;
    }

    .btn-filtrar {
        min-height: 40px;

        padding: 8px 17px;

        border: 0;
        border-radius: 8px;

        background:
            var(--sj-morado);

        color: #ffffff;

        font-size: 0.86rem;
        font-weight: 700;

        transition:
            background 0.2s ease,
            transform 0.2s ease;
    }

    .btn-filtrar:hover {
        background:
            var(--sj-verde);

        color: #ffffff;

        transform: translateY(-1px);
    }

    .btn-limpiar {
        min-height: 40px;

        padding: 8px 17px;

        border: 1px solid #D6DAE0;
        border-radius: 8px;

        background: #ffffff;

        color: #626B78;

        font-size: 0.86rem;
        font-weight: 700;

        text-decoration: none;

        transition:
            background 0.2s ease,
            color 0.2s ease;
    }

    .btn-limpiar:hover {
        background: #F2F3F5;

        color: #374151;
    }


    /* =========================================================
       TABLA
       ========================================================= */

    .tabla-card {
        overflow: hidden;

        border: 1px solid #ECEEF2;
        border-radius: 16px;

        background: #ffffff;

        box-shadow:
            0 8px 22px rgba(91, 63, 149, 0.07);
    }

    .tabla-scroll {
        width: 100%;
        overflow-x: auto;
    }

    .tabla-requerimientos {
        width: 100%;

        margin: 0;

        border-collapse: collapse;
    }

    .tabla-requerimientos thead th {
        padding: 14px 12px;

        background: #F5F3F8;

        color: var(--sj-morado);

        border-bottom:
            1px solid #E5E7EB;

        font-size: 0.82rem;
        font-weight: 800;

        vertical-align: middle;

        white-space: nowrap;
    }

    .tabla-requerimientos tbody td {
        padding: 13px 12px;

        border-bottom:
            1px solid #ECEEF2;

        color: #374151;

        font-size: 0.86rem;

        vertical-align: middle;
    }

    .tabla-requerimientos tbody tr {
        transition:
            background 0.18s ease;
    }

    .tabla-requerimientos tbody tr:hover {
        background: #FBFAFD;
    }

    .tabla-requerimientos tbody tr:last-child td {
        border-bottom: 0;
    }

    .numero-requerimiento {
        color: var(--sj-morado);
        font-weight: 800;
    }

    .funcionario-nombre {
        font-weight: 600;
        color: var(--sj-texto);
    }

    .titulo-requerimiento {
        min-width: 140px;
        max-width: 210px;
    }

    .fecha-requerimiento {
        min-width: 105px;
        white-space: nowrap;

        color: #667085;

        font-size: 0.82rem;
    }

    .fecha-requerimiento .hora {
        display: block;

        margin-top: 2px;

        color: #98A0AC;

        font-size: 0.77rem;
    }


    /* =========================================================
       PRIORIDADES
       ========================================================= */

    .badge-prioridad {
        display: inline-flex;
        align-items: center;

        padding: 5px 10px;

        border-radius: 999px;

        font-size: 0.76rem;
        font-weight: 700;

        white-space: nowrap;
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
       ACCIONES DE LA TABLA
       ========================================================= */

    .acciones-requerimiento {
        display: flex;
        align-items: center;

        gap: 6px;

        min-width: 250px;

        white-space: nowrap;
    }

    .acciones-requerimiento form {
        margin: 0;
    }

    .btn-tabla {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        min-height: 36px;

        padding: 7px 11px;

        border: 0;
        border-radius: 7px;

        text-decoration: none;

        font-size: 0.78rem;
        font-weight: 700;

        transition:
            background 0.2s ease,
            color 0.2s ease,
            transform 0.2s ease;
    }

    .btn-tabla:hover {
        transform: translateY(-1px);
    }

    .btn-ver {
        background: #6B7280;
        color: #ffffff;
    }

    .btn-ver:hover {
        background: #535B68;
        color: #ffffff;
    }

    .btn-gestionar {
        background: var(--sj-morado);
        color: #ffffff;
    }

    .btn-gestionar:hover {
        background: var(--sj-verde);
        color: #ffffff;
    }

    .btn-eliminar {
        background: var(--sj-rojo);
        color: #ffffff;

        cursor: pointer;
    }

    .btn-eliminar:hover {
        background: #D93420;
        color: #ffffff;
    }


    /* =========================================================
       PAGINACIÓN
       ========================================================= */

    .paginacion-contenedor {
        display: flex;
        justify-content: space-between;
        align-items: center;

        gap: 16px;

        padding: 16px 18px;

        border-top:
            1px solid #ECEEF2;

        background: #FCFCFD;

        flex-wrap: wrap;
    }

    .paginacion-info {
        color: #6B7280;

        font-size: 0.82rem;
    }

    .paginacion-info strong {
        color: var(--sj-texto);
    }

    .paginacion {
        display: flex;
        align-items: center;

        gap: 5px;

        flex-wrap: wrap;
    }

    .pagina-enlace,
    .pagina-deshabilitada {
        min-width: 36px;
        height: 36px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        padding: 0 10px;

        border-radius: 7px;

        font-size: 0.79rem;
        font-weight: 700;
    }

    .pagina-enlace {
        border:
            1px solid #E1E4E9;

        background: #ffffff;

        color: var(--sj-morado);

        text-decoration: none;

        transition:
            background 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease;
    }

    .pagina-enlace:hover {
        border-color:
            var(--sj-morado);

        background: #F5F1FA;

        color:
            var(--sj-morado);
    }

    .pagina-activa {
        border-color:
            var(--sj-morado);

        background:
            var(--sj-morado);

        color: #ffffff;
    }

    .pagina-activa:hover {
        background:
            var(--sj-morado);

        color: #ffffff;
    }

    .pagina-deshabilitada {
        border:
            1px solid #E5E7EB;

        background: #F3F4F6;

        color: #A0A7B0;
    }


    /* =========================================================
       SIN RESULTADOS
       ========================================================= */

    .sin-resultados {
        padding: 35px !important;

        text-align: center;

        color: #7A8493 !important;
    }


    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 991px) {

        .requerimientos-hero {
            align-items: flex-start;
            flex-direction: column;
        }

        .filtros-grid {
            grid-template-columns:
                repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {

        .admin-requerimientos-wrapper {
            margin-top: 16px;
        }

        .requerimientos-hero {
            padding: 22px;
        }

        .requerimientos-hero h1 {
            font-size: 1.65rem;
        }

        .btn-volver-panel {
            width: 100%;
        }

        .filtros-card {
            padding: 17px;
        }

        .filtros-cabecera {
            flex-direction: column;
            align-items: flex-start;
        }

        .filtros-grid {
            grid-template-columns: 1fr;
        }

        .filtros-acciones {
            flex-direction: column;
        }

        .btn-filtrar,
        .btn-limpiar {
            width: 100%;
            text-align: center;
        }

        .paginacion-contenedor {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>


<div class="container admin-requerimientos-wrapper">

    {{-- =====================================================
         CABECERA
         ===================================================== --}}

    <div class="requerimientos-hero">

        <div class="hero-contenido-admin">

            <span class="hero-etiqueta">
                Gestión administrativa
            </span>

            <h1>
                Administración de requerimientos
            </h1>

            <p>
                Revise, filtre y gestione los requerimientos
                registrados por los funcionarios municipales.
            </p>

        </div>


        <a
            href="{{ route('admin.dashboard') }}"
            class="btn-volver-panel"
        >
            ← Volver al panel
        </a>

    </div>


    {{-- =====================================================
         FILTROS
         ===================================================== --}}

    <div class="filtros-card">

        <div class="filtros-cabecera">

            <h2>
                Filtrar requerimientos
            </h2>


            <div class="contador-resultados">

                {{ $requerimientos->total() }}
                requerimientos encontrados

            </div>

        </div>


        <form
            action="{{ route('admin.requerimientos.index') }}"
            method="GET"
        >

            <div class="filtros-grid">


                {{-- ESTADO --}}
                <div class="filtro-campo">

                    <label for="estado">
                        Estado
                    </label>

                    <select
                        name="estado"
                        id="estado"
                        class="form-select"
                    >

                        <option value="">
                            Todos
                        </option>

                        <option
                            value="pendiente"
                            {{ request('estado') === 'pendiente' ? 'selected' : '' }}
                        >
                            Pendiente
                        </option>

                        <option
                            value="en_revision"
                            {{ request('estado') === 'en_revision' ? 'selected' : '' }}
                        >
                            En revisión
                        </option>

                        <option
                            value="en_proceso"
                            {{ request('estado') === 'en_proceso' ? 'selected' : '' }}
                        >
                            En proceso
                        </option>

                        <option
                            value="resuelto"
                            {{ request('estado') === 'resuelto' ? 'selected' : '' }}
                        >
                            Resuelto
                        </option>

                        <option
                            value="cerrado"
                            {{ request('estado') === 'cerrado' ? 'selected' : '' }}
                        >
                            Cerrado
                        </option>

                        <option
                            value="rechazado"
                            {{ request('estado') === 'rechazado' ? 'selected' : '' }}
                        >
                            Rechazado
                        </option>

                    </select>

                </div>


                {{-- PRIORIDAD --}}
                <div class="filtro-campo">

                    <label for="prioridad">
                        Prioridad
                    </label>

                    <select
                        name="prioridad"
                        id="prioridad"
                        class="form-select"
                    >

                        <option value="">
                            Todas
                        </option>

                        <option
                            value="sin_asignar"
                            {{ request('prioridad') === 'sin_asignar' ? 'selected' : '' }}
                        >
                            Sin asignar
                        </option>

                        <option
                            value="baja"
                            {{ request('prioridad') === 'baja' ? 'selected' : '' }}
                        >
                            Baja
                        </option>

                        <option
                            value="media"
                            {{ request('prioridad') === 'media' ? 'selected' : '' }}
                        >
                            Media
                        </option>

                        <option
                            value="alta"
                            {{ request('prioridad') === 'alta' ? 'selected' : '' }}
                        >
                            Alta
                        </option>

                        <option
                            value="urgente"
                            {{ request('prioridad') === 'urgente' ? 'selected' : '' }}
                        >
                            Urgente
                        </option>

                    </select>

                </div>


                {{-- CATEGORÍA --}}
                <div class="filtro-campo">

                    <label for="categoria">
                        Categoría
                    </label>

                    <select
                        name="categoria"
                        id="categoria"
                        class="form-select"
                    >

                        <option value="">
                            Todas
                        </option>

                        <option
                            value="computador"
                            {{ request('categoria') === 'computador' ? 'selected' : '' }}
                        >
                            Computador
                        </option>

                        <option
                            value="correo"
                            {{ request('categoria') === 'correo' ? 'selected' : '' }}
                        >
                            Correo institucional
                        </option>

                        <option
                            value="internet"
                            {{ request('categoria') === 'internet' ? 'selected' : '' }}
                        >
                            Internet / Red
                        </option>

                        <option
                            value="impresora"
                            {{ request('categoria') === 'impresora' ? 'selected' : '' }}
                        >
                            Impresora
                        </option>

                        <option
                            value="sistema"
                            {{ request('categoria') === 'sistema' ? 'selected' : '' }}
                        >
                            Sistema municipal
                        </option>

                        <option
                            value="firma"
                            {{ request('categoria') === 'firma' ? 'selected' : '' }}
                        >
                            Firma electrónica
                        </option>

                        <option
                            value="usuario"
                            {{ request('categoria') === 'usuario' ? 'selected' : '' }}
                        >
                            Usuario y contraseña
                        </option>

                        <option
                            value="otro"
                            {{ request('categoria') === 'otro' ? 'selected' : '' }}
                        >
                            Otro
                        </option>

                    </select>

                </div>


                {{-- FUNCIONARIO --}}
                <div class="filtro-campo">

                    <label for="funcionario">
                        Funcionario
                    </label>

                    <select
                        name="funcionario"
                        id="funcionario"
                        class="form-select"
                    >

                        <option value="">
                            Todos
                        </option>

                        @foreach ($funcionarios as $funcionario)

                            <option
                                value="{{ $funcionario->id }}"
                                {{ (string) request('funcionario') === (string) $funcionario->id ? 'selected' : '' }}
                            >
                                {{ $funcionario->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            <div class="filtros-acciones">

                <button
                    type="submit"
                    class="btn-filtrar"
                >
                    Filtrar
                </button>


                <a
                    href="{{ route('admin.requerimientos.index') }}"
                    class="btn-limpiar"
                >
                    Limpiar filtros
                </a>

            </div>

        </form>

    </div>


    {{-- =====================================================
         TABLA
         ===================================================== --}}

    <div class="tabla-card">

        <div class="tabla-scroll">

            <table class="table table-vcenter tabla-requerimientos">

                <thead>

                    <tr>
                        <th>N°</th>
                        <th>Funcionario</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Fecha ingreso</th>
                        <th>Acciones</th>
                    </tr>

                </thead>


                <tbody>

                    @forelse ($requerimientos as $requerimiento)

                        <tr>

                            {{-- NÚMERO --}}
                            <td>
                                <span class="numero-requerimiento">
                                    #{{ $requerimiento->id }}
                                </span>
                            </td>


                            {{-- FUNCIONARIO --}}
                            <td>
                                <span class="funcionario-nombre">
                                    {{ $requerimiento->usuario?->name ?? 'Usuario no disponible' }}
                                </span>
                            </td>


                            {{-- TÍTULO --}}
                            <td class="titulo-requerimiento">
                                {{ $requerimiento->titulo }}
                            </td>


                            {{-- CATEGORÍA --}}
                            <td>
                                {{ ucfirst($requerimiento->categoria) }}
                            </td>


                            {{-- PRIORIDAD --}}
                            <td>

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

                                        {{ ucfirst($requerimiento->prioridad) }}

                                @endswitch

                            </td>


                            {{-- ESTADO --}}
                            <td>
                                <x-estado :estado="$requerimiento->estado" />
                            </td>


                            {{-- FECHA --}}
                            <td class="fecha-requerimiento">

                                {{ $requerimiento->created_at->format('d-m-Y') }}

                                <span class="hora">
                                    {{ $requerimiento->created_at->format('H:i') }}
                                </span>

                            </td>


                            {{-- ACCIONES --}}
                            <td>

                                <div class="acciones-requerimiento">

                                    <a
                                        href="{{ route('requerimientos.show', $requerimiento) }}"
                                        class="btn-tabla btn-ver"
                                    >
                                        Ver detalle
                                    </a>


                                    <a
                                        href="{{ route('admin.requerimientos.edit', $requerimiento) }}"
                                        class="btn-tabla btn-gestionar"
                                    >
                                        Gestionar
                                    </a>


                                    <form
                                        action="{{ route('admin.requerimientos.destroy', $requerimiento) }}"
                                        method="POST"
                                        class="form-eliminar"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn-tabla btn-eliminar"
                                        >
                                            Eliminar
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="sin-resultados"
                            >
                                No se encontraron requerimientos
                                con los filtros seleccionados.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =================================================
             PAGINACIÓN
             ================================================= --}}

        @if ($requerimientos->hasPages())

            <div class="paginacion-contenedor">

                <div class="paginacion-info">

                    Mostrando

                    <strong>
                        {{ $requerimientos->firstItem() }}
                    </strong>

                    a

                    <strong>
                        {{ $requerimientos->lastItem() }}
                    </strong>

                    de

                    <strong>
                        {{ $requerimientos->total() }}
                    </strong>

                    requerimientos

                </div>


                <div class="paginacion">

                    {{-- ANTERIOR --}}
                    @if ($requerimientos->onFirstPage())

                        <span class="pagina-deshabilitada">
                            Anterior
                        </span>

                    @else

                        <a
                            href="{{ $requerimientos->previousPageUrl() }}"
                            class="pagina-enlace"
                        >
                            Anterior
                        </a>

                    @endif


                    {{-- PÁGINAS --}}
                    @for (
                        $pagina = 1;
                        $pagina <= $requerimientos->lastPage();
                        $pagina++
                    )

                        @if ($pagina === $requerimientos->currentPage())

                            <span
                                class="pagina-enlace pagina-activa"
                            >
                                {{ $pagina }}
                            </span>

                        @else

                            <a
                                href="{{ $requerimientos->url($pagina) }}"
                                class="pagina-enlace"
                            >
                                {{ $pagina }}
                            </a>

                        @endif

                    @endfor


                    {{-- SIGUIENTE --}}
                    @if ($requerimientos->hasMorePages())

                        <a
                            href="{{ $requerimientos->nextPageUrl() }}"
                            class="pagina-enlace"
                        >
                            Siguiente
                        </a>

                    @else

                        <span class="pagina-deshabilitada">
                            Siguiente
                        </span>

                    @endif

                </div>

            </div>

        @else

            {{-- Aunque solo haya una página,
                 seguimos mostrando el total --}}
            <div class="paginacion-contenedor">

                <div class="paginacion-info">

                    Mostrando

                    <strong>
                        {{ $requerimientos->count() }}
                    </strong>

                    de

                    <strong>
                        {{ $requerimientos->total() }}
                    </strong>

                    requerimientos

                </div>

            </div>

        @endif

    </div>

</div>

@endsection


@section('scripts')

<script>

    document
        .querySelectorAll('.form-eliminar')
        .forEach(form => {

            form.addEventListener(
                'submit',
                function (event) {

                    event.preventDefault();

                    Swal.fire({

                        title:
                            '¿Eliminar requerimiento?',

                        text:
                            'Esta acción no se puede deshacer.',

                        icon:
                            'warning',

                        showCancelButton:
                            true,

                        confirmButtonText:
                            'Sí, eliminar',

                        cancelButtonText:
                            'Cancelar',

                        confirmButtonColor:
                            '#EF3E24',

                        cancelButtonColor:
                            '#6B7280'

                    }).then((result) => {

                        if (result.isConfirmed) {

                            form.submit();

                        }

                    });

                }
            );

        });

</script>

@endsection