<?php

namespace App\Http\Controllers;

use App\Exports\BarangKeluarExport;
use App\Models\BarangKeluar;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluars = BarangKeluar::with('produk')->latest()->paginate(10);

        return view('barang_keluar.index', compact('barangKeluars'));
    }

    public function create()
    {
        $produks = Produk::all();

        return view('barang_keluar.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barang_keluar.create')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        $produk = Produk::findOrFail($data['produk_id']);

        if ($data['jumlah'] > $produk->stok) {
            return redirect()->route('barang_keluar.create')
                ->with('error', 'Jumlah keluar melebihi stok yang tersedia.')
                ->withInput();
        }

        $data['harga_jual'] = $produk->harga_jual;
        $data['total_pendapatan'] = $produk->harga_jual * $data['jumlah'];

        $barangKeluar = BarangKeluar::create($data);
        $produk->decrement('stok', $data['jumlah']);

        return redirect()->route('barang_keluar.index')->with('success', 'Barang keluar berhasil dicatat.');
    }

    public function destroy(BarangKeluar $barangKeluar)
    {
        $produk = $barangKeluar->produk;
        if ($produk) {
            $produk->increment('stok', $barangKeluar->jumlah);
        }

        $barangKeluar->delete();

        return redirect()->route('barang_keluar.index')->with('success', 'Catatan barang keluar berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new BarangKeluarExport(), 'barang-keluar.xlsx');
    }
}
