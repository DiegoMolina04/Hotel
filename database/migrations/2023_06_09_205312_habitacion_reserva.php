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
        Schema::create('habitacion_reserva', function (Blueprint $table) {
            //Llaves Primarias
            $table->id();

            //Columnas Personalizadas
            $table->unsignedBigInteger("id_habitacion")->comment("Fk Id habitacion");
            $table->unsignedBigInteger("id_reserva")->comment("Fk Id reserva");

            //Creacion Llaves Foraneas
            $table->foreign("id_habitacion")->references("id")->on("habitaciones");
            $table->foreign("id_reserva")->references("id")->on("reservas");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitacion_reserva');
    }
};
