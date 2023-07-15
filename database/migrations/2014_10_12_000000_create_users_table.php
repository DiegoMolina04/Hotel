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
        Schema::create('users', function (Blueprint $table) {
            //Llave Primaria
            $table->id();

            //Columnas Personalizadas
            $table->string("nombre",50)->comment("Nombre Completo")->unique();

            $table->unsignedBigInteger("id_pais")->comment("Fk Id Pais");
            $table->unsignedBigInteger("id_genero")->comment("Fk Genero");
            $table->unsignedBigInteger("id_tip_doc")->comment("Fk tipo Documento");

            $table->string("num_documento",15)->comment("Numero de Documento")->unique();
            $table->string("num_telefono",15)->comment("Numero Telefonico")->unique();
            $table->date("fecha_nacimiento")->comment("Fecha de Nacimiento");

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->boolean('activa')->nullable()->default(true);

            $table->rememberToken();
            $table->timestamps();

            //Creacion Llaves foraneas
            $table->foreign("id_pais")->references("id")->on("paises");
            $table->foreign("id_genero")->references("id")->on("generos");
            $table->foreign("id_tip_doc")->references("id")->on("tipo_documentos");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
