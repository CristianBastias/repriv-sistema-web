<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MensajeController extends Controller
{
    public function index()
    {
        // Aquí puedes agregar la consulta a tu modelo de mensajes si ya lo tienes, por ejemplo:
        // $mensajes = Mensaje::all();

        // Por ahora, retornamos la vista que gestiona la bandeja
        return view('admin.mensajes.index'); // Ajusta la ruta de la vista según la estructura de tus carpetas
    }
}
