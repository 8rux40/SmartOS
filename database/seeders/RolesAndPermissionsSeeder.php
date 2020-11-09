<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // orçamento
        Permission::create(['name' => 'gerenciar orcamento']);
        Permission::create(['name' => 'consultar orcamento']);
        Permission::create(['name' => 'informar orcamento']);

        // ordem de serviço
        Permission::create(['name' => 'gerar os']);
        Permission::create(['name' => 'editar os']);
        Permission::create(['name' => 'cancelar os']);
        Permission::create(['name' => 'consultar os']);
        Permission::create(['name' => 'fechar os']);

        // peças
        Permission::create(['name' => 'gerenciar pecas']);
        
        // outras
        Permission::create(['name' => 'gerar comprovante pagamento']);
        Permission::create(['name' => 'emitir relatorio de estoque']);

        // atores
        $role = Role::create(['name' => 'atendente'])->givePermissionTo([
            'gerenciar orcamento', 
            'gerar os', 
            'editar os', 
            'gerar comprovante pagamento',
            'cancelar os',
            'consultar os',
        ]);
        $role = Role::create(['name' => 'reparador'])->givePermissionTo([
            'consultar os',
            'fechar os', 
            'consultar orcamento', 
            'informar orcamento', 
        ]);
        $role = Role::create(['name' => 'auxiliar de estoque'])->givePermissionTo([
            'gerenciar pecas',
            'emitir relatorio de estoque', 
        ]);

        $role = Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo(Permission::all());
    }
}
