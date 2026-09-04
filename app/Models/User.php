<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'empresa_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Relación con la empresa
     */
    public function empresa()
    {
        return $this->belongsTo(Preinscripcion::class, 'empresa_id');
    }

    /**
     * Helper para verificar si es administrador
     * Ajusta la lógica según cómo identifiques a tus administradores
     */
    public function getIsAdminAttribute(): bool
    {
        // Ejemplo: Si el email contiene 'admin' o puedes definir un campo 'role' en tu tabla users
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
}
