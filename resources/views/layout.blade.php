<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MesaTI Municipal</title>

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
            background: linear-gradient(90deg, var(--morado-principal), var(--rojo-acento), var(--naranjo-acento));
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
            gap: 25px;
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

        .contenedor {
            width: 88%;
            max-width: 1150px;
            margin: 40px auto;
        }

        .grid-inicio {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 25px;
            align-items: start;
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
        }

        .acceso:hover {
            background: #7B5AC8;
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
        }

        .btn:hover {
            background: var(--morado-secundario);
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

        .footer {
            margin-top: 50px;
            padding: 20px;
            text-align: center;
            background: var(--morado-principal);
            color: white;
            font-size: 14px;
        }

        @media (max-width: 850px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .grid-inicio {
                grid-template-columns: 1fr;
            }

            .logo-link {
                flex-direction: column;
                gap: 8px;
            }

            .menu {
                gap: 15px;
            }
        }
    </style>
</head>

<body>

    <header>
        <div class="barra-superior">
            Sistema interno de soporte informático municipal
        </div>

        <div class="navbar">
            <div class="logo-contenedor">
                <a href="/" class="logo-link">
                    <img src="{{ asset('img/logo-municipal.png') }}" alt="Logo Municipal" class="logo-municipal">
                    <span>MesaTI Municipal</span>
                </a>
            </div>

            <nav class="menu">
                <a href="/">Inicio</a>
                <a href="/login">Login</a>
                <a href="/registro">Registro</a>
            </nav>
        </div>
    </header>

    <main class="contenedor">
        @yield('content')
    </main>

    <footer class="footer">
        MesaTI Municipal - Sistema interno de requerimientos informáticos
    </footer>

</body>
</html>