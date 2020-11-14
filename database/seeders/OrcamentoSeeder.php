<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrcamentoSeeder extends Seeder
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
            'status' => 1,
            'descricao_problema' => 'Tela trincada',
            'created_at' => Carbon::now()
        ]);

        DB::table('ordens_de_servico')->insert([
            'celular_id' => 2,
            'cliente_id' => 2,
            'status' => 2,
            'descricao_problema' => 'Display queimou',
            'valor_orcamento' => 200.0,
            'created_at' => Carbon::now()
        ]);
    }
}
