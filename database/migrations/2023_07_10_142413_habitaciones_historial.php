<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_habitaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("Numero_Habitacion")->comment("Número de la habitación");
            $table->unsignedBigInteger("Tipo_habitacion")->comment("Tipo de habitación");
            $table->unsignedBigInteger("Estado_Anterior")->comment("Estado anterior de la habitación");
            $table->unsignedBigInteger("Estado_Actual")->comment("Estado actual de la habitación");
            $table->unsignedBigInteger("Actualizado_por")->comment("Actualizado por");

            $table->timestamps();


            $table->foreign("Numero_Habitacion")->references("id")->on("habitaciones");
            $table->foreign("Tipo_habitacion")->references("id")->on("tipo_habitacion");
            $table->foreign("Estado_Anterior")->references("id")->on("estados_habitacion");
            $table->foreign("Estado_Actual")->references("id")->on("estados_habitacion");
            $table->foreign("Actualizado_por")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_habitaciones');

    }
};
