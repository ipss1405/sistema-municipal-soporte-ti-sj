@extends('layout')

@section('content')

<section class="card">

    <div style="text-align: center; max-width: 900px; margin: 0 auto 35px auto;">
        <h1 style="margin-bottom: 18px;">
            Plataforma de Requerimientos Informáticos Municipales
        </h1>

        <p style="font-size: 17px; line-height: 1.5; margin-bottom: 12px;">
            Sistema destinado a registrar, revisar y hacer seguimiento a solicitudes
            de soporte informático realizadas por funcionarios municipales.
        </p>

        <p style="font-size: 16px; line-height: 1.5;">
            Para ingresar requerimientos o revisar el estado de una solicitud,
            el funcionario debe iniciar sesión en la plataforma mediante los accesos disponibles.
        </p>
    </div>

    <div style="
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 25px;
        align-items: start;
    ">

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

        <div style="
            background: #F9FAFB;
            padding: 25px;
            border-radius: 8px;
            border-left: 5px solid #78BE20;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        ">
            <h2 style="color: #5B3F95; margin-top: 0;">
                Información del servicio
            </h2>

            <p>
                <strong>Unidad responsable:</strong><br>
                Dirección de Administración y Finanzas
            </p>

            <p>
                <strong>Área:</strong><br>
                Informática
            </p>

            <p>
                <strong>Uso:</strong><br>
                Plataforma interna para funcionarios municipales.
            </p>

            <p style="margin-bottom: 0;">
                <strong>Estado inicial:</strong><br>
                Todo requerimiento ingresado queda registrado como
                <strong>Pendiente</strong>.
            </p>
        </div>

        <div style="
            background: linear-gradient(135deg, #EAF7E3, #FFFFFF);
            border: 2px solid #78BE20;
            border-radius: 8px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        ">
            <div style="
                background: #5B3F95;
                color: white;
                border-radius: 50%;
                width: 80px;
                height: 80px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 15px auto;
                font-size: 30px;
                font-weight: bold;
            ">
                TI
            </div>

            <h2 style="color: #5B3F95; margin-top: 0; font-size: 24px;">
                Soporte informático municipal
            </h2>

            <p>
                Registro, seguimiento y gestión de solicitudes internas.
            </p>

            <div style="
                background: #FFFFFF;
                border-radius: 8px;
                padding: 15px;
                text-align: left;
                box-shadow: 0 2px 8px rgba(0,0,0,0.08);
                margin-top: 18px;
            ">
                <h3 style="color: #5B3F95; margin-top: 0;">
                    Contáctanos
                </h3>

                <p style="margin-bottom: 8px;">
                    <strong>Anexo:</strong> 8374 - 8487
                </p>

                <p style="margin-bottom: 8px;">
                    <strong>Celular:</strong> +56 9 5343 8487
                </p>

                <p style="margin-bottom: 0;">
                    <strong>Atención:</strong> Requerimientos informáticos internos
                </p>
            </div>
        </div>

    </div>

</section>

@endsection