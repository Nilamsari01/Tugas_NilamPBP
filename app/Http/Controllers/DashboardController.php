<?php

namespace App\Http\Controllers;

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

        $produkTerbaru = Produk::with(['kategori', 'supplier'])
            ->latest()
            ->take(5)
            ->get();

        $stokMenipis = Produk::with(['kategori', 'supplier'])
            ->where('stok', '<=', 10)
            ->orderBy('stok', 'asc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalProduk',
            'totalKategori',
            'totalSupplier',
            'totalStok',
            'produkTerbaru',
            'stokMenipis'
        ));
    }
}
