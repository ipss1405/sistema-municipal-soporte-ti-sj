@extends('layout')

@section('content')

<div class="card">
    <h1>Panel del funcionario</h1>

    <p>
        Desde este panel podrás registrar nuevos requerimientos informáticos
        y revisar el estado de las solicitudes ingresadas.
    </p>
</div>

<div class="grid-inicio" style="margin-top: 25px;">

    <section class="card">
        <h2>Gestión de requerimientos</h2>

        <p>
            Utiliza las siguientes opciones para ingresar una nueva solicitud
            o consultar los requerimientos que ya han sido registrados.
        </p>

        <a href="/requerimientos/crear" class="btn">
            Crear nuevo requerimiento
        </a>

        <a href="/mis-requerimientos" class="btn" style="background: #6B7280; margin-left: 10px;">
            Ver mis requerimientos
        </a>
    </section>

    <aside class="panel-accesos">
        <h2>Resumen</h2>

        <a href="#" class="acceso">
            Pendientes
        </a>

        <a href="#" class="acceso">
            En revisión
        </a>

        <a href="#" class="acceso">
            Resueltos
        </a>

        <a href="#" class="acceso">
            Seguimientos
        </a>
    </aside>

</div>

@endsection