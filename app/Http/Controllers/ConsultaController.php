<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ConsultaController extends Controller
{
    /**
     * Almacena una nueva consulta enviada desde el portal público.
     */
    public function store(Request $request)
    {
        // 1. Validar los campos utilizando exactamente el 'name' de la vista (nombre_remitente)
        $request->validate([
            'nombre_remitente' => 'required|string|max:255',
            'contacto'         => 'required|string|max:255',
            'mensaje'          => 'required|string',
        ]);

        // 2. Guardar la consulta en la base de datos MySQL
        Consulta::create([
            'nombre_remitente'   => $request->nombre_remitente,
            'contacto' => $request->contacto,
            'mensaje'  => $request->mensaje,
            'leido'    => false, // Deja el indicador en falso para que la bandeja de admin lo marque como nuevo/no leído
        ]);

        // 3. Redireccionar de vuelta mostrando la alerta de éxito en la vista pública
        return back()->with('success', '¡Su consulta ha sido enviada con éxito! Nos pondremos en contacto a la brevedad.');
    }

    public function index()
    {
        // Muestra los mensajes en la bandeja de administración ordenados del más reciente al más antiguo
        $mensajes = Consulta::latest()->get();
        return view('admin.consultas.index', compact('mensajes'));
    }

    public function show($id)
    {
        $consulta = Consulta::findOrFail($id);

        // Al abrir el mensaje, si estaba como no leído, lo actualiza a leído en la base de datos
        if (!$consulta->leido) {
            $consulta->update(['leido' => true]);
        }

        return view('admin.consultas.show', compact('consulta'));
    }

    public function responder($id)
    {
        $consulta = Consulta::findOrFail($id);
        return view('admin.consultas.responder', compact('consulta'));
    }

    public function enviarCorreo(Request $request, $id)
    {
        $request->validate([
            'asunto' => 'required|string|max:255',
            'cuerpo' => 'required|string',
        ]);

        $consulta = Consulta::findOrFail($id);

        // Envía el correo al campo 'contacto' del ciudadano
        Mail::raw($request->cuerpo, function ($message) use ($request, $consulta) {
            $message->to($consulta->contacto)
                    ->subject($request->asunto);
        });

        return redirect()->route('mensajes.index')->with('success', 'Respuesta enviada con éxito.');
    }

    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->delete();

        return redirect()->route('mensajes.index')->with('success', 'Consulta eliminada correctamente.');
    }
}