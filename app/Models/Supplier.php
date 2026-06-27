<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_supplier',
        'telepon',
        'alamat',
    ];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
