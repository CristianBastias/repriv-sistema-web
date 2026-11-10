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

    /* --- EFECTOS HOVER INTENSIFICADOS --- */
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

    .hover-glow-danger {
        transition: all 0.3s ease !important;
    }
    .hover-glow-danger:hover {
        background-color: #dc3545 !important;
        color: #ffffff !important;
        box-shadow: 0 0 15px rgba(220, 53, 69, 0.8) !important;
        transform: translateY(-2px);
    }

    /* Estilos personalizados para inputs y selectores */
    .form-control-custom {
        background-color: #ffffff !important;
        border: 1px solid rgba(255, 255, 255, 0.2) !important;
        color: #0f172a !important;
        font-weight: 500;
        font-size: 0.85rem;
        border-radius: 8px;
    }
    .form-control-custom::placeholder {
        color: #94a3b8;
    }
    .form-control-custom:focus {
        border-color: #b58d3d !important;
        box-shadow: 0 0 12px rgba(181, 141, 61, 0.5) !important;
    }
</style>

<div class="bg-animated"></div>
<div class="bg-overlay"></div>

<!-- Contenedor principal con ancho optimizado y responsivo -->
<div class="container py-4" style="max-width: 1250px;">

    <!-- ALERTA DE ÉXITO O AVISO -->
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

    <!-- Encabezado de la Sección con Icono -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-lg-7 d-flex align-items-center gap-3">
            <div class="icon-box-header flex-shrink-0">
                <i class="bi bi-shield-lock"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-white" style="letter-spacing: 0.5px;">
                    Documentos PDF
                </h3>
                <p class="mb-0 text-white-50 small fw-medium">Gestión de Documentación Privada</p>
            </div>
        </div>
    </div>

    <!-- Estructura en paralelo -->
    <div class="row g-4">

        <!-- Columna Izquierda: Formulario Principal -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg bg-white overflow-hidden" style="border-radius: 12px;">
                <div class="card-header py-3 px-4 fw-bold text-white border-0" style="background-color: #040723; font-size: 0.95rem;">
                    <i class="bi bi-pencil-square me-2" style="color: #b58d3d;"></i> Registrar Nuevo Expediente Privado
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('documentos.privados.store') }}" method="POST" enctype="multipart/form-data" id="formDocumentoPrivado">
    @csrf

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold text-secondary small">Empresa Destinataria</label>
            <select name="empresa_id" class="form-control form-control-custom py-2 px-3 shadow-sm" required>
                <option value="">Seleccione una empresa...</option>
                @foreach(\App\Models\Empresa::all() as $emp)
                    <option value="{{ $emp->id }}">{{ $emp->nombre_empresa ?? $emp->razon_social ?? 'Empresa ID: ' . $emp->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold text-secondary small">Título del Expediente</label>
            <input type="text" name="titulo" class="form-control form-control-custom py-2 px-3 shadow-sm" placeholder="Título del documento..." required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold text-secondary small">Adjunto Privado (PDF)</label>
        <input type="file" name="archivo" class="form-control form-control-custom py-2 px-3 shadow-sm" accept="application/pdf,.pdf" data-max-size="10485760" required>
        <small class="text-muted mt-1 d-block" style="font-size: 0.75rem;">Sube únicamente archivos en formato PDF (Máx. 10 MB).</small>
    </div>
</form>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Bloque lateral de Acciones -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg bg-white overflow-hidden mb-4" style="border-radius: 12px;">
                <div class="card-header py-3 px-4 fw-bold text-white border-0" style="background-color: #040723; font-size: 0.95rem;">Acción de Carga</div>
                <div class="card-body text-center py-4 text-muted small">
                    Verifique los datos y el archivo antes de confirmar la carga al expediente digital.
                </div>
            </div>

            <div class="card border-0 shadow-lg bg-white p-3" style="border-radius: 12px;">
                <div class="d-grid gap-2">
                    <button type="submit" form="formDocumentoPrivado" class="btn btn-sm text-white fw-bold shadow-sm py-2 hover-glow-gold d-flex align-items-center justify-content-center gap-1" style="background-color: #b58d3d; border-radius: 8px; font-size: 0.85rem;" title="Subir documento al expediente">
                        <i class="bi bi-cloud-upload-fill"></i> <span>Subir al Expediente</span>
                    </button>
                </div>
            </div>
        </div>

    </div>

      <!-- Tabla de Registro de Dcoumentos PDF privados -->

    <div class="card border-0 shadow-lg bg-white overflow-hidden mt-4" style="border-radius: 12px;">
        <div class="card-header py-3 px-4 fw-bold text-white border-0 d-flex justify-content-between align-items-center" style="background-color: #040723; font-size: 0.95rem;">
            <div>
                <i class="bi bi-folder2-open me-2" style="color: #b58d3d;"></i> Documentos Privados Registrados
            </div>
            <span class="badge bg-light text-dark fw-semibold px-3 py-2 text-dark">Total: {{ $documentos->count() }}</span>
        </div>
        <div class="table-responsive m-0">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background-color: #040723 !important;">
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">FECHA Y HORA</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">EMPRESA QUE REMITE</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">TIPO / NOMBRE</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">ARCHIVO</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">ESTADO</th>
                        <th class="text-center" style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">ACCIONES</th>
                    </tr>
                </thead>

                <tbody>
    @forelse($documentos as $doc)
    <tr>
        <td class="px-4 text-secondary small" style="white-space: nowrap;">
            {{ $doc->created_at ? $doc->created_at->format('d/m/Y H:i') : '-' }}
        </td>
        <td class="text-dark fw-medium">
            <i class="bi bi-building me-1 text-muted"></i>
            {{ $doc->empresa->nombre_empresa ?? 'Empresa ID: ' . $doc->empresa_id }}
        </td>
        <td class="fw-semibold text-dark" style="font-size: 0.9rem;">
            {{ $doc->titulo }}
        </td>
        <td>
            <a href="{{ route('documentos.empresa.ver', $doc->id) }}" target="_blank" class="text-decoration-none btn-ver-pdf" data-id="{{ $doc->id }}" title="Ver Documento PDF">
                <i class="bi bi-file-pdf text-danger fs-3 align-middle"></i>
            </a>
        </td>
        <td>
            {{-- Estilo exacto unificado: Amarillo brillante para nuevos, verde suave con tipografía uniforme y texto "Verificado" para revisados --}}
            @if($doc->estado === 'pendiente')
                <span class="badge px-3 py-1 fw-bold shadow-sm" style="background-color: #ffc107; color: #000000; font-size: 0.75rem; border-radius: 20px;">
                    NUEVO
                </span>
            @else
                <span class="badge px-3 py-1 fw-semibold" style="background-color: #d1e7dd; color: #0f5132; font-size: 0.75rem; border-radius: 20px;">
                    Revisado
                </span>
            @endif
        </td>
        <td class="text-center px-4">
            <div class="d-flex justify-content-center gap-2">
                <a href="{{ route('documentos.empresa.ver', $doc->id) }}" target="_blank"
                   class="btn btn-sm text-white fw-semibold shadow-sm d-flex align-items-center justify-content-center btn-ver-pdf"
                   data-id="{{ $doc->id }}"
                   title="Ver documento" style="width: 35px; height: 35px; background-color: #1e3a8a; border-radius: 8px;">
                    <i class="bi bi-eye"></i>
                </a>

                <form action="{{ route('documentos.privados.destroy', $doc->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este documento?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-sm text-white fw-semibold shadow-sm d-flex align-items-center justify-content-center"
                            title="Eliminar" style="width: 35px; height: 35px; background-color: #dc3545; border-radius: 8px;">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="6" class="text-center py-5 text-muted">
            <i class="bi bi-exclamation-circle fs-3 d-block mb-2 text-warning"></i> No hay documentos privados registrados.
        </td>
    </tr>
    @endforelse
</tbody>
            </table>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .container {
            padding-left: 10px;
            padding-right: 10px;
        }
    }
</style>

<script data-pdf-upload-handler>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[type="file"][name="archivo"]').forEach(function (input) {
        input.addEventListener('change', function () {
            const max = Number(input.dataset.maxSize || 10485760);
            const file = input.files && input.files[0];
            const oldError = input.parentElement.querySelector('[data-upload-size-error]');
            if (oldError) oldError.remove();
            if (!file) return;

            const isPdf = file.type === 'application/pdf' || /\.pdf$/i.test(file.name);
            if (!isPdf) {
                input.value = '';
                showUploadError(input, 'Solo se permiten archivos PDF.');
                return;
            }
            if (file.size > max) {
                input.value = '';
                showUploadError(input, 'El PDF supera el límite de 10 MB.');
            }
        });
    });

    function showUploadError(input, message) {
        const div = document.createElement('div');
        div.dataset.uploadSizeError = '1';
        div.className = 'text-danger small mt-1 fw-semibold';
        div.textContent = message;
        input.parentElement.appendChild(div);
    }
});
</script>

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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Recargar la página automáticamente al hacer clic en ver el PDF para actualizar el estado a "Verificado"
        const pdfLinks = document.querySelectorAll('.btn-ver-pdf');
        pdfLinks.forEach(link => {
            link.addEventListener('click', function() {
                setTimeout(() => {
                    window.location.reload();
                }, 800);
            });
        });
    });
</script>
@endsection
