<?php

namespace App\Http\Controllers;

use App\Models\DocumentoPrivado; // Usamos el modelo correcto que tiene la relación
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentoPrivadoController extends Controller
{
    public function index()
    {
        // Traemos todos los documentos privados para la tabla
        $documentos = DocumentoPrivado::with('empresa')->latest()->get();

        // Contamos SOLAMENTE los que están pendientes de revisión
        $pendientesCount = DocumentoPrivado::where('estado', 'pendiente')->orWhereNull('estado')->count();

        return view('admin.documentos.privado_pdf', compact('documentos', 'pendientesCount'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'empresa_id' => 'required|integer',
            'titulo' => 'required|string|max:255',
            'archivo' => 'required|mimes:pdf|max:10485',
        ]);

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $path = $archivo->store('documentos_privados', 'public');

            // Creamos usando el modelo DocumentoPrivado
            DocumentoPrivado::create([
                'empresa_id' => $validated['empresa_id'],
                'titulo' => $validated['titulo'],
                'archivo_path' => $path,
                'categoria' => 'privado',
                'es_certificado' => 0,
                'observaciones' => null,
            ]);
        }

        return redirect()->back()->with('success', 'Documento enviado correctamente al REPRIV.');
    }

    public function verDocumento($id)
    {
        $documento = DocumentoPrivado::findOrFail($id);

        // Si el documento está pendiente, lo marcamos como revisado/leído al abrirlo
        if ($documento->estado === 'pendiente' || is_null($documento->estado)) {
            $documento->estado = 'revisado'; // o 'leido' según prefieras
            $documento->save();
        }

        // Lógica para mostrar o descargar el archivo PDF desde el storage
        $path = storage_path('app/public/' . $documento->archivo_path);

        if (!file_exists($path)) {
            abort(404, 'Archivo no encontrado.');
        }

        return response()->file($path);
    }

    public function destroy($id)
    {
        $documento = DocumentoPrivado::findOrFail($id);

        // Opcional: Eliminar físicamente el archivo PDF del storage si existe
        if ($documento->archivo_path && Storage::disk('public')->exists($documento->archivo_path)) {
            Storage::disk('public')->delete($documento->archivo_path);
        }

        // Eliminar el registro de la base de datos
        $documento->delete();

        return redirect()->back()->with('success', 'Documento eliminado correctamente.');
    }
}