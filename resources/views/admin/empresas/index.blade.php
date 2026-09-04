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

    /* --- EFECTOS HOVER INTENSIFICADOS PARA TODOS LOS BOTONES Y ACCIONES --- */
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

    /* Botones de acción individual en tabla con hover potente */
    .action-btn {
        width: 34px;
        height: 34px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
    }
    .action-btn-view {
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        color: #334155;
    }
    .action-btn-view:hover {
        background: #040723 !important;
        color: #00d4ff !important;
        border-color: #00d4ff !important;
        box-shadow: 0 0 12px rgba(0, 212, 255, 0.7);
        transform: scale(1.1);
    }
    .action-btn-delete {
        background: rgba(220, 53, 69, 0.08);
        border: 1px solid rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }
    .action-btn-delete:hover {
        background: #dc3545 !important;
        color: #ffffff !important;
        border-color: #dc3545 !important;
        box-shadow: 0 0 15px rgba(220, 53, 69, 0.8);
        transform: scale(1.1);
    }

    /* Fila de tabla con realce al pasar el mouse */
    .table-hover-custom tbody tr {
        transition: background-color 0.2s ease, transform 0.2s ease;
    }
    .table-hover-custom tbody tr:hover {
        background-color: rgba(181, 141, 61, 0.06) !important;
    }
</style>

<div class="bg-animated"></div>
<div class="bg-overlay"></div>

<div class="container py-4" style="max-width: 1250px;">

    <!-- Encabezado Oficial -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-lg-6 d-flex align-items-center gap-3">
            <div class="icon-box-header flex-shrink-0">
                <i class="bi bi-building-gear"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-white" style="letter-spacing: 0.5px;">
                    Gestión de Empresas
                </h3>
                <p class="mb-0 text-white-50 small fw-medium">Listado oficial de Empresas de Seguridad Privadas registradas en el REPRIV</p>
            </div>
        </div>

        <!-- Filtro / Buscador Unificado con Botones Denominados y Hover Brillante -->
        <div class="col-lg-6 d-flex justify-content-lg-end align-items-center">
            <div class="p-2 glass-card-soft" style="width: 100%; max-width: 530px;">
                <form action="{{ route('empresas.index') }}" method="GET" class="row g-2 align-items-center m-0">
                    <div class="col">
                        <input type="text" name="buscar" class="form-control text-dark border-0 fw-medium py-2 px-3 shadow-sm" placeholder="Buscar Razón Social o CUIT..." value="{{ request('buscar') }}" style="background-color: #ffffff !important; font-size: 0.85rem; border-radius: 8px;">
                    </div>
                    <div class="col-auto d-flex gap-2">
                        <button type="submit" class="btn btn-sm fw-bold px-3 py-2 text-white d-flex align-items-center gap-1 hover-glow-gold" style="background-color: #b58d3d; border-radius: 8px; font-size: 0.85rem;" title="Buscar registros">
                            <i class="bi bi-search"></i> <span>Buscar</span>
                        </button>
                        <a href="{{ route('empresas.index') }}" class="btn btn-sm btn-light fw-bold px-3 py-2 d-flex align-items-center gap-1 hover-glow-light" style="background-color: #f8f9fa; border-radius: 8px; font-size: 0.85rem; color: #475569;" title="Limpiar filtros">
                            <i class="bi bi-arrow-clockwise"></i> <span>Limpiar</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Mensajes del Sistema -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background-color: #d1e7dd; color: #0f5132;">
            <i class="bi bi-check-circle-fill me-2"></i> <span class="small fw-semibold">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Barra de Herramientas Operativas con Hover Brillante -->
    <div class="mb-4">
        <div class="p-2 glass-card-soft d-inline-block w-100 w-md-auto">
            <div class="d-flex flex-wrap gap-2 align-items-center">
                <a href="{{ route('empresas.imprimir.padron') }}" class="btn btn-sm text-white shadow-sm d-flex align-items-center gap-1 px-3 py-2 fw-semibold hover-glow-primary" style="background-color: #1e3a8a; font-size: 0.8rem; border-radius: 8px;">
                    <i class="bi bi-file-earmark-pdf"></i> Imprimir Padrón
                </a>
                <a href="{{ route('empresas.create') }}" class="btn btn-sm text-white shadow-sm d-flex align-items-center gap-1 px-3 py-2 fw-semibold hover-glow-gold" style="background-color: #0f172a; border: 1px solid #b58d3d; font-size: 0.8rem; border-radius: 8px;">
                    <i class="bi bi-plus-lg"></i> Registrar Nueva Empresa
                </a>
            </div>
        </div>
    </div>

    <!-- Contenedor de Datos Oficiales -->
    <div class="card border-0 shadow-lg bg-white overflow-hidden" style="border-radius: 12px;">
        <div class="table-responsive m-0">
            <table class="table table-hover table-hover-custom align-middle mb-0">
                <thead>
                    <tr style="background-color: #040723 !important;">
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">ID</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Razón Social</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Localidad</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Correo Electrónico</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Estado Actual</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important; text-align: center !important;">Operaciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($empresas as $empresa)
                    <tr>
                        <td class="px-4 fw-bold text-secondary small">#{{ $empresa->id }}</td>
                        <td class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $empresa->nombre_empresa }}</td>
                        <td class="text-secondary fw-medium small">{{ $empresa->ubicacion_localidad }}</td>
                        <td class="text-secondary small">{{ $empresa->email }}</td>
                        <td>
                            @if($empresa->condicion_actual == 'Habilitada')
                                <span class="badge-status badge-habilitada">Habilitada</span>
                            @elseif($empresa->condicion_actual == 'En Trámite')
                                <span class="badge-status badge-tramite">En Trámite</span>
                            @else
                                <span class="badge-status badge-inhabilitada">Inhabilitada</span>
                            @endif
                        </td>
                        <td class="text-center px-4">
                            <div class="d-flex justify-content-center gap-1">
                                <a href="{{ route('empresas.show', $empresa->id) }}" class="action-btn action-btn-view" title="Consultar Legajo">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn action-btn-delete border-0" onclick="return confirm('¿Confirma la eliminación física de este registro del padrón?')" title="Baja de Registro">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted fw-medium">
                            No se encontraron empresas registradas en el padrón.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
