<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Bunga — Bloom & Glow</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FDFBF7] flex justify-center py-12">
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-[#ECE2D8] w-full max-w-lg">
        <h2 class="text-2xl font-bold text-[#4A0E17] mb-1">Edit Data Bunga</h2>
        <p class="text-xs text-gray-500 mb-6">Sistem Manajemen Stok Florist</p>
        <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="text-xs font-semibold text-[#4A0E17] uppercase">Kategori</label>
                <select name="category_id" required class="w-full mt-1 p-3 border rounded-xl bg-[#F9F4EF] text-sm">
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-xs font-semibold text-[#4A0E17] uppercase">SKU Produk</label>
                <input type="text" name="sku" value="{{ $product->sku }}" required class="w-full mt-1 p-3 border rounded-xl bg-[#F9F4EF] text-sm">
            </div>
            <div>
                <label class="text-xs font-semibold text-[#4A0E17] uppercase">Nama Bunga</label>
                <input type="text" name="name" value="{{ $product->name }}" required class="w-full mt-1 p-3 border rounded-xl bg-[#F9F4EF] text-sm">
            </div>
            <div>
                <label class="text-xs font-semibold text-[#4A0E17] uppercase">URL Gambar</label>
                <input type="url" name="image_url" value="{{ $product->image_url }}" class="w-full mt-1 p-3 border rounded-xl bg-[#F9F4EF] text-sm">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs font-semibold text-[#4A0E17] uppercase">Harga Beli (Rp)</label>
                    <input type="number" name="purchase_price" value="{{ $product->purchase_price }}" required class="w-full mt-1 p-3 border rounded-xl bg-[#F9F4EF] text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold text-[#4A0E17] uppercase">Harga Jual (Rp)</label>
                    <input type="number" name="selling_price" value="{{ $product->selling_price }}" required class="w-full mt-1 p-3 border rounded-xl bg-[#F9F4EF] text-sm">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="text-xs font-semibold text-[#4A0E17] uppercase">Stok</label>
                    <input type="number" name="stock" value="{{ $product->stock }}" required class="w-full mt-1 p-3 border rounded-xl bg-[#F9F4EF] text-sm">
                </div>
                <div>
                    <label class="text-xs font-semibold text-[#4A0E17] uppercase">Stok Minimum Alert</label>
                    <input type="number" name="minimum_stock" value="{{ $product->minimum_stock }}" required class="w-full mt-1 p-3 border rounded-xl bg-[#F9F4EF] text-sm">
                </div>
            </div>
            <button type="submit" class="w-full bg-[#4A0E17] hover:bg-[#360910] text-white py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider transition">Update Data Bunga</button>
            <a href="{{ route('products.index') }}" class="block text-center text-xs text-gray-500 mt-2 hover:underline">&larr; Batal & Kembali</a>
        </form>
    </div>
</body>
</html>