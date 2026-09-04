<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginAdmin()
    {
        return view('auth.login_admin');
    }

   public function loginAdminPost(Request $request)
   {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'jefe_admin' || $user->role === 'personal_admin') {
            return redirect()->intended(route('panel_repriv'))
                             ->with('success', '¡Bienvenido al sistema REPRIV!');
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()->withErrors([
            'email' => 'No tienes permisos de administración para acceder por este medio.',
        ])->onlyInput('email');
    }

    return back()->withErrors(['email' => 'Credenciales de administrador incorrectas.']);
    }

    public function loginEmpresa()
    {
        return view('auth.login_empresa');
    }

   public function loginEmpresaPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Autenticamos usando explícitamente el guard 'empresa'
        if (Auth::guard('empresa')->attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::guard('empresa')->user();

            if ($user->role === 'empresa') {
                return redirect()->route('empresa.dashboard');
            }

            Auth::guard('empresa')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors([
                'email' => 'Esta cuenta no pertenece a una empresa registrada.',
            ])->onlyInput('email');
        }

        return back()->withErrors(['email' => 'Credenciales de empresa incorrectas.']);
    }

    public function logoutEmpresa(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('inicio');
    }

     public function logoutAdmin(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.admin');
    }
}
