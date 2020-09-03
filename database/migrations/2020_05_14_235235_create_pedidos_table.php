<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('empresa_id');
            $table->string('estado', 20)->default('PENDIENTE');
			$table->string('estadoPago', 20);
            $table->integer('id_tipopago');
            $table->integer('id_regpago');
            $table->string('comentario', 100)->nullable();
            $table->string('latitud');
            $table->string('longitud');
            $table->string('meta_latitud')->nullable();
            $table->string('meta_longitud')->nullable();
            $table->integer('user_id');
            $table->integer('tipo_id');
            $table->string('direccion');
            $table->double('monto');
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
        Schema::dropIfExists('pedidos');
    }
}
