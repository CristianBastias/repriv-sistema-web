<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;

#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'empresa_id',
        'role',
        'must_change_password',
    ];

    /**
     * Relación con la empresa.
     */
    public function empresa()
    {
        return $this->belongsTo(Preinscripcion::class, 'empresa_id');
    }

    /**
     * Helper para verificar si es administrador.
     */
    public function getIsAdminAttribute(): bool
    {
        return str_contains($this->email, 'admin');
    }

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Envía la notificación de restablecimiento de contraseña de forma independiente
     * diferenciando el panel Corporativo (Empresa) del panel de Administración REPRIV.
     */
    public function sendPasswordResetNotification($token)
    {
        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            // Si la petición se origina en el flujo corporativo/empresarial
            if (request()->is('empresa/*') || request()->routeIs('empresa.*')) {
                return route('empresa.password.reset', [
                    'token' => $token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ]);
            }

            // Si la petición se origina en el panel de administración del REPRIV
            return route('admin.password.reset', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ]);
        });

        $this->notify(new ResetPassword($token));
    }
}