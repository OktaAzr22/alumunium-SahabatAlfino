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
            'name' => 'Aluminium Standar',
            'price' => 120000,
            'unit' => 'meter',
        ]);

        Material::create([
            'name' => 'Aluminium Premium',
            'price' => 180000,
            'unit' => 'meter',
        ]);

        Accessory::create([
            'name' => 'Kunci',
            'price' => 50000,
        ]);

        Accessory::create([
            'name' => 'Lampu LED',
            'price' => 75000,
        ]);

        Accessory::create([
            'name' => 'Kaca',
            'price' => 100000,
        ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
