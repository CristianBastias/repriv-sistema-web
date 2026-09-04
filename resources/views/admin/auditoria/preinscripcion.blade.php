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

<div class="container py-4" style="max-width: 1250px;">

    <!-- ALERTA ESPECÍFICA DE PREINSCRIPCIONES PENDIENTES -->
    @php
        $preinscripcionesNuevas = \App\Models\Preinscripcion::where('estado', 'pendiente')->count();
    @endphp

    @if($preinscripcionesNuevas > 0)
        <div class="alert alert-warning alert-dismissible fade show shadow-sm border-0 mb-4" role="alert" style="border-left: 5px solid #ffc107; background-color: #fff3cd; color: #664d03; border-radius: 10px;">
            <div class="d-flex align-items-center">
                <i class="bi bi-bell-fill fs-4 me-3 text-warning"></i>
                <div>
                    <strong>¡Aviso del Sistema!</strong> Hay <strong id="contador-pendientes">{{ $preinscripcionesNuevas }}</strong> solicitud(es) de preinscripción pendiente(s) de validación.
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Encabezado de la Sección con Icono -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-lg-7 d-flex align-items-center gap-3">
            <div class="icon-box-header flex-shrink-0">
                <i class="bi bi-shield-exclamation"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-white" style="letter-spacing: 0.5px;">Auditoría de Preinscripción</h3>
                <p class="mb-0 text-white-50 small fw-medium">Listado y validación de solicitudes pendientes del sistema.</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4 border-0" role="alert" style="background-color: #d1e7dd; color: #0f5132; border-radius: 10px;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabla con Estilo Coherente Institucional -->
    <div class="card border-0 shadow-lg bg-white overflow-hidden" style="border-radius: 12px;">
        <div class="card-header py-3 px-4 fw-bold text-white border-0 d-flex align-items-center" style="background-color: #040723; font-size: 0.95rem;">
            <i class="bi bi-clipboard2-check-fill me-2" style="color: #b58d3d;"></i> Solicitudes Pendientes de Validación
        </div>
        <div class="table-responsive m-0">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background-color: #040723 !important;">
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; border: none !important;">ID</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; border: none !important;">Razón Social</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; border: none !important;">CUIT</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; border: none !important;">Email</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; border: none !important;">Teléfono</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; border: none !important;">Domicilio</th>
                        <th class="text-center" style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; border: none !important;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($preinscripciones as $pre)
                    <tr>
                        <td class="px-4 fw-bold text-secondary" style="font-size: 0.9rem;">#{{ $pre->id }}</td>
                        <td class="fw-bold text-dark">{{ $pre->nombre_razon_social }}</td>
                        <td class="text-secondary small">{{ $pre->cuit }}</td>
                        <td class="text-secondary small">{{ $pre->email }}</td>
                        <td class="text-secondary small">{{ $pre->telefono }}</td>
                        <td class="text-secondary small">{{ $pre->domicilio }}</td>
                        <td class="text-center px-4">
                            <form action="{{ route('auditoria.validar', $pre->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm text-white fw-bold shadow-sm px-3 py-2 hover-glow-success d-inline-flex align-items-center gap-1" style="background-color: #198754; border-radius: 8px; font-size: 0.8rem;" title="Validar">
                                    <i class="bi bi-check-circle"></i> <span>Validar</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-exclamation-circle fs-3 d-block mb-2 text-warning"></i> No hay preinscripciones pendientes de auditoría.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const alerta = document.querySelector('.alert-success');

        if (alerta) {
            let segundos = 5;
            const contadorSpan = document.createElement('span');
            contadorSpan.className = 'float-end small fw-bold ms-2 opacity-75';
            alerta.appendChild(contadorSpan);

            const intervalo = setInterval(function () {
                contadorSpan.textContent = `Cerrando en ${segundos}s`;
                segundos--;

                if (segundos < 0) {
                    clearInterval(intervalo);
                    alerta.style.transition = "all 0.5s ease";
                    alerta.style.opacity = "0";
                    alerta.style.transform = "translateY(-10px)";
                    setTimeout(() => alerta.remove(), 500);
                }
            }, 1000);
        }
    });
</script>
@endsection
