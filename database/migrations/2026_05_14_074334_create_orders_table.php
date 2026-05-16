

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // user
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // kode order
            $table->string('code')
                ->unique();

            // estimasi sistem
            $table->decimal('estimated_price', 12, 2)
                ->nullable();

            // harga final admin
            $table->decimal('final_price', 12, 2)
                ->nullable();

            // status
            $table->enum('status', [
                'pending',
                'diproses',
                'selesai',
                'dibatalkan'
            ])->default('pending');

            // catatan customer
            $table->text('user_notes')
                ->nullable();

            // catatan admin
            $table->text('admin_notes')
                ->nullable();

            // upload design
            $table->string('design_file')
                ->nullable();

            // selesai
            $table->timestamp('finished_at')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};