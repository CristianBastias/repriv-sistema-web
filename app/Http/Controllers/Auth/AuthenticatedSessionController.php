<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Cierra la sesión del usuario.
     */
    public function destroy(Request $request)
    {
        // Cierra la sesión
        Auth::guard('web')->logout();

        // Invalida la sesión actual
        $request->session()->invalidate();

        // Regenera el token CSRF para seguridad
        $request->session()->regenerateToken();

        // Redirige al inicio (o a la pantalla de login que prefieras)
        return redirect('/');
    }
}
