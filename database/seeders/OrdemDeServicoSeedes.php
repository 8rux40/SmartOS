<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdemDeServicoSeedes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ordens_de_servico')->insert([
            'celular_id' => 1,
            'cliente_id' => 1,
            'status' => 3,
            'termo_garantia' => 'Ta Garantido',
            'descricao_problema' => 'Tela trincada',
            'descricao_problema_reparador' => 'Tela estilhaçada',
            'descricao_servico_executado' => 'Troca da do Painel e Display Frontal',
            'valor_total' => 229.9,
            'valor_servico' => 80,
            'valor_orcamento' => 229.90,
            'data_abertura' =>Carbon::now(),
            'created_at' => Carbon::now()
        ]);

        DB::table('ordens_de_servico')->insert([
            'celular_id' => 2,
            'cliente_id' => 1,
            'status' => 4,
            'termo_garantia' => 'Ta Garantido',
            'descricao_problema' => 'Bateria Explodiu',
            'descricao_problema_reparador' => 'Bateria com defeito',
            'descricao_servico_executado' => 'Troca da bateria',
            'valor_total' =>300,
            'valor_servico' => 100,
            'valor_orcamento' => 400,
            'data_abertura' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);

        DB::table('ordens_de_servico')->insert([
            'celular_id' => 2,
            'cliente_id' => 2,
            'status' => 3,
            'termo_garantia' => 'Ta Garantido',
            'descricao_problema' => 'Tela trincada',
            'descricao_problema_reparador' => 'Tela estilhaçada',
            'descricao_servico_executado' => 'Troca da do Painel e Display Frontal',
            'valor_total' => 229.9,
            'valor_servico' => 80,
            'valor_orcamento' => 229.90,
            'data_abertura' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);

        DB::table('ordens_de_servico')->insert([
            'celular_id' => 3,
            'cliente_id' => 1,
            'status' => 3,
            'termo_garantia' => 'Ta Garantido',
            'descricao_problema' => 'Tela trincada',
            'descricao_problema_reparador' => 'Tela estilhaçada',
            'descricao_servico_executado' => 'Troca da do Painel e Display Frontal',
            'valor_total' => 229.9,
            'valor_servico' => 80,
            'valor_orcamento' => 229.90,
            'data_abertura' => Carbon::now(),
            'created_at' => Carbon::now()
        ]);
    }
}
