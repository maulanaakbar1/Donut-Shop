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

                <p class="mt-1 hidden text-[10px] font-medium text-slate-400 sm:block">
                    Freshly Made With Love
                </p>
            </div>
        </a>

        <nav class="hidden items-center gap-6 lg:flex xl:gap-8">
            <a href="{{ route('home') }}" class="text-sm font-medium text-slate-600 transition hover:text-[#c96f32]">
                Beranda
            </a>

            <a href="{{ route('home') }}#kategori" class="text-sm font-medium text-slate-600 transition hover:text-[#c96f32]">
                Kategori
            </a>

            <a href="{{ route('home') }}#donat" class="text-sm font-medium text-slate-600 transition hover:text-[#c96f32]">
                Donat
            </a>

            <a href="{{ route('home') }}#tentang" class="text-sm font-medium text-slate-600 transition hover:text-[#c96f32]">
                Tentang
            </a>

            <a href="{{ route('home') }}#lokasi" class="text-sm font-medium text-slate-600 transition hover:text-[#c96f32]">
                Lokasi
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

                <div class="hidden max-w-[180px] items-center gap-2 rounded-xl border border-orange-100 bg-white px-3 py-2.5 text-xs font-semibold text-slate-600 sm:flex">
                    <i class="fa-regular fa-circle-user text-[#c96f32]"></i>
                    <span class="truncate">{{ auth()->user()->name }}</span>
                </div>

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
                id="frontendMobileMenuButton"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 bg-white text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32] lg:hidden"
            >
                <i id="frontendMobileMenuIcon" class="fa-solid fa-bars"></i>
            </button>

        </div>

    </div>

    <div
        id="frontendMobileMenu"
        class="hidden border-t border-orange-100 bg-white lg:hidden"
    >
        <nav class="mx-auto max-w-7xl px-4 py-3 sm:px-6">

            <div class="space-y-1">

                <a
                    href="{{ route('home') }}"
                    class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    Beranda
                </a>

                <a
                    href="{{ route('home') }}#kategori"
                    class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    Kategori
                </a>

                <a
                    href="{{ route('home') }}#donat"
                    class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    Donat
                </a>

                <a
                    href="{{ route('home') }}#tentang"
                    class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    Tentang
                </a>

                <a
                    href="{{ route('home') }}#lokasi"
                    class="block rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    Lokasi
                </a>

                @guest
                    <a
                        href="{{ route('login') }}"
                        class="mt-2 flex items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-4 py-3 text-sm font-semibold text-white transition hover:bg-[#b85f27]"
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

@push('scripts')
<script>
    const frontendMobileMenuButton = document.getElementById('frontendMobileMenuButton');
    const frontendMobileMenu = document.getElementById('frontendMobileMenu');
    const frontendMobileMenuIcon = document.getElementById('frontendMobileMenuIcon');

    frontendMobileMenuButton?.addEventListener('click', () => {
        const isHidden = frontendMobileMenu.classList.contains('hidden');

        frontendMobileMenu.classList.toggle('hidden');

        if (isHidden) {
            frontendMobileMenuIcon.classList.remove('fa-bars');
            frontendMobileMenuIcon.classList.add('fa-xmark');
        } else {
            frontendMobileMenuIcon.classList.remove('fa-xmark');
            frontendMobileMenuIcon.classList.add('fa-bars');
        }
    });

    document.querySelectorAll('#frontendMobileMenu a').forEach(link => {
        link.addEventListener('click', () => {
            frontendMobileMenu.classList.add('hidden');
            frontendMobileMenuIcon.classList.remove('fa-xmark');
            frontendMobileMenuIcon.classList.add('fa-bars');
        });
    });
</script>
@endpush