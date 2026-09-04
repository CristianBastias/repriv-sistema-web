@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4" style="max-width: 1250px;">

    <!-- Encabezado de la Sección con estilo institucional -->
    <div class="p-4 mb-4 rounded-4 shadow-sm" style="background: #040723; border: 1px solid rgba(181, 141, 61, 0.3); border-left: 6px solid #b58d3d;">
        <h2 class="fw-bold mb-1" style="color: #f9f9fd;">Buscador y Padrón de Empresas</h2>
        <p class="mb-0 text-secondary" style="font-weight: 600; letter-spacing: 0.3px;">Consulta interactiva y listado desplegable del padrón de seguridad privada.</p>
    </div>

    <!-- Botón de Volver -->
    <div class="mb-4">
        <a href="{{ route('inicio') }}" class="btn btn-sm px-3 rounded-pill shadow-sm" style="background-color: #040723; color: white; border: 1px solid #040723; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#b58d3d'; this.style.borderColor='#b58d3d';" onmouseout="this.style.backgroundColor='#040723'; this.style.borderColor='#040723';">
            <i class="bi bi-arrow-left me-1"></i> Volver a Inicio
        </a>
    </div>

    <!-- Acordeón Desplegable vinculado al Padrón -->
    <div class="accordion shadow-lg rounded-4 overflow-hidden" id="accordionPadronEmpresas" style="border: 1px solid rgba(4, 7, 35, 0.1);">

        <div class="accordion-item border-0">
            <h2 class="accordion-header" id="headingPadron">
                <button class="accordion-button fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePadron" aria-expanded="true" aria-controls="collapsePadron" style="background-color: #040723; color: #f9f9fd; font-size: 1rem;">
                    <i class="bi bi-list-nested me-2" style="color: #b58d3d;"></i> Desplegar Padrón General de Empresas Registradas
                </button>
            </h2>

            <div id="collapsePadron" class="accordion-collapse collapse show" aria-labelledby="headingPadron" data-bs-parent="#accordionPadronEmpresas">
                <div class="accordion-body p-0 bg-white">
                    <div class="table-responsive m-0">
                        <table class="table table-hover align-middle mb-0" style="background: transparent;">
                            <thead style="background: #f8f9fa; color: #040723; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.8px; border-bottom: 2px solid #b58d3d;">
                                <tr>
                                    <th class="py-3 px-4">ID</th>
                                    <th class="py-3">Razón Social</th>
                                    <th class="py-3">Ubicación</th>
                                    <th class="py-3">Email</th>
                                    <th class="py-3 text-center px-4">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($empresas as $empresa)
                                    <tr style="transition: background-color 0.2s ease;">
                                        <td class="px-4 fw-bold" style="color: #6c757d;">{{ $empresa->id }}</td>
                                        <td class="fw-bold" style="color: #040723;">{{ $empresa->nombre_empresa }}</td>
                                        <td style="color: #495057;">{{ $empresa->ubicacion_localidad ?? 'No especificada' }}</td>
                                        <td class="small" style="color: #6c757d;">{{ $empresa->email }}</td>
                                        <td class="text-center px-4">
                                            @php
                                                $badgeClass = 'bg-success';
                                                $estado = strtolower($empresa->condicion_actual ?? 'habilitada');
                                                if($estado == 'inhabilitada') {
                                                    $badgeClass = 'bg-danger';
                                                } elseif($estado == 'en trámite') {
                                                    $badgeClass = 'bg-warning text-dark';
                                                }
                                            @endphp
                                            <span class="badge {{ $badgeClass }} px-3 py-1 fw-semibold shadow-sm">
                                                {{ ucfirst($empresa->condicion_actual ?? 'Habilitada') }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5 text-muted">
                                            <i class="bi bi-exclamation-circle fs-3 d-block mb-2" style="color: #b58d3d;"></i> No se encontraron empresas registradas en el padrón.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
