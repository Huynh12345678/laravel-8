<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ordercode', 32);
            $table->integer('userid');
            $table->dateTime('orderdate');
            $table->integer('money');
            $table->integer('price_ship');
            $table->integer('coupon');
            $table->integer('province');
            $table->integer('district');
            $table->text('address');
            $table->text('note');
            $table->integer('status');
            $table->integer('save');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
