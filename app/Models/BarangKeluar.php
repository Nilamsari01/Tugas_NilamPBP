<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $table = 'barang_keluars';

    protected $fillable = [
        'produk_id',
        'jumlah',
        'tanggal_keluar',
        'keterangan',
        'harga_jual',
        'total_pendapatan',
    ];

    protected $casts = [
        'tanggal_keluar' => 'date',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
