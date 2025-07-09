<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Create roles
        $superadmin = Role::create(['name' => 'Superadmin']);
        $pgAdmin = Role::create(['name' => 'PG Admin']);
        $supportAdmin = Role::create(['name' => 'Support Admin']);

        // Create permissions
        // $permissions = [
        //     'manage users',
        //     'manage roles',
        //     'manage applications',
        //     'view applications',
        //     'process applications',
        //     'manage support tickets',
        //     'view support tickets',
        //     'resolve support tickets',
        // ];

        // foreach ($permissions as $permission) {
        //     Permission::create(['name' => $permission]);
        // }

        // // Assign permissions to roles
        // $superadmin->givePermissionTo(Permission::all());
        
        // $pgAdmin->givePermissionTo([
        //     'manage applications',
        //     'view applications',
        //     'process applications'
        // ]);

        // $supportAdmin->givePermissionTo([
        //     'manage support tickets',
        //     'view support tickets',
        //     'resolve support tickets'
        // ]);
    }
}