<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            FacultySeeder::class,
            DepartmentSeeder::class,
            ProgrammesTableSeeder::class,
        ]);

        // Create a superadmin user
        $superadmin = \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
        ]);
        $superadmin->assignRole('Superadmin');

        // Create a PG admin user
        $pgAdmin = \App\Models\User::factory()->create([
            'name' => 'PG Admin',
            'email' => 'pgadmin@example.com',
        ]);
        $pgAdmin->assignRole('PG Admin');

        // Create a support admin user
        $supportAdmin = \App\Models\User::factory()->create([
            'name' => 'Support Admin',
            'email' => 'support@example.com',
        ]);
        $supportAdmin->assignRole('Support Admin');
    }
}
