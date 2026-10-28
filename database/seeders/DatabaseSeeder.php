<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Pengguna Demo (RBAC)
        User::create([
            'name' => 'Owner Admin',
            'email' => 'admin@florist.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir Staff',
            'email' => 'staff@florist.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        $customerUser = User::create([
            'name' => 'Siti Pelanggan',
            'email' => 'customer@florist.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        Customer::create([
            'user_id' => $customerUser->id,
            'name' => 'Siti Pelanggan',
            'phone' => '081234567890',
            'address' => 'Jl. Mawar No. 12, Jakarta',
        ]);

        // 2. Kategori Bunga
        $bouquets = Category::create(['name' => 'Flower Bouquets']);
        $boxes = Category::create(['name' => 'Hat Boxes']);
        $dried = Category::create(['name' => 'Dried Flowers']);
        $hampers = Category::create(['name' => 'Gift Hampers']);

        // 3. Supplier
        Supplier::create([
            'name' => 'Perkebunan Bunga Lembang',
            'phone' => '089876543210',
            'email' => 'supplier@lembangflora.com',
            'address' => 'Lembang, Bandung',
        ]);

        // 4. Katalog Bunga dengan Gambar Unik Estetis
        Product::create([
            'category_id' => $bouquets->id,
            'sku' => 'BQT-ROSE-PNK',
            'name' => 'Royal Pink Peony & Rose Bouquet',
            'image_url' => 'https://images.unsplash.com/photo-1563241527-3004b7be0ffd?auto=format&fit=crop&q=80&w=600',
            'purchase_price' => 120000,
            'selling_price' => 250000,
            'stock' => 15,
            'minimum_stock' => 3,
        ]);

        Product::create([
            'category_id' => $boxes->id,
            'sku' => 'BOX-MRN-LUX',
            'name' => 'Velvet Maroon Rose Hat Box',
            'image_url' => 'https://images.unsplash.com/photo-1526047932273-341f2a7631f9?auto=format&fit=crop&q=80&w=600',
            'purchase_price' => 200000,
            'selling_price' => 380000,
            'stock' => 8,
            'minimum_stock' => 2,
        ]);

        Product::create([
            'category_id' => $bouquets->id,
            'sku' => 'BQT-WHT-LILY',
            'name' => 'Elegant White Lily & Baby Breath',
            'image_url' => 'https://images.unsplash.com/photo-1582794543139-8ac9cb0f7b11?auto=format&fit=crop&q=80&w=600',
            'purchase_price' => 90000,
            'selling_price' => 185000,
            'stock' => 12,
            'minimum_stock' => 4,
        ]);

        Product::create([
            'category_id' => $dried->id,
            'sku' => 'DRD-AUT-GOLD',
            'name' => 'Autumn Gold Dried Flower Arrangement',
            'image_url' => 'https://images.unsplash.com/photo-1520763185298-1b434c919102?auto=format&fit=crop&q=80&w=600',
            'purchase_price' => 110000,
            'selling_price' => 220000,
            'stock' => 20,
            'minimum_stock' => 5,
        ]);

        Product::create([
            'category_id' => $hampers->id,
            'sku' => 'HMP-LUX-GIFT',
            'name' => 'Bloom & Glow Deluxe Luxury Gift Set',
            'image_url' => 'https://images.unsplash.com/photo-1591886960571-74d43a9d4166?auto=format&fit=crop&q=80&w=600',
            'purchase_price' => 300000,
            'selling_price' => 550000,
            'stock' => 5,
            'minimum_stock' => 2,
        ]);
    }
}