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
        Schema::create('evento_salon', function (Blueprint $table) {
            //Llave Primaria
            $table->id();

            //Campos Personalizados
            $table->unsignedBigInteger("id_salon")->comment("Fk Id salon");
            $table->unsignedBigInteger("id_evento")->comment("Fk Id evento");

            //Creacion Llaves foraneas
            $table->foreign("id_salon")->references("id")->on("salones");
            $table->foreign("id_evento")->references("id")->on("eventos");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evento_salon');
    }
};
