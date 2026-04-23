<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/dashboard');

Route::view('/dashboard', 'dashboard.index')->name('dashboard');

Route::view('/kendaraans', 'pages.placeholder', ['title' => 'Data Kendaraan'])->name('kendaraans.index');
Route::view('/kendaraans/create', 'pages.placeholder', ['title' => 'Tambah Kendaraan'])->name('kendaraans.create');

Route::view('/transaksis', 'pages.placeholder', ['title' => 'Transaksi Parkir'])->name('transaksis.index');
Route::view('/transaksis/create', 'pages.placeholder', ['title' => 'Transaksi Baru'])->name('transaksis.create');

Route::view('/pembayarans', 'pages.placeholder', ['title' => 'Pembayaran'])->name('pembayarans.index');

Route::view('/users', 'pages.placeholder', ['title' => 'Data Pengguna'])->name('users.index');
Route::view('/laporan', 'pages.placeholder', ['title' => 'Laporan'])->name('laporan.index');
Route::view('/profile/edit', 'pages.placeholder', ['title' => 'Edit Profil'])->name('profile.edit');
