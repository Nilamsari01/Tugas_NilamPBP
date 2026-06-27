<?php

namespace App\Exports;

use App\Models\BarangKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BarangKeluarExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return BarangKeluar::with('produk')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal Keluar',
            'Kode Produk',
            'Nama Produk',
            'Jumlah',
            'Keterangan',
        ];
    }

    public function map($item): array
    {
        return [
            $item->tanggal_keluar ? $item->tanggal_keluar->format('d-m-Y') : '-',
            $item->produk->kode_produk ?? '-',
            $item->produk->nama_produk ?? '-',
            $item->jumlah,
            $item->keterangan ?? '-',
        ];
    }
}
