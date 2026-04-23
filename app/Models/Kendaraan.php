<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'kendaraans';

    // ── Kolom yang boleh diisi secara massal ─────────────────────────────
    protected $fillable = [
        'user_id',
        'plat_nomor',
        'jenis',
        'merk',
        'warna',
    ];

    // =====================================================================
    // RELASI ELOQUENT
    // =====================================================================

    /**
     * Kendaraan dimiliki oleh satu User  →  inverse dari users 1..* kendaraans
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Kendaraan memiliki banyak Transaksi  →  kendaraans 1..* transaksis
     */
    public function transaksis(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }

    // =====================================================================
    // SCOPE (filter query yang sering dipakai)
    // =====================================================================

    /** Filter hanya motor */
    public function scopeMotor($query)
    {
        return $query->where('jenis', 'motor');
    }

    /** Filter hanya mobil */
    public function scopeMobil($query)
    {
        return $query->where('jenis', 'mobil');
    }

    // =====================================================================
    // HELPER
    // =====================================================================

    /** Cek apakah kendaraan ini sedang parkir */
    public function sedangParkir(): bool
    {
        return $this->transaksis()->where('status', 'parkir')->exists();
    }
}