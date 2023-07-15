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
        Schema::create('habitaciones', function (Blueprint $table) {

            //Llave Primaria
            $table->id();
            
            //Campos Personalizados
            $table->unsignedBigInteger("id_tip_hab")->comment("Fk tipo de habitacion");
            $table->string("codigo",4)->comment("Codigo habitacion")->unique();
            $table->unsignedBigInteger("id_estado")->comment("Fk estado de la habitacion");

            //Creacion Llaves Foraneas
            $table->foreign("id_tip_hab")->references("id")->on("tipo_habitacion");
            $table->foreign("id_estado")->references("id")->on("estados_habitacion");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }
};
