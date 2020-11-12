<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PecasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pecas')->insert([
            'titulo' => 'Bateria',
            'descricao' => 'Litio',
            'preco' => '120.99',
            'quantidade_pecas' => '100',
            'codigo' => '0643bat'
        ]);

        DB::table('pecas')->insert([
            'titulo' => 'Tela',
            'descricao' => 'Para Iphone 6',
            'preco' => '349.90',
            'quantidade_pecas' => '100',
            'codigo' => '0641TEL'
        ]);

        DB::table('pecas')->insert([
            'titulo' => 'Mic',
            'descricao' => 'Mic de Som Galaxy',
            'preco' => '30',
            'quantidade_pecas' => '100',
            'codigo' => '0643MIC'
        ]);

        DB::table('pecas')->insert([
            'titulo' => 'Vidro Traseiro',
            'descricao' => 'Para Galaxy S20',
            'preco' => '430.90',
            'quantidade_pecas' => '100',
            'codigo' => '0642TRAS'
        ]);

        DB::table('pecas')->insert([
            'titulo' => 'Camera',
            'descricao' => '42Mpx para Iphone',
            'preco' => '99.90',
            'quantidade_pecas' => '100',
            'codigo' => '064CAM'
        ]);
        
        DB::table('pecas')->insert([
            'titulo' => 'Tela',
            'descricao' => 'Para Galaxy 20',
            'preco' => '549.90',
            'quantidade_pecas' => '100',
            'codigo' => '0644TEL'
        ]);

        DB::table('pecas')->insert([
            'titulo' => 'Tela',
            'descricao' => 'Para LG G7',
            'preco' => '149.90',
            'quantidade_pecas' => '100',
            'codigo' => '06435TEL'
        ]);

        DB::table('pecas')->insert([
            'titulo' => 'Tela',
            'descricao' => 'Para Motorola Moto G6',
            'preco' => '120.90',
            'quantidade_pecas' => '100',
            'codigo' => '0647TEL'
        ]);
    }
}
