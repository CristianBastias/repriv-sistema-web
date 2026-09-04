<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>REPRIV - La Rioja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        /* CSS MODERNO DIRECTO */
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #ffffff;
            /* Espacio para que el menú fijo no tape nada */
            padding-top: 110px !important;
        }

        /* HEADER FIJO CON BORDE CELESTE */
        .header-institucional {
            background-color: #212529 !important;
            border-bottom: 4px solid #00d4ff !important; /* Borde celeste llamativo */
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            z-index: 9999 !important;
            padding: 15px 0 !important;
            box-shadow: 0 4px 20px rgba(0, 212, 255, 0.3) !important;
        }

        /* ESTILOS PARA LOS MENÚS DESPLEGABLES (HOVER DROPDOWN) */
        .dropdown-hover {
            position: relative;
        }

        .dropdown-hover .dropdown-menu-sm {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            padding: 8px 0;
            min-width: 220px;
            z-index: 1000;
            list-style: none;
            border-left: 4px solid #00d4ff;
        }

        .dropdown-hover:hover .dropdown-menu-sm {
            display: block;
        }

        .dropdown-item-text-custom {
            display: block;
            padding: 6px 16px;
            color: #212529;
            font-size: 0.85rem;
        }

        .dropdown-item-text-custom:hover {
            background-color: #f1f7fd;
            color: #003366;
        }

        /* TARJETAS CON TEMÁTICA REPRIV */
        .card {
            /* Color de fondo suave (Azul Hielo) */
            background-color: #f1f7fd !important;

            /* El borde celeste que da identidad al REPRIV */
            border-left: 5px solid #00d4ff !important;
            border-top: none !important;
            border-right: none !important;
            border-bottom: none !important;

            /* Sombreado profundo y moderno */
            box-shadow: 0 8px 20px rgba(0, 51, 102, 0.15) !important;

            border-radius: 12px !important;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease-in-out;
        }

        /* Efecto de elevación al pasar el mouse */
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 212, 255, 0.2) !important;
            background-color: #ffffff !important; /* Se aclara al interactuar */
        }

        /* AJUSTE PARA LOS TÍTULOS DENTRO DE LAS TARJETAS */
        .card-title, .card-header, .card i, .card h4, .card h5 {
            color: #003366 !important; /* Azul oscuro policial para los textos */
            font-weight: 700;
        }

        /* Esto le da un brillo sutil a los iconos de los valores cuando pasas el mouse por la tarjeta */
        .card:hover i {
            transform: scale(1.2);
            color: #00d4ff !important;
            transition: 0.3s;
        }

        .nav-link {
            color: #ffffff !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            font-size: 0.85rem;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: #00d4ff !important;
        }

        /* CLASE ACTIVA PARA LOS ENLACES INSTITUCIONALES */
        .nav-link.active-link {
            color: #00d4ff !important;
            font-weight: 700 !important;
        }

        /* BOTÓN BUSCADOR MODERNO */
        .btn-buscador {
            background: transparent !important;
            color: #00d4ff !important;
            border: 2px solid #00d4ff !important;
            border-radius: 50px !important;
            padding: 8px 25px !important;
            font-weight: bold !important;
            transition: 0.3s !important;
        }

        .btn-buscador:hover {
            background: #00d4ff !important;
            color: #212529 !important;
            box-shadow: 0 0 15px rgba(0, 212, 255, 0.6) !important;
        }

        .btn-buscador.active-buscador {
            background: #00d4ff !important;
            color: #212529 !important;
            box-shadow: 0 0 15px rgba(0, 212, 255, 0.6) !important;
        }

        main { flex: 1; }

        footer {
            background-color: #212529;
            color: white;
            padding: 60px 0;
            border-top: 4px solid #343a40;
            text-align: center;
        }
    </style>
    @stack('styles')
</head>

