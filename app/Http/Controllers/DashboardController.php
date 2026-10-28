<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalSales = Sale::sum('total');

        // Menghitung Total Pembelian Stok (Harga Beli x Stok)
        $totalPurchases = Product::select(DB::raw('SUM(purchase_price * stock) as total'))->value('total') ?? 0;

        // Produk dengan stok di bawah atau sama dengan stok minimum
        $lowStockProducts = Product::whereColumn('stock', '<=', 'minimum_stock')->get();

        return view('dashboard', compact('totalProducts', 'totalSales', 'totalPurchases', 'lowStockProducts'));
    }
}