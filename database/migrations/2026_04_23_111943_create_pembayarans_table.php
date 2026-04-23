<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();                                       // BIGINT UNSIGNED PK

            $table->foreignId('transaksi_id')                  // BIGINT FK → transaksis.id (UNIQUE = 1-to-1)
                  ->unique()
                  ->constrained('transaksis')
                  ->cascadeOnDelete();

            $table->integer('durasi');                         // INT (dalam jam)
            $table->decimal('total_bayar', 12, 2);            // DECIMAL(12,2)
            $table->enum('metode', ['cash', 'qris'])           // ENUM
                  ->default('cash');
            $table->enum('status', ['pending', 'lunas'])       // ENUM
                  ->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};