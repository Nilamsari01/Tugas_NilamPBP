<?php

namespace App\Http\Controllers;

use App\Exports\BarangMasukExport;
use App\Models\BarangMasuk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuks = BarangMasuk::with('produk')->latest()->paginate(10);

        return view('barang_masuk.index', compact('barangMasuks'));
    }

    public function create()
    {
        $produks = Produk::all();

        return view('barang_masuk.create', compact('produks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('barang_masuk.create')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();
        $produk = Produk::findOrFail($data['produk_id']);
        $data['harga_beli'] = $produk->harga_beli;
        $data['total_pengeluaran'] = $produk->harga_beli * $data['jumlah'];

        $barangMasuk = BarangMasuk::create($data);
        $produk->increment('stok', $data['jumlah']);

        return redirect()->route('barang_masuk.index')->with('success', 'Barang masuk berhasil dicatat.');
    }

    public function destroy(BarangMasuk $barangMasuk)
    {
        $produk = $barangMasuk->produk;
        if ($produk) {
            $produk->decrement('stok', $barangMasuk->jumlah);
        }

        $barangMasuk->delete();

        return redirect()->route('barang_masuk.index')->with('success', 'Catatan barang masuk berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new BarangMasukExport(), 'barang-masuk.xlsx');
    }
}
