<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('sku', 10);
            $table->string('slug', 255);
            $table->string('thumb', 255);
            $table->text('thumb_list');
            $table->integer('price');
            $table->integer('sale');
            $table->integer('quantity');
            $table->integer('number_buy');
            $table->integer('catid');
            $table->integer('brandid');
            $table->integer('producerid');
            $table->integer('view');
            $table->integer('featured');
            $table->integer('status');
            $table->integer('trash');
            $table->string('intro_desc', 255);
            $table->text('detail_desc');
            $table->string('meta_title', 150);
            $table->string('meta_keyword', 150);
            $table->text('meta_description');
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
        Schema::dropIfExists('product');
    }
}
