<header class="sticky top-0 z-30 border-b border-orange-100 bg-white/90 backdrop-blur-xl">

    <div class="flex h-20 items-center justify-between px-5 sm:px-7 lg:px-8">

        <div class="flex items-center gap-4">

            <button
                type="button"
                id="openAdminSidebar"
                class="flex h-10 w-10 items-center justify-center rounded-xl border border-orange-100 text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32] lg:hidden"
            >
                <i class="fa-solid fa-bars"></i>
            </button>

            <div>
                <p class="text-xs font-medium text-slate-400">
                    Admin Panel
                </p>

                <h2 class="text-lg font-bold text-slate-900">
                    @yield('page-title', 'Dashboard')
                </h2>
            </div>

        </div>

        <div class="flex items-center gap-3">

            <a
                href="{{ route('home') }}"
                target="_blank"
                class="hidden items-center gap-2 rounded-xl border border-orange-100 px-4 py-2.5 text-xs font-semibold text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32] sm:flex"
            >
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                Lihat Website
            </a>

            <button
                type="button"
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-[#c96f32] transition hover:bg-orange-100"
            >
                <i class="fa-regular fa-bell"></i>
            </button>

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
        adminSidebar.classList.remove('-translate-x-full');
        adminSidebarOverlay.classList.remove('hidden');
    });

    closeAdminSidebar?.addEventListener('click', () => {
        adminSidebar.classList.add('-translate-x-full');
        adminSidebarOverlay.classList.add('hidden');
    });

    adminSidebarOverlay?.addEventListener('click', () => {
        adminSidebar.classList.add('-translate-x-full');
        adminSidebarOverlay.classList.add('hidden');
    });
</script>
@endpush