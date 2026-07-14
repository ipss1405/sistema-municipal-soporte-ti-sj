@extends('layout')

@section('content')

<div class="animacion-entrada" style="
    display: grid;
    grid-template-columns: 330px 1fr;
    gap: 25px;
    align-items: start;
">

    <div>
        <aside class="panel-accesos tarjeta-dinamica">
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

        <div class="tarjeta-dinamica" style="
            background: white;
            margin-top: 20px;
            padding: 22px;
            border-radius: 8px;
            border-top: 5px solid #78BE20;
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
        ">
            <h3 style="color: #5B3F95; margin-top: 0;">
                Información del servicio
            </h3>

            <p style="margin-bottom: 8px;">
                <strong>Unidad responsable:</strong><br>
                Dirección de Administración y Finanzas
            </p>

            <p style="margin-bottom: 8px;">
                <strong>Área:</strong><br>
                Informática
            </p>

            <p style="margin-bottom: 0;">
                <strong>Uso:</strong><br>
                Plataforma interna para funcionarios municipales.
            </p>
        </div>

        <div class="tarjeta-dinamica" style="
            background: white;
            margin-top: 20px;
            padding: 22px;
            border-radius: 8px;
            border-top: 5px solid #F26B21;
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
        ">
            <h3 style="color: #5B3F95; margin-top: 0;">
                Contáctanos
            </h3>

            <p style="margin-bottom: 8px;">
                <strong>Anexo:</strong><br>
                8374 - 8487
            </p>

            <p style="margin-bottom: 8px;">
                <strong>Celular:</strong><br>
                +56 9 5343 8487
            </p>

            <p style="margin-bottom: 0;">
                <strong>Atención:</strong><br>
                Requerimientos informáticos internos
            </p>
        </div>
    </div>

    <section class="card" style="padding: 0; overflow: hidden;">
        <div class="hero-municipal">
            <p class="etiqueta-municipal">
                Municipalidad de San Joaquín
            </p>

            <h1 style="
                color: white;
                font-size: 42px;
                margin-bottom: 15px;
            ">
                MesaTI Municipal
            </h1>

            <h2 style="
                color: white;
                font-size: 24px;
                font-weight: normal;
                margin-top: 0;
                margin-bottom: 0;
            ">
                Plataforma interna de gestión de requerimientos informáticos
            </h2>
        </div>

        <div style="padding: 35px;">
            <p style="font-size: 18px; line-height: 1.6;">
                Este sistema permite a los funcionarios municipales registrar solicitudes
                de soporte informático, revisar el estado de sus requerimientos y consultar
                las respuestas entregadas por el área de Informática.
            </p>

            <p style="font-size: 17px; line-height: 1.6;">
                El objetivo es mantener un seguimiento ordenado, trazable y centralizado
                de las solicitudes internas, facilitando la gestión del soporte técnico municipal.
            </p>

            <div style="
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 18px;
                margin-top: 30px;
            ">
                <div class="bloque-resumen" style="
                    background: #EAF7E3;
                    border-left: 5px solid #78BE20;
                    padding: 18px;
                    border-radius: 8px;
                ">
                    <h3 style="color: #5B3F95; margin-top: 0;">
                        Registrar
                    </h3>

                    <p style="margin-bottom: 0;">
                        Ingreso de solicitudes informáticas por parte del funcionario.
                    </p>
                </div>

                <div class="bloque-resumen" style="
                    background: #F9FAFB;
                    border-left: 5px solid #5B3F95;
                    padding: 18px;
                    border-radius: 8px;
                ">
                    <h3 style="color: #5B3F95; margin-top: 0;">
                        Seguimiento
                    </h3>

                    <p style="margin-bottom: 0;">
                        Consulta del estado y avance de cada requerimiento.
                    </p>
                </div>

                <div class="bloque-resumen" style="
                    background: #FFF7ED;
                    border-left: 5px solid #F26B21;
                    padding: 18px;
                    border-radius: 8px;
                ">
                    <h3 style="color: #5B3F95; margin-top: 0;">
                        Gestión TI
                    </h3>

                    <p style="margin-bottom: 0;">
                        Administración, respuesta y cierre de solicitudes internas.
                    </p>
                </div>
            </div>

            <div style="
                display: grid;
                grid-template-columns: 100px 1fr;
                gap: 20px;
                align-items: center;
                margin-top: 30px;
                padding: 22px;
                background: #F9FAFB;
                border-radius: 8px;
                border-left: 5px solid #78BE20;
            ">
                <div class="circulo-ti" style="
                    background: #5B3F95;
                    color: white;
                    border-radius: 50%;
                    width: 80px;
                    height: 80px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 30px;
                    font-weight: bold;
                ">
                    TI
                </div>

                <div>
                    <h3 style="color: #5B3F95; margin-top: 0;">
                        Seguimiento del requerimiento
                    </h3>

                    <p style="margin-bottom: 0;">
                        Todo requerimiento ingresado queda registrado inicialmente como
                        <strong>Pendiente</strong>, hasta que el área de Informática revise,
                        gestione y responda la solicitud.
                    </p>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection