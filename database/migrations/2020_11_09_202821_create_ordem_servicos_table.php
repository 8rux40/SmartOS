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
            $table->longText('descricao_problema');
            $table->longText('descricao_problema_reparador')->nullable();
            $table->longText('descricao_servico_executado')->nullable();
            $table->float('valor_total')->nullable();
            $table->float('valor_servico')->nullable();
            $table->float('valor_pecas')->nullable();
            $table->float('valor_orcamento')->nullable();
            $table->date('data_abertura')->nullable();
            $table->date('data_fechamento')->nullable();
            $table->longText('termo_garantia')->default('O cliente tem até 90 dias para reclamar de defeitos no produto durável (Celular) de acordo com o Art. 26 inc. II no código de defesa do consumidor. Limpeza e conservação do aparelho não fazem parte desta garantia. Para acionar a garantia é necessário apresentação do cupom fiscal ou documento de identidade. Qualquer mau funcionamento após atualização do Sistema Operacional pós entrega do equipamento reparado não fará parte da garantia. A garantia é válida somente ao item descrito na ordem de serviço.');

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
