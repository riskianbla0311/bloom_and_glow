<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan — Bloom & Glow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFBF7; color: #2C221E; }
        .font-serif-custom { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="min-h-screen py-8 px-6">

    <div class="max-w-7xl mx-auto space-y-6">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
            <div>
                <h1 class="font-serif-custom text-3xl font-bold text-[#4A0E17]">Laporan & Analisis Penjualan</h1>
                <p class="text-xs text-gray-500 mt-1">Pemantauan Transaksi Penjualan Toko Bunga</p>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('sales.print', ['period' => $period]) }}" target="_blank" class="bg-[#D4AF37] hover:bg-[#C19B2E] text-[#4A0E17] font-bold px-4 py-2.5 rounded-xl text-xs uppercase tracking-wider transition shadow-sm flex items-center gap-1.5">
                    🖨️ Cetak Laporan (PDF)
                </a>
                <a href="{{ route('dashboard') }}" class="bg-[#F4EBE1] text-[#4A0E17] font-bold px-4 py-2.5 rounded-xl text-xs uppercase tracking-wider transition border border-[#D9C3B0]">
                    &larr; Dashboard
                </a>
            </div>
        </div>

        <!-- Filter Periode & Ringkasan Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Box Filter Periode -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-[#ECE2D8] flex flex-col justify-between">
                <span class="text-xs font-semibold uppercase text-gray-400">Pilih Periode Laporan</span>
                <form action="{{ route('sales.index') }}" method="GET" class="mt-3 flex gap-2">
                    <select name="period" onchange="this.form.submit()" class="w-full px-3 py-2 border rounded-xl bg-[#F9F4EF] text-xs font-semibold text-[#4A0E17] focus:outline-none">
                        <option value="weekly" {{ $period == 'weekly' ? 'selected' : '' }}>Perminggu (Minggu Ini)</option>
                        <option value="monthly" {{ $period == 'monthly' ? 'selected' : '' }}>Perbulan (Bulan Ini)</option>
                        <option value="yearly" {{ $period == 'yearly' ? 'selected' : '' }}>Pertahun (Tahun Ini)</option>
                    </select>
                </form>
            </div>

            <!-- Total Pendapatan -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-[#ECE2D8]">
                <span class="text-xs font-semibold uppercase text-gray-400">Total Pendapatan ({{ ucfirst($period) }})</span>
                <p class="text-2xl font-bold text-emerald-700 mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>

            <!-- Total Transaksi -->
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-[#ECE2D8]">
                <span class="text-xs font-semibold uppercase text-gray-400">Total Transaksi Selesai</span>
                <p class="text-2xl font-bold text-[#4A0E17] mt-2">{{ $totalTransactions }} <span class="text-xs font-normal text-gray-500">Transaksi</span></p>
            </div>

        </div>

        <!-- Visualisasi Grafik Penjualan -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#ECE2D8]">
            <h2 class="font-serif-custom text-lg font-bold text-[#4A0E17] mb-4">Grafik Tren Penjualan</h2>
            <div class="h-64">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Tabel Detail Transaksi -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-[#ECE2D8]">
            <h2 class="font-serif-custom text-lg font-bold text-[#4A0E17] mb-4">Detail Riwayat Transaksi</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#F9F4EF] text-xs uppercase text-[#4A0E17] font-semibold">
                        <tr>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Nama Bunga</th>
                            <th class="p-3">Jumlah (Qty)</th>
                            <th class="p-3">Harga Satuan</th>
                            <th class="p-3">Total Transaksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#ECE2D8]">
                        @forelse($sales as $sale)
                        <tr>
                            <td class="p-3 font-mono text-xs text-gray-500">{{ $sale->created_at->format('d M Y, H:i') }}</td>
                            <td class="p-3 font-semibold text-[#4A0E17]">{{ $sale->product->name ?? 'Produk Dihapus' }}</td>
                            <td class="p-3 text-gray-600 font-bold">{{ $sale->quantity }} Pcs</td>
                            <td class="p-3 text-gray-600">Rp {{ number_format($sale->price, 0, ',', '.') }}</td>
                            <td class="p-3 font-bold text-emerald-700">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center italic text-gray-400">Belum ada transaksi pada periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Script Chart.js -->
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: {!! json_encode($chartValues) !!},
                    borderColor: '#4A0E17',
                    backgroundColor: 'rgba(74, 14, 23, 0.1)',
                    fill: true,
                    tension: 0.3,
                    borderWidth: 3,
                    pointBackgroundColor: '#D4AF37',
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>