<body>

    <style>
    /* Este es el bloque que hace la magia responsiva */
    @media (max-width: 991px) {
        .header-institucional img {
            height: 45px !important; /* Achica los logos en móvil */
        }

        .navbar-nav {
            background-color: #003366; /* Mantiene el color azul en el desplegable */
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .nav-link {
            color: white !important;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .nav-link.active-link {
            color: #00d4ff !important;
        }

        /* Fuerza a que el icono de la hamburguesa sea blanco y tenga fondo sutil */
        .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.5) !important;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E") !important;
        }
    }
    </style>

    <header class="header-institucional">
      <div class="container">
        <div class="row align-items-center d-flex flex-wrap">

            <div class="col-lg-2 col-6">
                <img src="{{ asset('/images/escudo-policia-orig.png') }}" alt="Policía" style="height: 50px;" class="img-fluid">
            </div>

            <div class="col-lg-2 col-6 text-end order-lg-3">
                <img src="{{ asset('/images/escudo_repriv_trans.png') }}" alt="REPRIV" style="height: 50px;" class="img-fluid">
            </div>

            <div class="col-lg-8 col-12 mt-3 mt-lg-0 order-lg-2">
                <nav class="navbar navbar-expand-lg justify-content-center">
                    <button class="navbar-toggler mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#navInstitucional" style="border-color: rgba(255,255,255,0.1);">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-center" id="navInstitucional">
                        <ul class="navbar-nav align-items-center">

                            <!-- Menú Inicio con Desplegable -->
                            <li class="nav-item dropdown-hover">
                                <a class="nav-link px-3 {{ request()->routeIs('inicio') ? 'active-link' : '' }}" href="{{ route('inicio') }}">Inicio</a>
                                <ul class="dropdown-menu-sm shadow-sm">
                                    <li><span class="dropdown-item-text-custom fw-bold text-dark">Contenido del módulo:</span></li>
                                    <li><span class="dropdown-item-text-custom">¿Qué es el REPRIV?</span></li>
                                    <li><span class="dropdown-item-text-custom">Nuestra identidad</span></li>
                                    <li><span class="dropdown-item-text-custom">Información de contactos</span></li>
                                </ul>
                            </li>

                             <!-- Menú Interés Ciudadano con Desplegable -->
                            <li class="nav-item dropdown-hover">
                                <a class="nav-link px-3 {{ request()->routeIs('interes-ciudadano') ? 'active-link' : '' }}" href="{{ route('interes-ciudadano') }}">Interés Ciudadano</a>
                                <ul class="dropdown-menu-sm shadow-sm">
                                    <li><span class="dropdown-item-text-custom fw-bold text-dark">Servicios disponibles:</span></li>
                                    <li><span class="dropdown-item-text-custom">Guía para el ciudadano</span></li>
                                    <li><span class="dropdown-item-text-custom">Novedades</span></li>
                                    <li><span class="dropdown-item-text-custom">Información en Gral.</span></li>
                                    <li><span class="dropdown-item-text-custom">Documentación y formularios (PDF)</span></li>
                                    <li><span class="dropdown-item-text-custom">Buzón de Consultas</span></li>
                                </ul>
                            </li>

                            <!-- Menú Empresas con Desplegable -->
                            <li class="nav-item dropdown-hover">
                                <a class="nav-link px-3 {{ request()->routeIs('portal.empresas') ? 'active-link' : '' }}" href="{{ route('portal.empresas') }}">Gestión de Empresas</a>
                                <ul class="dropdown-menu-sm shadow-sm">
                                    <li><span class="dropdown-item-text-custom fw-bold text-dark">Servicios disponibles:</span></li>
                                    <li><span class="dropdown-item-text-custom">Formulario para presincripcion de empresas</span></li>
                                    <li><span class="dropdown-item-text-custom">Gestión Empresarial (Panel Corporativo)</span></li>

                                </ul>
                            </li>

                            <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                                <a class="btn btn-buscador text-nowrap {{ request()->routeIs('buscador*') ? 'active-buscador' : '' }}" href="{{ route('buscador.index') }}">BUSCADOR DE EMPRESAS</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

        </div>
      </div>
    </header>

    <main>
        @yield('content')
    </main>

    <div class="py-5"></div>

    <footer class="mt-5">
        <div class="container">
            <p class="mb-1"><strong>REPRIV</strong> - Registro Provincial de Empresas de Seguridad Privada</p>
            <p class="small opacity-50">Policía de la Provincia de La Rioja</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
