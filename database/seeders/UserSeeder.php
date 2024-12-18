<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Clear cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create users
        $admin1 = User::firstOrCreate(
            ['email' => 'admin1@example.com'],
            [
                'name' => 'Admin One',
                'password' => Hash::make('password'),
            ]
        );
        $admin1->assignRole('admin');

        $admin2 = User::firstOrCreate(
            ['email' => 'admin2@example.com'],
            [
                'name' => 'Admin Two',
                'password' => Hash::make('password'),
            ]
        );
        $admin2->assignRole('admin');

        $agent1 = User::firstOrCreate(
            ['email' => 'agent1@example.com'],
            [
                'name' => 'Agent One',
                'password' => Hash::make('password'),
            ]
        );
        $agent1->assignRole('agent');

        $agent2 = User::firstOrCreate(
            ['email' => 'agent2@example.com'],
            [
                'name' => 'Agent Two',
                'password' => Hash::make('password'),
            ]
        );
        $agent2->assignRole('agent');

        $customer1 = User::firstOrCreate(
            ['email' => 'customer1@example.com'],
            [
                'name' => 'Customer One',
                'password' => Hash::make('password'),
            ]
        );
        $customer1->assignRole('customer');

        $customer2 = User::firstOrCreate(
            ['email' => 'customer2@example.com'],
            [
                'name' => 'Customer Two',
                'password' => Hash::make('password'),
            ]
        );
        $customer2->assignRole('customer');
    }
}
