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
                href="{{ route('home') }}"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 text-slate-400 transition hover:bg-orange-50 hover:text-[#c96f32]"
            >
                <i class="fa-solid fa-arrow-up"></i>
            </a>

        </div>

    </div>

</footer>