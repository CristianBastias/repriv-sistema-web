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
    .hover-glow-gold {
        transition: all 0.3s ease !important;
    }
    .hover-glow-gold:hover {
        background-color: #d4af37 !important;
        box-shadow: 0 0 20px rgba(212, 175, 55, 0.9) !important;
        transform: translateY(-2px);
    }
</style>

<div class="bg-animated"></div>
<div class="bg-overlay"></div>

<div class="container py-4" style="max-width: 1250px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-white mb-0" style="letter-spacing: 0.5px;">Padrón de Empresas Registradas</h2>
        <a href="{{ route('empresas.imprimir.padron') }}" class="btn btn-sm text-white fw-bold shadow-sm px-3 py-2 hover-glow-gold d-flex align-items-center gap-1" style="background-color: #b58d3d; border-radius: 8px;" target="_blank" title="Imprimir padrón completo">
            <i class="bi bi-printer"></i> <span>Imprimir Padrón</span>
        </a>
    </div>

    <div class="card border-0 shadow-lg bg-white overflow-hidden" style="border-radius: 12px;">
        <div class="table-responsive m-0">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background-color: #040723 !important;">
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Nombre</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">CUIT</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Email</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empresas as $empresa)
                    <tr>
                        <td class="px-4 fw-bold text-dark" style="font-size: 0.9rem;">{{ $empresa->nombre }}</td>
                        <td class="text-secondary small">{{ $empresa->cuit }}</td>
                        <td class="text-secondary small">{{ $empresa->email }}</td>
                        <td class="fw-semibold text-dark small">{{ $empresa->estado }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
