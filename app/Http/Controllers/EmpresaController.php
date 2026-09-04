<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EmpresaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');

        $empresas = Empresa::when($buscar, function ($query, $buscar) {
                return $query->where(function($q) use ($buscar) {
                    $q->where('nombre_empresa', 'LIKE', "%{$buscar}%")
                      ->orWhere('cuit', 'LIKE', "%{$buscar}%")
                      ->orWhere('ubicacion_localidad', 'LIKE', "%{$buscar}%")
                      ->orWhere('email', 'LIKE', "%{$buscar}%");
                });
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.empresas.index', compact('empresas'));
    }
    
    public function create()
    {
        return view('admin.empresas.create');
    }

    public function store(Request $request)
    {
        Empresa::create([
            'nombre_empresa'      => $request->nombre_empresa,
            'cuit'                => $request->cuit,
            'ubicacion_localidad' => $request->ubicacion_localidad ?? 'No especificada',
            'condicion_actual'    => $request->condicion_actual,
            'email'               => $request->email ?? null,
            'propietario'         => $request->propietario ?? null,
            'telefono'            => $request->telefono ?? null,
        ]);

        return redirect()->route('empresas.index')->with('success', '¡Empresa agregada con éxito!');
    }

    public function show($id)
    {
        $empresa = Empresa::findOrFail($id);
        return view('admin.empresas.ficha_tecnica', compact('empresa'));
    }

    public function edit($id)
    {
        $empresa = Empresa::findOrFail($id);
        return view('admin.empresas.edit', compact('empresa'));
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->update($request->all());

        return redirect()->route('empresas.index')
                         ->with('success', '¡Empresa actualizada correctamente!');
    }

    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();

        return redirect()->route('empresas.index')
                         ->with('success', 'Empresa eliminada correctamente');
    }

    // --- MÉTODOS DE IMPRESIÓN Y VISTAS PDF ---

    public function padron()
    {
        $empresas = Empresa::all();
        return view('admin.empresas.padron', compact('empresas'));
    }

    public function imprimirPadron()
    {
        $empresas = Empresa::all();
        $pdf = Pdf::loadView('pdf.padron', compact('empresas'))
          ->setPaper('a4', 'landscape');

        return $pdf->stream('padron_completo_' . date('d_m_Y') . '.pdf');
    }

    public function imprimirFichaTecnica($id)
    {
        $empresa = \App\Models\Empresa::findOrFail($id);

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.ficha_tecnica', compact('empresa'))
              ->setPaper('a4', 'portrait');

        return $pdf->stream('ficha_' . time() . '.pdf');
    }
}