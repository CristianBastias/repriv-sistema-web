<?php

namespace App\Http\Controllers;

use App\Models\DocumentoPrivado;
use App\Models\Empresa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmpresaPanelController extends Controller // <-- ASEGÚRATE DE QUE DIGA EMPRESAPANELCONTROLLER
{
    /**
     * Muestra el panel corporativo.
     */
    public function index()
    {
        $user = Auth::user();

        // 1. Verificación de ROL
        if ($user->role !== 'empresa') {
            abort(403, 'Acceso restringido.');
        }

        // 2. Verificación y búsqueda robusta de la VINCULACIÓN
        $empresa = Empresa::where('user_id', $user->id)->first();

        if (!$empresa && $user->email) {
            $empresa = Empresa::where('email', $user->email)->first();
        }

        if (!$empresa) {
            abort(403, 'Acceso denegado: No tienes una empresa vinculada en el sistema.');
        }

        // 3. Verificación de CAMBIO DE CONTRASEÑA OBLIGATORIO
        if ($user->must_change_password) {
            return redirect()->route('password.change.form');
        }

        // Consultamos directamente el modelo exclusivo de documentos privados
        $misDocumentos = DocumentoPrivado::where('empresa_id', $empresa->id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return view('admin.empresas.panel_corporativo', compact('empresa', 'misDocumentos'));
    }

    /**
     * Muestra el formulario para cambiar la clave.
     */
    public function showChangePassword()
    {
        return view('auth.cambiar-password');
    }

    /**
     * Procesa la actualización de la clave.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->must_change_password = 0;
        $user->save();

        return redirect()->route('empresa.dashboard')->with('success', 'Contraseña actualizada correctamente.');
    }
}
