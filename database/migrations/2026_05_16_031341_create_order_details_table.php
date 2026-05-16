<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {

            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            // ukuran custom
            $table->decimal('length', 10, 2);

            $table->decimal('width', 10, 2);

            $table->decimal('height', 10, 2);

            // luas m2
            $table->decimal('area', 10, 2)
                ->default(0);

            // qty
            $table->integer('qty')
                ->default(1);

            // material
            $table->foreignId('material_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // estimasi material
            $table->decimal('material_qty', 12, 2)
                ->default(0);

            // snapshot harga
            $table->decimal('unit_price', 12, 2)
                ->default(0);

            $table->decimal('subtotal', 12, 2)
                ->default(0);

            // notes
            $table->text('notes')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
