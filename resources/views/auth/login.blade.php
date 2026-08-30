<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Nona Donat</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen bg-[#fffaf5] text-slate-800">

<div class="min-h-screen flex items-center justify-center px-5 py-10">

    <div class="w-full max-w-md">

        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block">
                <h1 class="text-4xl font-bold text-[#8b4513]" style="font-family: 'Playfair Display', serif;">
                    Nona Donat
                </h1>
            </a>

            <p class="mt-2 text-sm text-slate-500">
                Manisnya bikin jatuh hati. 🍩
            </p>
        </div>

        <div class="bg-white rounded-3xl border border-orange-100 shadow-xl shadow-orange-100/40 p-7 sm:p-9">

            <div class="mb-7">
                <h2 class="text-2xl font-bold text-slate-900">
                    Selamat datang kembali 🍩
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Masuk ke akun Nona Donat kamu.
                </p>
            </div>

            @if ($errors->any())
                <div class="mb-5 rounded-2xl bg-red-50 border border-red-100 px-4 py-3">
                    <p class="text-sm font-medium text-red-600">
                        {{ $errors->first() }}
                    </p>
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="nama@email.com"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm outline-none transition focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-100"
                    >
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        placeholder="Masukkan password"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3.5 text-sm outline-none transition focus:border-orange-400 focus:bg-white focus:ring-4 focus:ring-orange-100"
                    >
                </div>

                <div class="flex items-center justify-between gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            class="h-4 w-4 rounded border-slate-300 text-orange-500 focus:ring-orange-400"
                        >

                        <span class="text-sm text-slate-500">
                            Ingat saya
                        </span>
                    </label>

                    <a href="#" class="text-sm font-semibold text-orange-500 hover:text-orange-600 transition">
                        Lupa password?
                    </a>
                </div>

                <button
                    type="submit"
                    class="w-full rounded-2xl bg-[#c96f32] px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-orange-200 transition hover:bg-[#b85f25] hover:-translate-y-0.5 active:translate-y-0"
                >
                    Masuk
                </button>
            </form>

            <div class="relative my-7">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-100"></div>
                </div>

                <div class="relative flex justify-center">
                    <span class="bg-white px-4 text-xs text-slate-400">
                        atau
                    </span>
                </div>
            </div>

            <p class="text-center text-sm text-slate-500">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-bold text-orange-500 hover:text-orange-600 transition">
                    Daftar sekarang
                </a>
            </p>

        </div>

        <p class="text-center text-xs text-slate-400 mt-6">
            © {{ date('Y') }} Nona Donat
        </p>

    </div>

</div>

</body>
</html>