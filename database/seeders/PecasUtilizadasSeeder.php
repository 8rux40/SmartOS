<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PecasUtilizadasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pecas_utilizadas')->insert([
            'peca_id' => 7,
            'ordem_de_servico_id' => 1,
            'quantidade_utilizada' => 1,
            'created_at' => Carbon::now()
        ]);

        DB::table('pecas_utilizadas')->insert([
            'peca_id' => 2,
            'ordem_de_servico_id' => 2,
            'quantidade_utilizada' => 1,
            'created_at' => Carbon::now()
            ]);
            
    }
}
