<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Parkir Kampus UMI</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* ── Variabel Warna ── */
        :root {
            --sidebar-w: 240px;
            --topbar-h:  60px;
            --primary:   #0d47a1;
            --primary-2: #1565c0;
            --accent:    #ffa000;
            --bg:        #f1f5f9;
            --surface:   #ffffff;
            --border:    #e2e8f0;
            --text:      #1e293b;
            --muted:     #64748b;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        /* ── Layout Wrapper ── */
        #wrapper { display: flex; min-height: 100vh; }

        /* ── Sidebar ── */
        #sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--primary);
            flex-shrink: 0;
            position: fixed;
            top: 0; left: 0;
            bottom: 0;
            z-index: 1000;
            transition: transform .25s ease;
            overflow-y: auto;
        }

        /* ── Topbar + Content ── */
        #content {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #topbar {
            height: var(--topbar-h);
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 900;
            box-shadow: 0 1px 4px rgba(0,0,0,.06);
        }

        #page-content {
            flex: 1;
            padding: 28px 24px;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #content { margin-left: 0; }
        }
    </style>

    @stack('styles')
</head>
<body>

<div id="wrapper">

    {{-- ══ SIDEBAR ══ --}}
    @include('components.sidebar')

    {{-- ══ CONTENT AREA ══ --}}
    <div id="content">

        {{-- ══ TOPBAR/NAVBAR ══ --}}
        @include('components.navbar')

        {{-- ══ HALAMAN UTAMA ══ --}}
        <main id="page-content">

            {{-- Alert Sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Alert Error --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Konten halaman spesifik --}}
            @yield('content')

        </main>

    </div>{{-- /#content --}}

</div>{{-- /#wrapper --}}

{{-- Bootstrap 5 JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Toggle sidebar di mobile
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('show');
    });

    // Auto-dismiss alert setelah 4 detik
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(el => {
            bootstrap.Alert.getOrCreateInstance(el)?.close();
        });
    }, 4000);
</script>

@stack('scripts')
</body>
</html>