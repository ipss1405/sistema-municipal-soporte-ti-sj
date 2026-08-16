@extends('layout')

@section('content')

<style>
    .filtros-panel {
        background: #F9FAFB;
        border: 1px solid #E5E7EB;
        border-left: 5px solid #5B3F95;
        border-radius: 10px;
        padding: 18px;
        margin-bottom: 22px;
    }

    .filtros-panel h3 {
        color: #5B3F95;
        font-size: 20px;
        margin-top: 0;
        margin-bottom: 15px;
    }

    .filtros-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }

    .filtro-campo label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .filtro-campo select {
        margin: 0;
    }

    .filtros-acciones {
        display: flex;
        gap: 10px;
        margin-top: 16px;
        flex-wrap: wrap;
    }

    .btn-limpiar {
        background: #6B7280;
    }

    .resultado-filtros {
        margin-top: 15px;
        margin-bottom: 5px;
        color: #4B5563;
        font-size: 14px;
    }

    .tabla-wrapper {
        width: 100%;
        overflow-x: auto;
    }

    .acciones-requerimiento {
        display: flex;
        gap: 7px;
        flex-wrap: wrap;
        align-items: center;
        min-width: 300px;
    }

    .acciones-requerimiento form {
        margin: 0;
    }

    .btn-detalle {
        background: #6B7280;
    }

    .btn-detalle:hover {
        background: #4B5563;
    }

    @media (max-width: 950px) {
        .filtros-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .filtros-grid {
            grid-template-columns: 1fr;
        }

        .filtros-acciones .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="card">

    <h1>Administración de requerimientos</h1>

    <p>
        En esta sección el área de Informática puede revisar,
        asignar prioridades, consultar la gestión técnica,
        gestionar o eliminar los requerimientos ingresados
        por los funcionarios municipales.
    </p>

    <a
        href="{{ route('admin.dashboard') }}"
        class="btn"
        style="
            background: #6B7280;
            margin-bottom: 20px;
        "
    >
        Volver al panel de administración
    </a>


    {{-- =========================
         FILTROS
         ========================= --}}

    <div class="filtros-panel">

        <h3>
            Filtrar requerimientos
        </h3>

        <form
            action="{{ route('admin.requerimientos.index') }}"
            method="GET"
        >

            <div class="filtros-grid">

                {{-- Estado --}}
                <div class="filtro-campo">

                    <label for="estado">
                        Estado
                    </label>

                    <select
                        name="estado"
                        id="estado"
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


                {{-- Prioridad --}}
                <div class="filtro-campo">

                    <label for="prioridad">
                        Prioridad
                    </label>

                    <select
                        name="prioridad"
                        id="prioridad"
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


                {{-- Categoría --}}
                <div class="filtro-campo">

                    <label for="categoria">
                        Categoría
                    </label>

                    <select
                        name="categoria"
                        id="categoria"
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


                {{-- Funcionario --}}
                <div class="filtro-campo">

                    <label for="funcionario">
                        Funcionario
                    </label>

                    <select
                        name="funcionario"
                        id="funcionario"
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
                    class="btn"
                >
                    Filtrar
                </button>

                <a
                    href="{{ route('admin.requerimientos.index') }}"
                    class="btn btn-limpiar"
                >
                    Limpiar filtros
                </a>

            </div>

        </form>


        <div class="resultado-filtros">

            Requerimientos encontrados:

            <strong>
                {{ $requerimientos->count() }}
            </strong>

        </div>

    </div>


    {{-- =========================
         TABLA
         ========================= --}}

    <div class="tabla-wrapper">

        <table>

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

                        <td>
                            {{ $requerimiento->id }}
                        </td>


                        <td>
                            {{ $requerimiento->usuario?->name ?? 'Usuario no disponible' }}
                        </td>


                        <td>
                            {{ $requerimiento->titulo }}
                        </td>


                        <td>
                            {{ ucfirst($requerimiento->categoria) }}
                        </td>


                        <td>

                            @if ($requerimiento->prioridad === 'sin_asignar')

                                <span style="
                                    background: #FEF3C7;
                                    color: #92400E;
                                    padding: 5px 10px;
                                    border-radius: 20px;
                                    font-weight: bold;
                                    white-space: nowrap;
                                ">
                                    Sin asignar
                                </span>

                            @else

                                {{ ucfirst($requerimiento->prioridad) }}

                            @endif

                        </td>


                        <td>
                            <x-estado :estado="$requerimiento->estado" />
                        </td>


                        <td>
                            {{ $requerimiento->created_at->format('d-m-Y H:i') }}
                        </td>


                        <td>

                            <div class="acciones-requerimiento">

                                {{-- VER DETALLE --}}
                                <a
                                    href="{{ route('requerimientos.show', $requerimiento) }}"
                                    class="btn btn-detalle"
                                >
                                    Ver detalle
                                </a>


                                {{-- GESTIONAR --}}
                                <a
                                    href="{{ route('admin.requerimientos.edit', $requerimiento) }}"
                                    class="btn"
                                >
                                    Gestionar
                                </a>


                                {{-- ELIMINAR --}}
                                <form
                                    action="{{ route('admin.requerimientos.destroy', $requerimiento) }}"
                                    method="POST"
                                    class="form-eliminar"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn"
                                        style="background: #EF3E24;"
                                    >
                                        Eliminar
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8">
                            No se encontraron requerimientos
                            con los filtros seleccionados.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

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
                        title: '¿Eliminar requerimiento?',
                        text: 'Esta acción no se puede deshacer.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar',
                        confirmButtonColor: '#EF3E24',
                        cancelButtonColor: '#6B7280'
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