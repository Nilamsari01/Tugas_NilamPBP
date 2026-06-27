<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $table = 'barang_masuks';

    protected $fillable = [
        'produk_id',
        'jumlah',
        'tanggal_masuk',
        'keterangan',
        'harga_beli',
        'total_pengeluaran',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
