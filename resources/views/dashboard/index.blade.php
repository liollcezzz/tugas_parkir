{{--
    Halaman: Dashboard
    Lokasi : resources/views/dashboard/index.blade.php
    Route  : Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
--}}

@extends('layouts.app')

@section('title', 'Dashboard')

{{-- Breadcrumb --}}
@section('breadcrumb')
    <li class="breadcrumb-item active" style="color:#1e293b; font-weight:600;">Dashboard</li>
@endsection

@push('styles')
<style>
    /* ── Kartu Statistik ── */
    .stat-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px 22px;
        display: flex;
        align-items: center;
        gap: 16px;
        text-decoration: none;
        color: inherit;
        transition: transform .2s, box-shadow .2s;
        box-shadow: 0 1px 3px rgba(0,0,0,.06);
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0,0,0,.10);
        color: inherit;
    }
    .stat-icon {
        width: 52px; height: 52px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
    }
    .stat-value {
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.5px;
        line-height: 1;
    }
    .stat-label {
        font-size: 12.5px;
        color: #64748b;
        margin-top: 4px;
    }

    /* ── Tabel ── */
    .tbl thead th {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #64748b;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 10px 14px;
    }
    .tbl tbody td {
        padding: 11px 14px;
        font-size: 13px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
    }
    .tbl tbody tr:last-child td { border-bottom: none; }
    .tbl tbody tr:hover td { background: #f8fafc; }

    /* ── Badge Status ── */
    .badge-parkir  { background:#dbeafe; color:#1d4ed8; }
    .badge-selesai { background:#dcfce7; color:#15803d; }
    .badge-pending { background:#fef3c7; color:#b45309; }
    .badge-lunas   { background:#dcfce7; color:#15803d; }
</style>
@endpush

@section('content')

{{-- ── Judul Halaman ── --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <h4 class="fw-bold mb-0">Dashboard</h4>
        <p class="text-muted mb-0" style="font-size:13px;">
            Selamat datang, <strong>{{ auth()->user()->name ?? 'Admin' }}</strong> —
            {{ now()->isoFormat('dddd, D MMMM Y') }}
        </p>
    </div>
    <a href="{{ route('transaksis.create') }}" class="btn btn-primary btn-sm"
       style="border-radius:8px; font-weight:600; font-size:13px;">
        <i class="bi bi-plus-lg me-1"></i> Transaksi Baru
    </a>
</div>

{{-- ══ KARTU STATISTIK ══ --}}
<div class="row g-3 mb-4">

    {{-- Kendaraan Parkir Aktif --}}
    <div class="col-6 col-xl-3">
        <a href="{{ route('transaksis.index', ['status' => 'parkir']) }}" class="stat-card d-flex">
            <div class="stat-icon" style="background:#dbeafe; color:#1d4ed8;">
                <i class="bi bi-car-front-fill"></i>
            </div>
            <div>
                <div class="stat-value">{{ $totalParkir ?? 42 }}</div>
                <div class="stat-label">Kendaraan Parkir</div>
            </div>
        </a>
    </div>

    {{-- Transaksi Hari Ini --}}
    <div class="col-6 col-xl-3">
        <a href="{{ route('transaksis.index') }}" class="stat-card d-flex">
            <div class="stat-icon" style="background:#dcfce7; color:#15803d;">
                <i class="bi bi-arrow-left-right"></i>
            </div>
            <div>
                <div class="stat-value">{{ $transaksiHariIni ?? 87 }}</div>
                <div class="stat-label">Transaksi Hari Ini</div>
            </div>
        </a>
    </div>

    {{-- Pendapatan Hari Ini --}}
    <div class="col-6 col-xl-3">
        <a href="{{ route('pembayarans.index') }}" class="stat-card d-flex">
            <div class="stat-icon" style="background:#fef3c7; color:#b45309;">
                <i class="bi bi-cash-coin"></i>
            </div>
            <div>
                <div class="stat-value" style="font-size:18px;">
                    Rp {{ number_format($pendapatanHariIni ?? 1250000, 0, ',', '.') }}
                </div>
                <div class="stat-label">Pendapatan Hari Ini</div>
            </div>
        </a>
    </div>

    {{-- Total Mahasiswa --}}
    <div class="col-6 col-xl-3">
        <a href="{{ route('users.index') }}" class="stat-card d-flex">
            <div class="stat-icon" style="background:#f3e8ff; color:#7c3aed;">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <div class="stat-value">{{ $totalMahasiswa ?? 312 }}</div>
                <div class="stat-label">Total Mahasiswa</div>
            </div>
        </a>
    </div>

</div>

{{-- ══ BARIS: Tabel Transaksi + Info Kapasitas ══ --}}
<div class="row g-3">

    {{-- ── Tabel Transaksi Terbaru ── --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-white d-flex justify-content-between align-items-center"
                 style="border-radius:12px 12px 0 0; border-bottom:1px solid #f1f5f9; padding:14px 20px;">
                <span style="font-size:14px; font-weight:700;">
                    <i class="bi bi-clock-history me-2 text-primary"></i>Transaksi Terbaru
                </span>
                <a href="{{ route('transaksis.index') }}"
                   style="font-size:12px; color:#0d47a1; font-weight:600; text-decoration:none;">
                    Lihat Semua →
                </a>
            </div>
            <div class="table-responsive">
                <table class="table tbl mb-0">
                    <thead>
                        <tr>
                            <th>Plat Nomor</th>
                            <th>Pemilik</th>
                            <th>Jenis</th>
                            <th>Masuk</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Data real dari controller --}}
                        @forelse($transaksiTerbaru ?? [] as $t)
                        <tr>
                            <td>
                                <code style="background:#f1f5f9; padding:2px 8px; border-radius:5px; font-size:12px;">
                                    {{ $t->kendaraan->plat_nomor }}
                                </code>
                            </td>
                            <td>{{ $t->kendaraan->user->name }}</td>
                            <td>
                                <i class="bi {{ $t->kendaraan->jenis === 'motor' ? 'bi-bicycle' : 'bi-car-front' }}"></i>
                                {{ ucfirst($t->kendaraan->jenis) }}
                            </td>
                            <td class="text-muted">{{ \Carbon\Carbon::parse($t->waktu_masuk)->format('H:i') }}</td>
                            <td>
                                <span class="badge rounded-pill badge-{{ $t->status }}"
                                      style="font-size:11px; padding:4px 10px;">
                                    {{ ucfirst($t->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        {{-- Data dummy (tampil saat variabel kosong / belum ada data) --}}
                        @foreach([
                            ['BK 1234 AB','Ahmad Fauzi','motor','08:15','parkir'],
                            ['BK 5678 CD','Sari Dewi','mobil','08:32','parkir'],
                            ['BK 9012 EF','Budi S.','motor','09:05','selesai'],
                            ['BK 3456 GH','Rina W.','motor','09:18','parkir'],
                            ['BK 7890 IJ','Doni K.','mobil','09:45','selesai'],
                        ] as $row)
                        <tr>
                            <td>
                                <code style="background:#f1f5f9; padding:2px 8px; border-radius:5px; font-size:12px;">
                                    {{ $row[0] }}
                                </code>
                            </td>
                            <td>{{ $row[1] }}</td>
                            <td>
                                <i class="bi {{ $row[2]==='motor'?'bi-bicycle':'bi-car-front' }}"></i>
                                {{ ucfirst($row[2]) }}
                            </td>
                            <td class="text-muted">{{ $row[3] }}</td>
                            <td>
                                <span class="badge rounded-pill badge-{{ $row[4] }}"
                                      style="font-size:11px; padding:4px 10px;">
                                    {{ ucfirst($row[4]) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ── Info Kapasitas + Aksi Cepat ── --}}
    <div class="col-lg-4 d-flex flex-column gap-3">

        {{-- Kapasitas Parkir --}}
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-white"
                 style="border-radius:12px 12px 0 0; border-bottom:1px solid #f1f5f9; padding:14px 20px;">
                <span style="font-size:14px; font-weight:700;">
                    <i class="bi bi-p-square-fill me-2 text-warning"></i>Kapasitas Parkir
                </span>
            </div>
            <div class="card-body" style="padding:16px 20px;">

                {{-- Motor --}}
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1" style="font-size:13px;">
                        <span><i class="bi bi-bicycle me-1"></i><strong>Motor</strong></span>
                        <span class="text-muted">{{ $slotMotorTerisi ?? 65 }}/{{ $slotMotorTotal ?? 100 }}</span>
                    </div>
                    <div class="progress" style="height:8px; border-radius:4px;">
                        <div class="progress-bar bg-primary" role="progressbar"
                             style="width: {{ isset($slotMotorTerisi,$slotMotorTotal) ? ($slotMotorTerisi/$slotMotorTotal*100) : 65 }}%">
                        </div>
                    </div>
                    <div style="font-size:11px; color:#64748b; margin-top:4px;">
                        {{ ($slotMotorTotal ?? 100) - ($slotMotorTerisi ?? 65) }} slot tersedia
                    </div>
                </div>

                {{-- Mobil --}}
                <div>
                    <div class="d-flex justify-content-between mb-1" style="font-size:13px;">
                        <span><i class="bi bi-car-front me-1"></i><strong>Mobil</strong></span>
                        <span class="text-muted">{{ $slotMobilTerisi ?? 8 }}/{{ $slotMobilTotal ?? 30 }}</span>
                    </div>
                    <div class="progress" style="height:8px; border-radius:4px;">
                        <div class="progress-bar bg-warning" role="progressbar"
                             style="width: {{ isset($slotMobilTerisi,$slotMobilTotal) ? ($slotMobilTerisi/$slotMobilTotal*100) : 27 }}%">
                        </div>
                    </div>
                    <div style="font-size:11px; color:#64748b; margin-top:4px;">
                        {{ ($slotMobilTotal ?? 30) - ($slotMobilTerisi ?? 8) }} slot tersedia
                    </div>
                </div>

            </div>
        </div>

        {{-- Aksi Cepat --}}
        <div class="card border-0 shadow-sm" style="border-radius:12px;">
            <div class="card-header bg-white"
                 style="border-radius:12px 12px 0 0; border-bottom:1px solid #f1f5f9; padding:14px 20px;">
                <span style="font-size:14px; font-weight:700;">
                    <i class="bi bi-lightning-fill me-2 text-warning"></i>Aksi Cepat
                </span>
            </div>
            <div class="card-body d-flex flex-column gap-2" style="padding:14px;">
                <a href="{{ route('transaksis.create') }}"
                   class="btn btn-outline-primary btn-sm text-start"
                   style="border-radius:8px; font-size:13px; padding:9px 14px;">
                    <i class="bi bi-plus-circle me-2"></i>Catat Kendaraan Masuk
                </a>
                <a href="{{ route('transaksis.index', ['status' => 'parkir']) }}"
                   class="btn btn-outline-success btn-sm text-start"
                   style="border-radius:8px; font-size:13px; padding:9px 14px;">
                    <i class="bi bi-box-arrow-right me-2"></i>Proses Kendaraan Keluar
                </a>
                <a href="{{ route('kendaraans.create') }}"
                   class="btn btn-outline-secondary btn-sm text-start"
                   style="border-radius:8px; font-size:13px; padding:9px 14px;">
                    <i class="bi bi-car-front-fill me-2"></i>Daftarkan Kendaraan
                </a>
                <a href="{{ route('pembayarans.index', ['status' => 'pending']) }}"
                   class="btn btn-outline-warning btn-sm text-start"
                   style="border-radius:8px; font-size:13px; padding:9px 14px;">
                    <i class="bi bi-clock me-2"></i>Pembayaran Pending
                </a>
            </div>
        </div>

    </div>
</div>

@endsection