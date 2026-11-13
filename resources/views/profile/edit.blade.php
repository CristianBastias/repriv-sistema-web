@extends('layouts.admin')

@section('content')
<!-- Contenedor con ancho optimizado y responsivo -->
<div class="container py-4" style="max-width: 1200px;">

    <!-- Encabezado Institucional -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3 p-3 rounded-3 text-white shadow-sm" style="background-color: #040723; border-left: 5px solid #b58d3d; border-right: 1px solid rgba(181, 141, 61, 0.3);">
        <div>
            <h2 class="fw-bold mb-1" style="color: #ffffff;">
                Editar Perfil de Usuario
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('panel_repriv') }}" class="text-white-50 text-decoration-none">Inicio</a></li>
                    <li class="breadcrumb-item active text-warning" aria-current="page">{{ $user->name }}</li>
                </ol>
            </nav>
        </div>

        <!-- Botón de Volver compacto arriba a la derecha -->
        <div>
            <a href="{{ route('panel_repriv') }}" class="btn btn-sm shadow-sm d-flex align-items-center gap-1 text-white" style="background-color: #040723; border: 1px solid #b58d3d;">
                <i class="bi bi-arrow-left"></i> Volver al Panel
            </a>
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
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden h-100" style="border-top: 4px solid #b58d3d !important;">
                <div class="card-header text-white py-3 fw-bold border-bottom" style="background-color: #040723;">
                    <i class="bi bi-person-gear me-2 text-warning"></i> Configuración de Cuenta
                </div>

                <div class="card-body p-4 bg-white">
                    <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="name" class="form-label text-dark fw-bold text-uppercase small tracking-wide">
                                <i class="bi bi-person me-1" style="color: #040723;"></i> Nombre Completo:
                            </label>
                            <input type="text" name="name" id="name" class="form-control fw-bold text-dark shadow-sm py-2" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <hr class="text-muted opacity-25">

                        <!-- Correo Electrónico -->
                        <div class="mb-4">
                            <label for="email" class="form-label text-dark fw-bold text-uppercase small tracking-wide">
                                <i class="bi bi-envelope me-1" style="color: #040723;"></i> Correo Electrónico:
                            </label>
                            <input type="email" name="email" id="email" class="form-control fw-semibold shadow-sm py-2" style="color: #040723;" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <hr class="text-muted opacity-25">

                        <div class="mb-3">
                            <h6 class="text-dark fw-bold text-uppercase small tracking-wide"><i class="bi bi-key me-2 text-warning"></i> Cambiar Contraseña (Opcional)</h6>
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

        <!-- Columna Derecha: Bloque de Botonera con los colores institucionales -->
        <div class="col-lg-4">

            <!-- Estado o Panel de Control Rápido -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-4" style="border-top: 4px solid #040723 !important;">
                <div class="card-header text-white py-3 fw-bold" style="background-color: #040723;">Panel de Acciones</div>
                <div class="card-body text-center py-4 bg-white">
                    <p class="text-muted small mb-0">Verifique los datos antes de guardar los cambios en el sistema.</p>
                </div>
            </div>

            <!-- Botonera Lateral -->
            <div class="card border-0 shadow-sm p-3 rounded-4" style="background-color: #040723; border: 1px solid rgba(181, 141, 61, 0.4);">
                <div class="d-grid gap-3">
                    <!-- Botón Guardar Cambios (Estilo Dorado Institucional) -->
                    <button type="submit" form="editProfileForm" class="btn fw-semibold shadow-sm custom-gold-btn">
                        <i class="bi bi-save me-1"></i> Guardar Cambios
                    </button>

                    <!-- Botón Cancelar -->
                    <a href="{{ route('panel_repriv') }}" class="btn btn-outline-light fw-semibold shadow-sm text-center">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>

<style>
    /* Estilo del botón dorado institucional */
    .custom-gold-btn {
        background-color: #b58d3d !important;
        border: 2px solid #b58d3d !important;
        color: #040723 !important;
        font-weight: bold;
        transition: all 0.3s ease-in-out;
    }
    .custom-gold-btn:hover {
        background-color: #c99d43 !important;
        color: #ffffff !important;
        box-shadow: 0 0 15px rgba(181, 141, 61, 0.6);
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