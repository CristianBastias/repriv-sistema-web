<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentoPrivado extends Model
{
    use HasFactory;

    protected $table = 'documentos_privados';

    protected $fillable = [
        'empresa_id',
        'titulo',
        'archivo_path',
        'categoria',
        'estado',
        'es_certificado',
        'observaciones',
    ];

    protected $casts = [
        'es_certificado' => 'boolean',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }
}