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
        Schema::create('estados_reserva', function (Blueprint $table) {
            //Llave primaria
            $table->id();

            //Campos personalizados
            $table->string("nombre",20)->comment("Nombre estado reserva")->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados_reserva');
    }
};
