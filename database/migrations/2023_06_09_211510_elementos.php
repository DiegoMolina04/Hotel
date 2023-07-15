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
        Schema::create('elementos', function (Blueprint $table) {
            //Llave Primaria
            $table->id();

            //Campos Personalizados
            $table->unsignedBigInteger("id_tipo_elemento")->comment("Fk tipo de elemento");
            $table->string("serial",20)->comment("Serial del Elemento")->unique();

            //Campos Create_at y Update_at
            $table->timestamps();
            
            //Creacion de Llaves Foraneas
            $table->foreign("id_tipo_elemento")->references("id")->on("tipo_elemento");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elementos');
    }
};
