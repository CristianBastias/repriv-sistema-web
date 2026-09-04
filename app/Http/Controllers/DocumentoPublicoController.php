<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DocumentoPublicoController extends Controller
{
    public function index()
    {
        // Traemos todos los documentos públicos ordenados por los más recientes
        $documentos = Documento::latest()->get();

        return view('admin.documentos.publicos_pdf', compact('documentos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'categoria' => 'required|string|max:100',
            'archivo' => 'required|mimes:pdf|max:10485',
        ]);

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $path = $archivo->store('documentos_publicos', 'public');

            Documento::create([
                'titulo' => $validated['titulo'],
                'categoria' => $validated['categoria'],
                'archivo_path' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Documento público publicado correctamente.');
    }
    
    public function verDocumento($id)
    {
        $documento = Documento::findOrFail($id);
        
        // Construimos la ruta real en el storage
        $path = storage_path('app/public/' . $documento->archivo_path);

        if (!file_exists($path)) {
            abort(404, 'El archivo no existe en el servidor.');
        }

        // Devuelve el archivo PDF directamente para que se abra en el navegador de forma segura
        return response()->file($path);
    }

    public function destroy($id)
    {
        try {
            $documento = Documento::findOrFail($id);

            // 1. Eliminamos el archivo físico del storage si existe
            if ($documento->archivo_path && Storage::disk('public')->exists($documento->archivo_path)) {
                Storage::disk('public')->delete($documento->archivo_path);
            }

            // 2. Eliminamos el registro de la base de datos
            $documento->delete();

            return redirect()->back()->with('success', 'Documento público eliminado correctamente.');

        } catch (\Exception $e) {
            Log::error('Error al eliminar documento público: ' . $e->getMessage());
            return redirect()->back()->withErrors('Ocurrió un error al intentar eliminar el documento.');
        }
    }
}
