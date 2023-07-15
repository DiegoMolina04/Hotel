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
        Schema::create('factura_habitacion', function (Blueprint $table) {

            //Llave Primaria
            $table->id();

            //Campos Personalizados
            $table->unsignedBigInteger("fk_reserva_habitacion")->comment("Fk Id Reservacion")->unique();
            $table->string("subtotal",20)->comment("Valor Neto de la reservacion");
            $table->string("valor_iva",20)->comment("Valor Iva");
            $table->string("valor_total",20)->comment("Valor Final");
            $table->unsignedBigInteger("fk_metodo_pago")->comment("Fk Id metodo de Pago")->nullable();

            //Campos Create_at y Update_at
            $table->timestamps();

            //Creacion Llaves Foraneas
            $table->foreign("fk_reserva_habitacion")->references("id")->on("reservas");
            $table->foreign("fk_metodo_pago")->references("id")->on("metodos_pago");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_habitacion');
    }
};
