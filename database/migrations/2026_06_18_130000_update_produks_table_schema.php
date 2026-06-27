<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('produks')) {
            return;
        }

        Schema::table('produks', function (Blueprint $table) {
            if (!Schema::hasColumn('produks', 'kode_produk')) {
                $table->string('kode_produk')->unique()->after('id');
            }

            if (!Schema::hasColumn('produks', 'kategori_id')) {
                $table->unsignedBigInteger('kategori_id')->nullable()->after('nama_produk');
            }

            if (!Schema::hasColumn('produks', 'supplier_id')) {
                $table->unsignedBigInteger('supplier_id')->nullable()->after('kategori_id');
            }

            if (!Schema::hasColumn('produks', 'harga_beli')) {
                $table->decimal('harga_beli', 12, 2)->default(0)->after('stok');
            }

            if (!Schema::hasColumn('produks', 'harga_jual')) {
                $table->decimal('harga_jual', 12, 2)->default(0)->after('harga_beli');
            }
        });

        if (Schema::hasColumn('produks', 'harga')) {
            DB::statement('UPDATE `produks` SET `harga_beli` = `harga`, `harga_jual` = `harga` WHERE `harga` IS NOT NULL');
        }

        Schema::table('produks', function (Blueprint $table) {
            if (Schema::hasColumn('produks', 'harga')) {
                $table->dropColumn('harga');
            }

            if (Schema::hasColumn('produks', 'kategori_id')) {
                $table->foreign('kategori_id')->references('id')->on('kategoris')->cascadeOnDelete();
            }

            if (Schema::hasColumn('produks', 'supplier_id')) {
                $table->foreign('supplier_id')->references('id')->on('suppliers')->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('produks')) {
            return;
        }

        Schema::table('produks', function (Blueprint $table) {
            if (Schema::hasColumn('produks', 'supplier_id')) {
                $table->dropForeign(['supplier_id']);
                $table->dropColumn('supplier_id');
            }

            if (Schema::hasColumn('produks', 'kategori_id')) {
                $table->dropForeign(['kategori_id']);
                $table->dropColumn('kategori_id');
            }

            if (Schema::hasColumn('produks', 'harga_beli')) {
                $table->dropColumn('harga_beli');
            }

            if (Schema::hasColumn('produks', 'harga_jual')) {
                $table->dropColumn('harga_jual');
            }

            if (!Schema::hasColumn('produks', 'harga')) {
                $table->decimal('harga', 10, 2)->default(0)->after('stok');
            }
        });
    }
};