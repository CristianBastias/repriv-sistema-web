<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword; // 1. Importar el contrato de reseteo
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification; // Importar la notificación

class Empresa extends Authenticatable implements CanResetPassword
{
    use Notifiable; // 2. Trait para permitir el envío de notificaciones/correos

    protected $table = 'empresas';

    protected $fillable = [
        'id',
        'nombre_empresa',
        'cuit',
        'propietario',
        'ubicacion_localidad',
        'telefono',
        'email',
        'condicion_actual',
        'password',
    ];

    public $timestamps = false;

    // Ocultar la contraseña para que no se vea en las consultas
    protected $hidden = [
        'password',
    ];

    /**
     * Envía la notificación de restablecimiento de contraseña.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        // Generamos la URL usando la ruta personalizada definida en routes/web.php
        $url = route('empresa.password.reset', ['token' => $token, 'email' => $this->email]);

        // Instanciamos la notificación nativa
        $notification = new ResetPasswordNotification($token);

        // Indicamos a Laravel que utilice nuestra URL personalizada en lugar de buscar 'password.reset'
        $notification->createUrlUsing(function ($notifiable, $token) use ($url) {
            return $url;
        });

        // Notificamos al modelo Empresa
        $this->notify($notification);
    }
}
