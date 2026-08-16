@extends('layout')

@section('content')

<style>
    .tecnico-encabezado {
        margin-bottom: 25px;
    }

    .tecnico-encabezado h1 {
        margin-bottom: 6px;
    }

    .tecnico-encabezado p {
        color: #6B7280;
        margin: 0;
    }

    .tarjetas-tecnico {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 15px;
        margin-bottom: 30px;
    }

    .tarjeta-tecnico {
        background: #FFFFFF;
        border-radius: 10px;
        padding: 18px;
        border-left: 5px solid #78BE20;
        box-shadow: 0 2px 7px rgba(0, 0, 0, 0.08);
    }

    .tarjeta-tecnico h3 {
        margin: 0 0 7px 0;
        font-size: 15px;
        color: #374151;
    }

    .tarjeta-tecnico .numero {
        font-size: 27px;
        font-weight: bold;
        color: #5B3F95;
    }

    .tabla-contenedor {
        overflow-x: auto;
    }

    .tabla-tecnico {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    .tabla-tecnico th {
        background: #5B3F95;
        color: white;
        padding: 11px;
        text-align: left;
        white-space: nowrap;
    }

    .tabla-tecnico td {
        padding: 11px;
        border-bottom: 1px solid #E5E7EB;
        vertical-align: middle;
    }

    .tabla-tecnico tr:hover {
        background: #F9FAFB;
    }

    .sin-requerimientos {
        background: #F9FAFB;
        padding: 25px;
        border-radius: 8px;
        border-left: 5px solid #78BE20;
        text-align: center;
        color: #4B5563;
        margin-top: 20px;
    }

    .prioridad-sin-asignar {
        color: #92400E;
        font-weight: 600;
    }

    .prioridad-alta,
    .prioridad-urgente {
        font-weight: 700;
    }

    .acciones-tecnico {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        min-width: 235px;
    }

    .btn-ver {
        background: #6B7280;
    }

    .btn-ver:hover {
        background: #4B5563;
    }

    .btn-gestionar {
        background: #5B3F95;
    }

    .btn-gestionar:hover {
        background: #6B4BB0;
    }

    @media (max-width: 1100px) {
        .tarjetas-tecnico {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 750px) {
        .tarjetas-tecnico {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 500px) {
        .tarjetas-tecnico {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="tecnico-encabezado">

    <h1>Panel Técnico TI</h1>

    <p>
        Bienvenido,
        <strong>{{ $tecnico->name }}</strong>.
        Aquí puede revisar y gestionar los requerimientos
        derivados a su atención.
    </p>

</div>


{{-- INDICADORES DEL TÉCNICO --}}
<div class="tarjetas-tecnico">

    <div class="tarjeta-tecnico">
        <h3>Total asignados</h3>

        <div class="numero">
            {{ $total }}
        </div>
    </div>


    <div class="tarjeta-tecnico">
        <h3>Pendientes</h3>

        <div class="numero">
            {{ $pendientes }}
        </div>
    </div>


    <div class="tarjeta-tecnico">
        <h3>En revisión</h3>

        <div class="numero">
            {{ $enRevision }}
        </div>
    </div>


    <div class="tarjeta-tecnico">
        <h3>En proceso / espera</h3>

        <div class="numero">
            {{ $enProceso }}
        </div>
    </div>


    <div class="tarjeta-tecnico">
        <h3>Resueltos</h3>

        <div class="numero">
            {{ $resueltos }}
        </div>
    </div>

</div>


<div class="card">

    <h2>Mis requerimientos asignados</h2>

    @if ($requerimientos->count() > 0)

        <div class="tabla-contenedor">

            <table class="tabla-tecnico">

                <thead>

                    <tr>
                        <th>N.º</th>
                        <th>Funcionario</th>
                        <th>Título</th>
                        <th>Categoría</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Asignado</th>
                        <th>Acciones</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach ($requerimientos as $requerimiento)

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

                                    <span class="prioridad-sin-asignar">
                                        Sin asignar
                                    </span>

                                @else

                                    <span class="prioridad-{{ $requerimiento->prioridad }}">
                                        {{ ucfirst($requerimiento->prioridad) }}
                                    </span>

                                @endif

                            </td>


                            <td>
                                <x-estado :estado="$requerimiento->estado" />
                            </td>


                            <td>

                                @if ($requerimiento->fecha_asignacion)

                                    {{ $requerimiento->fecha_asignacion->format('d-m-Y H:i') }}

                                @else

                                    Sin fecha

                                @endif

                            </td>


                            <td>

                                <div class="acciones-tecnico">

                                    <a
                                        href="{{ route('requerimientos.show', $requerimiento) }}"
                                        class="btn btn-ver"
                                    >
                                        Ver requerimiento
                                    </a>


                                    <a
                                        href="{{ route('tecnico.requerimientos.gestionar', $requerimiento) }}"
                                        class="btn btn-gestionar"
                                    >
                                        Gestionar atención
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="sin-requerimientos">

            Actualmente no tiene requerimientos asignados.

        </div>

    @endif

</div>

@endsection