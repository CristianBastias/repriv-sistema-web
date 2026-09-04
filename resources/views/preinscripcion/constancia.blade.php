@extends('layouts.app')

@push('styles')
<style>
    body {
        background-color: #12161c !important;
        color: #333333 !important;
    }

    /* Tarjetas estilo Panel Admin / Módulo Moderno */
    .panel-box {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        position: relative;
    }

    .panel-box-header {
        background-color: #0f2c59;
        border-bottom: 2px solid #38bdf8;
        padding: 1rem 1.25rem;
        font-weight: bold;
        color: #ffffff;
    }

    /* Marca de agua centrada exactamente en la tarjeta */
    .marca-de-agua {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 350px;
        opacity: 0.35;
        pointer-events: none;
        z-index: 0;
    }

    .panel-content-relative {
        position: relative;
        z-index: 1;
    }

    .btn-action-custom {
        transition: all 0.2s ease-in-out;
    }
    .btn-action-custom:hover {
        transform: translateY(-1px);
        filter: brightness(1.05);
    }

    /* Estilos específicos para cuando se imprima en papel */
    @media print {
        body {
            background-color: #ffffff !important;
        }
        nav, footer, .btn-imprimir-container, .navbar {
            display: none !important;
        }
        .container {
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .panel-box {
            border: none !important;
            box-shadow: none !important;
        }
        .panel-box-header {
            background-color: #f8f9fa !important;
            color: #0f2c59 !important;
            border-bottom: 3px solid #0f2c59 !important;
        }
    }
</style>
@endpush

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert" style="background-color: #d1e7dd; color: #0f5132;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4 justify-content-center">

        <!-- COLUMNA PRINCIPAL: Datos y Código QR integrados -->
        <div class="col-lg-8">
            <div class="panel-box h-100">
                <img src="{{ asset('/images/escudo_repriv_trans.png') }}" class="marca-de-agua" alt="escudo_repriv">

                <div class="panel-box-header d-flex align-items-center">
                    <i class="bi bi-file-earmark-text-fill me-2 text-info fs-5"></i>
                    <span>Constancia de Preinscripción — REPRIV</span>
                </div>

                <div class="card-body p-4 p-md-5 panel-content-relative">
                    <div class="row align-items-center g-4">

                        <!-- Datos de la empresa a la izquierda -->
                        <div class="col-md-7">
                            <div class="mb-4">
                                <span class="text-muted small fw-bold text-uppercase d-block mb-1">Razón Social</span>
                                <span class="fs-4 fw-bold text-dark">{{ $data->nombre_razon_social }}</span>
                            </div>

                            <div class="mb-4">
                                <span class="text-muted small fw-bold text-uppercase d-block mb-1">CUIT</span>
                                <span class="fs-6 fw-semibold font-monospace text-secondary">{{ $data->cuit }}</span>
                            </div>

                            <div class="mb-0">
                                <span class="text-muted small fw-bold text-uppercase d-block mb-1">ID de Trámite Oficial</span>
                                <span class="badge bg-dark text-white px-3 py-2 fs-6 font-monospace shadow-sm">
                                    {{ str_pad($data->id, 5, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                        </div>

                        <!-- Código QR integrado a la derecha -->
                        <div class="col-md-5 text-center">
                            <div class="p-3 bg-light border rounded-3 shadow-sm d-inline-block">
                                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=REPRIV-TRAMITE-{{ $data->id }}" alt="QR de Validación" class="img-fluid rounded mb-2" style="width: 110px; height: 110px;">
                                <span class="d-block text-muted fw-bold text-uppercase" style="font-size: 0.7rem;">Código de Validación</span>
                            </div>
                        </div>

                        <!-- Aviso importante abajo -->
                        <div class="col-12 mt-3">
                            <div class="alert alert-info border-0 rounded-3 p-3 shadow-sm mb-0" role="alert" style="background-color: #e3f2fd; color: #0d47a1;">
                                <div class="small">
                                    <i class="bi bi-info-circle-fill me-2"></i> Presente esta constancia impresa en las oficinas del REPRIV junto a su documentación física para continuar con el trámite.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- COLUMNA LATERAL: Acciones Rápidas -->
        <div class="col-lg-4">
            <div class="panel-box h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="panel-box-header">
                        <i class="bi bi-gear-fill me-2 text-info"></i> Opciones de Trámite
                    </div>

                    <div class="card-body p-4 bg-white">
                        <p class="text-muted small mb-0">
                            Utilice el botón de impresión para obtener su constancia en papel o guardarla en formato digital para su presentación formal.
                        </p>
                    </div>
                </div>

                <!-- Bloque inferior de botones -->
                <div class="p-4 bg-white border-top border-light btn-imprimir-container">
                    <div class="d-grid gap-2">
                        <button onclick="window.print();" class="btn text-white fw-bold py-2 btn-action-custom shadow-sm" style="background-color: #0f2c59; border: 1px solid #38bdf8;">
                            <i class="bi bi-printer-fill me-2 text-info"></i> Imprimir Constancia
                        </button>

                        <a href="{{ route('portal.empresas') }}" class="btn btn-outline-secondary py-2 btn-action-custom">
                            <i class="bi bi-arrow-left me-2"></i> Volver al Portal
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
