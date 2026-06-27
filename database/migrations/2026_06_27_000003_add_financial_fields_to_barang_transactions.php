<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->decimal('harga_beli', 15, 2)->default(0)->after('jumlah');
            $table->decimal('total_pengeluaran', 15, 2)->default(0)->after('harga_beli');
        });

        Schema::table('barang_keluars', function (Blueprint $table) {
            $table->decimal('harga_jual', 15, 2)->default(0)->after('jumlah');
            $table->decimal('total_pendapatan', 15, 2)->default(0)->after('harga_jual');
        });
    }

    public function down(): void
    {
        Schema::table('barang_masuks', function (Blueprint $table) {
            $table->dropColumn(['harga_beli', 'total_pengeluaran']);
        });

        Schema::table('barang_keluars', function (Blueprint $table) {
            $table->dropColumn(['harga_jual', 'total_pendapatan']);
        });
    }
};
