<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'consultas';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_remitente',
        'contacto',
        'mensaje',
        'leido'
    ];

    /**
     * Los atributos que deben convertirse a tipos nativos.
     * Esto ayuda a que Laravel maneje las fechas automáticamente.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'leido'      => 'boolean', // Convierte el 0/1 de la DB a true/false en PHP
    ];
}
