@extends('layouts.app')

@push('styles')
<style>
    body {
        background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.3)),
                    url("{{ asset('/images/bandera-argentina.png') }}") no-repeat center center fixed;
        background-size: cover;
    }
</style>
@endpush

@section('content')
<section class="py-4 py-md-5 bg-primary text-white mb-4 mb-md-5 shadow-sm">
    <div class="container text-center">
        <h1 class="display-5 fw-bold text-uppercase responsive-title text-white">Interés Ciudadano</h1>
        <p class="lead px-2 text-white-50">Lo que usted debe saber sobre Seguridad Privada en La Rioja</p>
    </div>
</section>

<div class="bg-dark text-white py-2 overflow-hidden position-relative border-bottom border-secondary shadow-sm">
    <div class="d-flex align-items-center">
        <div class="marquee-text font-weight-bold uppercase text-tracking-wide text-sm">
            <span class="px-4 text-warning"><i class="fas fa-shield-alt mr-2"></i> DIRECCION GENERAL DE PLANEAMIENTO ESTRATÉGICO (D.G.P.E.) </span>
            <span class="px-4 text-white">• REGISTRO PROVINCIAL DE EMPRESAS DE SEGURIDAD PRIVADA (REPRIV) •</span>
            <span class="px-4 text-warning"><i class="fas fa-police-box mr-2"></i> PROVINCIA DE LA RIOJA </span>
            <span class="px-4 text-white">• SEGURIDAD JURÍDICA •</span>

            <span class="px-4 text-warning"><i class="fas fa-shield-alt mr-2"></i> DIRECCIÓN GENERAL DE PLANEAMENTO ESTRATÉGICO (D.G.P.E.) </span>
            <span class="px-4 text-white">• REGISTRO PROVINCIAL DE EMPRESAS DE SEGURIDAD PRIVADA (REPRIV) •</span>
            <span class="px-4 text-warning"><i class="fas fa-police-box mr-2"></i> PROVINCIA DE LA RIOJA </span>
            <span class="px-4 text-white">• SEGURIDAD JURÍDICA •</span>
        </div>
    </div>
</div>

<!-- Guia para el ciudadano -->
<div class="container mb-5">
    <div class="row g-4 mb-5">
        <div class="col-12 col-md-8">
            <h3 class="mb-4 text-dark text-center text-md-start">
                <i class="bi bi-info-circle-fill me-2 text-primary"></i>Guía e información para el Ciudadano
            </h3>
            <div class="accordion shadow-sm" id="accordionGuia">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                            ¿Cómo saber si una empresa está habilitada?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionGuia">
                        <div class="accordion-body text-secondary">
                            Toda empresa de seguridad privada debe poseer un número de resolucion ministerial otorgado por la <strong>Secretaria de Seguridad (M.S.J.y D.H.) de la Provincia de La Rioja</strong>. Usted puede verificarlo utilizando el botón del <strong>Buscador de Empresas</strong> ubicado en la barra de navegación superior.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 bg-warning bg-opacity-10 h-100 shadow-sm border-start border-warning border-4">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold text-warning-emphasis">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>¡Importante!
                    </h5>
                    <p class="card-text text-dark">Contratar servicios no habilitados deriva en responsabilidades legales para el contratante.</p>
                </div>
            </div>
        </div>
    </div>

<!-- Título de la sección de Noticias -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="text-dark fw-bold border-bottom pb-2">
               <i class="bi bi-journal-richtext me-2 text-primary"></i> Noticias / Información Ciudadana
            </h3>
        </div>
    </div>

    <!-- Listado de Noticias ajustado a ancho completo -->
    <div class="row g-4 mb-5">
        @forelse($noticias as $noticia)
            <div class="col-12">
                <div class="card h-100 overflow-hidden p-3 p-md-4" style="background: rgba(255, 255, 255, 0.68) !important; backdrop-filter: blur(8px) !important; -webkit-backdrop-filter: blur(8px) !important; border-radius: 14px; border: 2px solid #0f2c59 !important; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);">
                    @php
    $imagenes = json_decode($noticia->imagenes);
@endphp

@if($imagenes && is_array($imagenes) && count($imagenes) > 0)
    <!-- Contenedor compacto y elegante para las imágenes -->
    <div class="mb-3">
        <div class="row g-2 justify-content-center">
            @foreach($imagenes as $img)
                <div class="col-md-{{ count($imagenes) > 1 ? '6' : '12' }} text-center">
                    <img src="{{ asset('storage/' . $img) }}" 
                         class="img-fluid rounded shadow-sm" 
                         alt="Imagen de la noticia" 
                         style="height: 130px; width: 100%; object-fit: cover; border: 1.5px solid #0f2c59 !important; transition: transform 0.2s ease;"
                         onmouseover="this.style.transform='scale(1.02)';" 
                         onmouseout="this.style.transform='scale(1)';">
                </div>
            @endforeach
        </div>
    </div>
