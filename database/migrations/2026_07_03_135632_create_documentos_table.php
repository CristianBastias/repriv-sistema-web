<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id')->constrained('preinscripciones')->onDelete('cascade');
            $table->string('nombre_archivo'); // Nombre original
            $table->string('ruta_archivo');   // Ruta física en el servidor
            $table->string('tipo_documento'); // Ej: Nómina, ART, DDJJ
            $table->string('estado')->default('pendiente'); // pendiente, aprobado, rechazado
            $table->text('observaciones')->nullable(); // Comentarios del REPRIV
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
