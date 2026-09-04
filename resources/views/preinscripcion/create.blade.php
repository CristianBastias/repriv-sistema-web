@extends('layouts.app')

@push('styles')
<style>
    body {
        background-color: #12161c !important;
        color: #ffffff !important;
    }

    /* Tarjetas estilo Panel Admin */
    .panel-box {
        background: #12161c;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        overflow: hidden;
    }

    .panel-box-header {
        background-color: #0f2c59;
        border-bottom: 2px solid #38bdf8;
        padding: 1rem 1.25rem;
        font-weight: bold;
        color: #ffffff;
    }

    .form-control:focus, .form-select:focus {
        border-color: #38bdf8 !important;
        box-shadow: 0 0 0 0.25rem rgba(56, 189, 248, 0.15) !important;
    }

    /* Efecto hover suave para botones */
    .btn-action-custom {
        transition: all 0.2s ease-in-out;
    }
    .btn-action-custom:hover {
        transform: translateY(-1px);
        filter: brightness(1.05);
    }
</style>
@endpush

@section('content')
<div class="container py-4">

    <!-- Alerta de éxito -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert" style="background-color: #d1e7dd; color: #0f5132;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('preinscripcion.store') }}" method="POST">
        @csrf

        <div class="row g-4">

            <!-- COLUMNA IZQUIERDA: Formulario principal de datos -->
            <div class="col-lg-8">
                <div class="panel-box bg-white text-dark h-100">
                    <div class="panel-box-header d-flex align-items-center text-white" style="background-color: #0f2c59;">
                        <i class="bi bi-shield-lock-fill me-2 text-info fs-5"></i>
                        <span>Formulario / Solicitud de Preinscripción</span>
                    </div>

                    <div class="card-body p-4 bg-white">
                        <div class="row g-3">
                            <!-- Razón Social -->
                            <div class="col-md-6">
                                <label for="nombre_razon_social" class="form-label fw-bold text-secondary small text-uppercase">Razón Social</label>
                                <input type="text" class="form-control bg-light border-secondary-subtle" id="nombre_razon_social" name="nombre_razon_social" placeholder="Ej. Seguridad Integral S.R.L." required>
                            </div>

                            <!-- CUIT -->
                            <div class="col-md-6">
                                <label for="cuit" class="form-label fw-bold text-secondary small text-uppercase">CUIT</label>
                                <input type="text" class="form-control bg-light border-secondary-subtle" id="cuit" name="cuit" placeholder="Ej. 30-XXXXXXXX-X" required>
                            </div>

                            <!-- Correo Electrónico -->
                            <div class="col-12">
                                <label for="email" class="form-label fw-bold text-secondary small text-uppercase">Correo Electrónico</label>
                                <input type="email" class="form-control bg-light border-secondary-subtle" id="email" name="email" placeholder="empresa@dominio.com" required>
                            </div>

                            <!-- Teléfono -->
                            <div class="col-md-6">
                                <label for="telefono" class="form-label fw-bold text-secondary small text-uppercase">Teléfono de Contacto</label>
                                <input type="text" class="form-control bg-light border-secondary-subtle" id="telefono" name="telefono" placeholder="Ej. 3804XXXXXX" required>
                            </div>

                            <!-- Domicilio -->
                            <div class="col-md-6">
                                <label for="domicilio" class="form-label fw-bold text-secondary small text-uppercase">Domicilio Legal / Comercial</label>
                                <input type="text" class="form-control bg-light border-secondary-subtle" id="domicilio" name="domicilio" placeholder="Calle, Número, Barrio, Ciudad" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLUMNA DERECHA: Panel de Opciones y Acciones -->
            <div class="col-lg-4">
                <div class="panel-box bg-white text-dark h-100 d-flex flex-column justify-content-between">
                    <div>
                        <div class="panel-box-header text-white" style="background-color: #0f2c59;">
                            <i class="bi bi-gear-fill me-2 text-info"></i> Opciones de Envío
                        </div>
                        <div class="card-body p-4 bg-white">
                            <p class="text-muted small mb-0">
                                Complete los datos requeridos de la entidad y confirme la solicitud para generar la constancia oficial de preinscripción en el sistema REPRIV.
                            </p>
                        </div>
                    </div>

                    <!-- Bloque inferior de botones idéntico al panel admin -->
                    <div class="p-4 bg-white border-top border-light">
                        <div class="d-grid gap-2">
                            <!-- Botón Enviar con el tono dorado/ocre característico o cian institucional -->
                            <button type="submit" class="btn text-white fw-bold py-2 btn-action-custom shadow-sm" style="background-color: #0f2c59; border: 1px solid #38bdf8;">
                                <i class="bi bi-check-circle-fill me-2 text-info"></i> Enviar Preinscripción
                            </button>

                            <!-- Botón Cancelar / Volver -->
                            <a href="{{ route('portal.empresas') }}" class="btn btn-outline-secondary py-2 btn-action-custom">
                                <i class="bi bi-x-circle me-2"></i> Cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

</div>
@endsection
