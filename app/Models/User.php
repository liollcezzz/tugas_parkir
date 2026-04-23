<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // ── Kolom yang boleh diisi secara massal ─────────────────────────────
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_hp',
    ];

    // ── Kolom yang disembunyikan dari JSON/array ──────────────────────────
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // ── Cast tipe data ────────────────────────────────────────────────────
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // =====================================================================
    // RELASI ELOQUENT
    // =====================================================================

    /**
     * User memiliki banyak Kendaraan  →  users 1..* kendaraans
     */
    public function kendaraans(): HasMany
    {
        return $this->hasMany(Kendaraan::class);
    }

    // =====================================================================
    // HELPER
    // =====================================================================

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMahasiswa(): bool
    {
        return $this->role === 'mahasiswa';
    }
}