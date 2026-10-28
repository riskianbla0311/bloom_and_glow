<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CategoryController;

// 1. Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Auth Routes (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 2. Protected Routes (Harus Login)
Route::middleware('auth')->group(function () {
    
    // Checkout Pembelian untuk Customer
    Route::get('/checkout/{product}', [SaleController::class, 'create'])->name('sales.checkout');
    Route::post('/checkout', [SaleController::class, 'store'])->name('sales.store');

    // Riwayat Penjualan & Laporan (Bisa Diakses Customer & Staff/Admin)
    Route::get('/sales-history', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales-print', [SaleController::class, 'printReport'])->name('sales.print');

    // Internal Dashboard & Operations (Admin & Staff Only)
    Route::middleware(\App\Http\Middleware\CheckRole::class . ':admin,staff')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Route Kelola Kategori
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        // CRUD Produk Bunga
        Route::resource('products', ProductController::class);
    });

});