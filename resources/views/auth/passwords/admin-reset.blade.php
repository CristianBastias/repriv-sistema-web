<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña | REPRIV</title>
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
            <h3 style="color: #040723; font-weight: bold;">NUEVA CONTRASEÑA</h3>
            <p class="text-muted small mb-4">Por favor, establezca su nueva clave de acceso administrativo.</p>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small text-start bg-danger bg-opacity-10 border-danger text-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Apunta estrictamente a la ruta de actualización del admin -->
            <form action="{{ route('admin.password.update') }}" method="POST">
                @csrf

                <!-- Token oculto requerido por Laravel Password Broker -->
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-3 text-start">
                    <label class="form-label fw-bold small">Correo Electrónico</label>
                    <input type="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" required autofocus>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label fw-bold small">Nueva Contraseña</label>
                    <input type="password" name="password" class="form-control" required placeholder="••••••••">
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label fw-bold small">Confirmar Nueva Contraseña</label>
                    <input type="password" name="password_confirmation" class="form-control" required placeholder="••••••••">
                </div>

                <button type="submit" class="btn btn-repriv w-100 py-2 mb-3">
                    <i class="bi bi-shield-lock me-1"></i> RESTABLECER CONTRASEÑA
                </button>

                <a href="{{ route('login.admin') }}" class="text-decoration-none small fw-semibold text-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Volver al Login
                </a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>