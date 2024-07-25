<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء صلاحيات
        $permissions = [
            'view flights',
            'create flights',
            'update flights',
            'delete flights',
            'view clients',
            'create clients',
            'update clients',
            'delete clients',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // إنشاء أدوار وإضافة صلاحيات
        $roles = [
            'admin' => Permission::all(),
            'agent' => Permission::whereIn('name', ['view flights', 'create flights'])->get(),
            'user' => Permission::whereIn('name', ['view flights'])->get(),
            'client' => Permission::whereIn('name', ['view clients'])->get(),
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo($rolePermissions);
        }
    }
}
