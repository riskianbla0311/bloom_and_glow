<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Bunga Baru — Bloom & Glow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFBF7; color: #2C221E; }
        .font-serif-custom { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="min-h-screen py-8 px-4">

    <div class="max-w-xl mx-auto space-y-5">
        <div>
            <h1 class="font-serif-custom text-2xl font-bold text-[#4A0E17]">Tambah Bunga Baru</h1>
            <p class="text-xs text-gray-500 mt-0.5">Sistem Manajemen Stok Florist</p>
        </div>

        <!-- BLOK PESAN ERROR VALIDASI -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-300 text-red-700 px-4 py-3 rounded-xl text-xs font-semibold shadow-sm space-y-1">
                <div class="font-bold flex items-center gap-1 text-red-800">
                    <span>⚠️</span> Terjadi kesalahan input:
                </div>
                <ul class="list-disc list-inside space-y-0.5 text-[11px]">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-sm border border-[#ECE2D8]">
            <form action="{{ route('products.store') }}" method="POST" class="space-y-3.5">
                @csrf

                <div>
                    <div class="flex justify-between items-center mb-1">
                        <label class="text-[11px] font-semibold uppercase text-[#4A0E17]">Kategori</label>
                        <a href="{{ route('categories.index') }}" target="_blank" class="text-[10px] text-amber-700 hover:underline font-bold">+ Kelola Kategori</a>
                    </div>
                    <select name="category_id" required class="w-full px-3 py-2 border rounded-lg bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17]">
                        <option value="" disabled selected>-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-[11px] font-semibold uppercase text-[#4A0E17]">SKU Produk</label>
                    <input type="text" name="sku" value="{{ old('sku') }}" required placeholder="Contoh: BQT-ROSE-RED" class="w-full mt-1 px-3 py-2 border rounded-lg bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17]">
                </div>

                <div>
                    <label class="text-[11px] font-semibold uppercase text-[#4A0E17]">Nama Bunga</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Red Rose Bouquet" class="w-full mt-1 px-3 py-2 border rounded-lg bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17]">
                </div>

                <div>
                    <label class="text-[11px] font-semibold uppercase text-[#4A0E17]">URL Gambar (Unsplash)</label>
                    <input type="url" name="image_url" value="{{ old('image_url') }}" placeholder="https://images.unsplash.com/..." class="w-full mt-1 px-3 py-2 border rounded-lg bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17]">
                    <p class="text-[9px] text-gray-400 mt-0.5">*Boleh dikosongkan jika ingin pakai gambar default</p>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-[11px] font-semibold uppercase text-[#4A0E17]">Harga Beli (Rp)</label>
                        <input type="number" name="purchase_price" value="{{ old('purchase_price') }}" required placeholder="100000" class="w-full mt-1 px-3 py-2 border rounded-lg bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17]">
                    </div>
                    <div>
                        <label class="text-[11px] font-semibold uppercase text-[#4A0E17]">Harga Jual (Rp)</label>
                        <input type="number" name="selling_price" value="{{ old('selling_price') }}" required placeholder="150000" class="w-full mt-1 px-3 py-2 border rounded-lg bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17]">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="text-[11px] font-semibold uppercase text-[#4A0E17]">Stok Awal</label>
                        <input type="number" name="stock" value="{{ old('stock') }}" required placeholder="10" class="w-full mt-1 px-3 py-2 border rounded-lg bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17]">
                    </div>
                    <div>
                        <label class="text-[11px] font-semibold uppercase text-[#4A0E17]">Stok Minimum Alert</label>
                        <input type="number" name="minimum_stock" value="{{ old('minimum_stock') }}" required placeholder="3" class="w-full mt-1 px-3 py-2 border rounded-lg bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17]">
                    </div>
                </div>

                <!-- TOMBOL DIBAGI 2 SAMA BESAR (50% : 50%) -->
                <div class="pt-3 grid grid-cols-2 gap-3">
                    <button type="submit" class="w-full bg-[#4A0E17] hover:bg-[#360910] text-white font-bold h-10 rounded-lg text-xs uppercase tracking-wider transition text-center shadow-sm flex items-center justify-center">
                        Simpan Produk
                    </button>
                    <a href="{{ route('products.index') }}" class="w-full bg-[#F4EBE1] hover:bg-[#EAE0D3] text-[#4A0E17] font-bold h-10 rounded-lg text-xs uppercase tracking-wider transition border border-[#D9C3B0] flex items-center justify-center text-center">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</body>
</html>