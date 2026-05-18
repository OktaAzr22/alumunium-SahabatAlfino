<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [

            [
                'name' => 'Pending',
                'slug' => 'pending',
                'description' => 'Pesanan baru masuk'
            ],

            [
                'name' => 'Dicek Admin',
                'slug' => 'checking',
                'description' => 'Pesanan sedang diperiksa admin'
            ],

            [
                'name' => 'Menunggu Pembayaran',
                'slug' => 'payment',
                'description' => 'Menunggu pembayaran customer'
            ],

            [
                'name' => 'Diproses',
                'slug' => 'process',
                'description' => 'Pesanan sedang dikerjakan'
            ],

            [
                'name' => 'Selesai Produksi',
                'slug' => 'finished',
                'description' => 'Produk selesai dibuat'
            ],

            [
                'name' => 'Siap Diambil',
                'slug' => 'ready_pickup',
                'description' => 'Pesanan siap diambil customer'
            ],

            [
                'name' => 'Selesai',
                'slug' => 'completed',
                'description' => 'Pesanan selesai'
            ],

            [
                'name' => 'Dibatalkan',
                'slug' => 'cancelled',
                'description' => 'Pesanan dibatalkan'
            ],
        ];

        foreach ($statuses as $status) {

            OrderStatus::updateOrCreate(
                ['slug' => $status['slug']],
                $status
            );
        }
    }
}