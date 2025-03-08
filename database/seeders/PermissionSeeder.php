<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view-users',
            'view-departments',
            'view-formations',
            'view-contracts',
            'view-jobs',
            'view-career',
            'view-hierarchy',
            'view-demandes', 
            'create-demande-conge',
            'demande-recuperation',
            'view-all-recuperation',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

    }
}
