@extends('layout')

@section('content')

<div class="grid-inicio">

    <aside class="panel-accesos">
        <h2>Accesos rápidos</h2>

        <a href="/requerimientos/crear" class="acceso">
            Nuevo requerimiento
        </a>

        <a href="/mis-requerimientos" class="acceso">
            Mis requerimientos
        </a>

        <a href="/admin/requerimientos" class="acceso">
            Administración de requerimientos
        </a>
    </aside>

    <section class="card">
        <h1>Plataforma de Requerimientos Informáticos Municipales</h1>

        <p>
            Sistema destinado a registrar, revisar y hacer seguimiento a solicitudes
            de soporte informático realizadas por funcionarios municipales.
        </p>

        <p>
            A través de esta plataforma, los funcionarios pueden ingresar requerimientos,
            consultar su estado y revisar las respuestas entregadas por el área de informática.
        </p>

        <a href="/requerimientos/crear" class="btn">
            Ingresar requerimiento
        </a>
    </section>

</div>

@endsection