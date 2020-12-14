<?php

use Brick\Math\BigInteger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePecaUtilizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pecas_utilizadas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('peca_id')->unsigned();
            $table->bigInteger('ordem_servico_id')->unsigned();
            $table->timestamps();
            $table->integer('quantidade_utilizada');
            $table->foreign('peca_id')->references('id')->on('pecas');
            $table->foreign('ordem_servico_id')->references('id')->on('ordens_de_servico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pecas_utilizadas');
    }
}
