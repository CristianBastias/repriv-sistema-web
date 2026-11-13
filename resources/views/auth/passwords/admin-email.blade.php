<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña Admin | REPRIV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
       body {
            background: linear-gradient(rgba(4, 7, 35, 0.85), rgba(15, 23, 42, 0.75)),
                        url('{{ asset('/images/fondo_repriv.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 30px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.37);
            border-top: 6px solid #b58d3d;
            color: #040723;
            position: relative;
            overflow: hidden;
        }

        .marca-de-agua {
            position: absolute;
            top: 28%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 240px;
            opacity: 0.35;
            pointer-events: none;
            z-index: 0;
        }

        .card-content-relative {
            position: relative;
            z-index: 1;
        }

        .btn-repriv {
            background-color: #040723;
            color: white;
            font-weight: bold;
            transition: all 0.3s;
        }
        .btn-repriv:hover {
            background-color: #b58d3d;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="login-card text-center">
        <img src="{{ asset('/images/escudo_repriv_trans.png') }}" class="marca-de-agua" alt="escudo_repriv">

        <div class="card-content-relative">
            <h3 style="color: #040723; font-weight: bold;">RECUPERAR ACCESO</h3>
            <p class="text-muted small mb-4">Panel de Administración REPRIV - Ingrese su correo institucional.</p>

            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show py-2 small text-start border-0 shadow-sm" role="alert" style="background-color: #d1e7dd; color: #0f5132;">
                    <i class="bi bi-check-circle-fill me-1"></i> Se ha enviado un enlace de recuperación a su correo electrónico. Verifique su bandeja de entrada.
                    <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.7rem;"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger py-2 small text-start bg-danger bg-opacity-10 border-danger text-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Apunta estrictamente a la ruta de correo del admin -->
            <form action="{{ route('admin.password.email') }}" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold small">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                </div>

                <button type="submit" class="btn btn-repriv w-100 py-2 mb-3">
                    <i class="bi bi-envelope-paper me-1"></i> ENVIAR ENLACE DE RECUPERACIÓN
                </button>

                <!-- Vuelve al login del admin del Repriv -->
                <a href="{{ route('login.admin') }}" class="text-decoration-none small fw-semibold text-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Volver al Login
                </a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
