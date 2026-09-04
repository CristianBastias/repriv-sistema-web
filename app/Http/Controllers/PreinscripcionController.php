<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preinscripcion;

class PreinscripcionController extends Controller
{
    /**
     * Muestra el formulario de preinscripción.
     */
    public function create()
    {
        return view('preinscripcion.create');
    }

    /**
     * Procesa y guarda la preinscripción.
     */
    public function store(Request $request)
    {
        // 1. Validamos los datos recibidos
        $request->validate([
            'nombre_razon_social' => 'required|string|max:255',
            'cuit'                => 'required|string|max:20',
            'email'               => 'required|email|max:255',
            'telefono'            => 'nullable|string|max:20',
            'domicilio'           => 'nullable|string|max:255',
        ]);

        // 2. Guardamos en la base de datos
        $preinscripcion = Preinscripcion::create($request->all());

        // 3. Redirigimos a la vista de constancia usando el ID generado
        return redirect()->route('preinscripcion.constancia', ['id' => $preinscripcion->id])
                         ->with('success', 'Preinscripción exitosa. Por favor, guarde su constancia.');
    }

    /**
     * Muestra la constancia con el ID único.
     */
    public function showConstancia($id)
    {
        $data = Preinscripcion::findOrFail($id);
        return view('preinscripcion.constancia', compact('data'));
    }
}
