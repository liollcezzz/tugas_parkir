{{--
    Komponen: Navbar / Topbar
    Lokasi  : resources/views/components/navbar.blade.php
    Dipanggil oleh layouts/app.blade.php via @include('components.navbar')
--}}

<header id="topbar">

    {{-- ── Kiri: Toggle (mobile) + Breadcrumb ── --}}
    <div class="d-flex align-items-center gap-3">

        {{-- Tombol toggle sidebar (hanya tampil di mobile) --}}
        <button id="sidebarToggle" class="btn btn-sm d-md-none"
                style="border:1px solid #e2e8f0; border-radius:8px; padding:5px 9px;">
            <i class="bi bi-list" style="font-size:18px;"></i>
        </button>

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size:13px;">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard') }}"
                       style="color:#64748b; text-decoration:none;">
                        <i class="bi bi-house-fill"></i>
                    </a>
                </li>
                @yield('breadcrumb')
            </ol>
        </nav>

    </div>

    {{-- ── Kanan: Notifikasi + Profil ── --}}
    <div class="d-flex align-items-center gap-2 ms-auto">

        {{-- Tombol Notifikasi --}}
        <div class="position-relative">
            <button class="btn btn-sm" style="border:1px solid #e2e8f0; border-radius:8px; padding:5px 9px;">
                <i class="bi bi-bell" style="font-size:16px; color:#64748b;"></i>
            </button>
            {{-- Dot merah jika ada notifikasi --}}
            <span style="position:absolute; top:5px; right:5px;
                         width:8px; height:8px; background:#ef4444;
                         border-radius:50%; border:2px solid #fff;"></span>
        </div>

        {{-- Dropdown Profil --}}
        @auth
        <div class="dropdown">
            <button class="btn btn-sm d-flex align-items-center gap-2 dropdown-toggle"
                    style="border:1px solid #e2e8f0; border-radius:8px; padding:5px 12px; font-size:13px;"
                    data-bs-toggle="dropdown" aria-expanded="false">
                {{-- Avatar inisial --}}
                <span style="width:26px; height:26px; background:#0d47a1; border-radius:50%;
                              display:flex; align-items:center; justify-content:center;
                              color:#fff; font-weight:700; font-size:11px; flex-shrink:0;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </span>
                <span class="d-none d-sm-inline">{{ auth()->user()->name }}</span>
            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm"
                style="min-width:180px; border-color:#e2e8f0; border-radius:10px; margin-top:6px; font-size:13px;">

                {{-- Info email --}}
                <li class="px-3 py-2" style="border-bottom:1px solid #f1f5f9;">
                    <div style="font-size:11px; color:#64748b;">{{ auth()->user()->email }}</div>
                    <div style="font-size:11px; color:#94a3b8;">
                        Role: <strong>{{ ucfirst(auth()->user()->role) }}</strong>
                    </div>
                </li>

                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person me-2"></i> Profil Saya
                    </a>
                </li>

                <li><hr class="dropdown-divider my-1"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        @endauth

    </div>

</header>