<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloom & Glow Florist — Premium Floral Atelier</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFBF7; color: #2C221E; }
        .font-serif-custom { font-family: 'Playfair Display', serif; }
        .bg-maroon { background-color: #4A0E17; }
        .bg-maroon-dark { background-color: #360910; }
        .text-maroon { color: #4A0E17; }
        .bg-warm-beige { background-color: #F9F4EF; }
        .bg-warm-card { background-color: #F4EBE1; }
    </style>
</head>
<body class="antialiased">

    <!-- Top Announcement Bar -->
    <div class="bg-maroon-dark text-[#E6D5C3] text-xs py-2 text-center tracking-widest uppercase">
        🌸 Same Day Delivery Available — Free Gift Card Included
    </div>

    <!-- Navigation Header (Menu Rapi & Proorsional) -->
    <nav class="bg-maroon text-[#FAF6F0] sticky top-0 z-50 shadow-md">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            
            <!-- Logo Toko -->
            <a href="/" class="font-serif-custom text-2xl font-bold tracking-wide text-[#F3E5D8]">
                Bloom & Glow <span class="text-[10px] font-sans tracking-widest uppercase block text-[#D4AF37]">Florist Atelier</span>
            </a>
            
            <!-- Group Menu Navigasi -->
            <div class="flex items-center space-x-6 text-xs uppercase tracking-wider text-[#E8D8C8]">
                <a href="#katalog" class="hover:text-white transition">Katalog Utama</a>
                <a href="#tentang" class="hover:text-white transition">Tentang Kami</a>

                @if (Route::has('login'))
                    @auth
                        @if(in_array(auth()->user()->role, ['admin', 'staff']))
                            <a href="{{ url('/dashboard') }}" class="bg-[#8C1D2F] hover:bg-[#A32237] text-white px-4 py-2 rounded-xl text-xs font-semibold tracking-wider transition">Dashboard</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-xs uppercase tracking-wider text-[#E8D8C8] hover:text-white transition ml-2">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-white transition">Login</a>
                        <a href="{{ route('register') }}" class="bg-[#D4AF37] hover:bg-[#C19B2E] text-maroon font-semibold px-4 py-2 rounded-xl text-xs uppercase tracking-wider transition">Daftar</a>
                    @endauth
                @endif
            </div>

        </div>
    </nav>

    <!-- Hero Banner -->
    <section class="bg-maroon text-white py-16 md:py-20 px-6 relative overflow-hidden">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6 z-10">
                <span class="text-[#D4AF37] text-xs uppercase tracking-widest font-semibold">Luxury Floral Collections</span>
                <h1 class="font-serif-custom text-4xl md:text-5xl font-bold leading-tight text-[#FAF6F0]">
                    Bigger. Brighter.<br><span class="italic font-normal text-[#E6C594]">More Luxurious.</span>
                </h1>
                <p class="text-[#D9C3B0] text-sm md:text-base leading-relaxed max-w-lg">
                    Rangkaian bunga segar dipadu dengan estetika maroon & warm beige mewah untuk momen paling istimewa dalam hidup Anda.
                </p>
                <div>
                    <a href="#katalog" class="inline-block bg-[#F4EBE1] hover:bg-white text-maroon font-semibold px-8 py-3.5 rounded-full text-xs uppercase tracking-widest transition shadow-lg">
                        Jelajahi Katalog Bunga &rarr;
                    </a>
                </div>
            </div>
            <div class="relative flex justify-center">
                <img src="https://images.unsplash.com/photo-1563241527-3004b7be0ffd?auto=format&fit=crop&q=80&w=800" 
                     alt="Luxury Flower Bouquet" 
                     class="rounded-2xl shadow-2xl border-4 border-[#8C1D2F] object-cover h-[350px] w-full md:w-[420px]">
            </div>
        </div>
    </section>

    <!-- Features Highlight -->
    <section class="bg-warm-card py-5 border-y border-[#E6D8CB]">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-6 text-center text-xs text-maroon font-semibold uppercase tracking-wider">
            <div class="flex items-center justify-center space-x-2"><span>🌸 100% Bunga Segar</span></div>
            <div class="flex items-center justify-center space-x-2"><span>🚚 Kirim Hari Yang Sama</span></div>
            <div class="flex items-center justify-center space-x-2"><span>🎀 Gratis Kartu Ucapan</span></div>
            <div class="flex items-center justify-center space-x-2"><span>✨ Desain Eksklusif</span></div>
        </div>
    </section>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="max-w-6xl mx-auto px-6 mt-8">
            <div class="bg-emerald-100 border border-emerald-400 text-emerald-800 px-4 py-3 rounded-xl text-sm font-semibold text-center">
                🎉 {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Katalog Produk Section -->
    <section id="katalog" class="max-w-6xl mx-auto px-6 py-16">
        <div class="text-center space-y-3 mb-12">
            <span class="text-xs uppercase tracking-widest text-[#B58A44] font-semibold">Our Signature Atelier</span>
            <h2 class="font-serif-custom text-3xl font-bold text-maroon">Katalog Koleksi Bunga</h2>
            <div class="w-16 h-0.5 bg-[#D4AF37] mx-auto"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(\App\Models\Product::with('category')->get() as $product)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-[#ECE2D8] flex flex-col justify-between group">
                <div>
                    <div class="relative overflow-hidden bg-warm-beige h-64">
                        <img src="{{ $product->image_url ?? 'https://images.unsplash.com/photo-1563241527-3004b7be0ffd?auto=format&fit=crop&q=80&w=600' }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <span class="absolute top-4 left-4 bg-maroon text-[#E6D5C3] text-[10px] uppercase font-bold tracking-widest px-3 py-1 rounded-full">
                            {{ $product->category->name ?? 'Florist' }}
                        </span>
                    </div>
                    <div class="p-6 space-y-2">
                        <span class="text-[11px] text-gray-400 font-mono">SKU: {{ $product->sku }}</span>
                        <h3 class="font-serif-custom font-bold text-lg text-maroon group-hover:text-[#8C1D2F] transition">
                            {{ $product->name }}
                        </h3>
                        <div class="flex items-center justify-between pt-2">
                            <span class="text-xs text-gray-500">Stok Tersedia: <strong class="text-maroon">{{ $product->stock }}</strong></span>
                            <span class="text-lg font-bold text-maroon">Rp {{ number_format($product->selling_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                <div class="p-6 pt-0">
                    <a href="{{ route('sales.checkout', $product->id) }}" class="block text-center w-full bg-warm-card hover:bg-maroon hover:text-white text-maroon font-semibold py-3 rounded-xl text-xs uppercase tracking-widest transition border border-[#D9C3B0]">
                        Beli / Order Sekarang
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Section Tentang Kami -->
    <section id="tentang" class="bg-warm-card py-16 border-t border-[#ECE2D8]">
        <div class="max-w-4xl mx-auto px-6 text-center space-y-4">
            <span class="text-xs uppercase tracking-widest text-[#B58A44] font-semibold">About Our Atelier</span>
            <h2 class="font-serif-custom text-3xl font-bold text-maroon">Tentang Bloom & Glow Florist</h2>
            <div class="w-16 h-0.5 bg-[#D4AF37] mx-auto"></div>
            <p class="text-sm text-gray-700 leading-relaxed max-w-2xl mx-auto pt-2">
                Bloom & Glow Florist menghadirkan seni merangkai bunga berkualitas tinggi dengan estetika mewah. Kami berkomitmen menyajikan keindahan bunga segar pilihan langsung dari perkebunan terbaik untuk merayakan setiap momen berharga Anda.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-maroon-dark text-[#D9C3B0] py-10 px-6 border-t border-[#60131E] text-center text-xs">
        <p class="font-serif-custom text-lg text-[#F3E5D8] mb-1">Bloom & Glow Florist</p>
        <p>&copy; {{ date('Y') }} Bloom & Glow Florist Atelier. All rights reserved.</p>
    </footer>

</body>
</html>