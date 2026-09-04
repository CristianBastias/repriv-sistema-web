@extends('layouts.app')

@push('styles')
<style>
    body {
        /* Estilo Fondo */
        background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.3)),
                    url("{{ asset('/images/bandera-rioja3 - copia.png') }}") no-repeat center center fixed;
        background-size: cover;
    }

    /* Clase específica para el texto que quieres resaltar */
    .texto-resaltado {
        color: #1a1a1a !important; /* Un negro casi puro para máximo contraste */
        font-weight: 500;           /* Grosor medio (semi-bold) */
        line-height: 1.6;           /* Mejor espaciado entre líneas */
        text-shadow: 0px 0px 1px rgba(255,255,255,0.5); /* Sutil aura blanca para separar del fondo */
        font-size: 1.1rem;
    }
</style>
@endpush


@section('content')

<body>
<section class="bg-dark text-white py-4 py-md-5 mb-4 mb-md-5 shadow" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7));">
    <div class="container text-center">
        <h1 class="display-4 fw-bold text-uppercase responsive-h1">¿Qué es el REPRIV?</h1>
        <p class="lead px-2"><D class="SEG PRIV">Departamento REPRIV</D></p>
        <div class="mx-auto bg-primary" style="height: 4px; width: 80px;"></div>
    </div>
</section>

<div class="container mb-5">
        <div class="p-4 rounded-4" style="background: rgba(255, 255, 255, 0.5); backdrop-filter: blur(5px);">
             <p class="texto-resaltado">
                  <h2 class="text-primary mb-4 border-bottom pb-2 text-center text-md-start"><strong>Nuestra Indentidad</strong></h2>
            <p class="lead text-secondary text-center text-md-start" style="font-size: 1.1rem;">
                El <strong>Registro Provincial de Empresas de Seguridad Privada, es un departamento dependiente de la Direccion General de Planeamiento Estrategico de la de la Policía de la Provincia de La Rioja. Este departamento REPRIV, es un ente encargado de fiscalizar y controlar a todas las empresas de seguridad privada en el ambito provincial.</strong>
            </p>
        </div>

            <div class="row mt-4 g-3">
                <div class="col-12 col-md-6">
                    <div class="card h-100 border-0 shadow-sm bg-white p-2 p-md-3 text-center">
                        <div class="card-body">
                            <i class="bi bi-shield-check fs-1 text-primary mb-3 d-block"></i>
                            <h4 class="card-title fw-bold">Misión</h4>
                            <p class="card-text text-muted small">Regulamos y supervisamos los servicios de seguridad privada para brindar tranquilidad a los ciudadanos riojanos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card h-100 border-0 shadow-sm bg-white p-2 p-md-3 text-center">
                        <div class="card-body">
                            <i class="bi bi-eye fs-1 text-primary mb-3 d-block"></i>
                            <h4 class="card-title fw-bold">Visión</h4>
                            <p class="card-text text-muted small">Ser un organismo modelo en transparencia, logrando la integración total de los sistemas con el comando policial en el ambito provincial.</p>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4 p-md-5">
                <h3 class="text-center fw-bold mb-4 mb-md-5 text-primary text-uppercase">Nuestros Valores</h3>
                <div class="row text-center g-4">
                    <div class="col-12 col-md-4">
                        <i class="bi bi-shield-lock-fill text-primary fs-1"></i>
                        <h5 class="fw-bold mt-3">Transparencia</h5>
                        <p class="small text-muted mb-0">Garantizamos procesos claros en la fiscalización de cada prestador.</p>
                    </div>
                    <div class="col-12 col-md-4">
                        <i class="bi bi-person-check-fill text-primary fs-1"></i>
                        <h5 class="fw-bold mt-3">Profesionalismo</h5>
                        <p class="small text-muted mb-0">Compromiso ético y responsabilidad laboral del personal.</p>
                    </div>
                    <div class="col-12 col-md-4">
                        <i class="bi bi-bank2 text-primary fs-1"></i>
                        <h5 class="fw-bold mt-3">Legalidad</h5>
                        <p class="small text-muted mb-0">Aseguramos que toda actividad se ajuste al marco legal vigente.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-3">

    <div class="col-md-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 15px; overflow: hidden; background: rgba(255,255,255,0.9);">
            <div class="card-header bg-primary text-white text-center fw-bold py-3">
                MARCO LEGAL
            </div>
            <div class="card-body p-4">
                <ul class="list-unstyled mb-0 texto-resaltado" style="font-size: 1rem;">
                    <li class="mb-3"><i class="bi bi-file-earmark-check-fill me-2 text-primary"></i>Ley Prov. N° 7.303/02.</li>
                    <li class="mb-3"><i class="bi bi-file-earmark-check-fill me-2 text-primary"></i>Decretos Reglamentarios.</li>
                    <li><i class="bi bi-file-earmark-check-fill me-2 text-primary"></i>Resoluciones Policiales.</li>
                </ul>
            </div>
        </div>
    </div>


    <div class="col-md-6">
            <div class="p-4 bg-primary text-white rounded shadow-sm text-center h-100">
                <i class="bi bi-telephone-fill fs-3 mb-2"></i>
                <h6 class="fw-bold">¿Necesita ayuda?</h6>
                <p class="small mb-0">Oficinas Centrales: <br> 08:00 a 13:00 hs; y 18:00 a 22:00 hs.</p> <br>
                <p> Tel:(380) 444-0711</p>
            </div>
    </div>
</div>

</body>

<style>


     /* Estilos dinámicos para fuentes */
    .responsive-h1 {
        font-size: calc(1.8rem + 1.2vw);
    }

    @media (max-width: 768px) {
        .card.p-5 {
            padding: 2rem !important; /* Menos relleno en móviles para ganar espacio */
        }
        .display-4 {
            font-size: 2.2rem;
        }
    }
</style>
@endsection
