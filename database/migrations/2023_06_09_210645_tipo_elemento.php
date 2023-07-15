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
        Schema::create('tipo_elemento', function (Blueprint $table) {
            //Llave Primaria
            $table->id();

            //Campos Personalizados
            $table->string("marca",90)->comment("Marca del Elemento");
            $table->string("modelo",90)->comment("Modelo del elemento")->unique();
            $table->integer("unidades")->comment("Numero de Unidades en total");
            $table->date("fecha_compra")->comment("Fecha de Compra");

            //Campos Create_at y Update_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_elemento');
    }
};
