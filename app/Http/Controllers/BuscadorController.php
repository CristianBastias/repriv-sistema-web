<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class BuscadorController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('q');

        // Muestra todas las empresas formales (En Trámite, Habilitada, Inhabilitada)
        // Excluyendo estrictamente las que siguen como pendientes/preinscripción.
        $empresas = Empresa::where(function($q) use ($query) {
                $q->where('nombre_empresa', 'LIKE', "%{$query}%")
                  ->orWhere('email', 'LIKE', "%{$query}%")
                  ->orWhere('ubicacion_localidad', 'LIKE', "%{$query}%");
            })
            ->where('condicion_actual', '!=', 'Pendiente') // O 'Preinscripcion' según guardes en la tabla de empresas
            ->get();

        return view('portal.resultados', compact('empresas', 'query'));
    }


    public function liveSearch(Request $request)
    {
        $query = $request->get('query');

        $empresas = Empresa::where(function($q) use ($query) {
                $q->where('nombre_empresa', 'LIKE', "%{$query}%")
                  ->orWhere('email', 'LIKE', "%{$query}%");
            })
            ->where('condicion_actual', '!=', 'Pendiente')
            ->get(['nombre_empresa', 'email', 'ubicacion_localidad', 'condicion_actual']);

        return response()->json($empresas);
    }
}
