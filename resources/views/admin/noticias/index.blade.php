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

    .hover-glow-danger {
        transition: all 0.3s ease !important;
    }
    .hover-glow-danger:hover {
        background-color: #dc3545 !important;
        color: #ffffff !important;
        box-shadow: 0 0 15px rgba(220, 53, 69, 0.8) !important;
        transform: translateY(-2px);
    }
</style>

<div class="bg-animated"></div>
<div class="bg-overlay"></div>

<!-- Contenedor principal con ancho optimizado y responsivo -->
<div class="container py-4" style="max-width: 1250px;">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4 border-0" role="alert" style="background-color: #d1e7dd; color: #0f5132; border-radius: 10px;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert" style="background-color: #f8d7da; color: #842029; border-radius: 10px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Encabezado de la Sección con Icono -->
    <div class="row align-items-center mb-4 g-3">
        <div class="col-lg-12 d-flex align-items-center gap-3">
            <div class="icon-box-header flex-shrink-0">
                <i class="bi bi-newspaper"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-white" style="letter-spacing: 0.5px;">
                    Gestión de Noticias y Novedades
                </h3>
                <p class="mb-0 text-white-50 small fw-medium">Panel de registro y control de comunicados oficiales en el portal.</p>
            </div>
        </div>
    </div>

    <!-- SECCIÓN 1: FORMULARIO DE REGISTRO (ARRIBA) -->
    <form action="{{ route('admin.noticias.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        
        <div class="row g-4">
            <!-- Tarjeta Izquierda: Campos del Formulario -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-lg bg-white overflow-hidden" style="border-radius: 12px;">
                    <div class="card-header py-3 px-4 fw-bold text-white border-0 d-flex align-items-center" style="background-color: #040723; font-size: 0.95rem;">
                        <i class="bi bi-pencil-square me-2" style="color: #b58d3d;"></i> Registrar Nueva Noticia
                    </div>
                    <div class="card-body p-4">
                        
                        <!-- Título -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Título de la Noticia</label>
                            <input type="text" name="titulo" class="form-control" placeholder="Ej: Nueva directiva de seguridad..." value="{{ old('titulo') }}" required style="background-color: #f8f9fa; border: 1px solid #ced4da; padding: 10px 15px; border-radius: 8px;">
                        </div>
                        
                        <!-- Contenido -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Contenido del Informe</label>
                            <textarea name="contenido" class="form-control" rows="4" placeholder="Escriba los detalles de la novedad..." required style="background-color: #f8f9fa; border: 1px solid #ced4da; padding: 10px 15px; border-radius: 8px;">{{ old('contenido') }}</textarea>
                        </div>

                        <!-- Imágenes Múltiples -->
                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Imágenes Ilustrativas (Múltiples)</label>
                            <input type="file" name="imagenes[]" class="form-control" multiple accept="image/*" style="background-color: #f8f9fa; border: 1px solid #ced4da; padding: 10px 15px; border-radius: 8px;">
                            <div class="form-text text-muted mt-1"><i class="bi bi-info-circle me-1"></i> Podés seleccionar varias imágenes manteniendo presionada la tecla Ctrl.</div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Tarjeta Derecha: Acción de Publicación -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-lg bg-white overflow-hidden h-100" style="border-radius: 12px;">
                    <div class="card-header py-3 px-4 fw-bold text-white border-0 d-flex align-items-center" style="background-color: #040723; font-size: 0.95rem;">
                        <i class="bi bi-shield-check me-2" style="color: #b58d3d;"></i> Acción de Publicación
                    </div>
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <p class="text-muted small mb-4">Verifique los datos y las imágenes antes de publicarlo oficialmente en el portal.</p>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn text-white fw-bold py-3 shadow-sm" style="background: linear-gradient(135deg, #b58d3d 0%, #8c6a2a 100%); border-radius: 8px; border: none;">
                                <i class="bi bi-cloud-arrow-up-fill me-1"></i> Publicar en Portal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- SECCIÓN 2: TABLA DE REGISTRO DE NOTICIAS (DEBAJO) -->
    <div class="card border-0 shadow-lg bg-white overflow-hidden" style="border-radius: 12px;">
        <div class="card-header py-3 px-4 fw-bold text-white border-0 d-flex align-items-center justify-content-between" style="background-color: #040723; font-size: 0.95rem;">
            <span><i class="bi bi-list-stars me-2" style="color: #b58d3d;"></i> Listado de Noticias Registradas</span>
        </div>
        <div class="table-responsive m-0">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background-color: #040723 !important;">
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important; width: 90px;">Imagen</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Título de la Noticia</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important; width: 180px;">Fecha de Publicación</th>
                        <th class="text-center" style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important; width: 120px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($noticias as $noticia)
                    <tr>
                        <td class="px-4">
                            @php
                                $imagenes = json_decode($noticia->imagenes);
                            @endphp
                            @if($imagenes && is_array($imagenes) && count($imagenes) > 0)
                                <img src="{{ asset('storage/' . $imagenes[0]) }}" alt="Miniatura" class="rounded shadow-sm" style="width: 45px; height: 45px; object-fit: cover;">
                            @else
                                <span class="text-muted small">Sin foto</span>
                            @endif
                        </td>
                        <td class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $noticia->titulo }}</td>
                        <td class="text-secondary small">{{ $noticia->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center px-4">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Botón Eliminar (Tacho) --}}
                                <form action="{{ route('admin.noticias.destroy', $noticia->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Estás seguro de eliminar esta noticia?');"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm text-white fw-semibold shadow-sm d-flex align-items-center justify-content-center hover-glow-danger"
                                            title="Eliminar" style="width: 35px; height: 35px; background-color: #dc3545; border-radius: 8px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="bi bi-exclamation-circle fs-3 d-block mb-2 text-warning"></i> No hay noticias publicadas todavía.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Paginador dentro del estilo -->
        @if(method_exists($noticias, 'links'))
            <div class="p-3 bg-light border-top">
                {{ $noticias->links() }}
            </div>
        @endif
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