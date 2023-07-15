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
        Schema::create('elemento_habitacion', function (Blueprint $table) {

            //Llave Primaria
            $table->id();

            //Campos Personalizados
            $table->unsignedBigInteger("id_elemento")->comment("Fk Id Elemento");
            $table->unsignedBigInteger("id_habitacion")->comment("Fk Id Habitacion");
            $table->unsignedBigInteger("id_estado_elemento")->comment("Fk Id estado elemento");

            //Campos Create_at y Update_at
            $table->timestamps();

            //Creacion llaves foreaneas
            $table->foreign("id_elemento")->references("id")->on("elementos");
            $table->foreign("id_habitacion")->references("id")->on("habitaciones");
            $table->foreign("id_estado_elemento")->references("id")->on("estados_elemento");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elemento_habitacion');
    }
};
