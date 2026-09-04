@extends('layouts.admin')

@section('content')
<style>
    /* Fondo institucional limpio y corporativo */
    .bg-animated {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%; z-index: -2;
        background-image: url('{{ asset('/images/repriv2_cap.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .bg-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%; z-index: -1;
        background: linear-gradient(135deg, rgba(20, 35, 85, 0.65), rgba(40, 60, 105, 0.55));
    }

    /* Icono superior */
    .icon-box-header {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.6rem;
        background: rgba(181, 141, 61, 0.1);
        border: 2px solid #b58d3d;
        color: #b58d3d;
        box-shadow: 0 4px 12px rgba(181, 141, 61, 0.15);
    }

    /* Contenedores translúcidos refinados */
    .glass-card-soft {
        background: rgba(255, 255, 255, 0.07) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        border-radius: 12px;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
    }

    /* Badges de Estado estables */
    .badge-status {
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.72rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .badge-habilitada {
        background-color: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
    }
    .badge-tramite {
        background-color: #fff3cd;
        color: #664d03;
        border: 1px solid #ffecb5;
    }
    .badge-inhabilitada {
        background-color: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
    }

    /* --- EFECTOS HOVER INTENSIFICADOS --- */
    .hover-glow-primary {
        transition: all 0.3s ease !important;
    }
    .hover-glow-primary:hover {
        background-color: #1e40af !important;
        color: #ffffff !important;
        box-shadow: 0 0 18px rgba(30, 64, 175, 0.8) !important;
        transform: translateY(-2px);
    }

    .hover-glow-gold {
        transition: all 0.3s ease !important;
    }
    .hover-glow-gold:hover {
        background-color: #d4af37 !important;
        border-color: #f3e5ab !important;
        color: #ffffff !important;
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.9) !important;
        transform: translateY(-2px);
    }

    .hover-glow-light {
        transition: all 0.3s ease !important;
    }
    .hover-glow-light:hover {
        background-color: #ffffff !important;
        color: #0f172a !important;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.8) !important;
        transform: translateY(-2px);
    }
</style>

<div class="bg-animated"></div>
<div class="bg-overlay"></div>

<!-- Contenedor con ancho optimizado y responsivo -->
<div class="container py-4" style="max-width: 1250px;">

    <!-- Encabezado de la Ficha Técnica -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-lg-7 d-flex align-items-center gap-3">
            <div class="icon-box-header flex-shrink-0">
                <i class="bi bi-file-earmark-text"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-white" style="letter-spacing: 0.5px;">
                    REPRIV - Panel Admin
                </h3>
                <p class="mb-0 text-white-50 small fw-medium">Ficha Técnica de Empresa (ID: #{{ $empresa->id }})</p>
            </div>
        </div>

        <!-- Botón de Volver arriba a la derecha -->
        <div class="col-lg-5 d-flex justify-content-lg-end align-items-center">
            <div class="p-2 glass-card-soft d-inline-block">
                <a href="{{ route('empresas.index') }}" class="btn btn-sm btn-light border-0 shadow-sm d-flex align-items-center gap-1 px-3 py-2 fw-semibold hover-glow-light" style="font-size: 0.8rem; color: #334155; border-radius: 8px;" title="Volver al listado">
                    <i class="bi bi-arrow-left"></i> Volver a Empresas
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background-color: #d1e7dd; color: #0f5132;">
            <i class="bi bi-check-circle-fill me-2"></i> <span class="small fw-semibold">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Columna de Información General con diseño limpio -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg bg-white overflow-hidden" style="border-radius: 12px;">
                <div class="card-header py-3 px-4 fw-bold text-white border-0" style="background-color: #040723; font-size: 0.95rem;">
                    <i class="bi bi-info-circle me-2" style="color: #b58d3d;"></i> Información General del Empresa.
                </div>
                <div class="card-body p-4 text-dark">
                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-4 text-secondary fw-bold small"><i class="bi bi-building me-1"></i> Razón Social:</div>
                        <div class="col-sm-8 fw-bold text-dark" style="font-size: 0.95rem;">{{ $empresa->nombre_empresa }}</div>
                    </div>
                    <hr class="border-secondary opacity-10">
                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-4 text-secondary fw-bold small"><i class="bi bi-card-text me-1"></i> CUIT:</div>
                        <div class="col-sm-8 fw-medium text-dark">{{ $empresa->cuit ?? 'No cargado' }}</div>
                    </div>
                    <hr class="border-secondary opacity-10">
                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-4 text-secondary fw-bold small"><i class="bi bi-person me-1"></i> Propietario:</div>
                        <div class="col-sm-8 fw-medium text-dark">{{ $empresa->propietario ?? 'No especificado' }}</div>
                    </div>
                    <hr class="border-secondary opacity-10">
                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-4 text-secondary fw-bold small"><i class="bi bi-geo-alt me-1"></i> Ubicación:</div>
                        <div class="col-sm-8 fw-medium text-dark">{{ $empresa->ubicacion_localidad ?? 'No especificada' }}</div>
                    </div>
                    <hr class="border-secondary opacity-10">
                    <div class="row mb-3 align-items-center">
                        <div class="col-sm-4 text-secondary fw-bold small"><i class="bi bi-telephone me-1"></i> Teléfono:</div>
                        <div class="col-sm-8 fw-medium text-dark">{{ $empresa->telefono ?? 'No disponible' }}</div>
                    </div>
                    <hr class="border-secondary opacity-10">
                    <div class="row align-items-center">
                        <div class="col-sm-4 text-secondary fw-bold small"><i class="bi bi-envelope me-1"></i> Email:</div>
                        <div class="col-sm-8 fw-medium text-primary">{{ $empresa->email }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna lateral: Estado y Acciones -->
        <div class="col-lg-4">
            <!-- Estado del Trámite -->
            <div class="card border-0 shadow-lg bg-white overflow-hidden mb-4" style="border-radius: 12px;">
                <div class="card-header py-3 px-4 fw-bold text-white border-0" style="background-color: #040723; font-size: 0.95rem;">Estado de la Empresa</div>
                <div class="card-body text-center py-4">
                    @php
                        $estado = strtolower($empresa->condicion_actual ?? 'habilitada');
                    @endphp
                    @if($estado == 'habilitada')
                        <span class="badge-status badge-habilitada fs-6 px-4 py-2">Habilitada</span>
                    @elseif($estado == 'en trámite')
                        <span class="badge-status badge-tramite fs-6 px-4 py-2">En Trámite</span>
                    @else
                        <span class="badge-status badge-inhabilitada fs-6 px-4 py-2">Inhabilitada</span>
                    @endif
                </div>
            </div>

            <!-- Botones de Acción Agrupados con hover brillante -->
            <div class="card border-0 shadow-lg bg-white p-3" style="border-radius: 12px;">
                <div class="d-grid gap-2">
                    <a href="{{ route('empresas.imprimir.ficha', $empresa->id) }}" class="btn btn-sm text-white fw-bold shadow-sm py-2 hover-glow-primary d-flex align-items-center justify-content-center gap-1" style="background-color: #1e3a8a; border-radius: 8px; font-size: 0.85rem;" target="_blank" title="Imprimir legajo oficial">
                        <i class="bi bi-printer"></i> <span>Imprimir Ficha</span>
                    </a>
                    <a href="{{ route('empresas.edit', $empresa->id) }}" class="btn btn-sm text-white fw-bold shadow-sm py-2 hover-glow-gold d-flex align-items-center justify-content-center gap-1" style="background-color: #b58d3d; border-radius: 8px; font-size: 0.85rem;" title="Editar registro">
                        <i class="bi bi-pencil-square"></i> <span>Editar Ficha</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
