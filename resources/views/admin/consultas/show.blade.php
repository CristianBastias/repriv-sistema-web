@extends('layouts.admin')

@section('content')
<style>
    .bg-animated {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2;
        background-image: url('{{ asset('/images/repriv2_cap.jpg') }}'); background-size: cover; background-position: center;
    }
    .bg-overlay {
        position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1;
        background: linear-gradient(135deg, rgba(20, 35, 85, 0.65), rgba(40, 60, 105, 0.55));
    }
    .icon-box-header {
        width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;
        border-radius: 12px; font-size: 1.6rem; background: rgba(181, 141, 61, 0.1); border: 2px solid #b58d3d; color: #b58d3d;
        box-shadow: 0 4px 12px rgba(181, 141, 61, 0.15);
    }
    .glass-card-soft {
        background: rgba(255, 255, 255, 0.07) !important; backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.12) !important; border-radius: 12px;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
    }
    .hover-glow-light { transition: all 0.3s ease !important; }
    .hover-glow-light:hover {
        background-color: #ffffff !important; color: #0f172a !important;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.8) !important; transform: translateY(-2px);
    }
    .hover-glow-success { transition: all 0.3s ease !important; }
    .hover-glow-success:hover {
        background-color: #198754 !important; color: #ffffff !important;
        box-shadow: 0 0 15px rgba(25, 135, 84, 0.8) !important; transform: translateY(-2px);
    }
</style>

<div class="bg-animated"></div>
<div class="bg-overlay"></div>

<!-- Contenedor principal con ancho optimizado y responsivo -->
<div class="container py-4" style="max-width: 1250px;">

    <!-- Encabezado de la Sección con Icono-->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-lg-7 d-flex align-items-center gap-3">
            <div class="icon-box-header flex-shrink-0">
                <i class="bi bi-chat-square-text-fill"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-white" style="letter-spacing: 0.5px;">REPRIV - Panel Admin</h3>
                <p class="mb-0 text-white-50 small fw-medium">Detalle de Consulta Ciudadana</p>
            </div>
        </div>

        <!-- Botón de Volver compacto arriba a la derecha -->
        <div class="col-lg-5 d-flex justify-content-lg-end align-items-center">
            <div class="p-2 glass-card-soft d-inline-block">
                <a href="{{ route('admin.consultas.index') }}" class="btn btn-sm btn-light border-0 shadow-sm d-flex align-items-center gap-1 px-3 py-2 fw-semibold hover-glow-light" style="font-size: 0.8rem; color: #334155; border-radius: 8px;">
                    <i class="bi bi-arrow-left"></i> Volver a la Bandeja
                </a>
            </div>
        </div>
    </div>

    <!-- Estructura en paralelo idéntica al padrón institucional -->
    <div class="row g-4">

        <!-- Columna Izquierda: Información Principal de la Consulta -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg bg-white overflow-hidden" style="border-radius: 12px;">
                <div class="card-header py-3 px-4 fw-bold text-white border-0 d-flex align-items-center" style="background-color: #040723; font-size: 0.95rem;">
                    <i class="bi bi-chat-left-text me-2" style="color: #b58d3d;"></i> Información del Mensaje
                </div>
                <div class="card-body p-4 text-dark">
                    <div class="row g-4">
                        {{-- Información del Remitente --}}
                        <div class="col-md-6">
                            <label class="text-secondary small text-uppercase fw-bold mb-1 d-block">Remitente</label>
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle d-flex align-items-center justify-content-center me-3 border shadow-sm" style="width: 45px; height: 45px; background-color: rgba(181, 141, 61, 0.1); border-color: #b58d3d !important; color: #b58d3d;">
                                    <i class="bi bi-person fs-4"></i>
                                </div>
                                <p class="fs-5 fw-bold text-dark mb-0">{{ $consulta->nombre_remitente ?? 'Sin nombre registrado' }}</p>
                            </div>
                        </div>

                        {{-- Correo Electrónico --}}
                        <div class="col-md-6">
                            <label class="text-secondary small text-uppercase fw-bold mb-1 d-block">Correo de Contacto</label>
                            <p class="fs-5 mb-0 pt-1">
                                @if(!empty($consulta->contacto))
                                    <span class="fw-bold text-decoration-underline" style="color: #1e3a8a;"><i class="bi bi-envelope-at me-1"></i>{{ $consulta->contacto }}</span>
                                @else
                                    <span class="text-danger small"><i class="bi bi-exclamation-circle me-1"></i>No proporcionado</span>
                                @endif
                            </p>
                        </div>

                        {{-- Fecha y Hora de Envío --}}
                        <div class="col-12">
                            <hr class="border-secondary opacity-25 my-2">
                            <label class="text-secondary small text-uppercase fw-bold mb-1 d-block">Fecha y Hora de Recepción</label>
                            <div class="d-flex align-items-center text-dark p-3 rounded-3 border border-secondary border-opacity-25 shadow-sm" style="background-color: #f8fafc;">
                                <i class="bi bi-calendar3 fs-4 me-3" style="color: #b58d3d;"></i>
                                <div>
                                    <span class="fs-5 fw-bold">{{ $consulta->created_at?->format('d/m/Y H:i') ?? 'Fecha no disponible' }}</span>
                                    <span class="text-muted small d-block">Registrado oficialmente en el sistema</span>
                                </div>
                            </div>
                        </div>

                        {{-- Mensaje --}}
                        <div class="col-12">
                            <label class="text-secondary small text-uppercase fw-bold mb-2 d-block">Mensaje / Consulta:</label>
                            <div class="p-4 rounded-4 border border-secondary border-opacity-25 text-dark shadow-sm" style="background-color: #f8fafc; white-space: pre-wrap; font-size: 1.05rem; line-height: 1.6;">
                                {{ $consulta->mensaje ?? 'Este mensaje no tiene contenido de texto.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Bloque lateral de Acciones -->
        <div class="col-lg-4">
            <!-- Tarjeta informativa superior -->
            <div class="card border-0 shadow-lg bg-white overflow-hidden mb-4" style="border-radius: 12px;">
                <div class="card-header py-3 px-4 fw-bold text-white border-0" style="background-color: #040723; font-size: 0.95rem;">Opciones de Gestión</div>
                <div class="card-body text-center py-4 text-muted small">
                    Puede responder de forma directa al correo del ciudadano o regresar al listado principal.
                </div>
            </div>

            <!-- Botonera lateral -->
            <div class="card border-0 shadow-lg bg-white p-3" style="border-radius: 12px;">
                <div class="d-grid gap-2">
                    @if(!empty($consulta->contacto))
                        {{-- Botón Responder directamente --}}
                        <a href="{{ route('admin.consultas.responder', $consulta->id) }}" class="btn btn-sm text-white fw-bold shadow-sm py-2 hover-glow-success d-flex align-items-center justify-content-center gap-1" style="background-color: #198754; border-radius: 8px; font-size: 0.85rem;">
                            <i class="bi bi-send-fill"></i> <span>Responder directamente</span>
                        </a>
                    @endif

                    {{-- Botón Volver a la Lista --}}
                    <a href="{{ route('admin.consultas.index') }}" class="btn btn-sm text-secondary fw-bold shadow-sm py-2 hover-glow-light border d-flex align-items-center justify-content-center gap-1" style="background-color: #f8fafc; border-radius: 8px; font-size: 0.85rem;">
                        <i class="bi bi-arrow-left"></i> <span>Volver a la Lista</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
