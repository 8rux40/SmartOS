<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolesAndPermissionsSeeder::class,
            UserSeeder::class,
            PecasSeeder::class,
            ClienteSeeder::class,
            CelularSeeder::class,
            // OrcamentoSeeder::class,
            // PecasUtilizadasSeeder::class,
            // OrdemDeServicoSeedes::class
        ]);
    }
}
