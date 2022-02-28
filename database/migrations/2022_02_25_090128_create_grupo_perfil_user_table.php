<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoPerfilUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_perfil_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grupo_indic_id');
            $table->foreign('grupo_indic_id')->references('id')->on('grupo_indicadores');
            $table->unsignedBigInteger('perfil_user_id');
            $table->foreign('perfil_user_id')->references('id')->on('perfil_user');
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
        Schema::dropIfExists('grupo_perfil_user');
    }
}
