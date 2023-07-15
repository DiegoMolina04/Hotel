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
        Schema::create('reportes', function (Blueprint $table) {
            //Llave Primaria
            $table->id();

            //Campos Personalizados
            $table->unsignedBigInteger("id_empleado")->comment("Fk Id empleado");
            $table->unsignedBigInteger("id_elemento")->comment("Fk Id elemento");

            //Campos Create_at y Update_at
            $table->timestamps();

            //Creacion Llaves foraneas
            $table->foreign("id_empleado")->references("id")->on("users");
            $table->foreign("id_elemento")->references("id")->on("elementos");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
