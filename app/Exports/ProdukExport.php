<?php

namespace App\Exports;

use App\Models\Produk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Http\Request;

class ProdukExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Produk::with(['kategori', 'supplier']);

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($sub) use ($search) {
                $sub->where('kode_produk', 'like', "%{$search}%")
                    ->orWhere('nama_produk', 'like', "%{$search}%");
            });
        }

        if (!empty($this->filters['kategori_id'])) {
            $query->where('kategori_id', $this->filters['kategori_id']);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Kode Produk',
            'Nama Produk',
            'Kategori',
            'Supplier',
            'Stok',
            'Harga Beli',
            'Harga Jual',
        ];
    }

    public function map($produk): array
    {
        return [
            $produk->kode_produk,
            $produk->nama_produk,
            $produk->kategori->nama_kategori ?? '-',
            $produk->supplier->nama_supplier ?? '-',
            $produk->stok,
            $produk->harga_beli,
            $produk->harga_jual,
        ];
    }
}
