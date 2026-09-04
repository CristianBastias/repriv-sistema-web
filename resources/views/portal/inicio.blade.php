@extends('layouts.app')

@push('styles')
<!-- Importamos una tipografía moderna y elegante estilo Inter/Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        /* Aplicamos la fuente elegante a todo el cuerpo */
        font-family: 'Inter', sans-serif !important;

        /* Fondo exacto del módulo Quiénes Somos */
        background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.3)),
                    url("{{ asset('/images/bandera-rioja3 - copia.png') }}") no-repeat center center fixed;
        background-size: cover;
        color: #212529;
    }

    /* Tarjetas y contenedores con estilo unificado y moderno */
    .panel-box {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(6px);
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .panel-box-header {
        background-color: #0f2c59;
        border-bottom: 2px solid #38bdf8;
        padding: 1rem 1.25rem;
        font-weight: 600;
        color: #ffffff;
        letter-spacing: 0.5px;
    }

    /* Estilo elegante para el texto resaltado */
    .texto-resaltado {
        color: #2c3e50 !important;
        font-weight: 400;
        line-height: 1.7;
        font-size: 1.02rem;
    }

    .carousel-img {
        height: 480px;
        object-fit: cover;
        filter: brightness(0.45);
    }

    .responsive-h1 { font-size: calc(1.5rem + 1.5vw); font-weight: 700; letter-spacing: -0.5px; }
    .responsive-p { font-size: calc(1rem + 0.5vw); font-weight: 300; }

    .escudo-animado {
        max-height: 280px !important;
        width: auto !important;
        object-fit: contain;
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15));
    }

    @media (max-width: 768px) {
        .carousel-img { height: 320px; }
        .escudo-animado { max-height: 150px !important; margin-bottom: 20px; }
    }
</style>
@endpush

@section('content')
<!-- 1. CARRUSEL PRINCIPAL -->
<div class="container-fluid px-0 mb-5">
    <div id="carouselRepriv" class="carousel slide shadow-lg" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselRepriv" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselRepriv" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselRepriv" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('/images/repriv2_cap.jpg') }}" class="d-block w-100 carousel-img" alt="Institucional">
                <div class="carousel-caption text-start pb-lg-5 mb-lg-4">
                    <h1 class="text-uppercase responsive-h1" style="color: #00d4ff;">Departamento REPRIV</h1>
                    <p class="responsive-p">Gestión y fiscalización de seguridad privada con excelencia y legalidad.</p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="{{ asset('/images/transformacion_digital.png') }}" class="d-block w-100 carousel-img" alt="Buscador">
                <div class="carousel-caption text-start pb-lg-5 mb-lg-4">
                    <h1 class="text-uppercase responsive-h1" style="color: #00d4ff;">Transparencia Digital</h1>
                    <p class="responsive-p">Acceda al padrón oficial de empresas habilitadas en toda la provincia.</p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="{{ asset('/images/seguridad_juridica.png') }}" class="d-block w-100 carousel-img" alt="Ley">
                <div class="carousel-caption text-start pb-lg-5 mb-lg-4">
                    <h1 class="text-uppercase responsive-h1" style="color: #00d4ff;">Seguridad Jurídica</h1>
                    <p class="responsive-p">Velamos por el estricto cumplimiento de la Ley Provincial vigente.</p>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselRepriv" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselRepriv" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>


<div class="container mb-5">

    <!-- 2. SECCIÓN IDENTIDAD / QUIÉNES SOMOS -->

     <section class="bg-dark text-white py-4 py-md-5 mb-4 mb-md-5 shadow" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7));">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-uppercase responsive-h1">¿Qué es el REPRIV?</h1>
        <p class="lead px-2"><D class="SEG PRIV"></D></p>
        <div class="mx-auto bg-primary" style="height: 4px; width: 80px;"></div>
    </div>
