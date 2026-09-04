<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preinscripcion extends Model
{
    use HasFactory;

    protected $table = 'preinscripciones'; // <-- Fuerza el nombre exacto de la tabla de phpMyAdmin

    protected $fillable = [
        'nombre_razon_social',
        'cuit',
        'email',
        'telefono',
        'domicilio',
        'estado',
        'codigo_validacion'
    ];
}
