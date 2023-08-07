<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermission = Permission::where('role', 'admin')->get();
        $userPermission = Permission::where('role', 'user')->get();
        $managerPermission = Permission::where('role', 'manager')->get();
        $hrPermission = Permission::where('role', 'HR')->get();
        $accountantPermission = Permission::where('role', 'accountant')->get();



        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();
        $managerRole = Role::where('name', 'manager')->first();
        $hrRole = Role::where('name', 'HR')->first();
        $accountantRole = Role::where('name', 'accountant')->first();

        
        $adminRole->syncPermissions([$userPermission,$adminPermission, $userPermission,$managerPermission, $hrPermission, $accountantPermission]);
        $userRole->syncPermissions([$userPermission,]);
        $managerRole->syncPermissions([$userPermission,$managerPermission]);
        $hrRole->syncPermissions([$userPermission,$hrPermission]);
        $accountantRole->syncPermissions([$userPermission,$accountantPermission]);
    }
}
