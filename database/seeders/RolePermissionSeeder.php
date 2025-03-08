<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
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
            'recuperation-rh',
            'demande-recuperation',
            'view-all-recuperation',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $adminRole = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions([
            'view-users', 'view-departments', 'view-formations', 'view-contracts','recuperation-rh',
            'view-jobs', 'view-career', 'view-hierarchy', 'view-demandes','create-demande-conge', 
        ]);

        $rhManagerRole = Role::firstOrCreate(['name' => 'RH Manager', 'guard_name' => 'web']);
        $rhManagerRole->syncPermissions([
            'view-users', 'view-departments', 'view-formations', 'view-contracts',
            'view-jobs', 'view-career', 'view-hierarchy', 'view-demandes','create-demande-conge', 
        ]);

        $managerRole = Role::firstOrCreate(['name' => 'Manager', 'guard_name' => 'web']);
        $managerRole->syncPermissions([
            'view-users', 'view-departments', 'view-formations', 'view-contracts',
            'view-jobs', 'view-career', 'view-hierarchy', 'view-demandes', 'create-demande-conge', 
        ]);

        $employeeRole = Role::firstOrCreate(['name' => 'Employé', 'guard_name' => 'web']);
        $employeeRole->syncPermissions([
            'view-career', 'view-hierarchy', 'view-users', 'create-demande-conge',
        ]);

        $user = User::find(1);
        if ($user) {
            $user->assignRole('Admin');
        }
    }
}
