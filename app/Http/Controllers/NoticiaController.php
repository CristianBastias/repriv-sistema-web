<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\Documento; // Asegúrate de importar también el modelo de documentos si lo usas aquí
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    // Listar noticias en el panel de administración
    public function index()
    {
        $noticias = Noticia::latest()->paginate(10);
        return view('admin.noticias.index', compact('noticias'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('admin.noticias.create');
    }

    // Guardar la noticia en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'contenido' => 'required',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $noticia = new Noticia();
        $noticia->titulo = $request->titulo;
        $noticia->slug = Str::slug($request->titulo);
        $noticia->contenido = $request->contenido;

        $rutasImagenes = [];

        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {
                // Guarda la imagen en storage/app/public/noticias
                $path = $imagen->store('noticias', 'public');
                $rutasImagenes[] = $path;
            }
        }

        $noticia->imagenes = json_encode($rutasImagenes);
        $noticia->save();

        return redirect()->route('admin.noticias.index')->with('success', 'Noticia publicada con éxito.');
    }
    // Eliminar la noticia
    public function destroy($id)
    {
        $noticia = Noticia::findOrFail($id);

        // Opcional: limpiar archivos de imágenes múltiples si existen en storage
        $imagenes = json_decode($noticia->imagenes);
        if ($imagenes && is_array($imagenes)) {
            foreach ($imagenes as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }

        $noticia->delete();

        return redirect()->route('admin.noticias.index')->with('success', 'Noticia eliminada correctamente.');
    }

    // Mostrar noticias en el portal público de Interés Ciudadano
    public function interesCiudadano()
    {
        // Obtenemos las noticias ordenadas de la más nueva a la más vieja
        $noticias = Noticia::latest()->get(); 
        
        // Obtenemos también los documentos para que la vista no arroje error
        $documentos = Documento::latest()->get();

        // Pasamos ambas variables a la vista pública correcta
        return view('portal.interes-ciudadano', compact('noticias', 'documentos'));
    }
}