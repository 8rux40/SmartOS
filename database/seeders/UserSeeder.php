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
            'name' => 'Administrador',
            'username' => 'admin',
            'email' => 'admin@localhost',
            'password' => Hash::make('teste123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Atendente',
            'username' => 'atendente',
            'email' => 'atendente@localhost',
            'password' => Hash::make('teste123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Técnico Reparador',
            'username' => 'reparador',
            'email' => 'reparador@localhost',
            'password' => Hash::make('teste123'),
        ]);
        DB::table('users')->insert([
            'name' => 'Auxiliar de Estoque',
            'username' => 'auxiliar',
            'email' => 'auxiliar@localhost',
            'password' => Hash::make('teste123'),
        ]);
        User::where('username','admin')->first()->assignRole('Super Admin');
        User::where('username','atendente')->first()->assignRole('atendente');
        User::where('username','reparador')->first()->assignRole('reparador');
        User::where('username','auxiliar')->first()->assignRole('auxiliar de estoque');
    }
}
