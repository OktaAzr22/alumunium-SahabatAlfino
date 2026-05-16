<?php

namespace Database\Seeders;

use App\Models\Accessory;
use App\Models\Material;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Material::create([
            'name' => 'Aluminium Premium',
            'price' => 95000,
            'unit' => 'meter',
        ]);

        Accessory::create([
            'name' => 'Handle Premium',
            'price' => 75000,
        ]);

        Accessory::create([
            'name' => 'Soft Closing ',
            'price' => 150000,
        ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            OrderStatusSeeder::class,
        ]);
    }
}
