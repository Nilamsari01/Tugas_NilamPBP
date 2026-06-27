<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $kategori1 = Kategori::create(["nama_kategori" => "Elektronik", "keterangan" => "Peralatan elektronik"]);
        $kategori2 = Kategori::create(["nama_kategori" => "Makanan", "keterangan" => "Produk makanan dan minuman"]);
        $kategori3 = Kategori::create(["nama_kategori" => "ATK", "keterangan" => "Alat tulis kantor"]);

        $supplier1 = Supplier::create(["nama_supplier" => "PT Sumber", "telepon" => "081234567890", "alamat" => "Jakarta"]);
        $supplier2 = Supplier::create(["nama_supplier" => "CV Mandiri", "telepon" => "082233445566", "alamat" => "Bandung"]);

        Produk::create([
            'kode_produk' => 'ELEK001',
            'nama_produk' => 'Smartphone',
            'kategori_id' => $kategori1->id,
            'supplier_id' => $supplier1->id,
            'stok' => 25,
            'harga_beli' => 1500000.00,
            'harga_jual' => 2000000.00,
            'gambar' => null,
        ]);

        Produk::create([
            'kode_produk' => 'MAKAN001',
            'nama_produk' => 'Snack Pack',
            'kategori_id' => $kategori2->id,
            'supplier_id' => $supplier2->id,
            'stok' => 8,
            'harga_beli' => 12000.00,
            'harga_jual' => 20000.00,
            'gambar' => null,
        ]);

        Produk::create([
            'kode_produk' => 'ATK001',
            'nama_produk' => 'Pulpen',
            'kategori_id' => $kategori3->id,
            'supplier_id' => $supplier1->id,
            'stok' => 50,
            'harga_beli' => 2000.00,
            'harga_jual' => 5000.00,
            'gambar' => null,
        ]);
    }
}
