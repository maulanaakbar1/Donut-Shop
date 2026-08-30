@extends('layouts.admin')

@section('title', 'Donat')
@section('page-title', 'Donat')

@section('content')

<div class="space-y-6">

<div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">

    <div>
        <p class="text-sm font-semibold text-[#c96f32]">
            Manajemen Produk
        </p>

        <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
            Donat
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Kelola produk donat, harga, stok, kategori, dan status.
        </p>
    </div>

    <button
        type="button"
        onclick="openDonutModal()"
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b85f27]"
    >
        <i class="fa-solid fa-plus"></i>
        Tambah Donat
    </button>

</div>

@if(session('success'))
    <div class="flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
        <i class="fa-solid fa-circle-exclamation"></i>
        <span>{{ session('error') }}</span>
    </div>
@endif

@if($errors->any())
    <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3">
        <div class="flex items-start gap-3">
            <i class="fa-solid fa-circle-exclamation mt-0.5 text-red-500"></i>

            <div>
                <p class="text-sm font-semibold text-red-700">
                    Data tidak dapat diproses.
                </p>

                <ul class="mt-1 space-y-1 text-xs text-red-600">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">

    <div class="flex flex-col gap-4 border-b border-slate-100 px-5 py-4 lg:flex-row lg:items-center lg:justify-between">

        <div>
            <h2 class="text-base font-bold text-slate-900">
                Daftar Donat
            </h2>

            <p class="mt-1 text-xs text-slate-400">
                {{ $donuts->count() }} produk tersedia
            </p>
        </div>

        <div class="flex flex-col gap-2 sm:flex-row">

            <div class="relative">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                <input
                    type="text"
                    id="donutSearch"
                    placeholder="Cari donat..."
                    class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-xs text-slate-700 outline-none transition focus:border-orange-300 focus:ring-4 focus:ring-orange-50 sm:w-56"
                >
            </div>

            <select
                id="categoryFilter"
                class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-medium text-slate-600 outline-none transition focus:border-orange-300 focus:ring-4 focus:ring-orange-50"
            >
                <option value="">Semua Kategori</option>

                @foreach($categories as $category)
                    <option value="{{ strtolower($category->name) }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead>
                <tr class="border-b border-slate-100 bg-slate-50/70">

                    <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        #
                    </th>

                    <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Donat
                    </th>

                    <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Kategori
                    </th>

                    <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Harga
                    </th>

                    <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Stok
                    </th>

                    <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Status
                    </th>

                    <th class="px-5 py-4 text-right text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Aksi
                    </th>

                </tr>
            </thead>

            <tbody id="donutTable" class="divide-y divide-slate-100">

                @forelse($donuts as $donut)

                    <tr
                        class="donut-row transition hover:bg-orange-50/40"
                        data-name="{{ strtolower($donut->name) }}"
                        data-category="{{ strtolower($donut->category->name) }}"
                    >

                        <td class="px-5 py-4 text-sm text-slate-400">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-5 py-4">

                            <div class="flex min-w-[230px] items-center gap-3">

                                @if($donut->image)

                                    <img
                                        src="{{ asset('storage/' . $donut->image) }}"
                                        alt="{{ $donut->name }}"
                                        class="h-12 w-12 shrink-0 rounded-xl object-cover"
                                    >

                                @else

                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-[#c96f32]">
                                        <i class="fa-solid fa-cookie-bite"></i>
                                    </div>

                                @endif

                                <div class="min-w-0">
                                    <p class="truncate text-sm font-semibold text-slate-800">
                                        {{ $donut->name }}
                                    </p>

                                    @if($donut->description)
                                        <p class="mt-1 max-w-xs truncate text-xs text-slate-400">
                                            {{ $donut->description }}
                                        </p>
                                    @endif
                                </div>

                            </div>

                        </td>

                        <td class="px-5 py-4">
                            <span class="inline-flex rounded-lg bg-orange-50 px-2.5 py-1 text-xs font-medium text-[#c96f32]">
                                {{ $donut->category->name }}
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <span class="whitespace-nowrap text-sm font-semibold text-slate-800">
                                Rp{{ number_format($donut->price, 0, ',', '.') }}
                            </span>
                        </td>

                        <td class="px-5 py-4">

                            @if($donut->stock <= 5)

                                <span class="font-semibold text-red-500">
                                    {{ $donut->stock }}
                                </span>

                                <span class="ml-1 text-xs text-red-400">
                                    menipis
                                </span>

                            @else

                                <span class="font-semibold text-slate-700">
                                    {{ $donut->stock }}
                                </span>

                                <span class="ml-1 text-xs text-slate-400">
                                    pcs
                                </span>

                            @endif

                        </td>

                        <td class="px-5 py-4">

                            @if($donut->is_active)

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    Aktif
                                </span>

                            @else

                                <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-500">
                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                    Nonaktif
                                </span>

                            @endif

                        </td>

                        <td class="px-5 py-4">

                            <div class="flex items-center justify-end gap-2">

                                <button
                                    type="button"
                                    onclick="openEditDonutModal(
                                        {{ $donut->id }},
                                        @js($donut->category_id),
                                        @js($donut->name),
                                        @js($donut->description),
                                        @js($donut->price),
                                        {{ $donut->stock }},
                                        {{ $donut->is_active ? 'true' : 'false' }},
                                        @js($donut->image)
                                    )"
                                    class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-orange-200 hover:bg-orange-50 hover:text-[#c96f32]"
                                    title="Edit donat"
                                >
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </button>

                                <form
                                    action="{{ route('admin.donut.destroy', $donut) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus {{ $donut->name }}?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-red-100 text-red-400 transition hover:bg-red-50 hover:text-red-500"
                                        title="Hapus donat"
                                    >
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="px-5 py-16 text-center">

                            <div class="mx-auto flex max-w-sm flex-col items-center">

                                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 text-xl text-[#c96f32]">
                                    <i class="fa-solid fa-cookie-bite"></i>
                                </div>

                                <h3 class="mt-4 text-sm font-bold text-slate-800">
                                    Belum ada donat
                                </h3>

                                <p class="mt-1 text-xs leading-5 text-slate-400">
                                    Tambahkan produk donat pertama untuk mulai mengelola katalog.
                                </p>

                                <button
                                    type="button"
                                    onclick="openDonutModal()"
                                    class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[#c96f32] px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-[#b85f27]"
                                >
                                    <i class="fa-solid fa-plus"></i>
                                    Tambah Donat
                                </button>

                            </div>

                        </td>
                    </tr>

                @endforelse

                <tr id="noDonutSearchResult" class="hidden">
                    <td colspan="7" class="px-5 py-12 text-center">

                        <div class="flex flex-col items-center">

                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-50 text-slate-300">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>

                            <p class="mt-3 text-sm font-semibold text-slate-700">
                                Donat tidak ditemukan
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Coba ubah kata pencarian atau filter kategori.
                            </p>

                        </div>

                    </td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

</div>

<div
    id="donutModal"
    class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 px-4 py-6 backdrop-blur-sm"
>

<div
    id="donutModalContent"
    class="max-h-[92vh] w-full max-w-2xl scale-95 overflow-y-auto rounded-2xl bg-white shadow-2xl transition-transform duration-200"
>

    <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">

        <div>
            <p class="text-xs font-semibold uppercase tracking-wider text-[#c96f32]">
                Produk
            </p>

            <h2
                id="donutModalTitle"
                class="mt-1 text-lg font-bold text-slate-900"
            >
                Tambah Donat
            </h2>
        </div>

        <button
            type="button"
            onclick="closeDonutModal()"
            class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700"
        >
            <i class="fa-solid fa-xmark"></i>
        </button>

    </div>

    <form
        id="donutForm"
        action="{{ route('admin.donut.store') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        <div id="donutMethod"></div>

        <div class="space-y-5 px-5 py-5 sm:px-6">

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                <div>
                    <label
                        for="donutName"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Nama Donat
                    </label>

                    <input
                        type="text"
                        id="donutName"
                        name="name"
                        required
                        placeholder="Contoh: Donat Cokelat"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-300 focus:border-orange-300 focus:ring-4 focus:ring-orange-50"
                    >
                </div>

                <div>
                    <label
                        for="donutCategory"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Kategori
                    </label>

                    <select
                        id="donutCategory"
                        name="category_id"
                        required
                        class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition focus:border-orange-300 focus:ring-4 focus:ring-orange-50"
                    >
                        <option value="">Pilih kategori</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

            </div>

            <div>
                <label
                    for="donutDescription"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Deskripsi
                </label>

                <textarea
                    id="donutDescription"
                    name="description"
                    rows="3"
                    placeholder="Deskripsi singkat produk..."
                    class="w-full resize-none rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-300 focus:border-orange-300 focus:ring-4 focus:ring-orange-50"
                ></textarea>
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                <div>
                    <label
                        for="donutPrice"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Harga
                    </label>

                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-400">
                            Rp
                        </span>

                        <input
                            type="number"
                            id="donutPrice"
                            name="price"
                            min="0"
                            step="100"
                            required
                            placeholder="12000"
                            class="w-full rounded-xl border border-slate-200 py-3 pl-11 pr-4 text-sm text-slate-700 outline-none transition placeholder:text-slate-300 focus:border-orange-300 focus:ring-4 focus:ring-orange-50"
                        >
                    </div>
                </div>

                <div>
                    <label
                        for="donutStock"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Stok
                    </label>

                    <input
                        type="number"
                        id="donutStock"
                        name="stock"
                        min="0"
                        required
                        placeholder="0"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-300 focus:border-orange-300 focus:ring-4 focus:ring-orange-50"
                    >
                </div>

            </div>

            <div>

                <label
                    for="donutImage"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Foto Donat
                </label>

                <div class="flex flex-col gap-4 sm:flex-row sm:items-start">

                    <div
                        id="donutImagePreview"
                        class="flex h-28 w-28 shrink-0 items-center justify-center overflow-hidden rounded-2xl border border-dashed border-slate-200 bg-slate-50 text-slate-300"
                    >
                        <i class="fa-solid fa-image text-2xl"></i>
                    </div>

                    <div class="flex-1">
                        <input
                            type="file"
                            id="donutImage"
                            name="image"
                            accept="image/png,image/jpeg,image/webp"
                            class="block w-full rounded-xl border border-slate-200 bg-white text-sm text-slate-500 file:mr-4 file:border-0 file:bg-orange-50 file:px-4 file:py-3 file:text-xs file:font-semibold file:text-[#c96f32] hover:file:bg-orange-100"
                        >

                        <p class="mt-2 text-xs text-slate-400">
                            JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                        </p>
                    </div>

                </div>

            </div>

            <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/70 px-4 py-4">

                <div class="pr-4">
                    <p class="text-sm font-semibold text-slate-700">
                        Status Produk
                    </p>

                    <p class="mt-1 text-xs leading-5 text-slate-400">
                        Produk aktif akan ditampilkan dan dapat dijual.
                    </p>
                </div>

                <label class="relative inline-flex shrink-0 cursor-pointer items-center">

                    <input
                        type="checkbox"
                        id="donutActive"
                        name="is_active"
                        value="1"
                        class="peer sr-only"
                        checked
                    >

                    <div class="h-6 w-11 rounded-full bg-slate-200 transition peer-checked:bg-[#c96f32] peer-focus:ring-4 peer-focus:ring-orange-100 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-slate-200 after:bg-white after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>

                </label>

            </div>

        </div>

        <div class="flex flex-col-reverse gap-3 border-t border-slate-100 px-5 py-4 sm:flex-row sm:justify-end sm:px-6">

            <button
                type="button"
                onclick="closeDonutModal()"
                class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
            >
                Batal
            </button>

            <button
                type="submit"
                id="donutSubmitButton"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b85f27]"
            >
                <i class="fa-solid fa-plus" id="donutSubmitIcon"></i>
                <span id="donutSubmitText">Simpan Donat</span>
            </button>

        </div>

    </form>

</div>

</div>

@endsection

@push('scripts')

<script>
    const donutModal = document.getElementById('donutModal');
    const donutModalContent = document.getElementById('donutModalContent');
    const donutForm = document.getElementById('donutForm');
    const donutMethod = document.getElementById('donutMethod');
    const donutModalTitle = document.getElementById('donutModalTitle');
    const donutSubmitIcon = document.getElementById('donutSubmitIcon');
    const donutSubmitText = document.getElementById('donutSubmitText');
    const donutName = document.getElementById('donutName');
    const donutCategory = document.getElementById('donutCategory');
    const donutDescription = document.getElementById('donutDescription');
    const donutPrice = document.getElementById('donutPrice');
    const donutStock = document.getElementById('donutStock');
    const donutActive = document.getElementById('donutActive');
    const donutImage = document.getElementById('donutImage');
    const donutImagePreview = document.getElementById('donutImagePreview');

    function showDonutModal() {
        donutModal.classList.remove('hidden');
        donutModal.classList.add('flex');

        requestAnimationFrame(() => {
            donutModalContent.classList.remove('scale-95');
            donutModalContent.classList.add('scale-100');
        });

        document.body.classList.add('overflow-hidden');
    }

    function resetDonutImagePreview() {
        donutImagePreview.innerHTML = '<i class="fa-solid fa-image text-2xl"></i>';
    }

    function openDonutModal() {
        donutForm.action = "{{ route('admin.donut.store') }}";
        donutMethod.innerHTML = '';

        donutModalTitle.textContent = 'Tambah Donat';

        donutName.value = '';
        donutCategory.value = '';
        donutDescription.value = '';
        donutPrice.value = '';
        donutStock.value = '';
        donutActive.checked = true;
        donutImage.value = '';

        resetDonutImagePreview();

        donutSubmitIcon.className = 'fa-solid fa-plus';
        donutSubmitText.textContent = 'Simpan Donat';

        showDonutModal();

        setTimeout(() => {
            donutName.focus();
        }, 100);
    }

    function openEditDonutModal(id, categoryId, name, description, price, stock, isActive, image) {
        donutForm.action = "{{ url('admin/donat') }}/" + id;
        donutMethod.innerHTML = '@method("PUT")';

        donutModalTitle.textContent = 'Edit Donat';

        donutCategory.value = categoryId;
        donutName.value = name;
        donutDescription.value = description || '';
        donutPrice.value = price;
        donutStock.value = stock;
        donutActive.checked = isActive;
        donutImage.value = '';

        if (image) {
            donutImagePreview.innerHTML = '<img src="{{ asset('storage') }}/' + image + '" class="h-full w-full object-cover" alt="">';
        } else {
            resetDonutImagePreview();
        }

        donutSubmitIcon.className = 'fa-solid fa-check';
        donutSubmitText.textContent = 'Simpan Perubahan';

        showDonutModal();

        setTimeout(() => {
            donutName.focus();
        }, 100);
    }

    function closeDonutModal() {
        donutModalContent.classList.remove('scale-100');
        donutModalContent.classList.add('scale-95');

        setTimeout(() => {
            donutModal.classList.add('hidden');
            donutModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }, 150);
    }

    donutModal?.addEventListener('click', function(event) {
        if (event.target === donutModal) {
            closeDonutModal();
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && !donutModal.classList.contains('hidden')) {
            closeDonutModal();
        }
    });

    donutImage?.addEventListener('change', function() {
        const file = this.files?.[0];

        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function(event) {
            donutImagePreview.innerHTML = '<img src="' + event.target.result + '" class="h-full w-full object-cover" alt="">';
        };

        reader.readAsDataURL(file);
    });

    const donutSearch = document.getElementById('donutSearch');
    const categoryFilter = document.getElementById('categoryFilter');
    const donutRows = document.querySelectorAll('.donut-row');
    const noDonutSearchResult = document.getElementById('noDonutSearchResult');

    function filterDonuts() {
        const keyword = donutSearch.value.toLowerCase().trim();
        const category = categoryFilter.value.toLowerCase().trim();

        let visibleRows = 0;

        donutRows.forEach(row => {
            const name = row.dataset.name || '';
            const rowCategory = row.dataset.category || '';

            const matchesName = name.includes(keyword);
            const matchesCategory = !category || rowCategory === category;

            const visible = matchesName && matchesCategory;

            row.classList.toggle('hidden', !visible);

            if (visible) {
                visibleRows++;
            }
        });

        noDonutSearchResult?.classList.toggle(
            'hidden',
            visibleRows !== 0 || (keyword === '' && category === '')
        );
    }

    donutSearch?.addEventListener('input', filterDonuts);
    categoryFilter?.addEventListener('change', filterDonuts);
</script>

@endpush
