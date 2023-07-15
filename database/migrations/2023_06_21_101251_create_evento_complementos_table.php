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
        Schema::create('evento_complementos', function (Blueprint $table) {
            // Id de registro, llave primaria
            $table->id();

            //Campos Personalizados
            $table->unsignedBigInteger("id_complemento")->comment("Fk Id complemento");
            $table->unsignedBigInteger("id_evento")->comment("Fk Id evento");

            //Creacion Llaves foraneas
            $table->foreign("id_complemento")->references("id")->on("complementos_eventos");
            $table->foreign("id_evento")->references("id")->on("eventos");
            

            // Time stamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento_complementos');
    }
};
