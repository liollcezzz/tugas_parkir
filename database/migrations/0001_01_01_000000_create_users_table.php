<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();                                      // BIGINT UNSIGNED PK AUTO_INCREMENT
            $table->string('name');                            // VARCHAR(255)
            $table->string('email')->unique();                 // VARCHAR(255) UNIQUE
            $table->string('password');                        // VARCHAR(255)
            $table->enum('role', ['admin', 'mahasiswa'])       // ENUM
                  ->default('mahasiswa');
            $table->string('no_hp', 20)->nullable();           // VARCHAR(20)
            $table->rememberToken();                           // VARCHAR(100) nullable
            $table->timestamps();                              // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};