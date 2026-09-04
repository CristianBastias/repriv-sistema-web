@extends('layouts.empresa')

@section('content')
<div class="container py-4">
    <!-- Encabezado Institucional con Estética Oscura y Dorada -->
    <div class="row align-items-center mb-4 p-3 rounded-3 text-white shadow-sm" style="background-color: #040723; border-left: 5px solid #b58d3d; border-right: 1px solid rgba(181, 141, 61, 0.3);">
        <div class="col-md-12 d-flex align-items-center justify-content-between">
            <div>
                <h2 class="fw-bold mb-1" style="color: #ffffff;">Panel Corporativo</h2>
                <p class="mb-0 text-white-50 small">Registro Provincial de Empresas de Seguridad Privada (REPRIV)</p>
            </div>
            <img src="{{ asset('/images/logo-sistema-transp.png') }}" alt="Escudo REPRIV" style="max-height: 110px; filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5));">
        </div>
    </div>

    <div class="row g-4">
         <!-- ALERTA DE ÉXITO CON CUENTA REGRESIVA -->
         @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert" style="border-left: 5px solid #28a745; background-color: #d1e7dd; color: #0f5132; border-radius: 10px;">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check-circle-fill fs-4 me-3 text-success"></i>
                    <div>
                        <strong>¡Éxito!</strong> {{ session('success') }}
                    </div>
                </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
         @endif
        <!-- Formulario de envio de PDF para el Repriv -->
        <div class="col-lg-4">
            <!-- Tarjeta de Identidad de la Empresa -->
            <div class="card border-0 shadow-sm mb-4 rounded-3 overflow-hidden" style="border-top: 4px solid #b58d3d !important;">
                <div class="card-body p-4 bg-white">
                    <h5 class="fw-bold mb-2" style="color: #040723;">
                        {{ auth()->user()->empresa->nombre_razon_social ?? 'Empresa Registrada' }}
                    </h5>
                    <p class="text-muted small mb-3"><i class="bi bi-envelope me-1 text-warning"></i> {{ auth()->user()->email }}</p>

                    <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top">
                        <div>
                            <span class="text-secondary small me-2">Estado:</span>
                            <span class="badge bg-success px-3 py-1.5 rounded-pill fw-normal">Habilitada</span>
                        </div>
                        <!-- Botón para ir a Editar Perfil Corporativo -->
                        <a href="{{ route('empresa.perfil.edit') }}" class="btn btn-sm text-white fw-semibold px-3 shadow-sm" style="background-color: #040723; border: 1px solid #b58d3d;" title="Editar Datos y Contraseña">
                            <i class="bi bi-gear-fill text-warning me-1"></i> Configurar
                        </a>
                    </div>
                </div>
            </div>

             @if ($errors->any())
            <div class="alert alert-danger shadow-sm border-0">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                       <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Tarjeta de Subida de Documentación -->
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden" style="border-top: 4px solid #040723 !important;">
                <div class="card-header text-white py-3 px-4 fw-semibold" style="background-color: #040723;">
                    <i class="bi bi-cloud-arrow-up me-2 text-warning"></i> Subir Nueva Documentación
                </div>
                <div class="card-body p-4 bg-white">
                    {{-- Formulario con campo de texto libre para el nombre del documento --}}
                    <form action="{{ route('empresa.documentos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-medium text-secondary small">Nombre o Descripción del Documento</label>
                            <input type="text" name="tipo_documento" class="form-control form-control-sm py-2" placeholder="Ej: Nómina Mensual Enero, ART 2026..." required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-medium text-secondary small">Seleccionar Archivo (PDF)</label>
                            <input type="file" name="archivo" class="form-control form-select-sm py-2" accept="application/pdf,.pdf" data-max-size="10485760" required>
                            <div class="form-text text-muted" style="font-size: 0.75rem;">Formato admitido: PDF. Máx. 10 MB.</div>
                        </div>
                        <button type="submit" class="btn w-100 py-2 shadow-sm fw-medium text-white" style="background-color: #040723; transition: all 0.3s;" onmouseover="this.style.backgroundColor='#b58d3d'" onmouseout="this.style.backgroundColor='#040723'">
                            <i class="bi bi-upload me-1"></i> Enviar al REPRIV
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Historial de Documentación -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100" style="border-top: 4px solid #b58d3d !important;">
                <div class="card-header text-white py-3 px-4 d-flex justify-content-between align-items-center" style="background-color: #040723;">
                    <span class="fw-semibold"><i class="bi bi-file-earmark-text me-2 text-warning"></i> Historial de Documentación Presentada</span>
                    <span class="badge px-2.5 py-1 rounded-pill" style="background-color: #b58d3d; color: #040723; font-weight: bold;">{{ count($misDocumentos ?? []) }} archivos</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 text-nowrap">
                            <thead class="table-light text-uppercase fs-7 text-muted">
                                <tr>
                                    <th class="py-3 ps-4">Fecha y Hora</th>
                                    <th class="py-3">Tipo / Nombre</th>
                                    <th class="py-3">Archivo</th>
                                    <th class="py-3 text-center pe-4">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($misDocumentos ?? [] as $doc)
                                    <tr>
                                        <!-- Muestra fecha y hora con formato d/m/Y H:i -->
                                        <td class="ps-4 text-muted small">{{ $doc->created_at->format('d/m/Y H:i') }}</td>

                                        <!-- Muestra el título que ingresó la empresa -->
                                        <td class="fw-medium text-dark">{{ $doc->titulo ?? $doc->tipo_documento }}</td>

                                        <!-- Columna Archivo limpia -->
                                        <td>
                                            <a href="{{ route('documentos.empresa.ver', $doc->id) }}" target="_blank" class="text-decoration-none fw-semibold" style="color: #040723;" title="Ver Documento PDF">
                                            <i class="bi bi-file-pdf text-danger fs-4 align-middle"></i>
                                            <span class="ms-1 small">Ver Documento</span>
                                            </a>
                                        </td>

                                        <td>
                                           {{-- Si está pendiente se muestra en amarillo, si ya fue revisado se muestra en verde claro --}}
                                           @if($doc->estado === 'pendiente')
                                            <span class="badge px-3 py-1 fw-bold shadow-sm" style="background-color: #ffc107; color: #000000; font-size: 0.75rem; border-radius: 20px;">
                                            Pendiente
                                            </span>
                                          @else
                                           <span class="badge px-3 py-1 fw-semibold" style="background-color: #d1e7dd; color: #0f5132; font-size: 0.75rem; border-radius: 20px;">
                                            Revisado
                                           </span>
                                          @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted">
                                            <div class="py-4">
                                                <i class="bi bi-folder2-open display-6 mb-2 d-block" style="color: #b58d3d;"></i>
                                                <p class="mb-0">No hay documentos registrados en el sistema todavía.</p>
                                            </div>
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
