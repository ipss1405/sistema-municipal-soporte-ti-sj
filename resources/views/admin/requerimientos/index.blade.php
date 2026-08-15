@extends('layout')

@section('content')

<div class="card">
    <h1>Administración de requerimientos</h1>

    <p>
        En esta sección el área de informática puede revisar, asignar prioridades,
        gestionar o eliminar los requerimientos ingresados por los funcionarios municipales.
    </p>

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
                        <a
                            href="{{ route('admin.requerimientos.edit', $requerimiento) }}"
                            class="btn"
                        >
                            Gestionar
                        </a>

                        <form
                            action="{{ route('admin.requerimientos.destroy', $requerimiento) }}"
                            method="POST"
                            class="form-eliminar"
                            style="display: inline-block; margin-left: 8px;"
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
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        No existen requerimientos registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <a
        href="/"
        class="btn"
        style="background: #6B7280;"
    >
        Volver al inicio
    </a>
</div>

@endsection

@section('scripts')
<script>
    document.querySelectorAll('.form-eliminar').forEach(form => {
        form.addEventListener('submit', function (event) {
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
        });
    });
</script>
@endsection