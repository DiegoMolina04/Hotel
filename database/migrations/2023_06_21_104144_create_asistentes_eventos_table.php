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
        Schema::create('asistentes_eventos', function (Blueprint $table) {
            // Id asistente evento, llave primaria
            $table->id();

            //Campos personalizados 
            $table->unsignedBigInteger("id_evento")->comment("Fk Id evento");
            $table->string("nombre",50)->comment("Nombre Completo");
            $table->unsignedBigInteger("id_tip_doc")->comment("Fk tipo Documento");
            $table->string("num_documento",15)->comment("Numero de Documento");
            $table->boolean("especial")->default(false)->comment("Se define si un invitado es especial o no");

            // Creación llaves foraneas 
            $table->foreign("id_tip_doc")->references("id")->on("tipo_documentos");
            $table->foreign("id_evento")->references("id")->on("eventos");

            // Marcas de tiempo 
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
        Schema::dropIfExists('asistentes_eventos');
    }
};
