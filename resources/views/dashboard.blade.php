<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Operational — Bloom & Glow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFBF7; color: #2C221E; }
        .font-serif-custom { font-family: 'Playfair Display', serif; }
        .bg-maroon { background-color: #4A0E17; }
        .text-maroon { color: #4A0E17; }
    </style>
</head>
<body class="antialiased">

    <!-- Top Navigation -->
    <nav class="bg-maroon text-[#FAF6F0] px-8 py-4 flex justify-between items-center shadow-md">
        <a href="/" class="font-serif-custom text-2xl font-bold tracking-wide text-[#F3E5D8]">
            Bloom & Glow <span class="text-xs font-sans tracking-widest uppercase block text-[#D4AF37]">Internal Panel</span>
        </a>
        <div class="flex items-center space-x-6 text-sm">
            <span>Halo, <strong class="text-[#D4AF37]">{{ auth()->user()->name }}</strong> ({{ strtoupper(auth()->user()->role) }})</span>
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-[#8C1D2F] hover:bg-[#A32237] text-white px-4 py-2 rounded-xl text-xs uppercase tracking-wider transition">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-10 space-y-8">
        
        <div>
            <h1 class="font-serif-custom text-3xl font-bold text-maroon">Dashboard Operational Toko</h1>
            <p class="text-xs text-gray-500 mt-1">Sistem Pemantauan Pesanan, Stok, & Operasional Staff Florist</p>
        </div>

        <!-- Metric Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1: Total Jenis Bunga -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#ECE2D8]">
                <span class="text-xs font-semibold uppercase text-gray-400">Total Jenis Bunga</span>
                <p class="text-3xl font-bold text-maroon mt-2">{{ $totalProducts }} <span class="text-xs font-normal text-gray-500">Produk</span></p>
            </div>

            <!-- TAMPILAN KHUSUS ADMIN -->
            @if(auth()->user()->role === 'admin')
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#ECE2D8]">
                    <span class="text-xs font-semibold uppercase text-gray-400">Total Transaksi Penjualan</span>
                    <p class="text-3xl font-bold text-emerald-700 mt-2">Rp {{ number_format($totalSales, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#ECE2D8]">
                    <span class="text-xs font-semibold uppercase text-gray-400">Total Pembelian Stok</span>
                    <p class="text-3xl font-bold text-blue-700 mt-2">Rp {{ number_format($totalPurchases, 0, ',', '.') }}</p>
                </div>
            @else
                <!-- TAMPILAN KHUSUS STAFF -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#ECE2D8]">
                    <span class="text-xs font-semibold uppercase text-gray-400">Total Pesanan Diproses</span>
                    <p class="text-3xl font-bold text-emerald-700 mt-2">{{ \App\Models\Sale::count() }} <span class="text-xs font-normal text-gray-500">Transaksi</span></p>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#ECE2D8]">
                    <span class="text-xs font-semibold uppercase text-gray-400">Status Stok Kritis</span>
                    <p class="text-3xl font-bold text-amber-600 mt-2">{{ $lowStockProducts->count() }} <span class="text-xs font-normal text-gray-500">Perlu Restock</span></p>
                </div>
            @endif
        </div>

        <!-- Warning Alert Stok Rendah -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#ECE2D8] space-y-4">
            <div class="flex items-center justify-between border-b pb-4 border-[#ECE2D8]">
                <h2 class="font-serif-custom font-bold text-xl text-maroon flex items-center gap-2">
                    ⚠️ Peringatan Stok Bunga Rendah 
                </h2>
                <span class="bg-amber-100 text-amber-800 text-xs px-3 py-1 rounded-full font-semibold">
                    {{ $lowStockProducts->count() }} Perlu Restock
                </span>
            </div>

            @if($lowStockProducts->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-[#F9F4EF] text-xs uppercase text-maroon font-semibold">
                            <tr>
                                <th class="p-3">SKU</th>
                                <th class="p-3">Nama Bunga</th>
                                <th class="p-3">Sisa Stok</th>
                                <th class="p-3">Batas Minimum</th>
                                <th class="p-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-[#ECE2D8]">
                            @foreach($lowStockProducts as $p)
                            <tr>
                                <td class="p-3 font-mono text-xs">{{ $p->sku }}</td>
                                <td class="p-3 font-semibold text-maroon">{{ $p->name }}</td>
                                <td class="p-3 font-bold text-red-600">{{ $p->stock }}</td>
                                <td class="p-3 text-gray-500">{{ $p->minimum_stock }}</td>
                                <td class="p-3">
                                    <span class="bg-red-100 text-red-700 text-[10px] uppercase font-bold px-2.5 py-1 rounded-full">Restock!</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-sm text-gray-500 italic">Semua stok bunga dalam kondisi aman.</p>
            @endif
        </div>

        <!-- Tombol Aksi Kustom Sesuai Role -->
        <div class="flex flex-wrap gap-4 pt-2">
            <a href="{{ route('sales.index') }}" class="bg-emerald-800 hover:bg-emerald-900 text-white font-bold px-6 py-3 rounded-xl text-xs uppercase tracking-wider transition shadow-sm">
                📑 Lihat Pesanan / Transaksi Masuk
            </a>
            
            <a href="{{ route('products.index') }}" class="bg-maroon hover:bg-[#360910] text-white font-bold px-6 py-3 rounded-xl text-xs uppercase tracking-wider transition shadow-sm">
                ⚙️ Kelola Produk & Stok Bunga
            </a>

            <!-- Khusus ADMIN: Tombol Cetak Laporan Keuangan -->
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('sales.print') }}" target="_blank" class="bg-[#D4AF37] hover:bg-[#C19B2E] text-maroon font-bold px-6 py-3 rounded-xl text-xs uppercase tracking-wider transition shadow-sm">
                    🖨️ Cetak Laporan Keuangan (PDF)
                </a>
            @endif

            <a href="/" class="bg-[#F4EBE1] hover:bg-[#EAE0D3] text-maroon font-bold px-6 py-3 rounded-xl text-xs uppercase tracking-wider transition border border-[#D9C3B0]">
                &larr; Kembali ke Katalog Utama
            </a>
        </div>

    </div>

</body>
</html>