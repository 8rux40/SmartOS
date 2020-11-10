<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoCelularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos_celulares', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ordem_de_servico_id')->unsigned();

            $table->timestamps();
            $table->string('url_foto');

            $table->foreign('ordem_de_servico_id')->references('id')->on('ordens_de_servico');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fotos_celulares');
    }
}
