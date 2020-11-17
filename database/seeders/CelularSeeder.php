<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CelularSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('celulares')->insert([
            'cliente_id' => 1,
            'imei' => '054105-54-514456-6',
            'imei2' => '054125-54-514556-7',
            'marca' => 'LG',
            'modelo' => 'G7'
        ]);

        DB::table('celulares')->insert([
            'cliente_id' => 2,
            'imei' => '0554605-54-514456-6',
            'imei2' => '055455-54-515456-7',
            'marca' => 'Apple',
            'modelo' => 'Iphone X'
        ]);
        
        DB::table('celulares')->insert([
            'cliente_id' => 1,
            'imei' => '054105-34-514356-6',
            'imei2' => '054125-12-512556-7',
            'marca' => 'Samsung',
            'modelo' => 'Galaxy S10'
        ]);
        
        DB::table('celulares')->insert([
            'cliente_id' => 2,
            'imei' => '0541445-32-511256-6',
            'imei2' => '054425-12-514556-7',
            'marca' => 'Samsung',
            'modelo' => 'Galaxy A7'
        ]);

        DB::table('celulares')->insert([
            'cliente_id' => 3,
            'imei' => '0541105-52-543456-6',
            'imei2' => '054125-51-513456-7',
            'marca' => 'Motorola',
            'modelo' => 'Moto G6'
        ]);

        DB::table('celulares')->insert([
            'cliente_id' => 4,
            'imei' => '05665-54-5146656-6',
            'imei2' => '054665-54-5146656-7',
            'marca' => 'Xiaomi',
            'modelo' => 'Redmi Note 9S'
        ]);

        DB::table('celulares')->insert([
            'cliente_id' => 3,
            'imei' => '0541775-54-5714756-6',
            'imei2' => '054177-54-517756-7',
            'marca' => 'Sony',
            'modelo' => 'Xperia Z'
        ]);

        DB::table('celulares')->insert([
            'cliente_id' => 1,
            'imei' => '0541335-54-514336-6',
            'imei2' => '054123-54-513356-7',
            'marca' => 'Apple',
            'modelo' => 'Iphone 7'
        ]);

        DB::table('celulares')->insert([
            'cliente_id' => 3,
            'imei' => '052205-54-514226-6',
            'imei2' => '05225-54-512256-7',
            'marca' => 'Apple',
            'modelo' => 'Iphone 11'
        ]);

        DB::table('celulares')->insert([
            'cliente_id' => 4,
            'imei' => '0588805-54-514886-6',
            'imei2' => '058885-54-5188556-7',
            'marca' => 'Samsung',
            'modelo' => 'Galaxy Note 10'
        ]);

    }
}
