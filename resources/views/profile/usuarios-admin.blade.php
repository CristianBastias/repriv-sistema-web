@extends('layouts.admin')

@section('content')
<div class="container py-4" style="max-width: 1200px;">

    <!-- Encabezado Institucional -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3 p-3 rounded-3 text-white shadow-sm" style="background-color: #040723; border-left: 5px solid #b58d3d; border-right: 1px solid rgba(181, 141, 61, 0.3);">
        <div>
            <h2 class="fw-bold mb-1" style="color: #ffffff;">
                Gestión de Personal Administrativo
            </h2>
            <p class="text-white-50 small mb-0">Alta y administración de operadores, auditores y jefatura del REPRIV.</p>
        </div>

        <div>
            <a href="{{ route('empresas.index') }}" class="btn btn-sm shadow-sm d-flex align-items-center gap-1 text-white" style="background-color: #040723; border: 1px solid #b58d3d;">
                <i class="bi bi-arrow-left"></i> Volver al Panel
            </a>
        </div>
    </div>

    <!-- Alertas -->
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

    <div class="row g-4">
        <!-- Columna Izquierda: Formulario de Alta (4 columnas) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="border-top: 4px solid #b58d3d !important;">
                <div class="card-header text-white py-3 fw-bold" style="background-color: #040723;">
                    <i class="bi bi-person-plus-fill me-2 text-warning"></i> Nuevo Usuario
                </div>

                <div class="card-body p-4 bg-white text-dark">
                    <form action="{{ route('admin.usuarios.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Nombre / Jerarquía</label>
                            <input type="text" name="name" class="form-control shadow-sm" placeholder="Ej: Of. Ayte. Juan Pérez" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Correo Electrónico</label>
                            <input type="email" name="email" class="form-control shadow-sm" placeholder="usuario@repriv.com" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Rol en el Sistema</label>
                            <select name="role" class="form-select shadow-sm fw-semibold" style="color: #040723;" required>
                                <option value="operador">Operador Administrativo</option>
                                <option value="auditor">Auditor de Documentación</option>
                                <option value="jefe_admin">Jefe Administrativo (Acceso Total)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-uppercase">Contraseña Provisoria</label>
                            <input type="password" name="password" class="form-control shadow-sm" placeholder="Mínimo 6 caracteres" required>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" name="must_change_password" id="mustChangePass" checked>
                            <label class="form-check-label small text-muted" for="mustChangePass">
                                Exigir cambio de contraseña en el primer ingreso
                            </label>
                        </div>

                        <button type="submit" class="btn w-100 fw-bold shadow-sm" style="background-color: #b58d3d; color: #040723; border: 2px solid #b58d3d;">
                            <i class="bi bi-save me-1"></i> Registrar Usuario
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Listado de Usuarios Activos (8 columnas) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="border-top: 4px solid #040723 !important;">
                <div class="card-header text-white py-3 fw-bold d-flex justify-content-between align-items-center" style="background-color: #040723;">
                    <span><i class="bi bi-people-fill me-2 text-info"></i> Personal Registrado</span>
                    <span class="badge bg-secondary">{{ $usuarios->count() }} activos</span>
                </div>

                <div class="card-body p-0 bg-white">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 text-dark">
                            <thead class="table-light small text-uppercase">
                                <tr>
                                    <th class="ps-4">Usuario</th>
                                    <th>Rol</th>
                                    <th>Estado Clave</th>
                                    <th class="text-end pe-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usr)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold" style="color: #040723;">{{ $usr->name }}</div>
                                        <div class="small text-muted">{{ $usr->email }}</div>
                                    </td>
                                    <td>
                                        @if($usr->role === 'jefe_admin')
                                            <span class="badge" style="background-color: #040723; color: #b58d3d; border: 1px solid #b58d3d;">Jefe Admin</span>
                                        @elseif($usr->role === 'auditor')
                                            <span class="badge bg-info text-dark">Auditor</span>
                                        @else
                                            <span class="badge bg-secondary">Operador</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($usr->must_change_password)
                                            <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i>Cambio pendiente</span>
                                        @else
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>Activa</span>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        @if($usr->id !== Auth::id())
                                            <form action="{{ route('admin.usuarios.destroy', $usr->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Confirma eliminar el acceso de {{ $usr->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar acceso">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge bg-light text-muted border">En sesión</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection