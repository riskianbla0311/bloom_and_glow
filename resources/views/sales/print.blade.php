<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan — Bloom & Glow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: sans-serif; background-color: #ffffff; color: #2C221E; }
        @media print {
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="p-8">

    <div class="max-w-4xl mx-auto space-y-6">
        
        <!-- Header Laporan -->
        <div class="flex justify-between items-center border-b pb-4">
            <div>
                <h1 class="text-2xl font-bold text-[#4A0E17]">Bloom & Glow Florist</h1>
                <p class="text-xs text-gray-500 mt-1">Laporan Penjualan Produk (Periode: {{ ucfirst($period ?? 'Bulanan') }})</p>
            </div>
            <div class="text-right">
                <button onclick="window.print()" class="no-print bg-[#4A0E17] text-white font-bold px-4 py-2 rounded-lg text-xs uppercase tracking-wider">
                    🖨️ Cetak / Download PDF
                </button>
            </div>
        </div>

        <!-- Tabel Detail Transaksi -->
        <table class="w-full text-left text-xs border-collapse">
            <thead>
                <tr class="bg-[#F9F4EF] text-[#4A0E17]">
                    <th class="border border-gray-300 p-2 text-center">ID</th>
                    <th class="border border-gray-300 p-2 text-center">Tanggal</th>
                    <th class="border border-gray-300 p-2">Nama Bunga</th>
                    <th class="border border-gray-300 p-2 text-center">Jumlah</th>
                    <th class="border border-gray-300 p-2 text-right">Harga Satuan</th>
                    <th class="border border-gray-300 p-2 text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $sale)
                <tr>
                    <td class="border border-gray-300 p-2 font-mono text-center">#INV-{{ $sale->id }}</td>
                    <td class="border border-gray-300 p-2 text-center">{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                    <td class="border border-gray-300 p-2 font-semibold">{{ $sale->product->name ?? 'Produk Dihapus' }}</td>
                    <td class="border border-gray-300 p-2 text-center">{{ $sale->quantity }} Pcs</td>
                    <td class="border border-gray-300 p-2 text-right">Rp {{ number_format($sale->price, 0, ',', '.') }}</td>
                    <td class="border border-gray-300 p-2 text-right font-bold">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="border border-gray-300 p-4 text-center italic text-gray-400">Belum ada transaksi pada periode ini.</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr class="bg-[#F9F4EF] font-bold text-[#4A0E17]">
                    <td colspan="5" class="border border-gray-300 p-2 text-right uppercase">Total Pendapatan:</td>
                    <td class="border border-gray-300 p-2 text-right text-sm">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <!-- Signature / Footer -->
        <div class="pt-8 flex justify-end text-xs text-right">
            <div>
                <p>Dicetak pada: {{ date('d M Y, H:i') }}</p>
                <p class="mt-12 font-bold">( Owner Bloom & Glow )</p>
            </div>
        </div>

    </div>

</body>
</html>