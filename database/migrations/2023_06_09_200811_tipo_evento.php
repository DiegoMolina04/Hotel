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
        Schema::create('tipo_evento', function (Blueprint $table) {
            //Llave Primaria
            $table->id();

            //Columnas Personalizadas
            $table->string("nombre",255)->comment("Nombre tipo de evento")->unique();
            $table->text("detallado")->comment("Detallado del tipo de evento");
            $table->string("nom_especiales")->default(0)->comment("Nombre con el que se identificarán los invitados especiales");
            $table->integer("max_especiales")->default(0)->comment("Número máximo de invitados especiales");
            $table->integer("min_especiales")->default(0)->comment("Número mínimo de invitados especiales");
            $table->string("precio_general")->default("0")->comment("Precio base de evento");
            $table->string("precio_invitado")->default("0")->comment("Precio por invitado");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_evento');
    }
};
