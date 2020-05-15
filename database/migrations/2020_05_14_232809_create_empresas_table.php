<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('ruc');
            $table->string('nombre', 100);
            $table->string('descripcion');
            $table->string('telefono', 10)->nullable();
            $table->string('celular', 10);
            $table->string('direccion', 100);
            $table->string('email', 100);
            $table->string('foto', 100);
            $table->integer('categoria_id');
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
        Schema::dropIfExists('empresas');
    }
}
