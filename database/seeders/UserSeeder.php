<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@gmail.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('123'),
            ]
        );

        $superAdmin->assignRole('super_admin');

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('123'),
            ]
        );

        $admin->assignRole('admin');

        $user = User::firstOrCreate(

            [
                'email' => 'user@example.com'
            ],

            [
                'name' => 'Yansaa',

                'password' => Hash::make('123'),
            ]
        );

        $user->assignRole('user');
    }
}