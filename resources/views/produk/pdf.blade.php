<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #333; padding: 8px; }
        th { background: #f4f4f4; }
        .header { text-align: center; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Daftar Produk</h2>
        <p>Export PDF produk</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Supplier</th>
                <th>Stok</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $produk)
            <tr>
                <td>{{ $produk->kode_produk }}</td>
                <td>{{ $produk->nama_produk }}</td>
                <td>{{ $produk->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ $produk->supplier->nama_supplier ?? '-' }}</td>
                <td>{{ $produk->stok }}</td>
                <td>{{ number_format($produk->harga_beli, 0, ',', '.') }}</td>
                <td>{{ number_format($produk->harga_jual, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
