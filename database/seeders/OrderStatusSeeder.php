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
                'slug' => 'pending'
            ],

            [
                'name' => 'Menunggu Konfirmasi',
                'slug' => 'menunggu_konfirmasi'
            ],

            [
    'name' => 'Menunggu Konfirmasi Pembayaran',
    'slug' => 'menunggu_konfirmasi_pembayaran'
],

            [
                'name' => 'Menunggu DP',
                'slug' => 'menunggu_dp'
            ],

            [
                'name' => 'DP Dicek',
                'slug' => 'dp_dicek'
            ],

            [
                'name' => 'Diproses',
                'slug' => 'diproses'
            ],

            [
                'name' => 'Menunggu Pelunasan',
                'slug' => 'menunggu_pelunasan'
            ],

            [
                'name' => 'Pelunasan Dicek',
                'slug' => 'pelunasan_dicek'
            ],

            [
                'name' => 'Lunas',
                'slug' => 'lunas'
            ],

            [
                'name' => 'Selesai',
                'slug' => 'selesai'
            ],

            [
                'name' => 'Dikirim',
                'slug' => 'dikirim'
            ],

            [
                'name' => 'Dibatalkan',
                'slug' => 'dibatalkan'
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