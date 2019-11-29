<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            // criado esta linha extra para ficar de acordo com o o nosso DER:
            $table->string('img_profile', 300);
            $table->rememberToken();
            // comando abaixo eh para podermos ativar ou dasativar o usuario, para nao apagarmos o usuario e consequentemente apagar todos os produtos que ele criou
            $table->integer('active');
            // comando abaixo eh automatico e cria default o created_at e o update_at na nossa tabela:
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
        Schema::dropIfExists('users');
    }
}
