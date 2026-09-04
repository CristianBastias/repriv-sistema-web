<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Empresa - REPRIV</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            padding-top: 80px;
            background-color: #f4f7f6;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        .navbar-brand img {
            max-height: 40px;
        }
    </style>
</head>
<body>
    <!-- Barra de Navegación Moderna e Institucional -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('inicio') }}">
                <img src="{{ asset('/images/escudo_repriv_trans.png') }}" alt="Escudo REPRIV" style="max-height: 60px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));">
                <span>REPRIV <span class="text-primary fw-light"></span></span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth('empresa')
                        <li class="nav-item text-white-50 small me-3">
                            <i class="bi bi-shield-check text-success me-1"></i> Sesión Activa
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a href="{{ route('inicio') }}" class="btn btn-outline-danger btn-sm px-3">
                            <i class="bi bi-box-arrow-right me-1"></i> Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer Institucional -->
    <footer style="background-color: #121213; color: #f9f9fd; border-top: 4px solid #b58d3d;" class="py-4 mt-auto">
    <div class="container text-center">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 text-center">
                <small class="text-white-50">
                    &copy; {{ date('Y') }} Regsitro Provincial de Empresas de Seguridad Privada<br> Policia de la Provincia de La Rioja
                </small>
            </div>
        </div>
    </div>
</footer>
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
