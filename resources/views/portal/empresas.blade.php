@extends('layouts.app')

@section('content')
<style>
    /* Fondo original respetado con capa sutil de profundidad institucional */
    body {
        background: linear-gradient(135deg, rgba(15, 23, 42, 0.7), rgba(30, 41, 59, 0.8)),
                    url("{{ asset('/images/fondo_repriv.png') }}") no-repeat center center fixed;
        background-size: cover;
    }

    /* Tarjetas principales con estilo Glassmorphism moderno y efectos de elevación */
    .card-glass-modern {
        background: rgba(255, 255, 255, 0.94) !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .card-glass-modern:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3) !important;
        background: rgba(255, 255, 255, 0.99) !important;
        border-color: rgba(56, 189, 248, 0.4);
    }

    /* Botón moderno de Preinscripción (Tono Azul Institucional Neón) */
    .btn-modern-primary {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%) !important;
        border: none !important;
        color: #ffffff !important;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 15px rgba(2, 132, 199, 0.35);
    }
    .btn-modern-primary:hover {
        background: linear-gradient(135deg, #0369a1 0%, #075985 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(2, 132, 199, 0.5);
        color: #ffffff !important;
    }

    /* Botón moderno de Autogestión (Tono Verde Esmeralda Neón) */
    .btn-modern-success {
        background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
        border: none !important;
        color: #ffffff !important;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 15px rgba(5, 150, 105, 0.35);
    }
    .btn-modern-success:hover {
        background: linear-gradient(135deg, #047857 0%, #065f46 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(5, 150, 105, 0.5);
        color: #ffffff !important;
    }

    /* Contenedores de iconos circulares con resplandor */
    .icon-circle-box {
        width: 80px;
        height: 80px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-bottom: 1.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }
</style>

<div class="container py-5" style="max-width: 1050px;">

    <!-- Encabezado superior opcional para dar contexto institucional moderno -->
    <div class="text-center mx-auto mb-5 p-4 rounded-4 shadow-lg bg-dark bg-opacity-50 backdrop-blur border border-secondary border-opacity-25">
        <span class="badge bg-info bg-opacity-25 text-info border border-info border-opacity-50 px-3 py-2 rounded-pill mb-2 fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 0.75rem;">
            <i class="bi bi-shield-lock-fill me-1"></i> REPRIV — La Rioja
        </span>
        <h2 class="fw-bold text-white mb-1" style="letter-spacing: -0.5px;">Portal de Gestión de Empresas</h2>
        <p class="text-white-50 mb-0 small">Seleccione una opción para iniciar su trámite o acceder al panel de autogestión.</p>
    </div>

    <!-- Tarjetas de Opciones en Paralelo -->
    <div class="row justify-content-center g-4">

        <!-- Tarjeta 1: Preinscripción Online -->
        <div class="col-md-6">
            <div class="card h-100 border-0 card-glass-modern shadow-lg rounded-4 overflow-hidden">
                <div class="card-body text-center p-5 d-flex flex-column justify-content-between">
                    <div>
                        <div class="icon-circle-box bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                            <i class="bi bi-file-earmark-plus-fill fs-2"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-3">Preinscripción Online</h3>
                        <p class="text-muted px-2 small lh-lg">¿Representa a una empresa nueva? Inicie su trámite de habilitación y registro oficial aquí.</p>
                    </div>
                    <div class="mt-4 pt-3">
                        <a href="{{ route('preinscripcion.create') }}" class="btn btn-modern-primary w-100 py-3 rounded-pill fw-bold text-uppercase shadow" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                            <i class="bi bi-arrow-right-circle me-2 fs-5 align-middle"></i> Iniciar Trámite
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta 2: Panel de Autogestión -->
        <div class="col-md-6">
            <div class="card h-100 border-0 card-glass-modern shadow-lg rounded-4 overflow-hidden">
                <div class="card-body text-center p-5 d-flex flex-column justify-content-between">
                    <div>
                        <div class="icon-circle-box bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                            <i class="bi bi-building-lock fs-2"></i>
                        </div>
                        <h3 class="fw-bold text-dark mb-3">Panel de Autogestión</h3>
                        <p class="text-muted px-2 small lh-lg">Acceso exclusivo para empresas registradas. Envíe documentación o consulte el estado de sus expedientes.</p>
                    </div>
                    <div class="mt-4 pt-3">
                        <a href="{{ route('login.empresa') }}" class="btn btn-modern-success w-100 py-3 rounded-pill fw-bold text-uppercase shadow" style="font-size: 0.85rem; letter-spacing: 0.5px;">
                            <i class="bi bi-box-arrow-in-right me-2 fs-5 align-middle"></i> Acceder al Sistema
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
