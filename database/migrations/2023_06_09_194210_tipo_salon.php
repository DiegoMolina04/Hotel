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
        Schema::create('tipo_salon', function (Blueprint $table) {
            //Llave Primaria
            $table->id();
        
            //Campos Personalizados
            $table->string("nombre",255)->comment("Nombre tipo habitacion")->unique();
            $table->integer("max_personas")->comment("capacidad maxima");
            $table->string("precio_base")->comment("Precio base Salon");
            $table->string("precio_silla")->comment("Precio silla individual");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_salon');
    }
};
