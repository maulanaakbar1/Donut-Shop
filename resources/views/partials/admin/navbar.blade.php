<header class="sticky top-0 z-30 border-b border-orange-100 bg-white/95 backdrop-blur-xl">
    <div class="flex h-20 items-center justify-between px-5 sm:px-7 lg:px-8">

    <div class="flex items-center gap-3">

        <button
            type="button"
            id="openAdminSidebar"
            class="flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 bg-white text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32] lg:hidden"
        >
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="hidden sm:block lg:hidden">
            <p class="text-[11px] font-semibold uppercase tracking-wider text-orange-500">
                Nona Donat
            </p>

            <p class="text-sm font-semibold text-slate-800">
                Admin Panel
            </p>
        </div>

    </div>

    <div class="flex items-center gap-2 sm:gap-3">

        <a
            href="{{ route('home') }}"
            target="_blank"
            class="hidden items-center gap-2 rounded-xl border border-orange-100 bg-white px-4 py-2.5 text-xs font-semibold text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32] sm:inline-flex"
        >
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            Lihat Website
        </a>

        <button
            type="button"
            class="relative flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 bg-white text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
        >
            <i class="fa-regular fa-bell"></i>

            <span class="absolute right-2 top-2 h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
        </button>

        <div class="relative">

            <button
                type="button"
                class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-2.5 py-2 transition hover:border-orange-200 hover:bg-orange-50"
            >
                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-orange-100 text-sm font-bold text-[#c96f32]">
                    A
                </div>

                <div class="hidden text-left md:block">
                    <p class="text-xs font-semibold text-slate-800">
                        Admin
                    </p>

                    <p class="text-[11px] text-slate-400">
                        Administrator
                    </p>
                </div>

                <i class="fa-solid fa-chevron-down hidden text-[10px] text-slate-400 md:block"></i>
            </button>

        </div>

    </div>

</div>

</header>

@push('scripts')

<script>
    const adminSidebar = document.getElementById('adminSidebar');
    const adminSidebarOverlay = document.getElementById('adminSidebarOverlay');
    const openAdminSidebar = document.getElementById('openAdminSidebar');
    const closeAdminSidebar = document.getElementById('closeAdminSidebar');

    openAdminSidebar?.addEventListener('click', () => {
        adminSidebar?.classList.remove('-translate-x-full');
        adminSidebarOverlay?.classList.remove('hidden');
    });

    closeAdminSidebar?.addEventListener('click', () => {
        adminSidebar?.classList.add('-translate-x-full');
        adminSidebarOverlay?.classList.add('hidden');
    });

    adminSidebarOverlay?.addEventListener('click', () => {
        adminSidebar?.classList.add('-translate-x-full');
        adminSidebarOverlay?.classList.add('hidden');
    });
</script>

@endpush
