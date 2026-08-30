@extends('layouts.admin')

@section('title', 'Kategori')
@section('page-title', 'Kategori')

@section('content')

<div class="space-y-6">

<div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <p class="text-sm font-semibold text-[#c96f32]">
            Manajemen Produk
        </p>

        <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
            Kategori
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Kelola kategori produk Nona Donat.
        </p>
    </div>

    <button
        type="button"
        onclick="openCategoryModal()"
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b85f27]"
    >
        <i class="fa-solid fa-plus"></i>
        Tambah Kategori
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

    <div class="flex flex-col gap-3 border-b border-slate-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h2 class="text-base font-bold text-slate-900">
                Daftar Kategori
            </h2>

            <p class="mt-1 text-xs text-slate-400">
                {{ $categories->count() }} kategori tersedia
            </p>
        </div>

        <div class="relative">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

            <input
                type="text"
                id="categorySearch"
                placeholder="Cari kategori..."
                class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-xs text-slate-700 outline-none transition focus:border-orange-300 focus:ring-4 focus:ring-orange-50 sm:w-64"
            >
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
                        Kategori
                    </th>

                    <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Slug
                    </th>

                    <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Produk
                    </th>

                    <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Status
                    </th>

                    <th class="px-5 py-4 text-right text-[11px] font-bold uppercase tracking-wider text-slate-400">
                        Aksi
                    </th>

                </tr>
            </thead>

            <tbody id="categoryTable" class="divide-y divide-slate-100">

                @forelse($categories as $category)

                    <tr class="category-row transition hover:bg-orange-50/40">

                        <td class="px-5 py-4 text-sm text-slate-400">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-[#c96f32]">
                                    <i class="fa-solid fa-layer-group"></i>
                                </div>

                                <div class="min-w-0">
                                    <p class="category-name text-sm font-semibold text-slate-800">
                                        {{ $category->name }}
                                    </p>

                                    @if($category->description)
                                        <p class="mt-1 max-w-xs truncate text-xs text-slate-400">
                                            {{ $category->description }}
                                        </p>
                                    @else
                                        <p class="mt-1 text-xs text-slate-400">
                                            Tidak ada deskripsi
                                        </p>
                                    @endif
                                </div>

                            </div>

                        </td>

                        <td class="px-5 py-4">
                            <span class="inline-flex rounded-lg bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                                {{ $category->slug }}
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <span class="text-sm font-semibold text-slate-700">
                                {{ $category->donuts_count }}
                            </span>

                            <span class="ml-1 text-xs text-slate-400">
                                produk
                            </span>
                        </td>

                        <td class="px-5 py-4">

                            @if($category->is_active)

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
                                    onclick="openEditCategoryModal(
                                        {{ $category->id }},
                                        @js($category->name),
                                        @js($category->description),
                                        {{ $category->is_active ? 'true' : 'false' }}
                                    )"
                                    class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-orange-200 hover:bg-orange-50 hover:text-[#c96f32]"
                                    title="Edit kategori"
                                >
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </button>

                                @if($category->donuts_count === 0)

                                    <form
                                        action="{{ route('admin.category.destroy', $category) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori {{ $category->name }}?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="flex h-9 w-9 items-center justify-center rounded-lg border border-red-100 text-red-400 transition hover:bg-red-50 hover:text-red-500"
                                            title="Hapus kategori"
                                        >
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>

                                @else

                                    <button
                                        type="button"
                                        onclick="alert('Kategori ini tidak dapat dihapus karena masih memiliki produk.')"
                                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-100 text-slate-300"
                                        title="Tidak dapat dihapus"
                                    >
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr id="emptyCategoryRow">
                        <td colspan="6" class="px-5 py-14 text-center">

                            <div class="mx-auto flex max-w-sm flex-col items-center">

                                <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 text-xl text-[#c96f32]">
                                    <i class="fa-solid fa-layer-group"></i>
                                </div>

                                <h3 class="mt-4 text-sm font-bold text-slate-800">
                                    Belum ada kategori
                                </h3>

                                <p class="mt-1 text-xs leading-5 text-slate-400">
                                    Tambahkan kategori pertama untuk mulai mengelompokkan produk.
                                </p>

                                <button
                                    type="button"
                                    onclick="openCategoryModal()"
                                    class="mt-5 inline-flex items-center gap-2 rounded-xl bg-[#c96f32] px-4 py-2.5 text-xs font-semibold text-white transition hover:bg-[#b85f27]"
                                >
                                    <i class="fa-solid fa-plus"></i>
                                    Tambah Kategori
                                </button>

                            </div>

                        </td>
                    </tr>

                @endforelse

                <tr id="noSearchResult" class="hidden">
                    <td colspan="6" class="px-5 py-12 text-center">

                        <div class="flex flex-col items-center">

                            <i class="fa-solid fa-magnifying-glass text-2xl text-slate-300"></i>

                            <p class="mt-3 text-sm font-semibold text-slate-700">
                                Kategori tidak ditemukan
                            </p>

                            <p class="mt-1 text-xs text-slate-400">
                                Coba gunakan kata pencarian yang berbeda.
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
    id="categoryModal"
    class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 px-4 py-6 backdrop-blur-sm"
>

<div
    id="categoryModalContent"
    class="w-full max-w-lg scale-95 rounded-2xl bg-white shadow-2xl transition-transform duration-200"
>

    <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">

        <div>
            <p
                id="categoryModalLabel"
                class="text-xs font-semibold uppercase tracking-wider text-[#c96f32]"
            >
                Kategori
            </p>

            <h2
                id="categoryModalTitle"
                class="mt-1 text-lg font-bold text-slate-900"
            >
                Tambah Kategori
            </h2>
        </div>

        <button
            type="button"
            onclick="closeCategoryModal()"
            class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700"
        >
            <i class="fa-solid fa-xmark"></i>
        </button>

    </div>

    <form
        id="categoryForm"
        action="{{ route('admin.category.store') }}"
        method="POST"
    >

        @csrf

        <div id="categoryMethod"></div>

        <div class="space-y-5 px-5 py-5 sm:px-6">

            <div>

                <label
                    for="categoryName"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Nama Kategori
                </label>

                <input
                    type="text"
                    id="categoryName"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Contoh: Cokelat"
                    required
                    class="w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-300 focus:border-orange-300 focus:ring-4 focus:ring-orange-50"
                >

            </div>

            <div>

                <label
                    for="categoryDescription"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Deskripsi
                </label>

                <textarea
                    id="categoryDescription"
                    name="description"
                    rows="4"
                    placeholder="Deskripsi singkat kategori..."
                    class="w-full resize-none rounded-xl border border-slate-200 px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-300 focus:border-orange-300 focus:ring-4 focus:ring-orange-50"
                >{{ old('description') }}</textarea>

            </div>

            <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/70 px-4 py-4">

                <div>
                    <p class="text-sm font-semibold text-slate-700">
                        Status Kategori
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Kategori aktif dapat digunakan untuk produk.
                    </p>
                </div>

                <label class="relative inline-flex cursor-pointer items-center">

                    <input
                        type="checkbox"
                        id="categoryActive"
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
                onclick="closeCategoryModal()"
                class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50"
            >
                Batal
            </button>

            <button
                type="submit"
                id="categorySubmitButton"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-[#b85f27]"
            >
                <i class="fa-solid fa-plus" id="categorySubmitIcon"></i>
                <span id="categorySubmitText">Simpan Kategori</span>
            </button>

        </div>

    </form>

</div>

</div>

@endsection

@push('scripts')

<script>
    const categoryModal = document.getElementById('categoryModal');
    const categoryModalContent = document.getElementById('categoryModalContent');
    const categoryForm = document.getElementById('categoryForm');
    const categoryMethod = document.getElementById('categoryMethod');
    const categoryModalLabel = document.getElementById('categoryModalLabel');
    const categoryModalTitle = document.getElementById('categoryModalTitle');
    const categorySubmitButton = document.getElementById('categorySubmitButton');
    const categorySubmitIcon = document.getElementById('categorySubmitIcon');
    const categorySubmitText = document.getElementById('categorySubmitText');
    const categoryName = document.getElementById('categoryName');
    const categoryDescription = document.getElementById('categoryDescription');
    const categoryActive = document.getElementById('categoryActive');

    function openCategoryModal() {
        categoryForm.action = "{{ route('admin.category.store') }}";
        categoryMethod.innerHTML = '';

        categoryModalLabel.textContent = 'Kategori';
        categoryModalTitle.textContent = 'Tambah Kategori';

        categoryName.value = '';
        categoryDescription.value = '';
        categoryActive.checked = true;

        categorySubmitIcon.className = 'fa-solid fa-plus';
        categorySubmitText.textContent = 'Simpan Kategori';

        categoryModal.classList.remove('hidden');
        categoryModal.classList.add('flex');

        requestAnimationFrame(() => {
            categoryModalContent.classList.remove('scale-95');
            categoryModalContent.classList.add('scale-100');
        });

        document.body.classList.add('overflow-hidden');
        categoryName.focus();
    }

    function openEditCategoryModal(id, name, description, isActive) {
        categoryForm.action = "{{ url('admin/category') }}/" + id;

        categoryMethod.innerHTML = '@method("PUT")';

        categoryModalLabel.textContent = 'Kategori';
        categoryModalTitle.textContent = 'Edit Kategori';

        categoryName.value = name;
        categoryDescription.value = description || '';
        categoryActive.checked = isActive;

        categorySubmitIcon.className = 'fa-solid fa-check';
        categorySubmitText.textContent = 'Simpan Perubahan';

        categoryModal.classList.remove('hidden');
        categoryModal.classList.add('flex');

        requestAnimationFrame(() => {
            categoryModalContent.classList.remove('scale-95');
            categoryModalContent.classList.add('scale-100');
        });

        document.body.classList.add('overflow-hidden');
        categoryName.focus();
    }

    function closeCategoryModal() {
        categoryModalContent.classList.remove('scale-100');
        categoryModalContent.classList.add('scale-95');

        setTimeout(() => {
            categoryModal.classList.add('hidden');
            categoryModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }, 150);
    }

    categoryModal?.addEventListener('click', function (event) {
        if (event.target === categoryModal) {
            closeCategoryModal();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !categoryModal.classList.contains('hidden')) {
            closeCategoryModal();
        }
    });

    const categorySearch = document.getElementById('categorySearch');
    const categoryRows = document.querySelectorAll('.category-row');
    const noSearchResult = document.getElementById('noSearchResult');

    categorySearch?.addEventListener('input', function () {
        const keyword = this.value.toLowerCase().trim();
        let visibleRows = 0;

        categoryRows.forEach(row => {
            const name = row.querySelector('.category-name')?.textContent.toLowerCase() || '';
            const visible = name.includes(keyword);

            row.classList.toggle('hidden', !visible);

            if (visible) {
                visibleRows++;
            }
        });

        noSearchResult?.classList.toggle('hidden', visibleRows !== 0 || keyword === '');
    });
</script>

@endpush
