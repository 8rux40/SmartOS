<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'nome' => 'Bruno Rocha Tardin',
            'cpf' => '44455566612',
            'numero_cel' => '2298653212',
            'numero_tel' => '2238243824',
            'endereco' => 'Rua Valao da Cehab, Cehab',
            'email' => 'btardin@gmail.com'
        ]);

        DB::table('clientes')->insert([
            'nome' => 'Joao Paulo ',
            'cpf' => '41252546652',
            'numero_cel' => '2255887799',
            'numero_tel' => '2238386633',
            'endereco' => 'Em algum Lugar Distante',
            'email' => 'joaopaulo@gmail.com'
        ]);

        DB::table('clientes')->insert([
            'nome' => 'Aroldo Rezende',
            'cpf' => '44355456612',
            'numero_cel' => '2277441122',
            'numero_tel' => '2234444444',
            'endereco' => 'Perto daquele lugar la',
            'email' => 'aroldorezende@gmail.com'
        ]);

        DB::table('clientes')->insert([
            'nome' => 'Caio Trócilo',
            'cpf' => '44355456668',
            'numero_cel' => '2269896969',
            'numero_tel' => '2233556688',
            'endereco' => 'Perto do centro',
            'email' => 'caio.trocilo@gmail.com'
        ]);

        DB::table('clientes')->insert([
            'nome' => 'Samir Assad',
            'cpf' => '12343454612',
            'numero_cel' => '2274852652',
            'numero_tel' => '2238444458',
            'endereco' => 'Exatamente onde você está pensando',
            'email' => 'aroldorezende@gmail.com'
        ]);

        DB::table('clientes')->insert([
            'nome' => 'Astolfo',
            'cpf' => '22233351112',
            'numero_cel' => '2223334445',
            'numero_tel' => '2233445566',
            'endereco' => 'RDV BR 356 KM 02, S/N',
            'email' => 'astolfo@gmail.com'
        ]);
    }
}
