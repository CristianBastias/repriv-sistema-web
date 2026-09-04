@extends('layouts.admin')

@section('content')
<!-- Contenedor con ancho optimizado y responsivo -->
<div class="container py-4" style="max-width: 1200px;">

    <!-- Encabezado idéntico a la Ficha Técnica -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold text-white mb-1" style="text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                Editar Perfil de Usuario
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('panel_repriv') }}" class="text-white-50 text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $user->name }}</li>
                </ol>
            </nav>
        </div>

        <!-- Botón de Volver compacto arriba a la derecha -->
        <div>
            <div class="card border-0 shadow-sm bg-white bg-opacity-10 backdrop-blur p-2 rounded-4 d-inline-block">
                <a href="{{ route('panel_repriv') }}" class="btn btn-secondary btn-sm shadow-sm d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-left"></i> Volver al Panel
                </a>
            </div>
        </div>
    </div>

    <!-- Mensajes de éxito y error -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-4 border-0 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-4 border-0 mb-4" role="alert">
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li><i class="bi bi-exclamation-circle me-1"></i>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Estructura en dos bloques en paralelo (8 columnas izq / 4 columnas der) -->
    <div class="row g-4">

        <!-- Columna Izquierda: Formulario de Edición -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100">
                <div class="card-header bg-primary text-white py-3 fw-bold border-bottom">
                    <i class="bi bi-person-gear me-2"></i> Configuración de Cuenta
                </div>

                <div class="card-body p-4 bg-white">
                    <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="name" class="form-label text-dark fw-bold text-uppercase small tracking-wide">
                                <i class="bi bi-person me-1 text-primary"></i> Nombre Completo:
                            </label>
                            <input type="text" name="name" id="name" class="form-control fw-bold text-dark shadow-sm py-2" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <hr class="text-muted opacity-25">

                        <!-- Correo Electrónico -->
                        <div class="mb-4">
                            <label for="email" class="form-label text-dark fw-bold text-uppercase small tracking-wide">
                                <i class="bi bi-envelope me-1 text-primary"></i> Correo Electrónico:
                            </label>
                            <input type="email" name="email" id="email" class="form-control text-primary fw-semibold shadow-sm py-2" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <hr class="text-muted opacity-25">

                        <div class="mb-3">
                            <h6 class="text-dark fw-bold text-uppercase small tracking-wide"><i class="bi bi-key me-2 text-primary"></i> Cambiar Contraseña (Opcional)</h6>
                            <p class="text-muted small mb-3">Deja estos campos en blanco si no deseas modificar tu contraseña actual.</p>
                        </div>

                        <!-- Nueva Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label text-dark fw-bold small">Nueva Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control shadow-sm py-2" placeholder="Mínimo 6 caracteres">
                        </div>

                        <!-- Confirmar Nueva Contraseña -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label text-dark fw-bold small">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control shadow-sm py-2" placeholder="Repite la nueva contraseña">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Bloque de Botonera con efectos traslúcidos exactos -->
        <div class="col-lg-4">

            <!-- Estado o Panel de Control Rápido -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-dark text-white py-3 fw-bold">Panel de Acciones</div>
                <div class="card-body text-center py-4 bg-white">
                    <p class="text-muted small mb-0">Verifique los datos antes de guardar los cambios en el sistema.</p>
                </div>
            </div>

            <!-- Botonera Lateral en Bloque Traslúcido con Estilos Personalizados -->
            <div class="card border-0 shadow-sm bg-white bg-opacity-10 backdrop-blur p-3 rounded-4">
                <div class="d-grid gap-3">
                    <!-- Botón Guardar Cambios -->
                    <button type="submit" form="editProfileForm" class="btn btn-outline-primary fw-semibold shadow-sm custom-transparent-btn">
                        <i class="bi bi-save me-1"></i> Guardar Cambios
                    </button>

                    <!-- Botón Cancelar -->
                    <a href="{{ route('panel_repriv') }}" class="btn btn-outline-light fw-semibold shadow-sm custom-transparent-btn-light text-center">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>

<style>
    /* Estilo transparente con bordes e iconos/letras en azul para Guardar Cambios */
    .custom-transparent-btn {
        background-color: transparent !important;
        border: 2px solid #0d6efd !important;
        color: #0d6efd !important;
        transition: all 0.3s ease-in-out;
    }
    .custom-transparent-btn:hover {
        background-color: #0d6efd !important;
        color: #ffffff !important;
        box-shadow: 0 0 15px rgba(13, 110, 253, 0.5);
        transform: translateY(-2px);
    }

    /* Estilo transparente con bordes e iconos/letras en blanco para Cancelar */
    .custom-transparent-btn-light {
        background-color: transparent !important;
        border: 2px solid #ffffff !important;
        color: #ffffff !important;
        transition: all 0.3s ease-in-out;
    }
    .custom-transparent-btn-light:hover {
        background-color: #ffffff !important;
        color: #212529 !important;
        box-shadow: 0 0 15px rgba(255, 255, 255, 0.6);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .container {
            padding-left: 10px;
            padding-right: 10px;
        }
    }
</style>
@endsection
