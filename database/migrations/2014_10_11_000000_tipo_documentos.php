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
        Schema::create('tipo_documentos', function (Blueprint $table) {
            //Llave Primaria
            $table->id();

            //Columnas Personalizadas
            $table->string("prefijo",5)->comment("Prefijo Tipo Documento")->unique();
            $table->string("nombre",40)->comment("Nombre Tipo Documento")->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_documentos');
    }
};