</section>
   <div class="row g-4 mb-5">
        <div class="col-12">
            <div class="p-4 p-md-5" style="background: rgba(255, 255, 255, 0.68) !important; backdrop-filter: blur(8px) !important; -webkit-backdrop-filter: blur(8px) !important; border-radius: 14px; border: 2px solid #0f2c59 !important; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);">
                <h2 class="text-primary mb-3 border-bottom pb-2 fw-bold" style="letter-spacing: -0.5px;">
                    <i class="bi bi-building-fill me-2"></i> Departamento REPRIV
                </h2>
                <p class="mb-0" style="color: #2c3e50; font-weight: 300; font-size: 1.1rem; line-height: 1.8;">
                    El <strong>Registro Provincial de Empresas de Seguridad Privada</strong>, es un departamento dependiente de la Dirección General de Planeamiento Estratégico de la Policía de la Provincia de La Rioja. Este departamento REPRIV, es un ente encargado de fiscalizar y controlar a todas las empresas de seguridad privada en el ámbito provincial.
                </p>
            </div>
        </div>
    </div>

    <hr class="my-5">

     <!-- 3. MISIÓN Y VISIÓN -->
    <h3 class="mb-4 text-dark fw-bold">
     <i class="bi bi-gem me-2" style="color: #0f2c59;"></i> Nuestra identidad
    </h3>
    <div class="row g-4 mb-5">
        <div class="col-12 col-md-6">
            <div class="card h-100 border-0 shadow-sm panel-box p-3 text-center">
                <div class="card-body">
                    <i class="bi bi-shield-check fs-1 text-primary mb-3 d-block"></i>
                    <h4 class="card-title fw-bold">Misión</h4>
                    <p class="card-text text-muted texto-resaltado" style="font-size: 0.95rem;">Regulamos y supervisamos los servicios de seguridad privada para brindar tranquilidad a los ciudadanos riojanos.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card h-100 border-0 shadow-sm panel-box p-3 text-center">
                <div class="card-body">
                    <i class="bi bi-eye fs-1 text-primary mb-3 d-block"></i>
                    <h4 class="card-title fw-bold">Visión</h4>
                    <p class="card-text text-muted texto-resaltado" style="font-size: 0.95rem;">Ser un organismo modelo en transparencia, logrando la integración total de los sistemas con el comando policial en el ambito provincial.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. VALORES -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm panel-box p-4 p-md-5">
                <h3 class="text-center fw-bold mb-4 text-primary text-uppercase" style="letter-spacing: 0.5px;">Nuestros Valores</h3>
                <div class="row text-center g-4">
                    <div class="col-12 col-md-4">
                        <i class="bi bi-shield-lock-fill text-primary fs-1"></i>
                        <h5 class="fw-bold mt-3">Transparencia</h5>
                        <p class="small text-muted mb-0 texto-resaltado" style="font-size: 0.9rem;">Garantizamos procesos claros en la fiscalización de cada prestador.</p>
                    </div>
                    <div class="col-12 col-md-4">
                        <i class="bi bi-person-check-fill text-primary fs-1"></i>
                        <h5 class="fw-bold mt-3">Profesionalismo</h5>
                        <p class="small text-muted mb-0 texto-resaltado" style="font-size: 0.9rem;">Compromiso ético y responsabilidad laboral del personal.</p>
                    </div>
                    <div class="col-12 col-md-4">
                        <i class="bi bi-bank2 text-primary fs-1"></i>
                        <h5 class="fw-bold mt-3">Legalidad</h5>
                        <p class="small text-muted mb-0 texto-resaltado" style="font-size: 0.9rem;">Aseguramos que toda actividad se ajuste al marco legal vigente.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">
    <!-- 5. CONTACTOS -->
    <div class="row g-4">
     <h3 class="mb-4 text-dark fw-bold">
        <i class="bi bi-person-badge-fill me-2" style="color: #0f2c59;"></i> Información de contactos
     </h3>

        <div class="col-md-6">
            <div class="panel-box h-100 d-flex flex-column">
                <div class="panel-box-header text-center">
                    CONTACTOS
                </div>
                <div class="card-body p-4 text-dark texto-resaltado" style="font-size: 0.95rem;">
                    <p class="mb-2">
                        <i class="bi bi-geo-alt-fill text-primary me-2"></i>
                        <strong>Ubicación:</strong> Av. Ortíz de Ocampo y C.S. Menem - Edificio del CAP. Planta Baja - Patio 4 - Oficina "E"
                    </p>
                    <p class="mb-2">
                        <i class="bi bi-telephone-fill text-primary me-2"></i>
                        <strong>Teléfono:</strong> (380) 444-0711
                    </p>
                    <p class="mb-0">
                        <i class="bi bi-envelope-at-fill text-primary me-2"></i>
                        <strong>Email:</strong> reprivprol.empri13@gmail.com
                    </p>
                    <hr class="my-3">
                    <p class="small text-muted mb-0 text-center">
                        <strong>Horarios de atención:</strong> 08:00 a 13:00 hs; y 18:00 a 22:00 hs.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
