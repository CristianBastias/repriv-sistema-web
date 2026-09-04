<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
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
