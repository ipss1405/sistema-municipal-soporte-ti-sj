
@extends('layout')

@section('content')

<div class="grid-inicio">

    <aside class="panel-accesos">
        <h2>Accesos rápidos</h2>

        <a href="/login" class="acceso">
            Ingreso funcionario
        </a>

        <a href="/login" class="acceso">
            Ingreso administración
        </a>

        <a href="/registro" class="acceso">
            Registrar usuario
        </a>
    </aside>

    <section class="card">
        <div style="display: grid; grid-template-columns: 1.4fr 1fr; gap: 25px; align-items: center;">

            <div>
                <h1>Plataforma de Requerimientos Informáticos Municipales</h1>

                <p>
                    Sistema destinado a registrar, revisar y hacer seguimiento a solicitudes
                    de soporte informático realizadas por funcionarios municipales.
                </p>

                <p>
                    Para ingresar requerimientos o revisar el estado de una solicitud,
                    el funcionario debe iniciar sesión en la plataforma mediante los accesos disponibles.
                </p>
            </div>

            <div style="
                background: linear-gradient(135deg, #EAF7E3, #FFFFFF);
                border: 2px solid #78BE20;
                border-radius: 8px;
                padding: 25px;
                text-align: center;
            ">
                <div style="
                    background: #5B3F95;
                    color: white;
                    border-radius: 50%;
                    width: 90px;
                    height: 90px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 15px auto;
                    font-size: 34px;
                    font-weight: bold;
                ">
                    TI
                </div>

                <h3 style="color: #5B3F95; margin-bottom: 10px;">
                    Soporte informático municipal
                </h3>

                <p style="font-size: 14px; margin-bottom: 0;">
                    Registro, seguimiento y gestión de solicitudes internas.
                </p>
            </div>

        </div>
    </section>

</div>

@endsection