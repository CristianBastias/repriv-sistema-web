<?php

namespace App\Http\Controllers;

use App\Models\Preinscripcion;
use App\Models\User;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuditoriaController extends Controller
{
    // 1. Auditoría: Listado de preinscripciones pendientes
    public function preinscripcion()
    {
        $preinscripciones = Preinscripcion::where('estado', 'pendiente')->get();

        // Calculamos los contadores por si el layout los necesita en el menú lateral/superior
        $preinscripcionesPendientes = Preinscripcion::where('estado', 'pendiente')->count();
        $consultasPendientes = \App\Models\Consulta::where('leido', false)->count();
        $totalEmpresas = \App\Models\Empresa::count();

        return view('admin.auditoria.preinscripcion', compact(
            'preinscripciones',
            'preinscripcionesPendientes',
            'consultasPendientes',
            'totalEmpresas'
        ));
    }

    // 2. Validación: Pasa de 'pendiente' a 'aprobado' (Corregido para sincronizar con la vista aprobadas)
    public function validar($id)
    {
        $preinscripcion = Preinscripcion::findOrFail($id);
        $preinscripcion->estado = 'aprobado'; // Cambiado de 'validado' a 'aprobado'
        $preinscripcion->save();

        return redirect()->route('auditoria.preinscripcion')->with('success', 'Preinscripción validada y aprobada correctamente.');
    }

    // 3. Aprobadas: Listado para iniciar la inscripción presencial
    public function aprobadas()
    {
        $aprobadas = Preinscripcion::where('estado', 'aprobado')->get();
        return view('admin.auditoria.aprobadas', compact('aprobadas'));
    }

    // 4. Iniciar Trámite: El admin recibe al empresario presencialmente
    public function iniciarTramite($id)
    {
        $pre = Preinscripcion::findOrFail($id);
        $pre->update(['estado' => 'en_tramite']);

        return back()->with('success', 'Trámite formal iniciado (Estado: En Trámite).');
    }

    // 5. Registradas: Listado de empresas que ya están en proceso formal o finalizado
    public function registrados()
    {
        $registrados = Preinscripcion::whereIn('estado', ['en_tramite', 'registrado'])->get();
        return view('admin.auditoria.registrados', compact('registrados'));
    }

    // 6. Habilitar Empresa: Resolución final (Habilita usuario y crea entidad)
    public function habilitarEmpresa($id)
    {
        $pre = Preinscripcion::findOrFail($id);

        DB::transaction(function () use ($pre) {
            // Crear usuario de acceso
            $user = User::create([
                'name' => $pre->nombre_razon_social,
                'email' => $pre->email,
                'password' => Hash::make('RePriv2026!'),
                'role' => 'empresa',
            ]);

            // Crear entidad empresa vinculada
            Empresa::create([
                'user_id' => $user->id,
                'razon_social' => $pre->nombre_razon_social,
                'cuit' => $pre->cuit,
                'domicilio' => $pre->domicilio,
                'telefono' => $pre->telefono,
                'estado' => 'habilitada'
            ]);

            // Marcar preinscripción como finalizada
            $pre->update(['estado' => 'registrado']);
        });

        return back()->with('success', 'Empresa habilitada formalmente. Credenciales generadas.');
    }

    public function destruirAprobada($id)
    {
    $preinscripcion = Preinscripcion::findOrFail($id);
    $preinscripcion->delete();

    return back()->with('success', 'Preinscripción eliminada correctamente.');
    }
}