<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    EmpresaController,
    ConsultaController,
    AuditoriaController,
    PreinscripcionController,
    EmpresaPanelController,
    EmpresaDocumentoController,
    AuthController,
    DocumentoPublicoController,
    PortalController,
    BuscadorController,
    ProfileController,
    DocumentoPrivadoController,
    NoticiaController,
    AdminUserController, // <--- NUEVO CONTROLADOR DE GESTIÓN DE USUARIOS ADMIN
    Auth\AuthenticatedSessionController,
    Auth\EmpresaForgotPasswordController,
    Auth\AdminForgotPasswordController
   };

// --- RUTAS PÚBLICAS ---
Route::get('/', [PortalController::class, 'inicio'])->name('inicio');
Route::get('/quienes-somos', [PortalController::class, 'quienesSomos'])->name('quienes-somos');
Route::get('/interes-ciudadano', [NoticiaController::class, 'interesCiudadano'])->name('interes-ciudadano');
Route::get('/empresas-portal', [PortalController::class, 'empresas'])->name('portal.empresas');

// --- RUTAS BUSCADOR ---
Route::get('/buscador', [BuscadorController::class, 'index'])->name('buscador.index');
Route::get('/buscar/live', [BuscadorController::class, 'liveSearch'])->name('buscador.live');

// --- RUTAS EXTERNAS ---
Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');

// --- ACCESOS (Login) ---
Route::get('/login-repriv', [AuthController::class, 'loginAdmin'])->name('login.admin');
Route::post('/login-repriv', [AuthController::class, 'loginAdminPost']);
Route::post('/logout-admin', [AuthController::class, 'logoutAdmin'])->name('logout.admin');

// --- ACCESO EMPRESA(Login) ---
Route::get('/login-empresa', [AuthController::class, 'loginEmpresa'])->name('login.empresa');
Route::post('/login-empresa', [AuthController::class, 'loginEmpresaPost']);
Route::get('/login', function () { return redirect()->route('login.admin'); })->name('login');

// --- RECUPERACIÓN DE CONTRASEÑA EMPRESAS ---
Route::get('/empresa/olvide-password', [EmpresaForgotPasswordController::class, 'showLinkRequestForm'])->name('empresa.password.request');
Route::post('/empresa/olvide-password', [EmpresaForgotPasswordController::class, 'sendResetLinkEmail'])->name('empresa.password.email');
Route::get('/empresa/reset-password/{token}', [EmpresaForgotPasswordController::class, 'showResetForm'])->name('empresa.password.reset');
Route::post('/empresa/reset-password', [EmpresaForgotPasswordController::class, 'reset'])->name('empresa.password.update');

