<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nona Donat - Donat Fresh Setiap Hari</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    >

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen overflow-x-hidden bg-[#fffaf5] text-slate-800 antialiased">

    <header class="sticky top-0 z-50 border-b border-orange-100 bg-white/95 backdrop-blur-xl">

        <div class="mx-auto flex h-[72px] max-w-7xl items-center justify-between px-4 sm:h-20 sm:px-6 lg:px-8">

            <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-2.5 sm:gap-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#c96f32] text-white shadow-md shadow-orange-200 sm:h-11 sm:w-11 sm:rounded-2xl">
                    <i class="fa-solid fa-cookie-bite text-base sm:text-lg"></i>
                </div>

                <div class="min-w-0">
                    <h1
                        class="truncate text-base font-bold leading-none text-[#8b4513] sm:text-lg"
                        style="font-family: 'Playfair Display', serif;"
                    >
                        Nona Donat
                    </h1>

                    <p class="mt-1 hidden text-[10px] font-medium text-slate-400 xs:block sm:block">
                        Freshly Made With Love
                    </p>
                </div>

            </a>

            <nav
                id="desktopNav"
                class="hidden items-center gap-6 lg:flex xl:gap-8"
            >
                <a
                    href="#beranda"
                    data-section="beranda"
                    class="nav-link relative py-2 text-sm font-semibold text-[#c96f32]"
                >
                    Beranda
                    <span class="nav-indicator"></span>
                </a>

                <a
                    href="#kategori"
                    data-section="kategori"
                    class="nav-link relative py-2 text-sm font-medium text-slate-600"
                >
                    Kategori
                    <span class="nav-indicator"></span>
                </a>

                <a
                    href="#donat"
                    data-section="donat"
                    class="nav-link relative py-2 text-sm font-medium text-slate-600"
                >
                    Donat
                    <span class="nav-indicator"></span>
                </a>

                <a
                    href="#tentang"
                    data-section="tentang"
                    class="nav-link relative py-2 text-sm font-medium text-slate-600"
                >
                    Tentang
                    <span class="nav-indicator"></span>
                </a>

                <a
                    href="#lokasi"
                    data-section="lokasi"
                    class="nav-link relative py-2 text-sm font-medium text-slate-600"
                >
                    Lokasi
                    <span class="nav-indicator"></span>
                </a>
            </nav>

            <div class="flex items-center gap-2 sm:gap-3">

                <a
                    href="{{ auth()->check() ? route('cart.index') : route('login') }}"
                    class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 bg-white text-slate-500 transition hover:bg-orange-50 hover:text-[#c96f32]"
                    title="Keranjang"
                >
                    <i class="fa-solid fa-cart-shopping text-sm"></i>

                    @auth
                        @php
                            $cartCount = auth()->user()->carts()->sum('quantity');
                        @endphp

                        @if($cartCount > 0)
                            <span class="absolute -right-1.5 -top-1.5 flex h-5 min-w-5 items-center justify-center rounded-full bg-[#c96f32] px-1 text-[10px] font-bold text-white">
                                {{ $cartCount > 99 ? '99+' : $cartCount }}
                            </span>
                        @endif
                    @endauth
                </a>

                @auth

                    <a
                        href="#"
                        class="hidden max-w-[180px] items-center gap-2 rounded-xl border border-orange-100 bg-white px-3 py-2.5 text-xs font-semibold text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32] sm:flex"
                    >
                        <i class="fa-regular fa-circle-user"></i>
                        <span class="truncate">{{ auth()->user()->name }}</span>
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="hidden items-center gap-2 rounded-xl bg-[#c96f32] px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-[#b85f27] sm:inline-flex"
                    >
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Masuk
                    </a>

                @endauth

                <button
                    type="button"
                    id="mobileMenuButton"
                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 bg-white text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32] lg:hidden"
                >
                    <i id="mobileMenuIcon" class="fa-solid fa-bars"></i>
                </button>

            </div>

        </div>

        <div
            id="mobileMenu"
            class="hidden border-t border-orange-100 bg-white lg:hidden"
        >

            <nav class="mx-auto max-w-7xl px-4 py-3 sm:px-6">

                <div class="space-y-1">

                    <a
                        href="#beranda"
                        class="block rounded-xl px-4 py-3 text-sm font-semibold text-[#c96f32] transition hover:bg-orange-50"
                    >
                        Beranda
                    </a>

                    <a
                        href="#kategori"
                        class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                    >
                        Kategori
                    </a>

                    <a
                        href="#donat"
                        class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                    >
                        Donat
                    </a>

                    <a
                        href="#tentang"
                        class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                    >
                        Tentang
                    </a>

                    <a
                        href="#lokasi"
                        class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                    >
                        Lokasi
                    </a>

                    @guest

                        <a
                            href="{{ route('login') }}"
                            class="mt-2 flex items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#b85f27] sm:hidden"
                        >
                            <i class="fa-solid fa-right-to-bracket"></i>
                            Masuk
                        </a>

                    @endguest

                    <a
                        href="{{ auth()->check() ? route('cart.index') : route('login') }}"
                        class="mt-2 flex items-center justify-center gap-2 rounded-xl border border-orange-100 bg-orange-50 px-4 py-3 text-sm font-semibold text-[#c96f32]"
                    >
                        <i class="fa-solid fa-cart-shopping"></i>
                        Keranjang
                    </a>

                </div>

            </nav>

        </div>

    </header>

    <main>

        <section id="beranda" class="relative overflow-hidden scroll-mt-20">

            <div class="absolute -left-32 top-10 h-72 w-72 rounded-full bg-orange-200/30 blur-3xl"></div>
            <div class="absolute -right-32 bottom-0 h-80 w-80 rounded-full bg-amber-200/30 blur-3xl"></div>

            <div class="relative mx-auto grid max-w-7xl items-center gap-10 px-4 py-12 sm:px-6 sm:py-16 md:gap-12 lg:grid-cols-2 lg:px-8 lg:py-24">

                <div class="relative z-10 max-w-2xl">

                    <span class="inline-flex max-w-full items-center gap-2 rounded-full border border-orange-100 bg-white px-3 py-1.5 text-[11px] font-semibold text-[#c96f32] shadow-sm sm:text-xs">
                        <span class="h-2 w-2 shrink-0 rounded-full bg-[#c96f32]"></span>
                        Freshly made every day
                    </span>

                    <h2
                        class="mt-4 max-w-xl text-[2.35rem] font-bold leading-[1.08] tracking-tight text-[#6f3510] sm:mt-5 sm:text-5xl lg:text-6xl"
                        style="font-family: 'Playfair Display', serif;"
                    >
                        Donat lembut,
                        <span class="text-[#c96f32]">
                            manisnya pas.
                        </span>
                    </h2>

                    <p class="mt-5 max-w-xl text-sm leading-6 text-slate-500 sm:text-base sm:leading-7 lg:text-lg">
                        Nikmati donat fresh dengan berbagai rasa dan topping favorit.
                        Dibuat dengan bahan pilihan untuk menemani setiap momen manismu.
                    </p>

                    <div class="mt-7 grid grid-cols-1 gap-3 xs:grid-cols-2 sm:flex sm:flex-row">

                        <a
                            href="#donat"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-orange-200 transition hover:bg-[#b85f27]"
                        >
                            Pesan Sekarang
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>

                        <a
                            href="#tentang"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-orange-100 bg-white px-5 py-3.5 text-sm font-semibold text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                        >
                            Tentang Kami
                        </a>

                    </div>

                    <div class="mt-9 grid grid-cols-3 gap-3 sm:mt-10 sm:flex sm:flex-wrap sm:items-center sm:gap-x-8 sm:gap-y-4">

                        <div>
                            <p class="text-base font-bold text-slate-900 sm:text-xl">
                                Fresh
                            </p>

                            <p class="mt-1 text-[10px] leading-4 text-slate-400 sm:text-xs">
                                Dibuat setiap hari
                            </p>
                        </div>

                        <div class="hidden h-8 w-px bg-slate-200 sm:block"></div>

                        <div>
                            <p class="text-base font-bold text-slate-900 sm:text-xl">
                                Premium
                            </p>

                            <p class="mt-1 text-[10px] leading-4 text-slate-400 sm:text-xs">
                                Bahan pilihan
                            </p>
                        </div>

                        <div class="hidden h-8 w-px bg-slate-200 sm:block"></div>

                        <div>
                            <p class="text-base font-bold text-slate-900 sm:text-xl">
                                Higienis
                            </p>

                            <p class="mt-1 text-[10px] leading-4 text-slate-400 sm:text-xs">
                                Dibuat dengan teliti
                            </p>
                        </div>

                    </div>

                </div>

                <div class="relative flex justify-center lg:justify-end">

                    <div class="relative w-full max-w-md sm:max-w-lg">

                        <div class="absolute -left-3 top-8 h-16 w-16 rotate-12 rounded-3xl bg-orange-100 sm:-left-6 sm:h-20 sm:w-20"></div>
                        <div class="absolute -right-2 bottom-8 h-20 w-20 rounded-full bg-amber-100 sm:-right-6 sm:h-24 sm:w-24"></div>

                        <div class="relative rounded-[1.75rem] border border-orange-100 bg-white p-3 shadow-xl shadow-orange-100/60 sm:rounded-[2rem] sm:p-4">

                            <div class="flex aspect-square items-center justify-center overflow-hidden rounded-[1.25rem] bg-gradient-to-br from-orange-50 via-amber-50 to-yellow-50 sm:rounded-[1.5rem]">

                                <div class="px-6 text-center">

                                    <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-white shadow-xl sm:h-36 sm:w-36">
                                        <i class="fa-solid fa-cookie-bite text-5xl text-[#c96f32] sm:text-7xl"></i>
                                    </div>

                                    <p class="mt-4 text-sm font-semibold text-[#8b4513] sm:mt-5">
                                        Nona Donat
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        Fresh & homemade
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section id="kategori" class="scroll-mt-20 bg-white py-14 sm:py-16 lg:py-20">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="mx-auto max-w-2xl text-center">

                    <p class="text-sm font-semibold text-[#c96f32]">
                        Pilihan Kami
                    </p>

                    <h2
                        class="mt-2 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl lg:text-4xl"
                        style="font-family: 'Playfair Display', serif;"
                    >
                        Pilih berdasarkan kategori
                    </h2>

                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Temukan rasa favoritmu dari berbagai kategori donat yang tersedia.
                    </p>

                </div>

                @if($categories->count())

                    <div class="mt-8 grid grid-cols-2 gap-3 sm:mt-10 sm:grid-cols-3 sm:gap-4 lg:grid-cols-4 xl:grid-cols-6">

                        @foreach($categories as $category)

                            <a
                                href="#donat"
                                class="group rounded-2xl border border-orange-100 bg-[#fffaf5] p-4 text-center transition hover:-translate-y-1 hover:border-orange-200 hover:bg-white hover:shadow-lg hover:shadow-orange-100/50 sm:p-5"
                            >

                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-[#c96f32] transition group-hover:bg-[#c96f32] group-hover:text-white sm:h-14 sm:w-14 sm:rounded-2xl">
                                    <i class="fa-solid fa-layer-group"></i>
                                </div>

                                <h3 class="mt-3 truncate text-xs font-bold text-slate-800 sm:mt-4 sm:text-sm">
                                    {{ $category->name }}
                                </h3>

                                <p class="mt-1 text-[10px] text-slate-400 sm:text-xs">
                                    {{ $category->donuts()->where('is_active', true)->count() }} produk
                                </p>

                            </a>

                        @endforeach

                    </div>

                @else

                    <div class="mt-8 rounded-2xl border border-dashed border-orange-200 bg-[#fffaf5] px-5 py-12 text-center sm:mt-10">
                        <i class="fa-solid fa-layer-group text-3xl text-orange-200"></i>

                        <p class="mt-4 text-sm font-semibold text-slate-700">
                            Belum ada kategori
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            Kategori produk akan ditampilkan di sini.
                        </p>
                    </div>

                @endif

            </div>

        </section>

        <section id="donat" class="scroll-mt-20 py-14 sm:py-16 lg:py-20">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">

                    <div class="max-w-2xl">

                        <p class="text-sm font-semibold text-[#c96f32]">
                            Menu Favorit
                        </p>

                        <h2
                            class="mt-2 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl lg:text-4xl"
                            style="font-family: 'Playfair Display', serif;"
                        >
                            Donat pilihan Nona Donat
                        </h2>

                        <p class="mt-3 text-sm leading-6 text-slate-500">
                            Pilih donat favoritmu dan nikmati rasa manis yang dibuat dengan sepenuh hati.
                        </p>

                    </div>

                    <span class="text-xs font-semibold text-slate-400 sm:text-sm">
                        {{ $donuts->count() }} produk tersedia
                    </span>

                </div>

                @if($donuts->count())

                    <div class="mt-8 grid grid-cols-1 gap-4 xs:grid-cols-2 sm:mt-10 sm:gap-5 lg:grid-cols-3 xl:grid-cols-4">

                        @foreach($donuts as $donut)

                            <article class="group overflow-hidden rounded-2xl border border-orange-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-xl hover:shadow-orange-100/60">

                                <div class="relative aspect-square overflow-hidden bg-orange-50">

                                    @if($donut->image)

                                        <img
                                            src="{{ asset('storage/' . $donut->image) }}"
                                            alt="{{ $donut->name }}"
                                            class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                                        >

                                    @else

                                        <div class="flex h-full w-full items-center justify-center">

                                            <div class="flex h-20 w-20 items-center justify-center rounded-full bg-white shadow-lg sm:h-24 sm:w-24">
                                                <i class="fa-solid fa-cookie-bite text-3xl text-[#c96f32] sm:text-4xl"></i>
                                            </div>

                                        </div>

                                    @endif

                                    <div class="absolute left-2.5 top-2.5 sm:left-3 sm:top-3">
                                        <span class="max-w-[calc(100vw-6rem)] truncate rounded-full bg-white/95 px-2 py-1 text-[9px] font-bold text-[#c96f32] shadow-sm sm:px-2.5 sm:text-[10px]">
                                            {{ $donut->category->name }}
                                        </span>
                                    </div>

                                </div>

                                <div class="p-4 sm:p-5">

                                    <h3 class="truncate text-sm font-bold text-slate-900 sm:text-base">
                                        {{ $donut->name }}
                                    </h3>

                                    <p class="mt-2 line-clamp-2 min-h-[36px] text-[11px] leading-5 text-slate-400 sm:min-h-[40px] sm:text-xs">
                                        {{ $donut->description ?: 'Donat fresh dengan rasa yang lezat dan topping pilihan.' }}
                                    </p>

                                    <div class="mt-4">

                                        <div class="flex items-end justify-between gap-3">

                                            <div class="min-w-0">

                                                <p class="truncate text-base font-bold text-[#c96f32] sm:text-lg">
                                                    Rp{{ number_format($donut->price, 0, ',', '.') }}
                                                </p>

                                                <p class="mt-1 text-[10px] text-slate-400 sm:text-[11px]">
                                                    Stok {{ $donut->stock }}
                                                </p>

                                            </div>

                                        </div>

                                        <div class="mt-3 grid grid-cols-2 gap-2">

                                            <button
                                                type="button"
                                                onclick="openDonutModal({{ $donut->id }}, '{{ addslashes($donut->name) }}', {{ $donut->price }}, {{ $donut->stock }}, 'cart')"
                                                class="inline-flex h-10 items-center justify-center gap-1.5 rounded-xl border border-orange-100 bg-orange-50 px-2 text-[11px] font-semibold text-[#c96f32] transition hover:bg-[#c96f32] hover:text-white sm:text-xs"
                                            >
                                                <i class="fa-solid fa-cart-shopping text-[10px]"></i>
                                                Keranjang
                                            </button>

                                            <button
                                                type="button"
                                                onclick="openDonutModal({{ $donut->id }}, '{{ addslashes($donut->name) }}', {{ $donut->price }}, {{ $donut->stock }}, 'order')"
                                                class="inline-flex h-10 items-center justify-center gap-1.5 rounded-xl bg-[#c96f32] px-2 text-[11px] font-semibold text-white transition hover:bg-[#b85f27] sm:text-xs"
                                            >
                                                <i class="fa-solid fa-bolt text-[10px]"></i>
                                                Pesan
                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </article>


                        @endforeach

                    </div>

                @else

                    <div class="mt-8 rounded-2xl border border-dashed border-orange-200 bg-white px-5 py-14 text-center sm:mt-10 sm:py-16">

                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 text-xl text-[#c96f32]">
                            <i class="fa-solid fa-cookie-bite"></i>
                        </div>

                        <h3 class="mt-4 text-sm font-bold text-slate-800">
                            Belum ada produk donat
                        </h3>

                        <p class="mx-auto mt-1 max-w-sm text-xs leading-5 text-slate-400">
                            Produk donat yang diaktifkan dari Admin akan otomatis muncul di bagian ini.
                        </p>

                    </div>

                @endif

            </div>

        </section>

        <section id="tentang" class="scroll-mt-20 bg-white py-14 sm:py-16 lg:py-20">

            <div class="mx-auto grid max-w-7xl gap-8 px-4 sm:px-6 lg:grid-cols-2 lg:gap-12 lg:px-8">

                <div class="flex flex-col justify-center">

                    <p class="text-sm font-semibold text-[#c96f32]">
                        Tentang Nona Donat
                    </p>

                    <h2
                        class="mt-2 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl lg:text-4xl"
                        style="font-family: 'Playfair Display', serif;"
                    >
                        Dibuat fresh untuk setiap gigitan
                    </h2>

                    <p class="mt-5 text-sm leading-7 text-slate-500">
                        Nona Donat hadir untuk menghadirkan donat yang lembut, fresh,
                        dan punya rasa yang bikin ingin kembali lagi. Kami mengutamakan
                        bahan berkualitas dan proses pembuatan yang konsisten.
                    </p>

                    <div class="mt-7 grid grid-cols-1 gap-3 sm:grid-cols-3 sm:gap-4">

                        <div class="rounded-2xl border border-orange-100 bg-[#fffaf5] p-4">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-[#c96f32]">
                                <i class="fa-solid fa-wheat-awn"></i>
                            </div>

                            <h3 class="mt-3 text-sm font-bold text-slate-800">
                                Bahan Pilihan
                            </h3>

                            <p class="mt-1 text-xs leading-5 text-slate-400">
                                Dipilih dengan perhatian.
                            </p>

                        </div>

                        <div class="rounded-2xl border border-orange-100 bg-[#fffaf5] p-4">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-[#c96f32]">
                                <i class="fa-solid fa-heart"></i>
                            </div>

                            <h3 class="mt-3 text-sm font-bold text-slate-800">
                                Dibuat Tulus
                            </h3>

                            <p class="mt-1 text-xs leading-5 text-slate-400">
                                Setiap donat dibuat sepenuh hati.
                            </p>

                        </div>

                        <div class="rounded-2xl border border-orange-100 bg-[#fffaf5] p-4">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-[#c96f32]">
                                <i class="fa-solid fa-face-smile"></i>
                            </div>

                            <h3 class="mt-3 text-sm font-bold text-slate-800">
                                Bikin Senyum
                            </h3>

                            <p class="mt-1 text-xs leading-5 text-slate-400">
                                Karena donat harus menyenangkan.
                            </p>

                        </div>

                    </div>

                </div>

                <div class="rounded-[1.75rem] border border-orange-100 bg-[#fffaf5] p-3 sm:rounded-[2rem] sm:p-5">

                    <div class="rounded-[1.25rem] bg-white p-5 shadow-sm sm:rounded-[1.5rem] sm:p-8">

                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-orange-50 text-[#c96f32] sm:h-16 sm:w-16">
                            <i class="fa-solid fa-cookie-bite text-xl sm:text-2xl"></i>
                        </div>

                        <h3
                            class="mt-5 text-xl font-bold text-[#8b4513] sm:text-2xl"
                            style="font-family: 'Playfair Display', serif;"
                        >
                            Nona Donat
                        </h3>

                        <p class="mt-3 text-sm leading-7 text-slate-500">
                            Tempat sederhana untuk menikmati donat fresh,
                            pilihan rasa yang beragam, dan pengalaman pesan
                            yang praktis.
                        </p>

                        <div class="mt-6 rounded-2xl bg-orange-50 p-4">

                            <p class="text-xs font-semibold text-[#c96f32]">
                                Freshness first
                            </p>

                            <p class="mt-1 text-xs leading-5 text-slate-500">
                                Kami percaya donat yang baik dimulai dari bahan yang baik
                                dan dibuat pada waktu yang tepat.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <section id="lokasi" class="scroll-mt-20 py-14 sm:py-16 lg:py-20">

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

                <div class="mx-auto max-w-2xl text-center">

                    <p class="text-sm font-semibold text-[#c96f32]">
                        Temukan Kami
                    </p>

                    <h2
                        class="mt-2 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl lg:text-4xl"
                        style="font-family: 'Playfair Display', serif;"
                    >
                        Lokasi Nona Donat
                    </h2>

                    <p class="mt-3 text-sm leading-6 text-slate-500">
                        Informasi lokasi toko akan tersedia di sini.
                    </p>

                </div>

                <div class="mt-8 rounded-2xl border border-orange-100 bg-white p-3 shadow-sm sm:mt-10 sm:p-5">

                    <div class="grid gap-4 lg:grid-cols-2 lg:gap-6 lg:items-stretch">

                        <div class="flex min-h-[220px] flex-col items-center justify-center rounded-2xl bg-orange-50 p-6 text-center sm:min-h-[260px] sm:p-8">

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-[#c96f32] shadow-sm sm:h-16 sm:w-16">
                                <i class="fa-solid fa-location-dot text-xl sm:text-2xl"></i>
                            </div>

                            <h3 class="mt-5 text-base font-bold text-slate-800">
                                Nona Donat Store
                            </h3>

                            <p class="mt-2 max-w-md text-sm leading-6 text-slate-500">
                                Alamat toko akan ditampilkan setelah informasi lokasi
                                diatur melalui Admin.
                            </p>

                        </div>

                        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-1">

                            <div class="flex items-start gap-3 rounded-2xl border border-slate-100 p-4 sm:p-5">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-[#c96f32]">
                                    <i class="fa-regular fa-clock"></i>
                                </div>

                                <div class="min-w-0">

                                    <p class="text-sm font-semibold text-slate-800">
                                        Jam Operasional
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-slate-400">
                                        Informasi jam buka akan tersedia di sini.
                                    </p>

                                </div>

                            </div>

                            <div class="flex items-start gap-3 rounded-2xl border border-slate-100 p-4 sm:p-5">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-[#c96f32]">
                                    <i class="fa-solid fa-phone"></i>
                                </div>

                                <div class="min-w-0">

                                    <p class="text-sm font-semibold text-slate-800">
                                        Hubungi Kami
                                    </p>

                                    <p class="mt-1 text-xs leading-5 text-slate-400">
                                        Kontak toko akan ditampilkan di sini.
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <div id="donutModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/40 px-4 backdrop-blur-sm">
                <div
                    id="donutModalContent"
                    class="w-full max-w-sm scale-95 rounded-2xl border border-orange-100 bg-white p-5 opacity-0 shadow-2xl transition duration-200 sm:p-6"
                >

        
                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-[11px] font-semibold uppercase tracking-wide text-[#c96f32]">
                            Pilih jumlah
                        </p>

                        <h3
                            id="modalDonutName"
                            class="mt-1 truncate text-lg font-bold text-slate-900"
                        >
                            Donat
                        </h3>

                        <p
                            id="modalDonutPrice"
                            class="mt-1 text-sm font-semibold text-[#c96f32]"
                        >
                            Rp0
                        </p>

                    </div>

                    <button
                        type="button"
                        onclick="closeDonutModal()"
                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-slate-400 transition hover:bg-orange-50 hover:text-[#c96f32]"
                    >
                        <i class="fa-solid fa-xmark"></i>
                    </button>

                </div>

                <div class="mt-6 rounded-2xl bg-[#fffaf5] p-4">

                    <div class="flex items-center justify-between gap-4">

                        <div>
                            <p class="text-sm font-semibold text-slate-700">
                                Jumlah
                            </p>

                            <p
                                id="modalStock"
                                class="mt-1 text-[11px] text-slate-400"
                            >
                                Stok tersedia
                            </p>
                        </div>

                        <div class="flex items-center rounded-xl border border-orange-100 bg-white">

                            <button
                                type="button"
                                id="modalDecrease"
                                class="flex h-10 w-10 items-center justify-center text-slate-500 transition hover:bg-orange-50 hover:text-[#c96f32]"
                            >
                                <i class="fa-solid fa-minus text-[10px]"></i>
                            </button>

                            <input
                                type="number"
                                id="modalQuantity"
                                min="1"
                                value="1"
                                class="h-10 w-12 border-x border-orange-100 bg-white text-center text-sm font-bold text-slate-700 outline-none"
                            >

                            <button
                                type="button"
                                id="modalIncrease"
                                class="flex h-10 w-10 items-center justify-center text-slate-500 transition hover:bg-orange-50 hover:text-[#c96f32]"
                            >
                                <i class="fa-solid fa-plus text-[10px]"></i>
                            </button>

                        </div>

                    </div>

                </div>

                <div class="mt-5 flex items-center justify-between gap-4">

                    <div>
                        <p class="text-[11px] text-slate-400">
                            Total
                        </p>

                        <p
                            id="modalTotal"
                            class="mt-0.5 text-lg font-bold text-[#c96f32]"
                        >
                            Rp0
                        </p>
                    </div>

                    <button
                        type="button"
                        id="modalSubmit"
                        class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-5 text-sm font-semibold text-white shadow-lg shadow-orange-100 transition hover:bg-[#b85f27]"
                    >
                        <i id="modalSubmitIcon" class="fa-solid fa-cart-plus text-xs"></i>
                        <span id="modalSubmitText">Tambah ke Keranjang</span>
                    </button>

                </div>

            </div>

        </div>

    </main>

    <footer class="border-t border-orange-100 bg-white">

        <div class="mx-auto flex max-w-7xl flex-col gap-6 px-4 py-8 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">

            <div class="min-w-0">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#c96f32] text-white">
                        <i class="fa-solid fa-cookie-bite"></i>
                    </div>

                    <div class="min-w-0">

                        <h3
                            class="truncate text-base font-bold text-[#8b4513]"
                            style="font-family: 'Playfair Display', serif;"
                        >
                            Nona Donat
                        </h3>

                        <p class="text-[11px] text-slate-400">
                            Freshly Made With Love
                        </p>

                    </div>

                </div>

                <p class="mt-3 text-xs text-slate-400">
                    © {{ date('Y') }} Nona Donat. Semua hak dilindungi.
                </p>

            </div>

            <div class="flex items-center gap-2">

                <a
                    href="#"
                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 text-slate-400 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a
                    href="#"
                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 text-slate-400 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    <i class="fa-brands fa-whatsapp"></i>
                </a>

                <a
                    href="#beranda"
                    class="flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 text-slate-400 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    <i class="fa-solid fa-arrow-up"></i>
                </a>

            </div>

        </div>

    </footer>

    <script>
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuIcon = document.getElementById('mobileMenuIcon');

        const navLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('main section[id]');

        const revealElements = document.querySelectorAll(
            'main section > div, main article, main section h2, main section p, main section a, footer'
        );

        document.documentElement.style.scrollBehavior = 'smooth';

        function closeMobileMenu() {
            mobileMenu?.classList.add('hidden');

            if (mobileMenuIcon) {
                mobileMenuIcon.classList.remove('fa-xmark');
                mobileMenuIcon.classList.add('fa-bars');
            }
        }

        function setActiveNav(sectionId) {
            navLinks.forEach(link => {
                link.classList.toggle(
                    'active',
                    link.dataset.section === sectionId
                );
            });
        }

        mobileMenuButton?.addEventListener('click', () => {
            const isHidden = mobileMenu.classList.contains('hidden');

            mobileMenu.classList.toggle('hidden');

            if (isHidden) {
                mobileMenuIcon.classList.remove('fa-bars');
                mobileMenuIcon.classList.add('fa-xmark');
            } else {
                mobileMenuIcon.classList.remove('fa-xmark');
                mobileMenuIcon.classList.add('fa-bars');
            }
        });

        document.querySelectorAll('a[href^="#"]').forEach(link => {
            link.addEventListener('click', function (event) {
                const targetId = this.getAttribute('href');

                if (!targetId || targetId === '#') {
                    return;
                }

                const target = document.querySelector(targetId);

                if (!target) {
                    return;
                }

                event.preventDefault();

                closeMobileMenu();

                if (this.classList.contains('nav-link')) {
                    setActiveNav(this.dataset.section);
                }

                const header = document.querySelector('header');
                const headerHeight = header ? header.offsetHeight : 0;

                const targetPosition =
                    target.getBoundingClientRect().top +
                    window.scrollY -
                    headerHeight +
                    4;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            });
        });

        const revealObserver = new IntersectionObserver(
            entries => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) {
                        return;
                    }

                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                });
            },
            {
                threshold: 0.12,
                rootMargin: '0px 0px -40px 0px'
            }
        );

        revealElements.forEach((element, index) => {
            element.classList.add('reveal-element');
            element.style.setProperty(
                '--reveal-delay',
                `${Math.min(index * 35, 300)}ms`
            );

            revealObserver.observe(element);
        });

        const sectionObserver = new IntersectionObserver(
            entries => {
                const visibleSections = entries
                    .filter(entry => entry.isIntersecting)
                    .sort(
                        (a, b) =>
                            b.intersectionRatio - a.intersectionRatio
                    );

                if (visibleSections.length) {
                    setActiveNav(visibleSections[0].target.id);
                }
            },
            {
                rootMargin: '-35% 0px -55% 0px',
                threshold: [0.1, 0.25, 0.5, 0.75]
            }
        );

        sections.forEach(section => {
            sectionObserver.observe(section);
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                closeMobileMenu();
            }
        });

        window.addEventListener('load', () => {
            document.body.classList.add('page-loaded');

            const heroElements = document.querySelectorAll(
                '#beranda .relative.z-10 > *'
            );

            heroElements.forEach((element, index) => {
                element.classList.add('hero-reveal');
                element.style.setProperty(
                    '--hero-delay',
                    `${index * 120}ms`
                );
            });

            const heroVisual = document.querySelector(
                '#beranda .relative.flex.justify-center'
            );

            if (heroVisual) {
                heroVisual.classList.add('hero-visual-reveal');
            }

            setActiveNav('beranda');
        });
        
        let selectedDonut = {
            id: null,
            name: '',
            price: 0,
            stock: 1,
            action: 'cart'
            };

            const donutModal = document.getElementById('donutModal');
            const donutModalContent = document.getElementById('donutModalContent');
            const modalDonutName = document.getElementById('modalDonutName');
            const modalDonutPrice = document.getElementById('modalDonutPrice');
            const modalStock = document.getElementById('modalStock');
            const modalQuantity = document.getElementById('modalQuantity');
            const modalTotal = document.getElementById('modalTotal');
            const modalDecrease = document.getElementById('modalDecrease');
            const modalIncrease = document.getElementById('modalIncrease');
            const modalSubmit = document.getElementById('modalSubmit');
            const modalSubmitIcon = document.getElementById('modalSubmitIcon');
            const modalSubmitText = document.getElementById('modalSubmitText');

            function formatDonutRupiah(value) {
            return 'Rp' + new Intl.NumberFormat('id-ID').format(value);
            }

            function updateDonutModalTotal() {
            const quantity = Number(modalQuantity.value) || 1;
            modalTotal.textContent = formatDonutRupiah(
            selectedDonut.price * quantity
            );
            }

            function openDonutModal(id, name, price, stock, action) {
            selectedDonut = {
            id,
            name,
            price,
            stock,
            action
            };

            modalDonutName.textContent = name;
            modalDonutPrice.textContent = formatDonutRupiah(price);
            modalStock.textContent = `Stok tersedia ${stock} pcs`;

            modalQuantity.value = 1;
            modalQuantity.max = stock;

            if (action === 'order') {
                modalSubmitText.textContent = 'Pesan Sekarang';
                modalSubmitIcon.className = 'fa-solid fa-bolt text-xs';
            } else {
                modalSubmitText.textContent = 'Tambah ke Keranjang';
                modalSubmitIcon.className = 'fa-solid fa-cart-plus text-xs';
            }

            updateDonutModalTotal();

            donutModal.classList.remove('hidden');
            donutModal.classList.add('flex');

            requestAnimationFrame(() => {
                donutModalContent.classList.remove('scale-95', 'opacity-0');
                donutModalContent.classList.add('scale-100', 'opacity-100');
            });

            document.body.classList.add('overflow-hidden');

            }

            function closeDonutModal() {
            donutModalContent.classList.remove('scale-100', 'opacity-100');
            donutModalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                donutModal.classList.add('hidden');
                donutModal.classList.remove('flex');
                document.body.classList.remove('overflow-hidden');
            }, 200);

            }

            modalDecrease?.addEventListener('click', () => {
            const current = Number(modalQuantity.value) || 1;

            modalQuantity.value = Math.max(
                current - 1,
                1
            );

            updateDonutModalTotal();

            });

            modalIncrease?.addEventListener('click', () => {
            const current = Number(modalQuantity.value) || 1;

            modalQuantity.value = Math.min(
                current + 1,
                selectedDonut.stock
            );

            updateDonutModalTotal();

            });

            modalQuantity?.addEventListener('input', () => {
            let quantity = Number(modalQuantity.value) || 1;

            quantity = Math.max(quantity, 1);
            quantity = Math.min(quantity, selectedDonut.stock);

            modalQuantity.value = quantity;

            updateDonutModalTotal();

            });

            donutModal?.addEventListener('click', event => {
            if (event.target === donutModal) {
            closeDonutModal();
            }
            });

            document.addEventListener('keydown', event => {
            if (
            event.key === 'Escape' &&
            donutModal &&
            !donutModal.classList.contains('hidden')
            ) {
            closeDonutModal();
            }
            });

            modalSubmit?.addEventListener('click', async () => {
            const quantity = Number(modalQuantity.value);

            if (
                !selectedDonut.id ||
                !quantity ||
                quantity < 1 ||
                quantity > selectedDonut.stock
            ) {
                return;
            }

            if (selectedDonut.action === 'order') {
                const params = new URLSearchParams();

                params.append('donut_id', selectedDonut.id);
                params.append('quantity', quantity);

                window.location.href = `{{ route('cart.store') }}?${params.toString()}&action=order`;
                return;
            }

            const originalText = modalSubmitText.textContent;

            modalSubmit.disabled = true;
            modalSubmitText.textContent = 'Menambahkan...';

            try {
                const csrfInput = document.querySelector(
                    'input[name="_token"]'
                );

                if (!csrfInput) {
                    throw new Error('CSRF token tidak ditemukan.');
                }

                const formData = new FormData();

                formData.append('donut_id', selectedDonut.id);
                formData.append('quantity', quantity);
                formData.append('_token', csrfInput.value);

                const response = await fetch(
                    `{{ route('cart.store') }}`,
                    {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    }
                );

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(
                        data.message || 'Gagal menambahkan donat ke keranjang.'
                    );
                }

                closeDonutModal();

                const cartBadge = document.querySelector(
                    '[data-cart-count]'
                );

                if (cartBadge && data.cart_count !== undefined) {
                    cartBadge.textContent =
                        data.cart_count > 99
                            ? '99+'
                            : data.cart_count;
                }

                showCartSuccess(
                    `${selectedDonut.name} berhasil ditambahkan ke keranjang.`
                );

            } catch (error) {
                alert(error.message);
            } finally {
                modalSubmit.disabled = false;
                modalSubmitText.textContent = originalText;
            }

            });

            function showCartSuccess(message) {
            const existing = document.getElementById('cartToast');

            if (existing) {
                existing.remove();
            }

            const toast = document.createElement('div');

            toast.id = 'cartToast';
            toast.className =
                'fixed bottom-5 left-1/2 z-[120] flex w-[calc(100%-2rem)] max-w-sm -translate-x-1/2 items-center gap-3 rounded-2xl border border-emerald-200 bg-white px-4 py-3 shadow-2xl';

            toast.innerHTML = `
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <i class="fa-solid fa-check text-sm"></i>
                </div>
                <p class="min-w-0 flex-1 text-xs font-semibold leading-5 text-slate-700">
                    ${message}
                </p>
            `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 2500);

        }

    </script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            overflow-x: hidden;
        }

        .reveal-element {
            opacity: 0;
            transform: translateY(24px);
            transition:
                opacity 700ms ease,
                transform 700ms cubic-bezier(0.22, 1, 0.36, 1);
            transition-delay: var(--reveal-delay);
        }

        .reveal-element.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .hero-reveal {
            opacity: 0;
            transform: translateY(20px);
            animation: heroReveal 800ms cubic-bezier(0.22, 1, 0.36, 1) forwards;
            animation-delay: var(--hero-delay);
        }

        .hero-visual-reveal {
            opacity: 0;
            transform: translateY(28px) scale(0.97);
            animation: heroVisualReveal 900ms cubic-bezier(0.22, 1, 0.36, 1) 250ms forwards;
        }

        @keyframes heroReveal {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes heroVisualReveal {
            from {
                opacity: 0;
                transform: translateY(28px) scale(0.97);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            .reveal-element,
            .hero-reveal,
            .hero-visual-reveal {
                opacity: 1;
                transform: none;
                animation: none;
                transition: none;
            }
        }
        
        .nav-link {
            position: relative;
            transition: color 0.25s ease;
        }

        .nav-indicator {
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 0;
            height: 2px;
            border-radius: 999px;
            background: #c96f32;
            transform: translateX(-50%);
            transition:
                width 0.25s ease,
                opacity 0.25s ease;
            opacity: 0;
        }

        .nav-link:hover {
            color: #c96f32;
        }

        .nav-link:hover .nav-indicator,
        .nav-link.active .nav-indicator {
            width: 100%;
            opacity: 1;
        }

        .nav-link.active {
            color: #c96f32;
        }
    </style>

</body>

</html>