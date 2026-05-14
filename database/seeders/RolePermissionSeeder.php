<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::firstOrCreate(['name' => 'view product']);
        Permission::firstOrCreate(['name' => 'create product']);
        Permission::firstOrCreate(['name' => 'edit product']);
        Permission::firstOrCreate(['name' => 'delete product']);

        Permission::firstOrCreate(['name' => 'view order']);
        Permission::firstOrCreate(['name' => 'create order']);
        Permission::firstOrCreate(['name' => 'update order status']);

        Permission::firstOrCreate(['name' => 'view dashboard']);

        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        $superAdmin->givePermissionTo(Permission::all());

        $admin->givePermissionTo([
            'view product',
            'create product',
            'edit product',
            'delete product',
            'view order',
            'update order status',
            'view dashboard',
        ]);

        $user->givePermissionTo([
            'view product',
            'create order',
            'view order',
        ]);
    }
}