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
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--fondo-claro);
            color: var(--texto);
        }

        header {
            background: linear-gradient(
                90deg,
                var(--morado-principal),
                var(--rojo-acento),
                var(--naranjo-acento)
            );
            color: var(--blanco);
        }

        .barra-superior {
            padding: 10px 40px;
            background: var(--verde-principal);
            font-size: 14px;
            font-weight: bold;
        }

        .navbar {
            padding: 24px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .menu a {
            color: var(--blanco);
            text-decoration: none;
            margin-left: 20px;
            font-size: 15px;
            font-weight: bold;
        }

        .menu a:hover {
            text-decoration: underline;
        }

        main {
            padding: 40px;
        }

        .contenedor {
            max-width: 1150px;
            margin: auto;
        }

        .grid-inicio {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 25px;
            align-items: start;
        }

        .card {
            background: var(--blanco);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-top: 5px solid var(--verde-principal);
        }

        .card h1 {
            margin-top: 0;
            color: var(--morado-principal);
        }

        .card p {
            line-height: 1.4;
        }

        .btn {
            display: inline-block;
            background: var(--morado-principal);
            color: var(--blanco);
            padding: 12px 18px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 15px;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        .btn:hover {
            background: #4A327D;
        }

        .panel-accesos {
            background: var(--morado-principal);
            color: var(--blanco);
            padding: 25px;
            border-radius: 8px;
        }

        .panel-accesos h2 {
            margin-top: 0;
            font-size: 24px;
        }

        .acceso {
            display: block;
            background: var(--morado-secundario);
            color: var(--blanco);
            text-decoration: none;
            padding: 11px 14px;
            border-radius: 5px;
            margin-bottom: 12px;
            font-size: 15px;
            font-weight: bold;
        }

        .acceso:hover {
            background: var(--naranjo-acento);
        }

        input,
        select,
        textarea {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        footer {
            margin-top: 40px;
            padding: 20px;
            text-align: center;
            background: var(--morado-principal);
            color: var(--blanco);
            font-size: 14px;
        }

        @media (max-width: 800px) {
            .grid-inicio {
                grid-template-columns: 1fr;
            }

            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .menu a {
                margin-left: 10px;
                margin-right: 10px;
            }

            main {
                padding: 25px;
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
            <div class="logo">
                <a href="/" style="color: white; text-decoration: none;">
                    MesaTI Municipal
                </a>
        </div>

            <nav class="menu">
                <a href="/">Inicio</a>
                <a href="/login">Login</a>
                <a href="/registro">Registro</a>
            </nav>
        </div>
    </header>

    <main>
        <div class="contenedor">
            @yield('content')
        </div>
    </main>

    <footer>
        Plataforma de Requerimientos Informáticos Municipales
    </footer>

</body>
</html>