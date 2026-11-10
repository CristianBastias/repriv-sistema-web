<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preinscripcion;
use Illuminate\Support\Str; // 1. Importante para generar códigos aleatorios

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

        // 2. Preparamos los datos incluyendo el código de validación único y estado inicial
        $data = $request->all();
        $data['codigo_validacion'] = 'REP-' . strtoupper(Str::random(8));
        $data['estado'] = 'pendiente';

        // 3. Guardamos en la base de datos
        $preinscripcion = Preinscripcion::create($data);

        // 4. Redirigimos a la vista de constancia usando el ID generado
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

    /**
     * Valida o aprueba la preinscripción desde el panel administrativo.
     */
    public function validar($id)
    {
        $preinscripcion = Preinscripcion::findOrFail($id);

        // Si no tiene código de validación por registros anteriores, se lo generamos
        if (empty($preinscripcion->codigo_validacion)) {
            $preinscripcion->codigo_validacion = 'REP-' . strtoupper(Str::random(8));
        }

        $preinscripcion->estado = 'aprobado';
        $preinscripcion->save();

        return redirect()->back()->with('success', 'Preinscripción validada y código generado con éxito.');
    }
}
