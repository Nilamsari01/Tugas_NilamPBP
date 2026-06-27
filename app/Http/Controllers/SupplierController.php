<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::withCount('produks');

        if ($search = $request->query('search')) {
            $query->where('nama_supplier', 'like', "%{$search}%");
        }

        $suppliers = $query->paginate(10)->withQueryString();

        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_supplier' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('supplier.create')
                ->withErrors($validator)
                ->withInput();
        }

        Supplier::create($request->only('nama_supplier', 'telepon', 'alamat'));

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validator = Validator::make($request->all(), [
            'nama_supplier' => 'required|string|max:255',
            'telepon' => 'nullable|string|max:50',
            'alamat' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('supplier.edit', $supplier)
                ->withErrors($validator)
                ->withInput();
        }

        $supplier->update($request->only('nama_supplier', 'telepon', 'alamat'));

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diupdate.');
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->produks()->count() > 0) {
            return redirect()->route('supplier.index')->with('error', 'Supplier tidak dapat dihapus karena masih memiliki produk terkait.');
        }

        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
