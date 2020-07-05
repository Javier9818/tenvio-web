<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->integer('empresa_id');
            $table->integer('plan_id');
            $table->string('estado',20);
            $table->float('plan_precio');
            $table->integer('pedidos_total');
            $table->integer('pedidos_contador');
            $table->dateTime('fecha_inicio')->default(now());
            $table->dateTime('fecha_vencimiento');
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
        Schema::dropIfExists('contratos');
    }
}
