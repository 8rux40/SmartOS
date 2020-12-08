<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens_de_servico', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('celular_id')->unsigned();
            $table->bigInteger('cliente_id')->unsigned();

            $table->timestamps();
            /**
             * 1 - Orçamento pendente
             * 2 - Aguardando OS
             * 3 - Aberta
             * 4 - Concluída
             * 5 - Cancelada
             */
            $table->integer('status'); 
            $table->string('termo_garantia')->nullable();
            $table->longText('descricao_problema');
            $table->longText('descricao_problema_reparador')->nullable();
            $table->longText('descricao_servico_executado')->nullable();
            $table->float('valor_total')->nullable();
            $table->float('valor_servico')->nullable();
            $table->float('valor_orcamento')->nullable();
            $table->date('data_abertura')->nullable();
            $table->date('data_fechamento')->nullable();

            $table->foreign('celular_id')->references('id')->on('celulares');
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordens_de_servico');
    }
}
