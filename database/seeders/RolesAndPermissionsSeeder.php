<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Crear permisos
        Permission::create(['name' => 'crear usuarios']);
        Permission::create(['name' => 'editar usuarios']);
        Permission::create(['name' => 'eliminar usuarios']);
        Permission::create(['name' => 'ver usuarios']);

        // Crear roles y asignar permisos
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(['crear usuarios', 'editar usuarios', 'eliminar usuarios', 'ver usuarios']);

        $userRole = Role::create(['name' => 'usuario']);
        $userRole->givePermissionTo(['ver usuarios']);
    }
}
