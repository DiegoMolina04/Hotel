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
        Schema::create('pqrs', function (Blueprint $table) {
            //Llave Primaria
            $table->id();
            
            //Campos Personalizadas
            $table->unsignedBigInteger("id_tipo_pqrs")->comment("Fk Tipo pqrs");
            $table->unsignedBigInteger("id_cliente")->comment("Fk Cliente");
            $table->text("descripcion")->comment("Descripcion PQRS");
            $table->unsignedBigInteger("id_trabajador")->comment("Fk Trabajador");
            $table->text("respuesta")->comment("Respuesta PQRS");

            //Campos create_at y update_at
            $table->timestamps();

            //Creacion Llaves foraneas
            $table->foreign("id_tipo_pqrs")->references("id")->on("tipo_pqrs");
            $table->foreign("id_cliente")->references("id")->on("users");
            $table->foreign("id_trabajador")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pqrs');
    }
};
