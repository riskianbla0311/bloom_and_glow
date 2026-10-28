<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Bunga — Bloom & Glow Florist</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FDFBF7] flex items-center justify-center min-h-screen py-10">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-lg border border-[#ECE2D8]">
        <h2 class="text-2xl font-bold text-[#4A0E17] text-center mb-2">Form Pemesanan Bunga</h2>
        <p class="text-xs text-center text-gray-500 mb-6">Bloom & Glow Luxury Atelier</p>

        @if(session('error'))
            <div class="bg-red-100 text-red-600 p-3 rounded-lg text-xs mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('sales.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="p-4 bg-[#F9F4EF] rounded-xl flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-[#4A0E17]">{{ $product->name }}</h3>
                    <p class="text-xs text-gray-500">Stok Tersedia: {{ $product->stock }}</p>
                </div>
                <span class="text-sm font-bold text-[#4A0E17]">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</span>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-[#4A0E17]">Jumlah Pesanan (Qty)</label>
                <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="1" required class="w-full mt-1 p-3 border rounded-xl bg-[#F9F4EF] text-sm">
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase text-[#4A0E17]">Metode Pembayaran</label>
                <select name="payment_method" required class="w-full mt-1 p-3 border rounded-xl bg-[#F9F4EF] text-sm">
                    <option value="Transfer Bank Manual">Transfer Bank (BCA / Mandiri)</option>
                    <option value="COD / Bayar di Tempat">COD / Bayar di Tempat</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-[#4A0E17] hover:bg-[#360910] text-white py-3.5 rounded-xl font-semibold text-xs uppercase tracking-widest transition shadow-lg">
                Proses Pesanan Sekarang
            </button>
            
            <a href="/" class="block text-center text-xs text-gray-500 mt-2 hover:underline">&larr; Batal & Kembali</a>
        </form>
    </div>
</body>
</html>