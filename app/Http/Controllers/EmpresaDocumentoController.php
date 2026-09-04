<?php

namespace App\Http\Controllers;

use App\Models\DocumentoPrivado;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EmpresaDocumentoController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validación estricta de los campos que envía tu formulario corporativo
        $validated = $request->validate([
            'tipo_documento' => ['required', 'string', 'max:100'],
            'archivo'        => ['required', 'file', 'mimes:pdf', 'max:10240'], // Máximo 10 MB
        ], [
            'tipo_documento.required' => 'Debe seleccionar el tipo de documento.',
            'archivo.required'        => 'Debe seleccionar un archivo PDF.',
            'archivo.file'            => 'El archivo recibido no es válido.',
            'archivo.mimes'           => 'El archivo debe ser un documento PDF válido.',
            'archivo.max'             => 'El archivo PDF no puede superar los 10 MB.',
        ]);

        $user = Auth::user();

        // 2. Búsqueda de la empresa vinculada (por user_id o email)
        $empresa = Empresa::where('user_id', $user->id)->first();
        if (!$empresa && $user->email) {
            $empresa = Empresa::where('email', $user->email)->first();
        }

        if (!$empresa) {
            return back()->withInput()->withErrors([
                'archivo' => 'La cuenta de usuario no tiene asignada una empresa en el sistema.',
            ]);
        }

        try {
            // 3. Almacenamiento físico del PDF en la carpeta pública del disco
            $archivo = $request->file('archivo');
            $path = $archivo->store('documentos_privados', 'public');

            if (!$path) {
                return back()->withInput()->withErrors([
                    'archivo' => 'No se pudo guardar el archivo en el servidor.',
                ]);
            }

            // 4. Registro en la base de datos (Tabla documentos_privados)
            DocumentoPrivado::create([
                'empresa_id'   => $empresa->id,
                'titulo'       => $validated['tipo_documento'],
                'archivo_path' => $path,
                'categoria'    => 'privado',
                'estado'       => 'pendiente',
                'es_certificado' => 0,
                'observaciones' => null,
            ]);

            return redirect()->back()
                ->with('success', 'Documento enviado correctamente al REPRIV.');

        } catch (\Exception $e) {
            Log::error('Error al subir documento privado: ' . $e->getMessage());

            return back()->withInput()->withErrors([
                'archivo' => 'Ocurrió un error interno al intentar guardar el documento.',
            ]);
        }
    }

    /**
     * Método seguro para visualizar el documento PDF de la empresa.
     */
    public function verDocumento($id)
    {
        $documento = DocumentoPrivado::findOrFail($id);

        // Cambiamos el estado a 'revisado' y actualizamos 'leido' para que la alerta y la etiqueta "NUEVO" desaparezcan
        if ($documento->estado === 'pendiente' || (isset($documento->leido) && $documento->leido == 0)) {
            $documento->update([
                'estado' => 'revisado',
                'leido'  => 1
            ]);
        }

        // Verificamos que el archivo exista en el disco público
        if (!Storage::disk('public')->exists($documento->archivo_path)) {
            abort(404, 'El archivo físico no se encuentra en el servidor.');
        }

        $path = Storage::disk('public')->path($documento->archivo_path);

        return response()->file($path);
    }

    /**
     * Método para marcar el documento como visto/revisado vía AJAX y actualizar su estado.
     */
    public function marcarVisto($id)
    {
        try {
            $documento = DocumentoPrivado::findOrFail($id);

            if ($documento->estado === 'pendiente') {
                $documento->update([
                    'estado' => 'revisado',
                    'leido'  => 1
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Documento marcado como revisado.']);
        } catch (\Exception $e) {
            Log::error('Error al marcar documento como visto: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error interno.'], 500);
        }
    }

    /**
     * Método para eliminar el documento privado (Físico y de Base de Datos).
     */
    public function destroy($id)
    {
        try {
            $documento = DocumentoPrivado::findOrFail($id);

            // 1. Eliminamos el archivo físico del storage si existe
            if ($documento->archivo_path && Storage::disk('public')->exists($documento->archivo_path)) {
                Storage::disk('public')->delete($documento->archivo_path);
            }

            // 2. Eliminamos el registro de la base de datos
            $documento->delete();

            return redirect()->back()->with('success', 'Documento privado eliminado correctamente.');

        } catch (\Exception $e) {
            Log::error('Error al eliminar documento privado: ' . $e->getMessage());
            return redirect()->back()->withErrors('Ocurrió un error al intentar eliminar el documento.');
        }
    }
}