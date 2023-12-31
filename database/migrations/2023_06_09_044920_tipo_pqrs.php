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
        Schema::create('tipo_pqrs', function (Blueprint $table) {
            //Llave Primaria
            $table->id();
            
            //Campos Personalizados
            $table->string("nombre",20)->comment("Nombre tipo PQRS")->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_pqrs');
    }
};
