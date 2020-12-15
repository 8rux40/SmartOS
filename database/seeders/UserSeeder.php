<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Bruno Tardin',
            'username' => 'btardin',
            'email' => 'btardin@smartos.com.br',
            'password' => Hash::make('teste123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Aroldo Rezende',
            'username' => 'arezende',
            'email' => 'arezende@smartos.com.br',
            'password' => Hash::make('teste123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Caio Trócilo',
            'username' => 'ctrocilo',
            'email' => 'ctrocilo@smartos.com.br',
            'password' => Hash::make('teste123'),
        ]);
        DB::table('users')->insert([
            'name' => 'João Paulo Alves',
            'username' => 'jalves',
            'email' => 'jalves@smartos.com.br',
            'password' => Hash::make('teste123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Samir Assad',
            'username' => 'sassad',
            'email' => 'sassad@smartos.com.br',
            'password' => Hash::make('teste123'),
        ]);
        User::where('username','btardin' )->first()->assignRole('Super Admin');
        User::where('username','arezende')->first()->assignRole('atendente');
        User::where('username','ctrocilo')->first()->assignRole('reparador');
        User::where('username','jalves'  )->first()->assignRole('reparador');
        User::where('username','sassad'  )->first()->assignRole('auxiliar de estoque');
    }
}
