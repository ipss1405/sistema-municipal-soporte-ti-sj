<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema Municipal de Soporte TI</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        :root {
            --verde-principal: #78BE20;
            --morado-principal: #5B3F95;
            --morado-secundario: #6B4BB0;
            --naranjo-acento: #F26B21;
            --rojo-acento: #EF3E24;
            --fondo-claro: #EAF7E3;
            --blanco: #FFFFFF;
            --texto: #1F2937;
            --gris: #6B7280;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--fondo-claro);
            color: var(--texto);
        }

        .barra-superior {
            background: var(--verde-principal);
            color: white;
            padding: 14px 40px;
            font-size: 14px;
            font-weight: bold;
        }

        .navbar {
            background: linear-gradient(
                90deg,
                var(--morado-principal),
                var(--rojo-acento),
                var(--naranjo-acento)
            );
            padding: 12px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-contenedor {
            display: flex;
            align-items: center;
        }

        .logo-link {
            display: flex;
            align-items: center;
            gap: 14px;
            color: white;
            text-decoration: none;
            font-size: 24px;
            font-weight: bold;
        }

        .logo-link:hover {
            color: white;
            text-decoration: none;
        }

        .logo-municipal {
            width: 145px;
            height: 58px;
            object-fit: contain;
            background: white;
            padding: 5px;
            border-radius: 6px;
        }

        .menu {
            display: flex;
            align-items: center;
            gap: 22px;
            flex-wrap: wrap;
        }

        .menu a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
        }

        .menu a:hover {
            text-decoration: underline;
        }

        .link-notificacion {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .contador-notificacion {
            background: var(--verde-principal);
            color: #ffffff;
            border-radius: 999px;
            min-width: 22px;
            height: 22px;
            padding: 2px 7px;
            font-size: 12px;
            font-weight: 800;
            display: none;
            align-items: center;
            justify-content: center;
            line-height: 1;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.35);
        }

        .link-notificacion.tiene-notificaciones .campana {
            animation: campanaMovimiento 1.2s ease-in-out infinite;
        }

        @keyframes campanaMovimiento {
            0% {
                transform: rotate(0deg);
            }

            20% {
                transform: rotate(-12deg);
            }

            40% {
                transform: rotate(12deg);
            }

            60% {
                transform: rotate(-8deg);
            }

            80% {
                transform: rotate(8deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        .form-logout {
            display: inline;
            margin: 0;
        }

        .btn-salir {
            background: transparent;
            border: none;
            color: white;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
            padding: 0;
        }

        .btn-salir:hover {
            color: var(--verde-principal);
            text-decoration: underline;
        }

        .contenedor {
            width: 88%;
            max-width: 1150px;
            margin: 40px auto;
        }

        .panel-accesos {
            background: var(--morado-principal);
            color: white;
            padding: 25px;
            border-radius: 8px;
        }

        .panel-accesos h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 26px;
        }

        .acceso {
            display: block;
            background: var(--morado-secundario);
            color: white;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 5px;
            margin-bottom: 12px;
            font-weight: bold;
            transition: transform 0.25s ease, background 0.25s ease;
        }

        .acceso:hover {
            background: #7B5AC8;
            transform: translateX(4px);
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            border-top: 5px solid var(--verde-principal);
            box-shadow: 0 2px 8px rgba(0,0,0,0.12);
        }

        .card h1 {
            color: var(--morado-principal);
            margin-top: 0;
            font-size: 34px;
        }

        .card h2 {
            color: var(--morado-principal);
            margin-top: 0;
        }

        .btn {
            display: inline-block;
            background: var(--morado-principal);
            color: white;
            text-decoration: none;
            border: none;
            padding: 12px 18px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.25s ease, background 0.25s ease;
        }

        .btn:hover {
            background: var(--morado-secundario);
            transform: translateY(-2px);
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border: 1px solid #D1D5DB;
            border-radius: 5px;
            font-size: 15px;
        }

        label {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border-bottom: 1px solid #E5E7EB;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #F3F4F6;
            color: var(--morado-principal);
        }

        .estado-badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            text-align: center;
            min-width: 95px;
        }

        .estado-pendiente {
            background: #FEF3C7;
            color: #92400E;
        }

        .estado-revision {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .estado-proceso {
            background: #EDE9FE;
            color: #5B21B6;
        }

        .estado-resuelto {
            background: #DCFCE7;
            color: #166534;
        }

        .estado-cerrado {
            background: #E5E7EB;
            color: #374151;
        }

        .estado-rechazado {
            background: #FEE2E2;
            color: #991B1B;
        }

        .animacion-entrada {
            animation: entradaSuave 0.7s ease-in-out;
        }

        @keyframes entradaSuave {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .tarjeta-dinamica {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .tarjeta-dinamica:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.16);
        }

        .hero-municipal {
            background: linear-gradient(
                135deg,
                #5B3F95,
                #EF3E24,
                #F26B21
            );
            color: white;
            padding: 35px;
            border-radius: 8px 8px 0 0;
        }

        .etiqueta-municipal {
            display: inline-block;
            background: #78BE20;
            color: white;
            padding: 8px 14px;
            border-radius: 20px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .bloque-resumen {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .bloque-resumen:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 14px rgba(0,0,0,0.14);
        }

        .circulo-ti {
            transition: transform 0.3s ease;
        }

        .circulo-ti:hover {
            transform: rotate(-4deg) scale(1.06);
        }

        .footer {
            margin-top: 50px;
            padding: 20px;
            text-align: center;
            background: var(--morado-principal);
            color: white;
            font-size: 14px;
        }

        .badge-municipal {
            background: #78BE20;
            color: #ffffff;
            font-weight: 700;
        }

        .btn-municipal {
            background: #5B3F95;
            color: #ffffff;
            border: none;
        }

        .btn-municipal:hover {
            background: #6B4BB0;
            color: #ffffff;
        }

        .btn-municipal-outline {
            border: 2px solid #5B3F95;
            color: #5B3F95;
            background: #ffffff;
        }

        .btn-municipal-outline:hover {
            background: #5B3F95;
            color: #ffffff;
        }

        .card-municipal {
            border: none;
            border-top: 6px solid #78BE20;
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(91, 63, 149, 0.12);
        }

        .card-acceso {
            border-radius: 24px;
            border: none;
            box-shadow: 0 12px 30px rgba(91, 63, 149, 0.15);
        }

        .titulo-municipal {
            color: #1F2937;
        }

        .texto-municipal {
            color: #374151;
        }

        @media (max-width: 850px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .logo-link {
                flex-direction: column;
                gap: 8px;
            }

            .menu {
                gap: 15px;
                justify-content: center;
            }

            .contenedor {
                width: 94%;
            }
        }
    </style>
</head>

<body>

    {{--
        Determina el panel de inicio
        correspondiente al rol del usuario.
    --}}
    @php

        if (auth()->check()) {

            if (auth()->user()->rol === 'administrador') {

                $rutaInicio = route('admin.dashboard');

            } elseif (auth()->user()->rol === 'tecnico') {

                $rutaInicio = route('tecnico.dashboard');

            } else {

                $rutaInicio = route('funcionario.dashboard');
            }

        } else {

            $rutaInicio = url('/');
        }

    @endphp

    <header>

        <div class="barra-superior">
            Sistema interno de soporte informático municipal
        </div>

        <div class="navbar">

            <div class="logo-contenedor">

                <a
                    href="{{ $rutaInicio }}"
                    class="logo-link"
                >

                    <img
                        src="{{ asset('img/logo-municipal.png') }}"
                        alt="Logo Municipal"
                        class="logo-municipal"
                    >

                    <span>
                        Sistema Municipal de Soporte TI
                    </span>

                </a>

            </div>

            <nav class="menu">

                @auth

                    @php
                        $notificacionesPendientes =
                            \App\Models\Notificacion::where(
                                'user_id',
                                auth()->id()
                            )
                            ->where(
                                'leida',
                                false
                            )
                            ->count();
                    @endphp

                    <a href="{{ $rutaInicio }}">
                        Inicio
                    </a>

                    <a
                        href="{{ route('notificaciones.index') }}"
                        class="link-notificacion"
                        id="link-notificaciones"
                    >

                        <span class="campana">
                            🔔
                        </span>

                        <span>
                            Notificaciones
                        </span>

                        <span
                            id="contador-notificaciones"
                            class="contador-notificacion"
                            style="{{ $notificacionesPendientes > 0 ? 'display: inline-flex;' : 'display: none;' }}"
                        >
                            {{ $notificacionesPendientes }}
                        </span>

                    </a>

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        class="form-logout"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn-salir"
                        >
                            Cerrar sesión
                        </button>

                    </form>

                @endauth


                @guest

                    <a href="{{ $rutaInicio }}">
                        Inicio
                    </a>

                @endguest

            </nav>

        </div>

    </header>


    <main class="contenedor">
        @yield('content')
    </main>


    <footer class="footer">

        Sistema Municipal de Soporte TI -
        Sistema interno de requerimientos informáticos

    </footer>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

    <script
        src="https://cdn.jsdelivr.net/npm/sweetalert2@11"
    ></script>


    @if(session('success'))

        <script>
            Swal.fire({
                icon: 'success',
                title: 'Operación realizada',
                text: @json(session('success')),
                confirmButtonText: 'Aceptar'
            });
        </script>

    @endif


    @if(session('error'))

        <script>
            Swal.fire({
                icon: 'error',
                title: 'Ocurrió un problema',
                text: @json(session('error')),
                confirmButtonText: 'Aceptar'
            });
        </script>

    @endif


    @auth

        <script>

            document.addEventListener(
                'DOMContentLoaded',
                function () {

                    const contador =
                        document.getElementById(
                            'contador-notificaciones'
                        );

                    const linkNotificaciones =
                        document.getElementById(
                            'link-notificaciones'
                        );

                    async function actualizarContadorNotificaciones() {

                        try {

                            const respuesta = await fetch(
                                "{{ route('notificaciones.contador') }}",
                                {
                                    headers: {
                                        'Accept': 'application/json',
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                }
                            );

                            if (!respuesta.ok) {
                                return;
                            }

                            const datos =
                                await respuesta.json();

                            const total =
                                Number(datos.total ?? 0);

                            if (total > 0) {

                                contador.textContent =
                                    total > 99
                                        ? '99+'
                                        : total;

                                contador.style.display =
                                    'inline-flex';

                                linkNotificaciones
                                    .classList
                                    .add(
                                        'tiene-notificaciones'
                                    );

                            } else {

                                contador.textContent =
                                    '0';

                                contador.style.display =
                                    'none';

                                linkNotificaciones
                                    .classList
                                    .remove(
                                        'tiene-notificaciones'
                                    );
                            }

                        } catch (error) {

                            console.log(
                                'No se pudo actualizar el contador de notificaciones.'
                            );
                        }
                    }

                    actualizarContadorNotificaciones();

                    setInterval(
                        actualizarContadorNotificaciones,
                        10000
                    );
                }
            );

        </script>

    @endauth


    @yield('scripts')

</body>
</html>