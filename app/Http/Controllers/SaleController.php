<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SaleController extends Controller
{
    // 1. Menampilkan Laporan & Grafik Penjualan
    public function index(Request $request)
    {
        $period = $request->get('period', 'monthly');
        $query = Sale::with('product');

        if ($period == 'weekly') {
            $query->where('created_at', '>=', Carbon::now()->startOfWeek());
        } elseif ($period == 'monthly') {
            $query->where('created_at', '>=', Carbon::now()->startOfMonth());
        } elseif ($period == 'yearly') {
            $query->where('created_at', '>=', Carbon::now()->startOfYear());
        }

        $sales = $query->latest()->get();

        $totalRevenue = $sales->sum('total');
        $totalTransactions = $sales->count();

        // Grouping data berdasarkan tanggal asli transaksi
        $chartData = $sales->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        })->map(function($row) {
            return $row->sum('total');
        });

        $chartLabels = $chartData->keys()->toArray();
        $chartValues = $chartData->values()->toArray();

        return view('sales.index', compact(
            'sales', 'period', 'totalRevenue', 'totalTransactions', 'chartLabels', 'chartValues'
        ));
    }

    // 2. Menampilkan Form Checkout/Penjualan Produk
    public function create($id)
    {
        $product = Product::findOrFail($id);
        return view('sales.checkout', compact('product'));
    }

    // 3. Menyimpan Transaksi Penjualan & Mengurangi Stok
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        // Simpan transaksi
        Sale::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->selling_price,
            'total' => $product->selling_price * $request->quantity,
        ]);

        // Kurangi stok produk otomatis
        $product->decrement('stock', $request->quantity);

        return redirect()->route('sales.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    // 4. Halaman Cetak Laporan
    public function printReport(Request $request)
    {
        $period = $request->get('period', 'monthly');
        $query = Sale::with('product');

        if ($period == 'weekly') {
            $query->where('created_at', '>=', Carbon::now()->startOfWeek());
        } elseif ($period == 'monthly') {
            $query->where('created_at', '>=', Carbon::now()->startOfMonth());
        } elseif ($period == 'yearly') {
            $query->where('created_at', '>=', Carbon::now()->startOfYear());
        }

        $sales = $query->latest()->get();
        $totalRevenue = $sales->sum('total');

        return view('sales.print', compact('sales', 'period', 'totalRevenue'));
    }
}