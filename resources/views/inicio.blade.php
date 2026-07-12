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

                <div style="
                    margin-top: 25px;
                    padding: 18px;
                    background: #F9FAFB;
                    border-left: 5px solid #78BE20;
                    border-radius: 6px;
                ">
                    <h3 style="color: #5B3F95; margin-bottom: 10px;">
                        Información del servicio
                    </h3>

                    <p style="margin-bottom: 6px;">
                        <strong>Unidad responsable:</strong> Dirección de Administración y Finanzas
                    </p>

                    <p style="margin-bottom: 6px;">
                        <strong>Área:</strong> Informática
                    </p>

                    <p style="margin-bottom: 0;">
                        <strong>Uso:</strong> Plataforma interna para funcionarios municipales.
                    </p>
                </div>
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

                <p style="font-size: 14px; margin-bottom: 18px;">
                    Registro, seguimiento y gestión de solicitudes internas.
                </p>

                <div style="
                    background: #FFFFFF;
                    border-radius: 8px;
                    padding: 15px;
                    text-align: left;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
                ">
                    <h4 style="color: #5B3F95; margin-bottom: 10px;">
                        Contáctanos
                    </h4>

                    <p style="font-size: 14px; margin-bottom: 6px;">
                        <strong>Anexo:</strong> 8374 - 8487
                    </p>

                    <p style="font-size: 14px; margin-bottom: 6px;">
                        <strong>Celular:</strong> +56 9 5343 8487
                    </p>

                    <p style="font-size: 14px; margin-bottom: 0;">
                        <strong>Atención:</strong> Requerimientos informáticos internos
                    </p>
                </div>
            </div>

        </div>
    </section>

</div>

@endsection