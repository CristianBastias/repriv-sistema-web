<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        /* Aumentamos el margen superior de 150px a 180px para dar más aire */
        @page {
            size: a4 portrait;
            margin: 180px 30px 40px 30px;
        }

        body { font-family: sans-serif; margin: 0; padding: 0; }

        header {
            position: fixed;
            top: -160px; /* Ajustado para compensar el margen superior */
            left: 0;
            right: 0;
            height: 140px; /* Espacio reservado para la imagen */
            text-align: center;
        }

        .header-img {
            width: 100%;
            height: auto;
            display: block;
        }

        main { margin-top: 10px; }
    </style>
</head>

<body>
    <header>
        <img src="{{ public_path('/images/encabezado1.png') }}" class="header-img">
    </header>

    <main>
    <main>
        @yield('content')
    </main>

</body>
</html>
