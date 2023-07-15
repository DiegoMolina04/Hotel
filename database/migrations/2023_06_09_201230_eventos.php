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
        Schema::create('eventos', function (Blueprint $table) {
            //Llave Primaria
            $table->id();

            //Campos Personalizados
            $table->unsignedBigInteger("id_tipo_evento")->default(null)->comment("Fk tipo de Evento");
            $table->unsignedBigInteger("id_cliente")->comment("Fk Id Cliente");
            $table->dateTime("fecha_inicio")->comment("Fecha y Hora inicio Evento");
            $table->dateTime("fecha_fin")->comment("Fecha y Hora finalizacion evento");
            $table->integer("Numero_invitados")->comment("Número de invitados al evento");
            $table->unsignedBigInteger("id_estado_evento")->comment("Fk estado reserva");

            //Campos Create_at y Update_at
            $table->timestamps();

            //Creacion llaves foraneas
            $table->foreign("id_tipo_evento")->references("id")->on("tipo_evento");
            $table->foreign("id_cliente")->references("id")->on("users");
            $table->foreign("id_estado_evento")->references("id")->on("estados_reserva");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
