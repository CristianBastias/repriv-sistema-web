<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Empresas | REPRIV</title>
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
            max-width: 400px;
            padding: 30px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.37);
            border-top: 6px solid #b58d3d;
            color: #040723;
            position: relative;
            overflow: hidden;
        }

        /* Marca de agua subida aún más (top: 13%) para quedar perfectamente enmarcada detrás del título y subtítulo */
        .marca-de-agua {
            position: absolute;
            top: 13%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 190px;
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
        .btn-cancel-repriv {
            border: 1px solid #040723;
            color: #040723;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-cancel-repriv:hover {
            background-color: #040723;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="login-card text-center">
        <!-- Imagen de marca de agua institucional reubicada más arriba -->
        <img src="{{ asset('/images/escudo_repriv_trans.png') }}" class="marca-de-agua" alt="escudo_repriv">

        <div class="card-content-relative">
            <h3 style="color: #040723; font-weight: bold;">ÁREA EMPRESARIAL</h3>
            <p class="text-muted small">Gestión de trámites y documentos</p>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small text-start bg-danger bg-opacity-10 border-danger text-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="loginForm" action="{{ route('login.empresa') }}" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label class="form-label fw-bold small">Correo Electrónico</label>
                    <input type="email" name="email" id="email" class="form-control" required autofocus>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label fw-bold small">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="mb-4 text-end">
                    <a href="{{ route('empresa.password.request') }}" class="text-decoration-none small fw-semibold" style="color: #b58d3d;">
                        <i class="bi bi-question-circle me-1"></i>¿Olvidaste tu contraseña?
                    </a>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-repriv py-2">
                        <i class="bi bi-box-arrow-in-right me-1"></i> INGRESAR AL PANEL
                    </button>

                    <a href="{{ route('portal.empresas') }}" class="btn btn-cancel-repriv py-2">
                        <i class="bi bi-arrow-left me-1"></i> Cancelar / Volver
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function() {
            Swal.fire({
                icon: 'success',
                title: 'Autenticando...',
                html: '<span style="color: #b58d3d; font-weight: bold;">Cargando panel corporativo...</span>',
                background: '#040723',
                color: '#fff',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true
            });
        });
    </script>
</body>
</html>
