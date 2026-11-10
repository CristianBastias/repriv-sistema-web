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
</style>

<div class="bg-animated"></div>
<div class="bg-overlay"></div>

<!-- Contenedor principal con ancho optimizado y responsivo -->
<div class="container py-4" style="max-width: 1250px;">

    <!-- ALERTA ESPECÍFICA DE CONSULTAS NO LEÍDAS -->
    @php
        $mensajesNoLeidos = \App\Models\Consulta::where('leido', false)->count();
    @endphp

    @if($mensajesNoLeidos > 0)
        <div class="alert alert-warning alert-dismissible fade show shadow-sm border-0 mb-4" role="alert" style="border-left: 5px solid #ffc107; background-color: #fff3cd; color: #664d03; border-radius: 10px;">
            <div class="d-flex align-items-center">
                <i class="bi bi-bell-fill fs-4 me-3 text-warning"></i>
                <div>
                    <strong>¡Aviso del Sistema!</strong> Hay <strong id="contador-no-leidos">{{ $mensajesNoLeidos }}</strong> mensaje(s) o consulta(s) sin leer en la bandeja de entrada.
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
                <i class="bi bi-inbox-fill"></i>
            </div>
            <div>
                <h3 class="fw-bold mb-0 text-white" style="letter-spacing: 0.5px;">
                    Bandeja Mail/Consultas
                </h3>
                <p class="mb-0 text-white-50 small fw-medium">Bandeja de Entrada - Gestión y revisión de consultas y mensajes ciudadanos[cite: 7].</p>
            </div>
        </div>
    </div>

    <!-- Tabla con Estilo Coherente Institucional -->
    <div class="card border-0 shadow-lg bg-white overflow-hidden" style="border-radius: 12px;">
        <div class="card-header py-3 px-4 fw-bold text-white border-0 d-flex align-items-center" style="background-color: #040723; font-size: 0.95rem;">
            <i class="bi bi-envelope-open-fill me-2" style="color: #b58d3d;"></i> Mensajes y Consultas Ciudadanas
        </div>
        <div class="table-responsive m-0">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr style="background-color: #040723 !important;">
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Remitente</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Asunto</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Mail</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Fecha</th>
                        <th style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Estado</th>
                        <th class="text-center" style="background-color: #040723 !important; color: #ffffff !important; padding: 15px 20px !important; font-size: 0.8rem !important; font-weight: 700 !important; letter-spacing: 1px; border: none !important;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mensajes as $consulta)
                    <tr>
                        <td class="px-4 fw-bold text-dark" style="font-size: 0.9rem;">{{ $consulta->nombre_remitente }}</td>
                        <td class="text-secondary small">{{ Str::limit($consulta->mensaje, 30) }}</td>
                        <td class="text-secondary small">{{ $consulta->contacto }}</td>
                        <td class="text-secondary small">{{ $consulta->created_at->format('d/m/Y') }}</td>
                        <td>
                            @if($consulta->leido)
                                <span class="badge px-3 py-2 fw-semibold rounded-pill shadow-sm" style="background-color: #d1e7dd; color: #0f5132; font-size: 0.75rem;">Leído</span>
                            @else
                                <span class="badge px-3 py-2 fw-semibold rounded-pill shadow-sm" style="background-color: #fff3cd; color: #664d03; font-size: 0.75rem;">No leído</span>
                            @endif
                        </td>
                        <td class="text-center px-4">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- Botón Ver (Ojo) --}}
                                <a href="{{ route('admin.consultas.show', $consulta->id) }}"
                                   class="btn btn-sm text-white fw-semibold shadow-sm d-flex align-items-center justify-content-center hover-glow-primary"
                                   title="Ver detalle" style="width: 35px; height: 35px; background-color: #1e3a8a; border-radius: 8px;">
                                   <i class="bi bi-eye"></i>
                                </a>

                                {{-- Botón Eliminar (Tacho) --}}
                                <form action="{{ route('admin.consultas.destroy', $consulta->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar esta consulta?');"
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
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-exclamation-circle fs-3 d-block mb-2 text-warning"></i> No hay mensajes en la bandeja de entrada.
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
