<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Admin | REPRIV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden;
        }

        body {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #06093a;
        }

        .animated-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("{{ asset('images/repriv2_cap.jpg') }}");
            background-size: cover;
            background-position: center;
            z-index: 1;
            animation: slowPanZoom 25s infinite alternate ease-in-out;
        }

        .bg-gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(4, 7, 35, 0.80), rgba(15, 23, 42, 0.70));
            z-index: 2;
        }

        .login-card {
            position: relative;
            z-index: 3;
            width: 100%;
            max-width: 420px;
            padding: 35px;
            background: #ffffff !important;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.37);
            border-top: 6px solid #b58d3d;
            margin: 20px;
            color: #040723;
        }

        .label-badge {
            display: inline-block;
            padding: 4px 10px;
            background-color: rgba(4, 7, 35, 0.06);
            border-left: 3px solid #b58d3d;
            border-radius: 4px;
            color: #040723;
            font-size: 0.8rem;
        }

        .btn-repriv {
            background-color: #040723;
            border: 1px solid #040723;
            color: white;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-repriv:hover {
            background-color: #b58d3d;
            border-color: #b58d3d;
            color: #ffffff;
            box-shadow: 0 0 15px rgba(181, 141, 61, 0.5);
        }

        @keyframes slowPanZoom {
            0% { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.08) translate(-2%, -2%); }
        }
    </style>
</head>
<body>

    <div class="animated-bg"></div>
    <div class="bg-gradient-overlay"></div>

    <div class="login-card text-center">
        <img src="{{ asset('/images/escudo_repriv_trans.png') }}" alt="Escudo REPRIV" style="width: 110px; margin-bottom: 15px;">

        <h4 style="color: #040723; font-weight: bold;" class="mb-0">REPRIV</h4>
        <p class="text-muted mb-4 small" style="font-weight: 600; letter-spacing: 0.3px;">Gestión Administrativa</p>

        @if ($errors->any())
            <div class="alert alert-danger py-2 small text-start bg-danger bg-opacity-10 border-danger text-danger">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="loginFormAdmin" action="{{ route('login.admin') }}" method="POST">
            @csrf

            <div class="mb-3 text-start">
                <label class="form-label mb-1 fw-bold label-badge">Usuario / Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control border-secondary border-opacity-25" placeholder="usuario@mail.com" required autofocus style="color: #040723;">
            </div>

            <div class="mb-3 text-start">
                <label class="form-label mb-1 fw-bold label-badge">Contraseña</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control border-secondary border-opacity-25" placeholder="••••••••" required style="color: #040723;">
                    <!-- ID corregido para que funcione el botón de ver contraseña -->
                    <button class="btn btn-outline-secondary border-secondary border-opacity-25" type="button" id="togglePasswordAdmin" title="Mostrar/Ocultar contraseña">
                        <i class="bi bi-eye" id="toggleIconAdmin"></i>
                    </button>
                </div>
            </div>

            <!-- Enlace corregido para apuntar exclusivamente a la recuperación del Admin REPRIV -->
            <div class="mb-4 text-end">
                <a href="{{ route('admin.password.request') }}" class="text-decoration-none small fw-semibold" style="color: #b58d3d;">
                    <i class="bi bi-question-circle me-1"></i>¿Olvidaste tu contraseña?
                </a>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-repriv py-2 shadow-sm">
                    <i class="bi bi-box-arrow-in-right me-1"></i> INGRESAR AL SISTEMA
                </button>

                <a href="{{ route('inicio') }}" class="btn btn-outline-secondary py-2 text-dark border-secondary border-opacity-25">
                    <i class="bi bi-arrow-left me-1"></i> Cancelar / Volver
                </a>
            </div>
        </form>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Script corregido para mostrar/ocultar contraseña (vinculado a togglePasswordAdmin)
        const togglePasswordAdmin = document.getElementById('togglePasswordAdmin');
        const passwordInput = document.getElementById('password');
        const toggleIconAdmin = document.getElementById('toggleIconAdmin');

        togglePasswordAdmin.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            toggleIconAdmin.classList.toggle('bi-eye');
            toggleIconAdmin.classList.toggle('bi-eye-slash');
        });

        // Script de alerta de autenticación vinculado al formulario de Admin
        document.getElementById('loginFormAdmin').addEventListener('submit', function() {
            Swal.fire({
                icon: 'success',
                title: 'Autenticando...',
                html: '<span style="color: #b58d3d; font-weight: bold;">Cargando panel de administración...</span>',
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