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
        Schema::create('estados_habitacion', function (Blueprint $table) {

            //Llave Primaria
            $table->id();
            
            //Campos personalizados
            $table->string("nombre",50)->unique()->comment("Nombre del estado de la habitacion");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados_habitacion');
    }
};
