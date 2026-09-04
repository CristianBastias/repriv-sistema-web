<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Campos utilizados por el módulo de documentos públicos.
        if (!Schema::hasColumn('documentos', 'titulo')) {
            Schema::table('documentos', function (Blueprint $table) {
                $table->string('titulo')->nullable()->after('id');
            });
        }

        if (!Schema::hasColumn('documentos', 'archivo_path')) {
            Schema::table('documentos', function (Blueprint $table) {
                $table->string('archivo_path')->nullable()->after('titulo');
            });
        }

        if (!Schema::hasColumn('documentos', 'categoria')) {
            Schema::table('documentos', function (Blueprint $table) {
                $table->string('categoria')->nullable()->after('archivo_path');
            });
        }

        if (!Schema::hasColumn('documentos', 'es_certificado')) {
            Schema::table('documentos', function (Blueprint $table) {
                $table->boolean('es_certificado')->default(false)->after('observaciones');
            });
        }

        // Los documentos públicos no pertenecen a una empresa concreta.
        if (Schema::hasColumn('documentos', 'empresa_id')) {
            Schema::table('documentos', function (Blueprint $table) {
                $table->unsignedBigInteger('empresa_id')->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        // Deliberadamente conservadora: no elimina columnas ni datos existentes.
    }
};
