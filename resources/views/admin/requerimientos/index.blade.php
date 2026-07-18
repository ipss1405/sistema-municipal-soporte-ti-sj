@extends('layout')

@section('content')

<div class="card">
    <h1>Administración de requerimientos</h1>

    <p>
        En esta sección el área de informática puede revisar, gestionar o eliminar
        los requerimientos ingresados por los funcionarios municipales.
    </p>

    @if (session('success'))
        <div style="
            background: #DCFCE7;
            color: #166534;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            border-left: 5px solid #78BE20;
        ">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>N°</th>
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
                    <td>{{ $requerimiento->id }}</td>
                    <td>{{ $requerimiento->titulo }}</td>
                    <td>{{ ucfirst($requerimiento->categoria) }}</td>
                    <td>{{ ucfirst($requerimiento->prioridad) }}</td>
                    <td>
                        <x-estado :estado="$requerimiento->estado" />
                    </td>
                    <td>{{ $requerimiento->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.requerimientos.edit', $requerimiento) }}" class="btn">
                            Gestionar
                        </a>

                        <form
                            action="{{ route('admin.requerimientos.destroy', $requerimiento) }}"
                            method="POST"
                            style="display: inline-block; margin-left: 8px;"
                            onsubmit="return confirm('¿Está seguro/a de eliminar este requerimiento? Esta acción no se puede deshacer.');"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn" style="background: #EF3E24;">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        No existen requerimientos registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <a href="/" class="btn" style="background: #6B7280;">
        Volver al inicio
    </a>
</div>

@endsection