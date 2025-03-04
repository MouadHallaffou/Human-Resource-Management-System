<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\JoobsSeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\DepartementSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(1)->create();

        $this->call([
            // RoleSeeder::class,
            // PermissionSeeder::class,
            // CompanySeeder::class,
            // DepartementSeeder::class,
            // ContractSeeder::class,
            // JoobsSeeder::class,
            // FormationSeeder::class,
            RolePermissionSeeder::class,
        ]);

    }
}
