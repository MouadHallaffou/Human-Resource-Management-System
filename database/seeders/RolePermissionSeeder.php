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
        // Définition des permissions
        $permissions = [
            'create-employe', 'edit-employe', 'delete-employe', 'view-employe',
            'create-department', 'edit-department', 'delete-department', 'view-department',
            'create-formation', 'edit-formation', 'delete-formation', 'view-formation',
            'create-contract', 'edit-contract', 'delete-contract', 'view-contract',
            'approve-leave', 'reject-leave', 'manage-payroll',
            'generate-reports','view-users', 'view-departments', 'view-formations', 
            'view-contracts','view-jobs', 'view-career', 'view-hierarchy',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'web']);
        }

        $adminRole = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions($permissions); 

        $rhManagerRole = Role::create(['name' => 'RH Manager', 'guard_name' => 'web']);
        $rhManagerRole->syncPermissions([
            'create-employe', 'edit-employe', 'delete-employe', 'view-employe',
            'approve-leave', 'reject-leave', 'manage-payroll',
            'view-users', 'view-departments', 'view-formations', 'view-contracts',
        ]);

        $managerRole = Role::create(['name' => 'Manager', 'guard_name' => 'web']);
        $managerRole->syncPermissions([
            'view-employe', 'view-department', 'view-formation', 'view-contract',
            'view-jobs', 'generate-reports',
        ]);

        $employeeRole = Role::create(['name' => 'Employé', 'guard_name' => 'web']);
        $employeeRole->syncPermissions([
            'view-career', 'view-hierarchy','view-employe',
        ]);


        $user = User::find(1);
        if ($user) {
            $user->assignRole('Admin');
        }
    }
}