

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_accessories', function (Blueprint $table) {

            $table->id();

            // relasi detail order
            $table->foreignId('order_detail_id')
                ->constrained()
                ->cascadeOnDelete();

            // accessory
            $table->foreignId('accessory_id')
                ->constrained()
                ->cascadeOnDelete();

            // qty
            $table->integer('qty')
                ->default(1);

            // snapshot harga
            $table->decimal('price', 12, 2)
                ->default(0);

            // subtotal
            $table->decimal('subtotal', 12, 2)
                ->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_accessories');
    }
};