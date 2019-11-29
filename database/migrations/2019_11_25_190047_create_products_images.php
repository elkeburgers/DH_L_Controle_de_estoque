<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url_img', 300);
            $table->string('description', 300);
            $table->unsignedBigInteger('product_id');
            $table->timestamps();
            //por semantica eh  costume colocar as chaves estrangeiras no final da tabela, para ficar no comeco só o que eh da tabela
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_images');
    }
}
