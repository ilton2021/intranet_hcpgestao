<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestaquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destaques', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('imagem');
            $table->string('caminho');
            $table->string('text');
            $table->string('titulo');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->string('imagem2');
            $table->string('caminho2');
            $table->string('imagem3');
            $table->string('caminho3');
            $table->string('imagem4');
            $table->string('caminho4');
            $table->string('imagem5');
            $table->string('caminho5');
            $table->string('imagem6');
            $table->string('caminho6');
            $table->unsignedBigInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
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
        Schema::dropIfExists('destaques');
    }
}
