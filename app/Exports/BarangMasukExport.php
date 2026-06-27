<?php

namespace App\Exports;

use App\Models\BarangMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BarangMasukExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return BarangMasuk::with('produk')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal Masuk',
            'Kode Produk',
            'Nama Produk',
            'Jumlah',
            'Keterangan',
        ];
    }

    public function map($item): array
    {
        return [
            $item->tanggal_masuk ? $item->tanggal_masuk->format('d-m-Y') : '-',
            $item->produk->kode_produk ?? '-',
            $item->produk->nama_produk ?? '-',
            $item->jumlah,
            $item->keterangan ?? '-',
        ];
    }
}
