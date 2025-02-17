<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRamaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ramais', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('nome');
            $table->string('telefone');
            $table->string('funcionario');
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->unsignedBigInteger('setor_id');
            $table->foreign('setor_id')->references('id')->on('setores');
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
        Schema::dropIfExists('ramais');
    }
}