// --- RECUPERACIÓN DE CONTRASEÑA - PANEL ADMIN REPRIV ---
Route::get('/admin/olvide-password', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
Route::post('/admin/olvide-password', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
Route::get('/admin/reset-password/{token}', [AdminForgotPasswordController::class, 'showResetForm'])->name('admin.password.reset');
Route::post('/admin/reset-password', [AdminForgotPasswordController::class, 'reset'])->name('admin.password.update');

// --- ACCESOS (Logout Empresa) ---
Route::post('/logout-empresa', [AuthController::class, 'logoutEmpresa'])->name('empresa.logout');

// --- PANEL EMPRESA ---
Route::get('/admin/empresa/panel_corporativo', [EmpresaPanelController::class, 'index'])
    ->middleware('auth:empresa')
    ->name('empresa.dashboard');

Route::post('/admin/empresa/documentos', [EmpresaDocumentoController::class, 'store'])
    ->middleware('auth:empresa')
    ->name('empresa.documentos.store');

// Ruta segura para visualizar el documento PDF de la empresa
Route::get('/admin/empresa/documento/ver/{id}', [EmpresaDocumentoController::class, 'verDocumento'])
    ->middleware('auth:empresa')
    ->name('empresa.documentos.ver');

// --- GESTIÓN DE PERFIL CORPORATIVO ---
Route::middleware(['auth:empresa'])->group(function () {
    Route::get('/admin/empresa/perfil/editar', [ProfileController::class, 'editCorporativo'])->name('empresa.perfil.edit');
    Route::put('/admin/empresa/perfil/actualizar', [ProfileController::class, 'update'])->name('empresa.perfil.update');
});

// --- PREINSCRIPCIÓN ---
Route::get('/preinscripcion', [PreinscripcionController::class, 'create'])->name('preinscripcion.create');
Route::post('/preinscripcion', [PreinscripcionController::class, 'store'])->name('preinscripcion.store');
Route::get('/preinscripcion/constancia/{id}', [PreinscripcionController::class, 'showConstancia'])->name('preinscripcion.constancia');

 // --- MÓDULOS PROTEGIDOS POR AUTH (Panel de Administración REPRIV) ---
  Route::middleware(['auth'])->group(function () {

    // Panel Principal Administrador
    Route::get('/panel-repriv', function() {
        return redirect()->route('empresas.index');
    })->name('panel_repriv');

    Route::get('/dashboard', function () { return redirect()->route('panel_repriv'); });

    // Perfil y Auth
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // --- GESTIÓN DE USUARIOS DEL PANEL ADMINISTRATIVO ---
    Route::prefix('admin/usuarios')->name('admin.usuarios.')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'indexUsuarios')->name('index');
        Route::post('/', 'storeUsuario')->name('store');
        Route::delete('/{id}', 'destroyUsuario')->name('destroy');
    });
    
    // Gestión de Empresas
    Route::controller(EmpresaController::class)->prefix('admin/empresas')->name('empresas.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/padron', 'padron')->name('padron');
        Route::get('/imprimir-padron', 'imprimirPadron')->name('imprimir.padron');
        Route::get('/registradas', 'registrados')->name('registradas');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::get('/{id}/imprimir-ficha', 'imprimirFichaTecnica')->name('imprimir.ficha');
    });

    // Módulo de Auditoría
    Route::controller(AuditoriaController::class)->prefix('auditoria')->name('auditoria.')->group(function () {
        Route::get('/', function() {
            return redirect()->route('auditoria.preinscripcion');
        })->name('index');

        Route::get('/preinscripcion', 'preinscripcion')->name('preinscripcion');
        Route::get('/aprobadas', 'aprobadas')->name('aprobadas');
        Route::post('/validar/{id}', 'validar')->name('validar');
        Route::post('/iniciar-tramite/{id}', 'iniciarTramite')->name('iniciar_tramite');
        Route::post('/habilitar/{id}', 'habilitarEmpresa')->name('habilitar');

        Route::delete('/aprobadas/{id}', 'destruirAprobada')->name('aprobadas.destroy');
    });

    // Grupo de Documentos
    Route::prefix('admin/documentos')->name('documentos.')->group(function () {
        // Documentos Públicos
        Route::get('/publicos', [DocumentoPublicoController::class, 'index'])->name('publicos');
        Route::post('/publicos', [DocumentoPublicoController::class, 'store'])->name('publicos.store');
        Route::delete('/publicos/{id}', [DocumentoPublicoController::class, 'destroy'])->name('publicos.destroy');
        Route::get('/publicos/ver/{id}', [DocumentoPublicoController::class, 'verDocumento'])->name('publicos.ver');

        // Documentos Privados
        Route::get('/privados', [DocumentoPrivadoController::class, 'index'])->name('privados');
        Route::post('/privados', [DocumentoPrivadoController::class, 'store'])->name('privados.store');
        Route::delete('/privados/{id}', [DocumentoPrivadoController::class, 'destroy'])->name('privados.destroy');
        Route::post('/empresas/store', [EmpresaDocumentoController::class, 'store'])->name('empresa.store');

        Route::get('/empresa/ver/{id}', [EmpresaDocumentoController::class, 'verDocumento'])->name('empresa.ver');
        Route::post('/empresa/ver/{id}/marcar-visto', [EmpresaDocumentoController::class, 'marcarVisto'])->name('empresa.marcarVisto');
    });

    // GESTIÓN DE NOTICIAS Y PUBLICACIONES (ADMIN)
    Route::prefix('admin/noticias')->name('admin.noticias.')->controller(NoticiaController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

    // Consultas / Bandeja de Mail
    Route::controller(ConsultaController::class)->prefix('admin/consultas')->name('admin.consultas.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/responder', 'responder')->name('responder');
        Route::post('/{id}/enviar', 'enviarCorreo')->name('enviar');
        Route::delete('/{id}/eliminar', 'destroy')->name('destroy');
    });

    // Alias para mensajes
    Route::get('/admin/mensajes', function() {
        return redirect()->route('admin.consultas.index');
    })->name('mensajes.index');

});