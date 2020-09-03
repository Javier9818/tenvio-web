<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransCulqiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones_culqi', function (Blueprint $table) {
            $table->id();
            $table->string('transId', 30);
            $table->decimal('amount', 9, 2);
            $table->decimal('transfer_amount', 9, 2);
			$table->string('email', 100);
			$table->string('description', 80);
			$table->string('card_number', 16);
			$table->string('card_brand', 20);
			$table->string('card_type', 20);
			$table->string('reference_code', 15);
			$table->string('authorization_code', 10);
			$table->string('ip', 60);
			$table->string('device_type', 20);
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
        Schema::dropIfExists('transacciones_culqi');
    }
}
