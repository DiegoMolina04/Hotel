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
        Schema::create('estados_elemento', function (Blueprint $table) {
            //Llave Primaria
            $table->id();
            
            //Campos Personalizados
            $table->string("nombre",10)->comment("Nombre estado Elemento")->unique();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estados_elemento');
    }
};
