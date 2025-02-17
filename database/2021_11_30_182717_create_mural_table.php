<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMuralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mural', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('imagem');
            $table->string('caminho');
            $table->string('titulo');
            $table->string('texto');
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->string('unidade_id');
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
        Schema::dropIfExists('mural');
    }
}
