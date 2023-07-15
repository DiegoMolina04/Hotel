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
        Schema::create('complementos_eventos', function (Blueprint $table) {
            // Llave primaria de tabla
            $table->id();

            // Campos personalizados tabla 
            $table->string('nombre')->comment('Nombre del complemento de evento');
            $table->string('precio_general')->comment('Precio general de evento (es el mismo sin importar el número de invitados)');
            $table->string('precio_invitado')->comment('Precio por invitado de complemento');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('complementos_eventos');
    }
};
