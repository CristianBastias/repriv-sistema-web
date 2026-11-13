<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * Verifica que el usuario logueado tenga el rol jefe_admin.
     */
    private function verificarJefeAdmin()
    {
        if (Auth::user()->role !== 'jefe_admin') {
            abort(403, 'Acceso denegado. Esta sección es exclusiva para la Jefatura Administrativa del REPRIV.');
        }
    }

    /**
     * Muestra el listado de usuarios administrativos y el formulario de alta.
     */
    public function indexUsuarios()
    {
        $this->verificarJefeAdmin();

        $usuarios = User::where('role', '!=', 'empresa')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('profile.usuarios-admin', compact('usuarios'));
    }

    /**
     * Registra un nuevo usuario administrativo en el sistema.
     */
    public function storeUsuario(Request $request)
    {
        $this->verificarJefeAdmin();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:jefe_admin,operador,auditor',
        ], [
            'email.unique' => 'Este correo electrónico ya está registrado en el sistema.',
            'password.min' => 'La contraseña provisoria debe tener al menos 6 caracteres.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'must_change_password' => $request->has('must_change_password') ? 1 : 0,
        ]);

        return back()->with('success', 'Usuario administrativo registrado correctamente.');
    }

    /**
     * Elimina un usuario administrativo del panel.
     */
    public function destroyUsuario($id)
    {
        $this->verificarJefeAdmin();

        $usuario = User::findOrFail($id);

        if ($usuario->id === Auth::id()) {
            return back()->withErrors(['error' => 'No puedes eliminar tu propia cuenta mientras estás en sesión.']);
        }

        $usuario->delete();

        return back()->with('success', 'El usuario fue eliminado del panel administrativo.');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function editCorporativo()
    {
        $user = Auth::user();
        return view('profile.edit-corporativo', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'nombre_razon_social' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['nullable', 'required_with:password'],
            'password' => ['nullable', 'min:6', 'confirmed'],
        ]);

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => ['La contraseña actual ingresada es incorrecta.'],
                ]);
            }
            $user->password = Hash::make($request->password);
        }

        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        if ($request->filled('nombre_razon_social') && $user->empresa) {
            $user->empresa->nombre_razon_social = $request->nombre_razon_social;
            $user->empresa->save();
        }

        $user->email = $request->email;
        $user->save();

        return back()->with('success', '¡Perfil y credenciales actualizados correctamente!');
    }
}