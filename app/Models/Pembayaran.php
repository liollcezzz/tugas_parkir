<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    // ── Kolom yang boleh diisi secara massal ─────────────────────────────
    protected $fillable = [
        'transaksi_id',
        'durasi',
        'total_bayar',
        'metode',
        'status',
    ];

    
    protected $casts = [
        'total_bayar' => 'decimal:2',
        'durasi'      => 'integer',
    ];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class);
    }

    
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeLunas($query)
    {
        return $query->where('status', 'lunas');
    }

    public function scopeCash($query)
    {
        return $query->where('metode', 'cash');
    }

    public function scopeQris($query)
    {
        return $query->where('metode', 'qris');
    }

    // =====================================================================
    // HELPER
    // =====================================================================

    /** Format total_bayar sebagai Rupiah */
    public function getTotalFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->total_bayar, 0, ',', '.');
    }

    /** Tandai pembayaran lunas */
    public function tandaiLunas(): void
    {
        $this->update(['status' => 'lunas']);
    }

    public function isPending(): bool { return $this->status === 'pending'; }
    public function isLunas(): bool   { return $this->status === 'lunas'; }
}