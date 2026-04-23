{{--
    Komponen: Sidebar
    Lokasi  : resources/views/components/sidebar.blade.php
    Dipanggil oleh layouts/app.blade.php via @include('components.sidebar')
--}}

<nav id="sidebar">

    {{-- ── Logo / Brand ── --}}
    <div class="d-flex align-items-center gap-2 px-3 py-3"
         style="border-bottom: 1px solid rgba(255,255,255,.12); min-height:60px;">
        <div style="width:36px; height:36px; background:#ffa000; border-radius:8px;
                    display:flex; align-items:center; justify-content:center; font-size:18px; flex-shrink:0;">
            🅿
        </div>
        <div>
            <div style="color:#fff; font-weight:700; font-size:14px; line-height:1.2;">Parkir Kampus</div>
            <div style="color:rgba(255,255,255,.55); font-size:11px;">UMI Medan 1</div>
        </div>
    </div>

    {{-- ── Menu Utama ── --}}
    <ul class="nav flex-column px-2 pt-3" style="gap:2px;">

        {{-- Label seksi --}}
        <li class="nav-item">
            <span style="font-size:10px; font-weight:700; letter-spacing:1px;
                         color:rgba(255,255,255,.4); text-transform:uppercase;
                         padding:6px 12px; display:block;">MENU UTAMA</span>
        </li>

        {{-- Dashboard --}}
        <li class="nav-item">
            <a href="{{ route('dashboard') }}"
               class="nav-link d-flex align-items-center gap-2 rounded
                      {{ request()->routeIs('dashboard') ? 'active' : '' }}"
               style="color:rgba(255,255,255,.75); font-size:13.5px; padding:9px 12px;
                      {{ request()->routeIs('dashboard') ? 'background:rgba(255,255,255,.15); color:#fff;' : '' }}">
                <i class="bi bi-speedometer2" style="font-size:16px; width:20px; text-align:center;"></i>
                Dashboard
            </a>
        </li>

        {{-- Data Kendaraan --}}
        <li class="nav-item">
            <a href="{{ route('kendaraans.index') }}"
               class="nav-link d-flex align-items-center gap-2 rounded
                      {{ request()->routeIs('kendaraans.*') ? 'active' : '' }}"
               style="color:rgba(255,255,255,.75); font-size:13.5px; padding:9px 12px;
                      {{ request()->routeIs('kendaraans.*') ? 'background:rgba(255,255,255,.15); color:#fff;' : '' }}">
                <i class="bi bi-car-front-fill" style="font-size:16px; width:20px; text-align:center;"></i>
                Data Kendaraan
            </a>
        </li>

        {{-- Transaksi Parkir --}}
        <li class="nav-item">
            <a href="{{ route('transaksis.index') }}"
               class="nav-link d-flex align-items-center gap-2 rounded
                      {{ request()->routeIs('transaksis.*') ? 'active' : '' }}"
               style="color:rgba(255,255,255,.75); font-size:13.5px; padding:9px 12px;
                      {{ request()->routeIs('transaksis.*') ? 'background:rgba(255,255,255,.15); color:#fff;' : '' }}">
                <i class="bi bi-arrow-left-right" style="font-size:16px; width:20px; text-align:center;"></i>
                Transaksi Parkir
            </a>
        </li>

        {{-- Pembayaran --}}
        <li class="nav-item">
            <a href="{{ route('pembayarans.index') }}"
               class="nav-link d-flex align-items-center gap-2 rounded
                      {{ request()->routeIs('pembayarans.*') ? 'active' : '' }}"
               style="color:rgba(255,255,255,.75); font-size:13.5px; padding:9px 12px;
                      {{ request()->routeIs('pembayarans.*') ? 'background:rgba(255,255,255,.15); color:#fff;' : '' }}">
                <i class="bi bi-credit-card-fill" style="font-size:16px; width:20px; text-align:center;"></i>
                Pembayaran
            </a>
        </li>

        {{-- ── Seksi Admin ── --}}
        @auth
        @if(auth()->user()->role === 'admin')
        <li class="nav-item mt-2">
            <span style="font-size:10px; font-weight:700; letter-spacing:1px;
                         color:rgba(255,255,255,.4); text-transform:uppercase;
                         padding:6px 12px; display:block;">ADMIN</span>
        </li>

        <li class="nav-item">
            <a href="{{ route('users.index') }}"
               class="nav-link d-flex align-items-center gap-2 rounded
                      {{ request()->routeIs('users.*') ? 'active' : '' }}"
               style="color:rgba(255,255,255,.75); font-size:13.5px; padding:9px 12px;
                      {{ request()->routeIs('users.*') ? 'background:rgba(255,255,255,.15); color:#fff;' : '' }}">
                <i class="bi bi-people-fill" style="font-size:16px; width:20px; text-align:center;"></i>
                Data Pengguna
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('laporan.index') }}"
               class="nav-link d-flex align-items-center gap-2 rounded
                      {{ request()->routeIs('laporan.*') ? 'active' : '' }}"
               style="color:rgba(255,255,255,.75); font-size:13.5px; padding:9px 12px;
                      {{ request()->routeIs('laporan.*') ? 'background:rgba(255,255,255,.15); color:#fff;' : '' }}">
                <i class="bi bi-bar-chart-fill" style="font-size:16px; width:20px; text-align:center;"></i>
                Laporan
            </a>
        </li>
        @endif
        @endauth

    </ul>

    {{-- ── Info User di Bawah ── --}}
    @auth
    <div style="position:absolute; bottom:0; left:0; right:0;
                padding:12px 16px; border-top:1px solid rgba(255,255,255,.12);
                background:rgba(0,0,0,.15);">
        <div class="d-flex align-items-center gap-2">
            <div style="width:32px; height:32px; border-radius:50%; background:#ffa000;
                        display:flex; align-items:center; justify-content:center;
                        font-weight:700; font-size:13px; color:#fff; flex-shrink:0;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div style="overflow:hidden;">
                <div style="color:#fff; font-size:12.5px; font-weight:600;
                            white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    {{ auth()->user()->name }}
                </div>
                <div style="color:rgba(255,255,255,.5); font-size:11px;">
                    {{ ucfirst(auth()->user()->role) }}
                </div>
            </div>
        </div>
    </div>
    @endauth

</nav>{{-- /#sidebar --}}

<style>
    /* Hover efek pada nav-link sidebar */
    #sidebar .nav-link:hover {
        background: rgba(255,255,255,.1) !important;
        color: #fff !important;
    }
    /* Tambah padding bawah agar konten tidak tertutup info user */
    #sidebar ul { padding-bottom: 70px; }
</style>