<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role::factory()->count(4)->create();
    }

    
    // 1. Démarrer Tinker
    // php artisan tinker

    // // 2. Vider les tables 
    // DB::table('role_has_permissions')->truncate();
    // DB::table('model_has_roles')->truncate();

    // // 3. Importer les modèles nécessaires
    // use Spatie\Permission\Models\Role;
    // use Spatie\Permission\Models\Permission;

    // // 4. Récupérer les rôles
    // $admin = Role::where('name', 'Admin')->first();
    // $rhManager = Role::where('name', 'RH Manager')->first();
    // $manager = Role::where('name', 'Manager')->first();
    // $employe = Role::where('name', 'Employé')->first();

    // // 5. Assigner les permissions aux rôles

    // // Admin : Toutes les permissions
    // $allPermissions = Permission::all();
    // $admin->syncPermissions($allPermissions);

    // // RH Manager
    // $rhManager->syncPermissions([
    //     'create-employe', 'edit-employe', 'delete-employe', 'view-employe',
    //     'approve-leave', 'reject-leave', 'manage-payroll',
    //     'view-users', 'view-departments', 'view-formations', 'view-contracts',
    // ]);

    // // Manager
    // $manager->syncPermissions([
    //     'view-employe', 'view-department', 'view-formation', 'view-contract',
    //     'view-jobs', 'generate-reports',
    // ]);

    // // Employé
    // $employe->syncPermissions([
    //     'view-career', 'view-hierarchy',
    // ]);

}
