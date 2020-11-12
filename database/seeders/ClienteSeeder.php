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
            'cpf' => '444.555.666-12',
            'numero_cel' => '2298653212',
            'numero_tel' => '2238243824',
            'endereco' => 'Rua Valao da Cehab, Cehab',
            'email' => 'btardin@gmail.com'
        ]);

        DB::table('clientes')->insert([
            'nome' => 'Joao Paulo ',
            'cpf' => '412.525.466-52',
            'numero_cel' => '2255887799',
            'numero_tel' => '2238386633',
            'endereco' => 'Em algum Lugar Distante',
            'email' => 'joaopaulo@gmail.com'
        ]);

        DB::table('clientes')->insert([
            'nome' => 'Aroldo Rezende',
            'cpf' => '443.554.566-12',
            'numero_cel' => '2277441122',
            'numero_tel' => '2234444444',
            'endereco' => 'Perto daquele lugar la',
            'email' => 'aroldorezende@gmail.com'
        ]);

        DB::table('clientes')->insert([
            'nome' => 'Caio Trócilo',
            'cpf' => '443.554.566-68',
            'numero_cel' => '2269896969',
            'numero_tel' => '2233556688',
            'endereco' => 'Perto do centro',
            'email' => 'caio.trocilo@gmail.com'
        ]);

        DB::table('clientes')->insert([
            'nome' => 'Samir Assad',
            'cpf' => '123.434.546-12',
            'numero_cel' => '2274852652',
            'numero_tel' => '2238444458',
            'endereco' => 'Exatamente onde você está pensando',
            'email' => 'aroldorezende@gmail.com'
        ]);

        DB::table('clientes')->insert([
            'nome' => 'Alberto Roberto',
            'cpf' => '222.333.511-12',
            'numero_cel' => '2223334445',
            'numero_tel' => '2233445566',
            'endereco' => 'RDV BR 356 KM 02, S/N',
            'email' => 'albertoRoberto@gmail.com'
        ]);
    }
}
