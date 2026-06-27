<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalKategori = Kategori::count();
        $totalSupplier = Supplier::count();
        $totalStok = Produk::sum('stok');
        $totalBarangMasuk = BarangMasuk::sum('jumlah');
        $totalBarangKeluar = BarangKeluar::sum('jumlah');
        $totalPengeluaran = BarangMasuk::sum('total_pengeluaran');
        $totalPendapatan = BarangKeluar::sum('total_pendapatan');

        $produkTerbaru = Produk::with(['kategori', 'supplier'])
            ->latest()
            ->take(5)
            ->get();

        $stokMenipis = Produk::with(['kategori', 'supplier'])
            ->where('stok', '<=', 10)
            ->orderBy('stok', 'asc')
            ->take(5)
            ->get();

        $grafikProduk = Produk::select('kategori_id')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('kategori_id')
            ->with('kategori')
            ->get();

        return view('dashboard', compact(
            'totalProduk',
            'totalKategori',
            'totalSupplier',
            'totalStok',
            'totalBarangMasuk',
            'totalBarangKeluar',
            'totalPengeluaran',
            'totalPendapatan',
            'produkTerbaru',
            'stokMenipis',
            'grafikProduk'
        ));
    }
}
