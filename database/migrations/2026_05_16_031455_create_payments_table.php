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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

             $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            // tipe pembayaran
            $table->enum('payment_type', [
                'dp',
                'pelunasan'
            ]);

            // nominal transfer
            $table->decimal('amount', 12, 2);

            // rekening tujuan
            $table->string('bank_name')
                ->nullable();

            $table->string('account_name')
                ->nullable();

            $table->string('account_number')
                ->nullable();

            // bukti pembayaran
            $table->string('payment_proof')
                ->nullable();

            // status pembayaran
            $table->enum('status', [
                'pending',
                'checking',
                'approved',
                'rejected'
            ])->default('pending');

            // catatan admin
            $table->text('admin_notes')
                ->nullable();

            // waktu konfirmasi
            $table->timestamp('confirmed_at')
                ->nullable();
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
