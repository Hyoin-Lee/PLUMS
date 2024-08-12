<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions
        $allPermissions = [
            'view', 'edit', 'create', 'delete', 'browse', 'show', 'add',
            'trash-recover', 'trash-remove', 'trash-empty', 'trash-restore',
            'view-users', 'create-user'
        ];

        // Create permissions
        foreach ($allPermissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $staffPermissions = [
            'view'
        ];

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($allPermissions);

        $staffRole = Role::create(['name' => 'staff']);
        $staffRole->givePermissionTo($staffPermissions);

//        Permission::create(['name' => 'view admins']);
//        Permission::create(['name' => 'edit admins']);
//        Permission::create(['name' => 'create admins']);
//        Permission::create(['name' => 'delete admins']);


//        $admin = Role::create(['name' => 'admin']);
//        $admin->givePermissionTo(['view admins', 'edit admins', 'create admins', 'delete admins']);
//
//        $staff = Role::create(['name' => 'staff']);
//        $staff->givePermissionTo(['view admins']);
    }
}
