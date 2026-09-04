<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('preinscripciones', function (Blueprint $table) {
        $table->id();
        $table->string('nombre_razon_social');
        $table->string('cuit')->unique();
        $table->string('email');
        $table->string('domicilio');
        $table->string('estado')->default('pendiente'); // pendiente, aprobado, rechazado
        $table->string('codigo_validacion')->nullable(); // Para el QR
        $table->timestamp('fecha_preinscripcion')->useCurrent();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preinscripciones');
    }
};
