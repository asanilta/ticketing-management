<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        Permission::firstOrCreate(['name' => 'create ticket']);
        Permission::firstOrCreate(['name' => 'view ticket']);
        Permission::firstOrCreate(['name' => 'update ticket']);
        Permission::firstOrCreate(['name' => 'delete ticket']);
        Permission::firstOrCreate(['name' => 'assign ticket']);

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'view ticket',
            'update ticket',
            'delete ticket',
            'assign ticket',
        ]);

        $agentRole = Role::firstOrCreate(['name' => 'agent']);
        $agentRole->givePermissionTo([
            'view ticket',
            'update ticket',
        ]);

        $customerRole = Role::firstOrCreate(['name' => 'customer']);
        $customerRole->givePermissionTo([
            'create ticket',
            'view ticket',
        ]);

    }
}
