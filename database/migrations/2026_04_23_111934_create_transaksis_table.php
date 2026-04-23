<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();                                       // BIGINT UNSIGNED PK

            $table->foreignId('kendaraan_id')                  // BIGINT FK → kendaraans.id
                  ->constrained('kendaraans')
                  ->cascadeOnDelete();

            $table->dateTime('waktu_masuk');                   // DATETIME
            $table->dateTime('waktu_keluar')->nullable();      // DATETIME (NULL = masih parkir)
            $table->enum('status', ['parkir', 'selesai'])      // ENUM
                  ->default('parkir');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};