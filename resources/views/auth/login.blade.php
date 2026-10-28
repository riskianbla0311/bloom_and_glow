<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Bloom & Glow Florist</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#FDFBF7] flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-[#ECE2D8]">
        <h2 class="text-2xl font-bold text-[#4A0E17] text-center mb-6">Masuk Akun</h2>
        
        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded-lg text-xs mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold uppercase text-[#4A0E17]">Email</label>
                <input type="email" name="email" required class="w-full mt-1 p-3 border rounded-xl bg-[#F9F4EF] text-sm focus:outline-none focus:ring-2 focus:ring-[#4A0E17]">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase text-[#4A0E17]">Password</label>
                <input type="password" name="password" required class="w-full mt-1 p-3 border rounded-xl bg-[#F9F4EF] text-sm focus:outline-none focus:ring-2 focus:ring-[#4A0E17]">
            </div>
            <button type="submit" class="w-full bg-[#4A0E17] hover:bg-[#360910] text-white py-3 rounded-xl font-semibold text-xs uppercase tracking-widest transition">
                Login
            </button>
        </form>
        <p class="text-center text-xs text-gray-500 mt-4">
            Belum punya akun? <a href="{{ route('register') }}" class="text-[#4A0E17] font-bold">Daftar</a>
        </p>
    </div>
</body>
</html>