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

    <!-- ALERTA DE ÉXITO -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4 border-0" role="alert" style="background-color: #d1e7dd; color: #0f5132; border-radius: 10px;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Encabezado de la Sección con Icono -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-lg-7 d-flex align-items-center gap-3">
          <div class="icon-box-header flex-shrink-0">
             <i class="bi bi-shield-fill-check"></i>
          </div>
          <div>
             <h3 class="fw-bold mb-0 text-white" style="letter-spacing: 0.5px;">Auditoría-Preinscripciones Aprobadas</h3>
             <p class="mb-0 text-white-50 small fw-medium">Listado oficial de preinscripciones aprobadas con sus respectivos códigos.</p>
           </div>
        </div>
    </div>
    
    <!-- Tabla con Estilo Coherente Institucional -->
    <div class="card border-0 shadow-lg bg-white overflow-hidden" style="border-radius: 12px;">
        <div class="card-header py-3 px-4 fw-bold text-white border-0 d-flex align-items-center" style="background-color: #040723; font-size: 0.95rem;">
            <i class="bi bi-building-check me-2" style="color: #b58d3d;"></i> Listado de Preinscripciones Aprobadas.
        </div>
        <div class="table-responsive m-0">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background-color: #040723 !important;">
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; border: none !important;">ID</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; border: none !important;">Razón Social</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; border: none !important;">Código de Validación</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; border: none !important;">Email</th>
                        <th class="text-center" style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; border: none !important;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aprobadas as $pre)
                    <tr>
                        <td class="px-4 fw-bold text-secondary" style="font-size: 0.9rem;">#{{ $pre->id }}</td>
                        <td class="fw-bold text-dark">{{ $pre->nombre_razon_social }}</td>
                        <td>
                            <span class="badge px-3 py-2 fw-semibold rounded-pill shadow-sm" style="background-color: #d1e7dd; color: #0f5132; font-size: 0.75rem;">
                                <i class="bi bi-key me-1"></i> {{ $pre->codigo_validacion }}
                            </span>
                        </td>
                        <td class="text-secondary small">{{ $pre->email }}</td>
                        <td class="text-center px-4">
                            <form action="{{ route('auditoria.aprobadas.destroy', $pre->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar esta preinscripción aprobada?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm text-white fw-semibold shadow-sm d-inline-flex align-items-center justify-content-center"
                                        title="Eliminar preinscripción" style="width: 35px; height: 35px; background-color: #dc3545; border-radius: 8px;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-exclamation-circle fs-3 d-block mb-2 text-warning"></i> No hay empresas aprobadas aún.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection