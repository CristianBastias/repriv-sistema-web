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

    /* Icono superior con carácter policial y dorado heráldico */
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

    /* --- EFECTOS HOVER INTENSIFICADOS --- */
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

    /* Estilos personalizados para inputs y selectores */
    .form-control-custom, .form-select-custom {
        background-color: #ffffff !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        color: #0f172a !important;
        font-weight: 500;
        font-size: 0.85rem;
        border-radius: 8px;
    }
    .form-control-custom::placeholder {
        color: #94a3b8;
    }
    .form-control-custom:focus, .form-select-custom:focus {
        border-color: #b58d3d !important;
        box-shadow: 0 0 12px rgba(181, 141, 61, 0.5) !important;
    }
</style>

<div class="bg-animated"></div>
<div class="bg-overlay"></div>

<!-- Contenedor principal con ancho optimizado y responsivo -->
<div class="container py-4" style="max-width: 1250px;">

    <!-- Encabezado unificado con Icono -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-lg-7 d-flex align-items-center gap-3">
            <div class="icon-box-header flex-shrink-0">
                <i class="bi bi-building-add"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-white" style="letter-spacing: 0.5px;">
                    REPRIV - Panel Admin
                </h3>
                <p class="mb-0 text-white-50 small fw-medium">Alta de Nueva Empresa de Seguridad Privada</p>
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

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4" style="background-color: #f8d7da; color: #842029;">
            <ul class="mb-0 small fw-semibold">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">
        <!-- Columna Izquierda: Formulario Principal -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg bg-white overflow-hidden" style="border-radius: 12px;">
                <div class="card-header py-3 px-4 fw-bold text-white border-0" style="background-color: #040723; font-size: 0.95rem;">
                    <i class="bi bi-plus-circle me-2" style="color: #b58d3d;"></i> Registrar Nueva Empresa en el Padrón
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('empresas.store') }}" method="POST" id="formCrearEmpresa">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-secondary small">Razón Social</label>
                                <input type="text" name="nombre_empresa" class="form-control form-control-custom py-2 px-3 shadow-sm" value="{{ old('nombre_empresa') }}" required placeholder="Ej: Seguridad Integral S.A.">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-secondary small">CUIT</label>
                                <input type="text" name="cuit" class="form-control form-control-custom py-2 px-3 shadow-sm" value="{{ old('cuit') }}" placeholder="Ej: 30-XXXXXXXX-X">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-secondary small">Propietario / Encargado</label>
                                <input type="text" name="propietario" class="form-control form-control-custom py-2 px-3 shadow-sm" value="{{ old('propietario') }}" placeholder="Nombre y Apellido">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-secondary small">Ubicación / Localidad</label>
                                <input type="text" name="ubicacion_localidad" class="form-control form-control-custom py-2 px-3 shadow-sm" value="{{ old('ubicacion_localidad') }}" placeholder="Ej: La Rioja Capital">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold text-secondary small">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control form-control-custom py-2 px-3 shadow-sm" value="{{ old('email') }}" required placeholder="correo@empresa.com">
                            </div>
                        </div>

                        <div class="mb-3 mt-3">
                            <label class="form-label fw-bold text-secondary small">Estado Inicial del Trámite</label>
                            <select name="condicion_actual" class="form-select form-select-custom py-2 px-3 shadow-sm">
                                <option value="En Trámite" {{ old('condicion_actual') == 'En Trámite' ? 'selected' : '' }}>En Trámite</option>
                                <option value="Habilitada" {{ old('condicion_actual') == 'Habilitada' ? 'selected' : '' }}>Habilitada</option>
                                <option value="Inhabilitada" {{ old('condicion_actual') == 'Inhabilitada' ? 'selected' : '' }}>Inhabilitada</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Bloque lateral de acciones -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg bg-white overflow-hidden mb-4" style="border-radius: 12px;">
                <div class="card-header py-3 px-4 fw-bold text-white border-0" style="background-color: #040723; font-size: 0.95rem;">Instrucciones</div>
                <div class="card-body text-center py-4 text-muted small">
                    Complete los campos obligatorios para dar de alta una nueva entidad de seguridad privada en el sistema oficial.
                </div>
            </div>

            <div class="card border-0 shadow-lg bg-white p-3" style="border-radius: 12px;">
                <div class="d-grid gap-2">
                    <button type="submit" form="formCrearEmpresa" class="btn btn-sm text-white fw-bold shadow-sm py-2 hover-glow-gold d-flex align-items-center justify-content-center gap-1" style="background-color: #b58d3d; border-radius: 8px; font-size: 0.85rem;" title="Guardar nuevo registro">
                        <i class="bi bi-check-lg"></i> <span>Guardar Registro</span>
                    </button>
                    <a href="{{ route('empresas.index') }}" class="btn btn-sm btn-light fw-bold shadow-sm py-2 hover-glow-light d-flex align-items-center justify-content-center gap-1" style="background-color: #f8f9fa; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.85rem; color: #475569;" title="Cancelar registro">
                        <i class="bi bi-x-lg"></i> <span>Cancelar</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
