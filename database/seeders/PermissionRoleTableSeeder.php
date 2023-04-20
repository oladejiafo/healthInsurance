<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'Auditor', 'slug' => 'auditor']);
        $cfoRole = Role::create(['name' => 'CLient Relation', 'slug' => 'client_relation']);

        // Create permissions

        $viewClaimsPermission = Permission::create(['name' => 'view claims', 'slug' => 'view-claims']);
        $createClaimsPermission = Permission::create(['name' => 'create claims', 'slug' => 'create-claims']);
        $editClaimsPermission = Permission::create(['name' => 'edit claims', 'slug' => 'edit-claims']);
        $deleteClaimsPermission = Permission::create(['name' => 'delete claims', 'slug' => 'delete-claims']);
        $viewTariffsPermission = Permission::create(['name' => 'view tariffs', 'slug' => 'view-tariffs']);
        $createTariffsPermission = Permission::create(['name' => 'create tariffs', 'slug' => 'create-tariffs']);
        $editTariffsPermission = Permission::create(['name' => 'edit tariffs', 'slug' => 'edit-tariffs']);
        $deleteTariffsPermission = Permission::create(['name' => 'delete tariffs', 'slug' => 'delete-tariffs']);

        // Assign permissions to roles
        $adminRole->permissions()->attach([$viewClaimsPermission->id, $createClaimsPermission->id, $editClaimsPermission->id, $deleteClaimsPermission->id, $viewTariffsPermission->id, $createTariffsPermission->id, $editTariffsPermission->id, $deleteTariffsPermission->id]);
        $cfoRole->permissions()->attach([$viewClaimsPermission->id, $viewTariffsPermission->id]);
    }
}
