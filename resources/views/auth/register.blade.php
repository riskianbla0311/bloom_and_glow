<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — Bloom & Glow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFBF7; color: #2C221E; }
        .font-serif-custom { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center py-10 px-4">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-sm border border-[#ECE2D8] space-y-5">
        
        <!-- Header Brand -->
        <div class="text-center space-y-1">
            <h1 class="font-serif-custom text-3xl font-bold text-[#4A0E17]">Bloom & Glow</h1>
            <h2 class="text-base font-bold text-[#2C221E]">Buat Akun Pelanggan</h2>
            <p class="text-xs text-gray-500">Daftar untuk mulai memesan rangkaian bunga mewah</p>
        </div>

        <!-- Alert Error Validasi -->
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 p-3.5 rounded-xl text-xs space-y-1">
                <div class="font-bold flex items-center gap-1">
                    <span>⚠️</span> Gagal Mendaftar:
                </div>
                <ul class="list-disc list-inside space-y-0.5 text-[11px]">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Register -->
        <form action="{{ route('register') }}" method="POST" class="space-y-3.5">
            @csrf

            <div>
                <label class="text-[11px] font-semibold uppercase tracking-wider text-[#4A0E17] block mb-1">NAMA LENGKAP</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Budi Santoso" class="w-full px-3.5 py-2.5 border border-[#ECE2D8] rounded-xl bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17] transition">
            </div>

            <div>
                <label class="text-[11px] font-semibold uppercase tracking-wider text-[#4A0E17] block mb-1">EMAIL</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Contoh: budi@gmail.com" class="w-full px-3.5 py-2.5 border border-[#ECE2D8] rounded-xl bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17] transition">
            </div>

            <div>
                <label class="text-[11px] font-semibold uppercase tracking-wider text-[#4A0E17] block mb-1">PASSWORD</label>
                <input type="password" name="password" required placeholder="Minimal 6 karakter" class="w-full px-3.5 py-2.5 border border-[#ECE2D8] rounded-xl bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17] transition">
            </div>

            <div>
                <label class="text-[11px] font-semibold uppercase tracking-wider text-[#4A0E17] block mb-1">KONFIRMASI PASSWORD</label>
                <input type="password" name="password_confirmation" required placeholder="Ulangi password" class="w-full px-3.5 py-2.5 border border-[#ECE2D8] rounded-xl bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17] transition">
            </div>

            <div>
                <label class="text-[11px] font-semibold uppercase tracking-wider text-[#4A0E17] block mb-1">NOMOR HP / WHATSAPP</label>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 081234567890" class="w-full px-3.5 py-2.5 border border-[#ECE2D8] rounded-xl bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17] transition">
            </div>

            <div>
                <label class="text-[11px] font-semibold uppercase tracking-wider text-[#4A0E17] block mb-1">ALAMAT PENGIRIMAN</label>
                <textarea name="address" rows="3" placeholder="Contoh: Jl. Sudirman No. 45" class="w-full px-3.5 py-2.5 border border-[#ECE2D8] rounded-xl bg-[#F9F4EF] text-xs focus:outline-none focus:border-[#4A0E17] transition resize-none block font-sans">{{ old('address') }}</textarea>
            </div>

            <!-- Tombol Daftar dengan Warna Asli (#D8A838 / Gold) -->
            <button type="submit" class="w-full bg-[#D8A838] hover:bg-[#C2942E] text-white font-bold py-3 rounded-xl text-xs uppercase tracking-wider transition shadow-sm cursor-pointer mt-2">
                DAFTAR SEKARANG
            </button>
        </form>

        <!-- Footer Link -->
        <div class="text-center pt-2 border-t border-[#ECE2D8]">
            <p class="text-xs text-gray-500">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-bold text-[#4A0E17] hover:underline">Masuk di sini</a>
            </p>
        </div>

    </div>

</body>
</html>