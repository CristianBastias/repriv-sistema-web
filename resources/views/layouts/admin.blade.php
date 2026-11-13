<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>REPRIV - Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #3c4169;
            color: #ffffff;
            padding-top: 135px !important;
        }
        .header-institucional {
            background-color: #212529 !important;
            border-bottom: 4px solid #00d4ff !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            z-index: 9999 !important;
            padding: 12px 0 !important;
            box-shadow: 0 4px 20px rgba(0, 212, 255, 0.3) !important;
        }

        .navbar-modulos {
            position: fixed !important;
            top: 74px !important;
            left: 0 !important;
            width: 100% !important;
            z-index: 9998 !important;
            background-color: #040723 !important;
            border-bottom: 2px solid #b58d3d !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
        }

        main { flex: 1; }

        footer {
            background-color: #212529 !important;
            color: #ffffff;
            padding: 30px 0;
            border-top: 4px solid #00d4ff !important;
            text-align: center;
            box-shadow: -4px 20px rgba(0, 0, 0, 0.3);
        }

        .header-institucional .btn-vista-publica:hover { background-color: #00d4ff !important; color: #040723 !important; box-shadow: 0 0 15px rgba(0, 212, 255, 0.7); transform: translateY(-2px); border-color: #00d4ff !important; }
        .header-institucional .btn-cerrar-sesion:hover { background-color: #dc3545 !important; color: #ffffff !important; box-shadow: 0 0 15px rgba(220, 53, 69, 0.6); transform: translateY(-2px); border-color: #dc3545 !important; }

        .navbar-modulos .nav-link {
            color: #ffffff !important;
            font-weight: 500;
            padding: 8px 16px !important;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
        }
        .navbar-modulos .nav-link:hover, .navbar-modulos .nav-link.active {
            background-color: rgba(181, 141, 61, 0.25) !important;
            color: #00d4ff !important;
            border: 1px solid rgba(181, 141, 61, 0.4);
        }
        .dropdown-menu {
            background-color: #040723 !important;
            border: 1px solid rgba(181, 141, 61, 0.3) !important;
        }
        .dropdown-item {
            color: #cbd5e1 !important;
        }
        .dropdown-item:hover {
            background-color: #b58d3d !important;
            color: #ffffff !important;
        }
    </style>
    @stack('styles')
</head>
<body>

    <header class="header-institucional">
      <div class="container-fluid px-4">
        <div class="row align-items-center">
            <div class="col-6 d-flex align-items-center gap-3">
                <img src="{{ asset('/images/logo-sistema-transp.png') }}" alt="Policía" style="height: 50px;" class="img-fluid">
                <h5 class="text-info m-0 fw-bold d-none d-sm-block" style="letter-spacing: 0.5px;">Panel Administrativo - Sistema REPRIV</h5>
            </div>
            <div class="col-6 d-flex align-items-center justify-content-end gap-2 flex-wrap">

                <!-- SECCIÓN DE PERFIL DE USUARIO (INTEGRADA EN EL ENCABEZADO) -->
                @auth
                <div class="dropdown">
                    <button class="btn btn-sm px-3 rounded-pill fw-semibold text-white dropdown-toggle d-flex align-items-center gap-1" type="button" id="userProfileDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border: 2px solid #b58d3d; background: rgba(181, 141, 61, 0.1); transition: all 0.3s ease;">
                        <i class="bi bi-person-circle text-warning"></i> {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="userProfileDropdown">
                        <li>
                            <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('profile.edit') }}">
                                <i class="bi bi-gear text-info"></i> Configuración de Perfil
                            </a>
                        </li>
                        
                        <!-- AQUÍ SE AGREGA LA OPCIÓN EXCLUSIVA PARA EL JEFE ADMINISTRATIVO -->
                        @if(Auth::user()->role === 'jefe_admin')
                        <li><hr class="dropdown-divider border-secondary"></li>
                        <li>
                            <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="{{ route('admin.usuarios.index') }}">
                                <i class="bi bi-people text-warning"></i> Gestión de Usuarios
                            </a>
                        </li>
                        @endif

                    </ul>
                </div>
                @endauth

                <!-- Botón Vista Pública -->
                <a href="{{ route('inicio') }}" target="_blank" class="btn btn-sm px-3 rounded-pill fw-semibold text-info d-flex align-items-center gap-1 btn-vista-publica" style="border: 2px solid #00d4ff; background: rgba(0, 212, 255, 0.05); transition: all 0.3s ease;">
                    <i class="bi bi-eye"></i> Vista Pública
                </a>

                <!-- Botón Cerrar Sesión -->
                <form action="{{ route('logout.admin') }}" method="POST" class="d-inline m-0">
                @csrf
                    <button type="submit" class="btn btn-sm px-3 rounded-pill fw-semibold text-danger d-flex align-items-center gap-1 btn-cerrar-sesion" style="border: 2px solid #dc3545; background: rgba(220, 53, 69, 0.05); transition: all 0.3s ease;">
                      <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
      </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-modulos">
        <div class="container" style="max-width: 1250px;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#submenuModulos" aria-controls="submenuModulos" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="submenuModulos">
                <ul class="navbar-nav gap-2 py-1">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('empresas.*') ? 'active text-info' : '' }}" href="{{ route('empresas.index') }}">
                            <i class="bi bi-building me-1"></i> Empresas
                        </a>
                    </li>

                   @php
                        $pendientesPre = \App\Models\Preinscripcion::where('estado', 'pendiente')->count();
                        $totalPrivados = \App\Models\DocumentoPrivado::where('categoria', 'privado')->where('estado', 'pendiente')->count();
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('auditoria.*') ? 'active text-info' : '' }}" href="#" id="navbarAuditoria" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-shield-check me-1"></i> Auditoría
                            @if($pendientesPre > 0)
                                <span class="badge bg-warning text-dark rounded-pill ms-1" style="font-size: 0.65rem;"><i class="bi bi-bell-fill"></i> {{ $pendientesPre }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu shadow-lg">
                            <li>
                                <a class="dropdown-item py-2 d-flex justify-content-between align-items-center" href="{{ route('auditoria.preinscripcion') }}">
                                    <span><i class="bi bi-check2-circle me-2"></i>Validar Preinscripción</span>
                                    @if($pendientesPre > 0)
                                        <span class="badge bg-warning text-dark rounded-pill" style="font-size: 0.65rem;"><i class="bi bi-bell-fill"></i> {{ $pendientesPre }}</span>
                                    @endif
                                </a>
                            </li>
                            <li><a class="dropdown-item py-2" href="{{ route('auditoria.aprobadas') }}"><i class="bi bi-list-check me-2"></i> Preinscripciones Aprobadas</a></li>
                        </ul>
                    </li>

                   @php
                        $totalPrivados = \App\Models\DocumentoPrivado::where('categoria', 'privado')->where('estado', 'pendiente')->count();
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('documentos.*') ? 'active text-info' : '' }}" href="#" id="navbarDocumentos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Documentos PDF
                            @if($totalPrivados > 0)
                                <span class="badge text-dark rounded-pill ms-1" style="font-size: 0.65rem; background-color: #b58d3d;"><i class="bi bi-bell-fill"></i> {{ $totalPrivados }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu shadow-lg">
                            <li><a class="dropdown-item py-2" href="{{ route('documentos.publicos') }}"><i class="bi bi-globe me-2"></i>Doc. PDF Públicos</a></li>
                            <li>
                                <a class="dropdown-item py-2 d-flex justify-content-between align-items-center" href="{{ route('documentos.privados') }}">
                                    <span><i class="bi bi-shield-lock me-2"></i>Doc. PDF Privados</span>
                                    @if($totalPrivados > 0)
                                        <span class="badge text-dark rounded-pill" style="font-size: 0.65rem; background-color: #b58d3d;"><i class="bi bi-bell-fill"></i> {{ $totalPrivados }}</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                    </li>

                    @php
                        $noLeidosMail = \App\Models\Consulta::where('leido', false)->count();
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.consultas.*') ? 'active text-info' : '' }} d-flex align-items-center gap-1" href="{{ route('admin.consultas.index') }}">
                            <div><i class="bi bi-envelope me-1"></i> Mail / Consultas</div>
                            @if($noLeidosMail > 0)
                                <span class="badge bg-warning text-dark rounded-pill ms-1" style="font-size: 0.65rem;"><i class="bi bi-bell-fill"></i> {{ $noLeidosMail }}</span>
                            @endif
                        </a>
                    </li>

                    <!-- MÓDULO: NOTICIAS -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.noticias.*') ? 'active text-info' : '' }} d-flex align-items-center gap-1" href="{{ route('admin.noticias.index') }}">
                            <div><i class="bi bi-newspaper me-1"></i> Noticias</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        @yield('content')
    </main>

    <footer>
        <div class="container">
            <p class="mb-1 fw-bold" style="letter-spacing: 0.5px;"><strong>REPRIV</strong> - Registro Provincial de Empresas de Seguridad Privada</p>
            <p class="small opacity-50 mb-0">Policía de la Provincia de La Rioja</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>