<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('nome');
            $table->string('nome_unidade');
            $table->string('imagem');
            $table->string('caminho');
            $table->string('horario');
            $table->string('telefone');
            $table->string('ouvidoria');
            $table->string('endereco');
            $table->string('texto');
            $table->string('sigla');
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
        Schema::dropIfExists('unidades');
    }
}
