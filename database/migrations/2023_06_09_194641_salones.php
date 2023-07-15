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
        Schema::create('salones', function (Blueprint $table) {
            //Llave Primaria
            $table->id();

            //Campos Personalizados
            $table->unsignedBigInteger("id_tip_salon")->comment("Fk tipo Salon");
            $table->string("codigo",4)->comment("Codigo Salon")->unique();

            //Creacion Llaves Foraneas
            $table->foreign("id_tip_salon")->references("id")->on("tipo_salon");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salones');
    }
};
