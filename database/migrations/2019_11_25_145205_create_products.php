<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 300);
            $table->string('description', 300);
            $table->integer('quantity');
            // float coloca a quantidade de casas antes e depois da virgula:
            $table->float('price', 10, 2);
            // foreign key:
                //conforme documentacao, o cascade define que se o usuario que tem o produto for deletado, todos os produtos criados por ele serao apagados junto (default). Por isso, o usuario nunca pode ser apagado, mas desativado.
                //campo criado, depois o campo buscado e por ultimo a tabela onde busco este campo:
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('products');
    }
}
