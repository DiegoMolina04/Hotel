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
        Schema::create('reservas', function (Blueprint $table) {
            //Llave Primaria
            $table->id();

            //Campos Personalizados
            $table->unsignedBigInteger("id_cliente")->comment("Fk Id cliente");
            $table->dateTime("fecha_inicio")->comment("Fecha y Hora de Inicio de la reserva");
            $table->dateTime("fecha_fin")->comment("Fecha y hora de la finalizacion de la reserva");
            $table->unsignedBigInteger("id_estado_reserva")->comment("Fk Id estado reserva");

            //Campos Create_at y Update_at
            $table->timestamps();

            //Creacion Llaves Foreaneas
            $table->foreign("id_cliente")->references("id")->on("users");
            $table->foreign("id_estado_reserva")->references("id")->on("estados_reserva");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
