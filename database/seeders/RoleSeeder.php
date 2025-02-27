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

    
    // // asigne roles using tinker::
    // //1:
    // php artisan tinker

    // //2:
    // DB::table('role_has_permissions')->truncate();
    // DB::table('model_has_roles')->truncate();

    // //3:
    // use Spatie\Permission\Models\Role;
    // use Spatie\Permission\Models\Permission;

    // $admin = Role::where('name', 'Admin')->first();
    // $manager = Role::where('name', 'Manager')->first();
    // $rhManager = Role::where('name', 'RH Manager')->first();
    // $employe = Role::where('name', 'Employé')->first();

    // $allPermissions = Permission::all();

    // $admin->syncPermissions($allPermissions);
    // $manager->syncPermissions(['view employe', 'edit employe', 'generate reports']);
    // $rhManager->syncPermissions(['view employe', 'approve leave', 'reject leave']);
    // $employe->syncPermissions(['view employe']);


}
