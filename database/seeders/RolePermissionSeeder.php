<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // -------------------------
        // 1️⃣ Define Permissions
        // -------------------------
        $permissions = [
            'view dashboard',
            'manage users',
            'manage roles',
            'approve loans',
            'disburse loans',
            'view reports',
            'view applications',
            'print reports',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // -------------------------
        // 2️⃣ Define Roles and Assign Permissions
        // -------------------------
        $rolesPermissions = [
            'superadmin'  => Permission::all()->pluck('name')->toArray(), // all permissions
            'admin'       => ['view dashboard', 'manage users', 'manage roles', 'view reports'],
            'accountant'  => ['view dashboard', 'view reports', 'view applications', 'print reports'],
            'mwenyekiti'  => ['view dashboard', 'view reports', 'approve loans'],
            'katibu'      => ['view dashboard', 'view reports'],
        ];

        foreach ($rolesPermissions as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($perms);
        }

        // -------------------------
        // 3️⃣ Optional: Assign Default Roles to Users
        // -------------------------
        // For example, assign 'superadmin' to the first user
        $firstUser = \App\Models\User::first();
        if ($firstUser && !$firstUser->hasAnyRole(array_keys($rolesPermissions))) {
            $firstUser->assignRole('superadmin');
        }
    }
}
