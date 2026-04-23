<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    // ── Kolom yang boleh diisi secara massal ─────────────────────────────
    protected $fillable = [
        'kendaraan_id',
        'waktu_masuk',
        'waktu_keluar',
        'status',
    ];

    // ── Cast tipe data ────────────────────────────────────────────────────
    protected $casts = [
        'waktu_masuk'  => 'datetime',
        'waktu_keluar' => 'datetime',
    ];

    // =====================================================================
    // RELASI ELOQUENT
    // =====================================================================

    /**
     * Transaksi dimiliki oleh satu Kendaraan  →  inverse dari kendaraans 1..* transaksis
     */
    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class);
    }

    /**
     * Transaksi memiliki satu Pembayaran  →  transaksis 1..1 pembayarans
     */
    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class);
    }

    // =====================================================================
    // SCOPE
    // =====================================================================

    /** Kendaraan yang masih di parkiran */
    public function scopeParkir($query)
    {
        return $query->where('status', 'parkir');
    }

    /** Kendaraan yang sudah keluar */
    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    /** Transaksi hari ini */
    public function scopeHariIni($query)
    {
        return $query->whereDate('waktu_masuk', Carbon::today());
    }

    // =====================================================================
    // HELPER
    // =====================================================================

    /**
     * Hitung durasi parkir dalam jam (minimal 1 jam, dibulatkan ke atas)
     */
    public function hitungDurasi(): int
    {
        $keluar = $this->waktu_keluar ?? Carbon::now();
        $menit  = $this->waktu_masuk->diffInMinutes($keluar);

        return max(1, (int) ceil($menit / 60));
    }

    /**
     * Hitung total biaya parkir
     * Tarif: Motor Rp 2.000/jam | Mobil Rp 5.000/jam
     */
    public function hitungTotalBayar(): float
    {
        $jenis = $this->kendaraan->jenis ?? 'motor';
        $tarif = ($jenis === 'mobil') ? 5000 : 2000;

        return $this->hitungDurasi() * $tarif;
    }

    /**
     * Proses kendaraan keluar: isi waktu_keluar dan ubah status
     */
    public function prosesKeluar(): void
    {
        $this->update([
            'waktu_keluar' => Carbon::now(),
            'status'       => 'selesai',
        ]);
    }
}