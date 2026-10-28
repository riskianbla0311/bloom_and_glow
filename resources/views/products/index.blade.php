<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bunga — Bloom & Glow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFBF7; color: #2C221E; }
        .font-serif-custom { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="min-h-screen py-8 px-4">

    <div class="max-w-6xl mx-auto space-y-6">
        
        <!-- Header Page -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="font-serif-custom text-2xl font-bold text-[#4A0E17]">Daftar Bunga & Stok</h1>
                <p class="text-xs text-gray-500 mt-0.5">Sistem Manajemen Stok Florist</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('categories.index') }}" class="bg-[#F4EBE1] hover:bg-[#EAE0D3] text-[#4A0E17] font-bold px-4 py-2 rounded-lg text-xs uppercase tracking-wider transition border border-[#D9C3B0]">
                    Kelola Kategori
                </a>
                <a href="{{ route('products.create') }}" class="bg-[#4A0E17] hover:bg-[#360910] text-white font-bold px-4 py-2 rounded-lg text-xs uppercase tracking-wider transition shadow-sm">
                    + Tambah Bunga
                </a>
            </div>
        </div>

        <!-- Alert Notification -->
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-xs font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <!-- Card Tabel Daftar Produk -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#ECE2D8]">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#F9F4EF] text-[#4A0E17] text-[11px] font-bold uppercase tracking-wider">
                            <th class="p-3 pl-4 rounded-l-xl">GAMBAR</th>
                            <th class="p-3">SKU</th>
                            <th class="p-3">NAMA BUNGA</th>
                            <th class="p-3">KATEGORI</th>
                            <th class="p-3">HARGA BELI</th>
                            <th class="p-3">HARGA JUAL</th>
                            <th class="p-3 text-center">STOK</th>
                            <th class="p-3 pr-4 text-right rounded-r-xl">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-xs">
                        @forelse($products as $product)
                        <tr class="hover:bg-[#FDFBF7] transition">
                            <td class="p-3 pl-4">
                                <img src="{{ $product->image_url ?? 'https://images.unsplash.com/photo-1563241527-3004b7be0ffd?w=150' }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-10 h-10 object-cover rounded-lg border border-[#ECE2D8]">
                            </td>
                            <td class="p-3 text-gray-500 font-medium">{{ $product->sku }}</td>
                            <td class="p-3 font-semibold text-[#4A0E17]">{{ $product->name }}</td>
                            <td class="p-3 text-gray-400">{{ $product->category->name ?? '-' }}</td>
                            <td class="p-3 text-gray-600 font-medium">Rp {{ number_format($product->purchase_price, 0, ',', '.') }}</td>
                            <td class="p-3 text-emerald-700 font-bold">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</td>
                            <td class="p-3 text-center">
                                <span class="{{ $product->stock <= $product->minimum_stock ? 'text-red-600 font-bold' : 'text-gray-700 font-medium' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <!-- Kolom AKSI dengan Tombol Berbentuk Badge & Icon -->
                            <td class="p-3 pr-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('products.edit', $product->id) }}" 
                                       class="inline-flex items-center gap-1 bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 px-3 py-1.5 rounded-lg text-[11px] font-bold transition shadow-xs">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus bunga ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center gap-1 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 px-3 py-1.5 rounded-lg text-[11px] font-bold transition shadow-xs cursor-pointer">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="p-6 text-center text-gray-400 italic">Belum ada produk bunga yang ditambahkan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>