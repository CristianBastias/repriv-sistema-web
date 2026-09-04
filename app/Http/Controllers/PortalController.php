<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Empresa;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function inicio() {
        return view('portal.inicio');
    }

    public function quienesSomos() {
        return view('portal.quienes-somos');
    }

    public function interesCiudadano() {
        $documentos = Documento::latest()->get();
        return view('portal.interes-ciudadano', compact('documentos'));
    }

    public function empresas() {
        return view('portal.empresas');
    }

    public function buscador()
    {
        $empresas = Empresa::whereIn('condicion_actual', ['Habilitada', 'En Trámite', 'Inhabilitada'])->get();

        return view('portal.resultados', compact('empresas'));
    }
}