@endif
                    <div class="card-body d-flex flex-column p-0">
                        <small class="text-muted mb-2">
                            <i class="bi bi-calendar3 me-1"></i> {{ $noticia->created_at->format('d/m/Y H:i') }}
                        </small>
                        <h4 class="card-title fw-bold text-primary mb-3">{{ $noticia->titulo }}</h4>
                        <!-- Contenido con fuente más pequeña y estilizada (0.92rem) -->
                        <p class="card-text flex-grow-1" style="color: #2c3e50; font-weight: 300; font-size: 0.92rem; line-height: 1.6; white-space: pre-line;">{{ $noticia->contenido }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert text-center py-4 text-muted" style="background: rgba(255, 255, 255, 0.68) !important; backdrop-filter: blur(8px) !important; -webkit-backdrop-filter: blur(8px) !important; border-radius: 14px; border: 2px solid #0f2c59 !important; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);">
                    <i class="bi bi-info-circle fs-2 d-block mb-2 text-warning"></i>
                    Aún no hay noticias o informes publicados en esta sección.
                </div>
            </div>
        @endforelse
    </div>


    <hr class="my-5">
    <!--  Documentos PDF (normativas) -->
    <h3 class="mb-4 text-dark text-center text-md-start">
        <i class="bi bi-file-earmark-arrow-down-fill me-2 text-danger"></i>Documentación de normativas y requisitos para descargar (PDF)
    </h3>

    <!-- Contenedor con efecto translúcido y sombra marcada -->
    <div class="p-4 p-md-5 mb-4" style="background: rgba(255, 255, 255, 0.82); backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px); border-radius: 14px; border: 1px solid rgba(255, 255, 255, 0.4); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);">

    <!-- Título de la sección -->
    <h4 class="mb-4 text-dark fw-bold">
        <i class="bi bi-file-earmark-text-fill me-2 text-primary"></i> Marco Legal y Requisitos
    </h4>

    <!-- Contenido interno -->
    <div class="row g-4">
        <div class="col-12">
            <ul class="list-unstyled mb-0 texto-resaltado">
                <li class="mb-3"><i class="bi bi-file-earmark-check-fill me-2 text-primary"></i> Ley Prov. N° 7.303/02.</li>
                <li class="mb-3"><i class="bi bi-file-earmark-check-fill me-2 text-primary"></i> Decretos Reglamentarios.</li>
                <li><i class="bi bi-file-earmark-check-fill me-2 text-primary"></i> Resoluciones Policiales.</li>
            </ul>
        </div>
    </div>

</div>

    <h5 class="mb-4 text-dark text-center text-md-start">
        Documentos del marco normativo, requeridos para el trámite de habilitación de empresa de seguridad privada
    </h5>

    <div class="list-group shadow-sm mb-5">
    @forelse($documentos as $doc)
        <div class="list-group-item p-3 bg-white">
            <div class="row align-items-center g-3">
                <div class="col-12 col-md-8 text-center text-md-start">
                    <h5 class="mb-1 text-primary fw-bold">{{ $doc->titulo }}</h5>
                    <small class="text-muted d-block">Publicado el: {{ $doc->created_at->format('d/m/Y') }}</small>
                </div>
                <div class="col-12 col-md-4 text-center text-md-end">
                    <a href="{{ asset('uploads/' . $doc->archivo_path) }}"
                       target="_blank"
                       class="btn btn-outline-danger w-100 w-md-auto shadow-sm">
                        <i class="bi bi-file-earmark-pdf"></i> Descargar PDF
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center border-0 shadow-sm py-4">
            <i class="bi bi-info-circle fs-2 d-block mb-2"></i>
            Aún no hay documentos disponibles para descarga.
        </div>
    @endforelse
    </div>

    <hr class="my-5">
    <!-- Formulario de Consultas -->
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <h3 class="mb-4 text-dark text-center text-md-start">
                <i class="bi bi-chat-dots-fill me-2 text-success"></i>Buzón de Consultas
            </h3>
            <div class="card border-0 shadow-sm bg-white p-3 p-md-4">
                @if(session('success'))
                    <div class="alert alert-success border-0 shadow-sm mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('consultas.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-dark">Nombre Completo</label>
                        <input type="text" name="nombre_remitente" class="form-control form-control-lg fs-6 text-dark" placeholder="Ingrese su nombre" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-dark">Correo Electrónico o Teléfono</label>
                        <input type="text" name="contacto" class="form-control form-control-lg fs-6 text-dark" placeholder="Donde podamos responderle" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-dark">Su Consulta</label>
                        <textarea name="mensaje" class="form-control fs-6 text-dark" rows="4" placeholder="Escriba aquí su duda..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg w-100 fw-bold shadow-sm mt-2">
                        <i class="bi bi-send me-2"></i>ENVIAR CONSULTA
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    @media (max-width: 768px) {
        .responsive-title {
            font-size: 1.8rem;
        }
        .list-group-item {
            border-left: 4px solid #dc3545;
        }
        .form-control-lg {
            padding: 0.75rem;
        }
    }
</style>

<style>
.overflow-hidden {
    overflow: hidden;
}

/* Animación del texto marquesina */
.marquee-text {
    white-space: nowrap;
    display: inline-block;
    padding-left: 100%;
    animation: marquee-infinite 25s linear infinite;
    font-size: 0.9rem;
    letter-spacing: 1px;
}

/* Definición del movimiento de derecha a izquierda */
@keyframes marquee-infinite {
    0% {
        transform: translate3d(0, 0, 0);
    }
    100% {
        transform: translate3d(-30%, 0, 0);
    }
}

/* Opcional: Detener el movimiento si el usuario pasa el mouse por encima */
.marquee-text:hover {
    animation-play-state: paused;
    cursor: default;
}
</style>
@endsection