<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('products.index', compact('products'));
    }

    // Form tambah produk
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Simpan produk baru (dengan validasi harga jual >= harga beli)
    public function store(Request $request)
    {
        $request->validate([
            'category_id'     => 'required|exists:categories,id',
            'sku'             => 'required|unique:products,sku',
            'name'            => 'required|string|max:255',
            'image_url'       => 'nullable|url',
            'purchase_price'  => 'required|numeric|min:0',
            'selling_price'   => 'required|numeric|gte:purchase_price',
            'stock'           => 'required|integer|min:0',
            'minimum_stock'   => 'required|integer|min:0',
        ], [
            'selling_price.gte' => 'Harga jual tidak boleh lebih kecil dari harga beli!'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Form edit produk
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Update produk (dengan validasi harga jual >= harga beli)
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id'     => 'required|exists:categories,id',
            'sku'             => 'required|unique:products,sku,' . $product->id,
            'name'            => 'required|string|max:255',
            'image_url'       => 'nullable|url',
            'purchase_price'  => 'required|numeric|min:0',
            'selling_price'   => 'required|numeric|gte:purchase_price',
            'stock'           => 'required|integer|min:0',
            'minimum_stock'   => 'required|integer|min:0',
        ], [
            'selling_price.gte' => 'Harga jual tidak boleh lebih kecil dari harga beli!'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Hapus produk
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}