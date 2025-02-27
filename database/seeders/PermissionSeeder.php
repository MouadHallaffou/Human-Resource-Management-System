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
            'create employe', 'edit employe', 'delete employe', 'view employe',
            'create département', 'edit département', 'delete département', 'view département',
            'create contrats', 'edit contrats', 'delete contrats', 'view contrats',
            'approve leave', 'reject leave', 'manage payroll', 'generate reports'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

    }
}
