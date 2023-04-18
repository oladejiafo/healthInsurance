<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Define your permissions here
        $permissions = [
            ['name' => 'view claims'],
            ['name' => 'create claims'],
            ['name' => 'edit claims'],
            ['name' => 'delete claims'],
            ['name' => 'view tariff'],
            ['name' => 'create tariff'],
            ['name' => 'edit tariff'],
            ['name' => 'delete tariff'],
        ];

        // Loop through the permissions and insert them into the database
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
