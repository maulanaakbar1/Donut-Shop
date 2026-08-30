<aside
    id="adminSidebar"
    class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col border-r border-orange-100 bg-white transition-transform duration-300 lg:translate-x-0"
>

    <div class="flex h-full flex-col">

        <div class="flex items-center justify-between border-b border-orange-50 px-6 py-6">

            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">

                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#c96f32] text-white shadow-lg shadow-orange-200">
                    <i class="fa-solid fa-cookie-bite text-lg"></i>
                </div>

                <div>
                    <h1
                        class="text-lg font-bold text-[#8b4513]"
                        style="font-family: 'Playfair Display', serif;"
                    >
                        Nona Donat
                    </h1>

                    <p class="text-[11px] font-medium text-slate-400">
                        Admin Panel
                    </p>
                </div>

            </a>

            <button
                type="button"
                id="closeAdminSidebar"
                class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-400 transition hover:bg-orange-50 hover:text-[#c96f32] lg:hidden"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>

        <div class="flex-1 overflow-y-auto px-4 py-5">

            <p class="mb-3 px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Menu Utama
            </p>

            <nav class="space-y-1">

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 rounded-xl bg-orange-50 px-4 py-3 text-sm font-semibold text-[#c96f32]"
                >
                    <i class="fa-solid fa-house w-5 text-center"></i>
                    Dashboard
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    <i class="fa-solid fa-cookie-bite w-5 text-center"></i>
                    Donat
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    <i class="fa-solid fa-layer-group w-5 text-center"></i>
                    Kategori
                </a>

                <a
                    href="#"
                    class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    <span class="flex items-center gap-3">
                        <i class="fa-solid fa-bag-shopping w-5 text-center"></i>
                        Pesanan
                    </span>

                    <span class="rounded-full bg-orange-100 px-2 py-0.5 text-[10px] font-bold text-[#c96f32]">
                        0
                    </span>
                </a>

                <a
                    href="#"
                    class="flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    <span class="flex items-center gap-3">
                        <i class="fa-regular fa-comments w-5 text-center"></i>
                        Chat
                    </span>

                    <span class="rounded-full bg-red-100 px-2 py-0.5 text-[10px] font-bold text-red-500">
                        0
                    </span>
                </a>

            </nav>

            <p class="mb-3 mt-8 px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Website
            </p>

            <nav class="space-y-1">

                <a
                    href="#"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    <i class="fa-solid fa-image w-5 text-center"></i>
                    Landing Page
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    <i class="fa-solid fa-location-dot w-5 text-center"></i>
                    Lokasi Toko
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    <i class="fa-solid fa-gear w-5 text-center"></i>
                    Pengaturan
                </a>

            </nav>

            <p class="mb-3 mt-8 px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Manajemen
            </p>

            <nav class="space-y-1">

                <a
                    href="#"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    <i class="fa-solid fa-headset w-5 text-center"></i>
                    Customer Service
                </a>

                <a
                    href="#"
                    class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium text-slate-600 transition hover:bg-orange-50 hover:text-[#c96f32]"
                >
                    <i class="fa-solid fa-users w-5 text-center"></i>
                    Pengguna
                </a>

            </nav>

        </div>

        <div class="border-t border-orange-50 p-4">

            <div class="flex items-center gap-3 rounded-2xl bg-orange-50 p-3">

                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#c96f32] text-sm font-bold text-white">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="min-w-0 flex-1">

                    <p class="truncate text-sm font-bold text-slate-800">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="truncate text-xs text-slate-400">
                        Administrator
                    </p>

                </div>

            </div>

            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf

                <button
                    type="submit"
                    class="flex w-full items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-red-500 transition hover:bg-red-50"
                >
                    <i class="fa-solid fa-right-from-bracket w-5 text-center"></i>
                    Keluar
                </button>

            </form>

        </div>

    </div>

</aside>

<div
    id="adminSidebarOverlay"
    class="fixed inset-0 z-40 hidden bg-slate-900/40 backdrop-blur-sm lg:hidden">
</div>