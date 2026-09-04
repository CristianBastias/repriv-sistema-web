@extends('layouts.admin')

@section('content')
<style>
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
    .icon-box-header {
        width: 60px; height: 60px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 12px; font-size: 1.6rem;
        background: rgba(181, 141, 61, 0.1);
        border: 2px solid #b58d3d; color: #b58d3d;
        box-shadow: 0 4px 12px rgba(181, 141, 61, 0.15);
    }
    .glass-card-soft {
        background: rgba(255, 255, 255, 0.07) !important;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.12) !important;
        border-radius: 12px;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
    }
    .hover-glow-gold { transition: all 0.3s ease !important; }
    .hover-glow-gold:hover {
        background-color: #d4af37 !important; border-color: #f3e5ab !important; color: #ffffff !important;
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.9) !important; transform: translateY(-2px);
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
    .form-control-custom {
        background-color: #ffffff !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        color: #0f172a !important;
        font-weight: 500;
        font-size: 0.85rem;
        border-radius: 8px;
    }
    .form-control-custom:focus {
        border-color: #b58d3d !important;
        box-shadow: 0 0 12px rgba(181, 141, 61, 0.5) !important;
    }
</style>

<div class="bg-animated"></div>
<div class="bg-overlay"></div>

<div class="container py-4" style="max-width: 1250px;">
    <!-- Encabezado de la Sección con Icono -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-lg-7 d-flex align-items-center gap-3">
            <div class="icon-box-header flex-shrink-0">
                <i class="bi bi-reply-fill"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-white" style="letter-spacing: 0.5px;">REPRIV - Panel Admin</h3>
                <p class="mb-0 text-white-50 small fw-medium">Redacción de Respuesta Ciudadana</p>
            </div>
        </div>
        <div class="col-lg-5 d-flex justify-content-lg-end align-items-center">
            <div class="p-2 glass-card-soft d-inline-block">
                <span class="badge px-3 py-2 fw-semibold text-white shadow-sm" style="background-color: rgba(181, 141, 61, 0.2); border: 1px solid #b58d3d; font-size: 0.8rem;">
                    <i class="bi bi-envelope-at me-1" style="color: #b58d3d;"></i> Correo Oficial REPRIV
                </span>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Formulario principal de respuesta (Columna Izquierda) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg bg-white overflow-hidden" style="border-radius: 12px;">
                <div class="card-header py-3 px-4 fw-bold text-white border-0" style="background-color: #040723; font-size: 0.95rem;">
                    <i class="bi bi-reply-fill me-2" style="color: #b58d3d;"></i> Redactar Respuesta para: {{ $consulta->nombre_remitente }}
                </div>
                <div class="card-body p-4 text-dark">
                    <form action="{{ route('admin.consultas.enviar', $consulta->id) }}" method="POST" id="formResponder">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary small">Para:</label>
                            <div class="input-group">
                                <span class="input-group-text text-white border-0" style="background-color: #040723;"><i class="bi bi-envelope"></i></span>
                                <input type="text" class="form-control form-control-custom py-2 px-3 shadow-sm fw-semibold" value="{{ $consulta->contacto }}" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary small">Asunto:</label>
                            <input type="text" name="asunto" class="form-control form-control-custom py-2 px-3 shadow-sm" value="Respuesta a su consulta: {{ $consulta->nombre_remitente }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold text-secondary small">Mensaje:</label>
                            <textarea name="cuerpo" class="form-control form-control-custom py-2 px-3 shadow-sm" rows="8" required placeholder="Escribe aquí tu respuesta..."></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Bloque lateral de Acciones y Botonera -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg bg-white overflow-hidden mb-4" style="border-radius: 12px;">
                <div class="card-header py-3 px-4 fw-bold text-white border-0" style="background-color: #040723; font-size: 0.95rem;">Envío de Correo</div>
                <div class="card-body text-center py-4 text-muted small">
                    Asegúrese de revisar el contenido del mensaje antes de proceder con el envío oficial al ciudadano.
                </div>
            </div>

            <div class="card border-0 shadow-lg bg-white p-3" style="border-radius: 12px;">
                <div class="d-grid gap-2">
                    <button type="submit" form="formResponder" class="btn btn-sm text-white fw-bold shadow-sm py-2 hover-glow-success d-flex align-items-center justify-content-center gap-1" style="background-color: #198754; border-radius: 8px; font-size: 0.85rem;" title="Enviar correo oficial">
                        <i class="bi bi-send-fill"></i> <span>Enviar Correo</span>
                    </button>

                    <a href="{{ route('admin.consultas.show', $consulta->id) }}" class="btn btn-sm text-secondary fw-bold shadow-sm py-2 hover-glow-light border d-flex align-items-center justify-content-center gap-1" style="background-color: #f8fafc; border-radius: 8px; font-size: 0.85rem;" title="Cancelar y volver">
                        <i class="bi bi-x-circle"></i> <span>Cancelar</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
