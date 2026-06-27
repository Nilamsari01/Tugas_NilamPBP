<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['checklogin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('produk', ProdukController::class);
    Route::get('/produk/export/pdf', [ProdukController::class, 'exportPdf'])->name('produk.export.pdf');
    Route::get('/produk/export/excel', [ProdukController::class, 'exportExcel'])->name('produk.export.excel');
    Route::resource('kategori', KategoriController::class)->except(['show']);
    Route::resource('supplier', SupplierController::class)->except(['show']);
    Route::resource('user', UserController::class)->except(['show']);

    Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang_masuk.index');
    Route::get('/barang-masuk/create', [BarangMasukController::class, 'create'])->name('barang_masuk.create');
    Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('barang_masuk.store');
    Route::delete('/barang-masuk/{barang_masuk}', [BarangMasukController::class, 'destroy'])->name('barang_masuk.destroy');
    Route::get('/barang-masuk/export/excel', [BarangMasukController::class, 'exportExcel'])->name('barang_masuk.export.excel');

    Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang_keluar.index');
    Route::get('/barang-keluar/create', [BarangKeluarController::class, 'create'])->name('barang_keluar.create');
    Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('barang_keluar.store');
    Route::delete('/barang-keluar/{barang_keluar}', [BarangKeluarController::class, 'destroy'])->name('barang_keluar.destroy');
    Route::get('/barang-keluar/export/excel', [BarangKeluarController::class, 'exportExcel'])->name('barang_keluar.export.excel');
});