@extends('layouts.app')

@section('title', $title ?? 'Halaman')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('dashboard') }}" style="color:#64748b; text-decoration:none;">Dashboard</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page" style="color:#1e293b; font-weight:600;">
        {{ $title ?? 'Halaman' }}
    </li>
@endsection

@section('content')
    <div class="card border-0 shadow-sm" style="border-radius:12px;">
        <div class="card-body p-4">
            <h4 class="mb-3">{{ $title ?? 'Halaman' }}</h4>
            <p class="text-muted" style="font-size:14px; line-height:1.7;">
                Halaman ini dibuat sebagai placeholder sementara sampai fitur lengkap tersedia.
            </p>
            <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-sm" style="border-radius:8px;">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
@endsection