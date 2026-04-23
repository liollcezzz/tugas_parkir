<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();                                       // BIGINT UNSIGNED PK

            $table->foreignId('user_id')                       // BIGINT FK → users.id
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('plat_nomor', 20)->unique();        // VARCHAR(20) UNIQUE
            $table->enum('jenis', ['motor', 'mobil']);         // ENUM
            $table->string('merk', 100)->nullable();            // VARCHAR(100)
            $table->string('warna', 50)->nullable();            // VARCHAR(50)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kendaraans');
    }
};