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
            $table->string('estado', 20);
            $table->string('comentario', 100);
            $table->string('latitud');
            $table->string('longitud');
            $table->string('meta_latitud');
            $table->string('meta_longitud');
            $table->integer('user_id');
            $table->integer('tipo_id');
            $table->string('direccion');
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
