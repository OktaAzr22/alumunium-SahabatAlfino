

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->text('description')
                ->nullable();

            // harga dasar per m2
            $table->decimal('base_price', 12, 2)
                ->default(0);

            // ukuran standar
            $table->decimal('standard_length', 8, 2)->nullable();

$table->decimal('standard_width', 8, 2)->nullable();

$table->decimal('standard_height', 8, 2)->nullable();

            // pengali kebutuhan frame
            $table->decimal('frame_multiplier', 8, 2)
                ->default(1);

            $table->string('image')
                ->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};