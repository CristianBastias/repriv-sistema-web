<?php

namespace App\Http\Controllers;

use App\Models\DocumentoPrivado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DocumentoPrivadoController extends Controller
{
    public function index()
    {
        // Traemos todos los documentos privados para la tabla ordenados del más reciente
        $documentos = DocumentoPrivado::with('empresa')->latest()->get();

        // Contamos SOLAMENTE los que están pendientes de revisión
        $pendientesCount = DocumentoPrivado::where('estado', 'pendiente')->orWhereNull('estado')->count();

        return view('admin.documentos.privado_pdf', compact('documentos', 'pendientesCount'));
    }

    public function store(Request $request)
    {
        // 1. Validación estricta de los campos del formulario administrativo
        $validated = $request->validate([
            'empresa_id' => 'required|integer',
            'titulo'     => 'required|string|max:255',
            'archivo'    => 'required|file|mimes:pdf|max:10240', // Máximo 10 MB
        ], [
            'empresa_id.required' => 'Debe seleccionar una empresa destinataria.',
            'titulo.required'     => 'Debe ingresar el título del expediente.',
            'archivo.required'    => 'Debe adjuntar un archivo PDF.',
            'archivo.mimes'       => 'El archivo debe ser un documento PDF válido.',
            'archivo.max'         => 'El archivo PDF no puede superar los 10 MB.',
        ]);

        try {
            if ($request->hasFile('archivo')) {
                $archivo = $request->file('archivo');

                // Guardamos el archivo físicamente en el storage público
                $path = $archivo->store('documentos_privados', 'public');

                if (!$path) {
                    return back()->withInput()->withErrors([
                        'archivo' => 'No se pudo guardar el archivo físico en el servidor.',
                    ]);
                }

                // 2. Creamos el registro en la base de datos con estado 'pendiente'
                DocumentoPrivado::create([
                    'empresa_id'     => $validated['empresa_id'],
                    'titulo'         => $validated['titulo'],
                    'archivo_path'   => $path,
                    'categoria'      => 'privado',
                    'estado'         => 'pendiente',
                    'es_certificado' => 0,
                    'observaciones'  => null,
                ]);
            }

            // 3. Redirección con mensaje flash de éxito
            return redirect()->back()->with('success', 'Documento enviado y registrado correctamente al expediente privado.');

        } catch (\Exception $e) {
            Log::error('Error al subir documento privado desde admin: ' . $e->getMessage());

            return back()->withInput()->withErrors([
                'archivo' => 'Ocurrió un error interno al intentar registrar el documento.',
            ]);
        }
    }

    public function verDocumento($id)
    {
        $documento = DocumentoPrivado::findOrFail($id);

        // Si el documento está pendiente, lo marcamos como revisado al abrirlo
        if ($documento->estado === 'pendiente' || is_null($documento->estado)) {
            $documento->update([
                'estado' => 'revisado',
                'leido'  => 1
            ]);
        }

        // Verificamos que el archivo exista en el disco
        if (!Storage::disk('public')->exists($documento->archivo_path)) {
            abort(404, 'El archivo físico no se encuentra en el servidor.');
        }

        $path = Storage::disk('public')->path($documento->archivo_path);

        return response()->file($path);
    }

    public function destroy($id)
    {
        try {
            $documento = DocumentoPrivado::findOrFail($id);

            // Eliminamos físicamente el archivo PDF del storage si existe
            if ($documento->archivo_path && Storage::disk('public')->exists($documento->archivo_path)) {
                Storage::disk('public')->delete($documento->archivo_path);
            }

            // Eliminamos el registro de la base de datos
            $documento->delete();

            return redirect()->back()->with('success', 'Documento privado eliminado correctamente.');

        } catch (\Exception $e) {
            Log::error('Error al eliminar documento privado: ' . $e->getMessage());
            return redirect()->back()->withErrors('Ocurrió un error al intentar eliminar el documento.');
        }
    }
}
