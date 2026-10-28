<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori — Bloom & Glow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFBF7; color: #2C221E; }
        .font-serif-custom { font-family: 'Playfair Display', serif; }
        .bg-maroon { background-color: #4A0E17; }
        .text-maroon { color: #4A0E17; }
    </style>
</head>
<body class="min-h-screen py-10 px-6">

    <div class="max-w-4xl mx-auto space-y-8">
        
        <div class="flex justify-between items-center">
            <div>
                <h1 class="font-serif-custom text-3xl font-bold text-maroon">Kelola Kategori Bunga</h1>
                <p class="text-xs text-gray-500 mt-1">Tambah & Hapus Kategori Produk Toko</p>
            </div>
            <a href="{{ route('products.index') }}" class="bg-[#F4EBE1] text-maroon font-bold px-4 py-2 rounded-xl text-xs uppercase tracking-wider transition border border-[#D9C3B0]">
                &larr; Kembali ke Kelola Bunga
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs p-4 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-300 text-red-800 text-xs p-4 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Tambah Kategori -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#ECE2D8]">
            <form action="{{ route('categories.store') }}" method="POST" class="flex gap-4 items-end">
                @csrf
                <div class="flex-1">
                    <label class="text-xs font-semibold uppercase text-maroon">Nama Kategori Baru</label>
                    <input type="text" name="name" required placeholder="Contoh: Table Flower, Standing Flower..." class="w-full mt-1 p-3 border rounded-xl bg-[#F9F4EF] text-sm focus:outline-none focus:border-maroon">
                </div>
                <button type="submit" class="bg-maroon hover:bg-[#360910] text-white font-bold px-6 py-3 rounded-xl text-xs uppercase tracking-wider transition">
                    + Tambah Kategori
                </button>
            </form>
        </div>

        <!-- Tabel Daftar Kategori -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#ECE2D8]">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#F9F4EF] text-xs uppercase text-maroon font-semibold">
                    <tr>
                        <th class="p-3">No</th>
                        <th class="p-3">Nama Kategori</th>
                        <th class="p-3">Jumlah Produk</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#ECE2D8]">
                    @forelse($categories as $index => $category)
                    <tr>
                        <td class="p-3 text-gray-400 font-mono text-xs">{{ $index + 1 }}</td>
                        <td class="p-3 font-semibold text-maroon">{{ $category->name }}</td>
                        <td class="p-3 text-gray-500">{{ $category->products_count }} Bunga</td>
                        <td class="p-3 text-right">
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-xs font-bold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center italic text-gray-400">Belum ada kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</body>
</html>