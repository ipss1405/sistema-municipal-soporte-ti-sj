@extends('layout')

@section('content')

<div class="card">
    <h1>Mis requerimientos</h1>

    <p>
        En esta sección se muestran los requerimientos informáticos registrados
        en la plataforma.
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
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($requerimientos as $requerimiento)
                <tr>
                    <td>{{ $requerimiento->id }}</td>
                    <td>{{ $requerimiento->titulo }}</td>
                    <td>{{ ucfirst($requerimiento->categoria) }}</td>
                    <td>{{ ucfirst($requerimiento->prioridad) }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $requerimiento->estado)) }}</td>
                    <td>{{ $requerimiento->created_at->format('d-m-Y H:i') }}</td>
                    <td>
                        <a href="{{ route('requerimientos.show', $requerimiento) }}" class="btn">
                            Ver detalle
                        </a>
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

    <a href="/funcionario" class="btn" style="background: #6B7280;">
        Volver al panel
    </a>

    <a href="/requerimientos/crear" class="btn" style="margin-left: 10px;">
        Nuevo requerimiento
    </a>
</div>

@endsection