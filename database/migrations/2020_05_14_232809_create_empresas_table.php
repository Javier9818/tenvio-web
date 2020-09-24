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
            $table->string('ruc')->nullable();
            $table->string('nombre', 100);
            $table->string('token_fb', 200)->nullable();
            $table->string('fb_id', 20)->nullable();
            $table->string('nombre_unico', 110)->unique();
            $table->string('descripcion')->nullable();
            $table->string('telefono', 10)->nullable();
            $table->string('celular', 10);
            $table->string('direccion', 100);
            $table->string('foto', 100)->nullable();
            $table->integer('ciudad_id');
            $table->string('estado', 20)->default('ACTIVO');
            $table->string('latitud', 25)->nullable();
            $table->string('longitud', 25)->nullable();
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
