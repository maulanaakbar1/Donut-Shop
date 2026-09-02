@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')

<div class="min-h-screen bg-[#fffaf5]">

<div class="mx-auto max-w-6xl px-4 py-8 pb-28 sm:px-6 sm:pb-8 lg:px-8">

    <div class="mb-8">
        <a
            href="{{ route('home') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-[#c96f32]"
        >
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Kembali belanja
        </a>

        <h1 class="mt-5 text-2xl font-bold text-slate-900 sm:text-3xl">
            Keranjang
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Pilih item yang ingin kamu beli.
        </p>
    </div>

    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>
    @endif

    @if($carts->count())

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

            <div class="space-y-4 lg:col-span-2">

                <div class="flex items-center justify-between gap-3 rounded-2xl border border-orange-100 bg-white px-4 py-3 shadow-sm sm:px-5">

                    <label class="flex min-w-0 cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            id="selectAll"
                            class="h-4 w-4 shrink-0 cursor-pointer rounded border-slate-300 text-[#c96f32] focus:ring-[#c96f32]"
                        >

                        <span class="text-sm font-semibold text-slate-700">
                            Pilih Semua
                        </span>

                    </label>

                    <div class="flex shrink-0 items-center gap-2 sm:gap-3">

                        <span
                            id="selectedInfo"
                            class="text-xs font-medium text-slate-400"
                        >
                            0 item dipilih
                        </span>

                        <button
                            type="button"
                            id="deleteSelectedButton"
                            disabled
                            class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-2 text-xs font-semibold text-red-500 transition hover:bg-red-50 hover:text-red-600 disabled:cursor-not-allowed disabled:opacity-40 sm:px-3"
                        >
                            <i class="fa-solid fa-trash-can"></i>
                            <span class="hidden sm:inline">
                                Hapus Terpilih
                            </span>
                            <span class="sm:hidden">
                                Hapus
                            </span>
                        </button>

                    </div>

                </div>

                @foreach($carts as $cart)

                    <div
                        class="cart-item rounded-2xl border border-orange-100 bg-white p-4 shadow-sm transition sm:p-5"
                        data-id="{{ $cart->id }}"
                    >

                        <div class="flex gap-3 sm:gap-4">

                            <div class="flex items-center">

                                <input
                                    type="checkbox"
                                    name="cart_ids[]"
                                    value="{{ $cart->id }}"
                                    class="cart-checkbox h-5 w-5 cursor-pointer rounded border-slate-300 text-[#c96f32] focus:ring-[#c96f32]"
                                    data-price="{{ $cart->price }}"
                                    data-quantity="{{ $cart->quantity }}"
                                >

                            </div>

                            <div class="h-24 w-24 shrink-0 overflow-hidden rounded-xl bg-orange-50 sm:h-28 sm:w-28">

                                @if($cart->donut->image)

                                    <img
                                        src="{{ asset('storage/' . $cart->donut->image) }}"
                                        alt="{{ $cart->donut->name }}"
                                        class="h-full w-full object-cover"
                                    >

                                @else

                                    <div class="flex h-full w-full items-center justify-center text-[#c96f32]">
                                        <i class="fa-solid fa-cookie-bite text-2xl"></i>
                                    </div>

                                @endif

                            </div>

                            <div class="min-w-0 flex-1">

                                <div class="flex items-start justify-between gap-3">

                                    <div class="min-w-0">

                                        <span class="inline-flex rounded-full bg-orange-50 px-2.5 py-1 text-[10px] font-semibold text-[#c96f32]">
                                            {{ $cart->donut->category->name }}
                                        </span>

                                        <h2 class="mt-2 truncate text-sm font-bold text-slate-900 sm:text-base">
                                            {{ $cart->donut->name }}
                                        </h2>

                                    </div>

                                    <button
                                        type="button"
                                        onclick="deleteCart({{ $cart->id }})"
                                        class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-red-50 hover:text-red-500"
                                        title="Hapus"
                                    >
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>

                                </div>

                                <p class="mt-2 text-xs text-slate-400">
                                    Rp{{ number_format($cart->price, 0, ',', '.') }} / pcs
                                </p>

                                <div class="mt-4 flex items-center justify-between gap-3">

                                    <form
                                        action="{{ route('cart.update', $cart) }}"
                                        method="POST"
                                        class="flex items-center rounded-xl border border-slate-200"
                                    >
                                        @csrf
                                        @method('PUT')

                                        <button
                                            type="button"
                                            class="quantity-btn flex h-9 w-9 items-center justify-center text-slate-500 transition hover:bg-orange-50 hover:text-[#c96f32]"
                                            data-target="quantity-{{ $cart->id }}"
                                            data-action="decrease"
                                        >
                                            <i class="fa-solid fa-minus text-[10px]"></i>
                                        </button>

                                        <input
                                            id="quantity-{{ $cart->id }}"
                                            type="number"
                                            name="quantity"
                                            value="{{ $cart->quantity }}"
                                            min="1"
                                            max="{{ $cart->donut->stock }}"
                                            class="h-9 w-12 border-x border-slate-200 text-center text-sm font-semibold text-slate-700 outline-none"
                                        >

                                        <button
                                            type="button"
                                            class="quantity-btn flex h-9 w-9 items-center justify-center text-slate-500 transition hover:bg-orange-50 hover:text-[#c96f32]"
                                            data-target="quantity-{{ $cart->id }}"
                                            data-action="increase"
                                        >
                                            <i class="fa-solid fa-plus text-[10px]"></i>
                                        </button>

                                    </form>

                                    <p
                                        id="subtotal-{{ $cart->id }}"
                                        class="text-sm font-bold text-[#c96f32] sm:text-base"
                                    >
                                        Rp{{ number_format($cart->subtotal, 0, ',', '.') }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

            <div>

                <div class="sticky top-24 hidden rounded-2xl border border-orange-100 bg-white p-5 shadow-sm lg:block sm:p-6">

                    <h2 class="text-base font-bold text-slate-900">
                        Ringkasan Pesanan
                    </h2>

                    <div class="mt-5 space-y-3">

                        <div class="flex items-center justify-between text-sm">

                            <span class="text-slate-500">
                                Item dipilih
                            </span>

                            <span
                                id="selectedQuantity"
                                class="font-semibold text-slate-800"
                            >
                                0
                            </span>

                        </div>

                        <div class="flex items-center justify-between text-sm">

                            <span class="text-slate-500">
                                Subtotal
                            </span>

                            <span
                                id="selectedSubtotal"
                                class="font-semibold text-slate-800"
                            >
                                Rp0
                            </span>

                        </div>

                    </div>

                    <div class="my-5 border-t border-slate-100"></div>

                    <div class="flex items-center justify-between gap-4">

                        <span class="text-sm font-semibold text-slate-600">
                            Total
                        </span>

                        <span
                            id="selectedTotal"
                            class="text-xl font-bold text-[#c96f32]"
                        >
                            Rp0
                        </span>

                    </div>

                    <button
                        type="button"
                        id="checkoutButtonDesktop"
                        disabled
                        class="mt-5 flex w-full items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-orange-100 transition hover:bg-[#b85f27] disabled:cursor-not-allowed disabled:bg-slate-200 disabled:text-slate-400 disabled:shadow-none"
                    >
                        Lanjut Checkout
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </button>

                    <p
                        id="checkoutHint"
                        class="mt-3 text-center text-[11px] leading-5 text-slate-400"
                    >
                        Pilih minimal satu item untuk melanjutkan checkout.
                    </p>

                </div>

            </div>

        </div>

    @else

        <div class="rounded-2xl border border-dashed border-orange-200 bg-white px-5 py-16 text-center shadow-sm">

            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-orange-50 text-[#c96f32]">
                <i class="fa-solid fa-cart-shopping text-2xl"></i>
            </div>

            <h2 class="mt-5 text-lg font-bold text-slate-800">
                Keranjang masih kosong
            </h2>

            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-400">
                Yuk pilih donat favoritmu dan tambahkan ke keranjang.
            </p>

            <a
                href="{{ route('home') }}#donat"
                class="mt-6 inline-flex items-center gap-2 rounded-xl bg-[#c96f32] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#b85f27]"
            >
                <i class="fa-solid fa-cookie-bite"></i>
                Lihat Donat
            </a>

        </div>

    @endif

</div>

</div>

@if($carts->count())

<div class="fixed inset-x-0 bottom-0 z-50 border-t border-orange-100 bg-white/95 px-4 pb-4 pt-3 shadow-[0_-8px_30px_rgba(0,0,0,0.08)] backdrop-blur-xl lg:hidden">

    <div class="mx-auto flex max-w-6xl items-center gap-3">

        <div class="min-w-0 flex-1">

            <p
                id="selectedInfoMobile"
                class="text-[11px] font-medium text-slate-400"
            >
                0 item dipilih
            </p>

            <p
                id="selectedTotalMobile"
                class="mt-0.5 truncate text-lg font-bold text-[#c96f32]"
            >
                Rp0
            </p>

        </div>

        <button
            type="button"
            id="checkoutButtonMobile"
            disabled
            class="flex h-12 shrink-0 items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-5 text-sm font-semibold text-white shadow-lg shadow-orange-100 transition active:scale-[0.98] disabled:cursor-not-allowed disabled:bg-slate-200 disabled:text-slate-400 disabled:shadow-none"
        >
            Checkout
            <i class="fa-solid fa-arrow-right text-xs"></i>
        </button>

    </div>

</div>

<form
    id="delete-selected-form"
    action="{{ route('cart.destroySelected') }}"
    method="POST"
    class="hidden"
>
    @csrf
    @method('DELETE')

    <div id="selected-cart-inputs"></div>
</form>

@foreach($carts as $cart)

    <form
        id="delete-form-{{ $cart->id }}"
        action="{{ route('cart.destroy', $cart) }}"
        method="POST"
        class="hidden"
    >
        @csrf
        @method('DELETE')
    </form>

@endforeach

@endif

@endsection

@push('scripts')

<script>
    const checkboxes = document.querySelectorAll('.cart-checkbox');
    const selectAll = document.getElementById('selectAll');

    const checkoutButtonDesktop = document.getElementById('checkoutButtonDesktop');
    const checkoutButtonMobile = document.getElementById('checkoutButtonMobile');

    const deleteSelectedButton = document.getElementById('deleteSelectedButton');
    const deleteSelectedForm = document.getElementById('delete-selected-form');
    const selectedCartInputs = document.getElementById('selected-cart-inputs');

    const selectedInfo = document.getElementById('selectedInfo');
    const selectedInfoMobile = document.getElementById('selectedInfoMobile');

    const selectedQuantity = document.getElementById('selectedQuantity');
    const selectedSubtotal = document.getElementById('selectedSubtotal');
    const selectedTotal = document.getElementById('selectedTotal');

    const selectedTotalMobile = document.getElementById('selectedTotalMobile');
    const checkoutHint = document.getElementById('checkoutHint');

    function formatRupiah(value) {
        return 'Rp' + new Intl.NumberFormat('id-ID').format(value);
    }

    function getSelectedCarts() {
        return [...checkboxes].filter(checkbox => checkbox.checked);
    }

    function updateSummary() {
        let total = 0;
        let quantity = 0;

        const selected = getSelectedCarts();

        selected.forEach(checkbox => {
            const price = Number(checkbox.dataset.price);
            const itemQuantity = Number(checkbox.dataset.quantity);

            total += price * itemQuantity;
            quantity += itemQuantity;
        });

        const selectedCount = selected.length;
        const infoText = `${selectedCount} item dipilih`;
        const disabled = selectedCount === 0;

        if (selectedInfo) {
            selectedInfo.textContent = infoText;
        }

        if (selectedInfoMobile) {
            selectedInfoMobile.textContent = infoText;
        }

        if (selectedQuantity) {
            selectedQuantity.textContent = quantity;
        }

        if (selectedSubtotal) {
            selectedSubtotal.textContent = formatRupiah(total);
        }

        if (selectedTotal) {
            selectedTotal.textContent = formatRupiah(total);
        }

        if (selectedTotalMobile) {
            selectedTotalMobile.textContent = formatRupiah(total);
        }

        if (checkoutButtonDesktop) {
            checkoutButtonDesktop.disabled = disabled;
        }

        if (checkoutButtonMobile) {
            checkoutButtonMobile.disabled = disabled;
        }

        if (deleteSelectedButton) {
            deleteSelectedButton.disabled = disabled;
        }

        if (checkoutHint) {
            checkoutHint.textContent = disabled
                ? 'Pilih minimal satu item untuk melanjutkan checkout.'
                : `${selectedCount} item siap untuk checkout.`;
        }

        const checkedCount = selected.length;

        if (selectAll) {
            selectAll.checked = checkedCount === checkboxes.length;
            selectAll.indeterminate =
                checkedCount > 0 &&
                checkedCount < checkboxes.length;
        }
    }

    function goToCheckout() {
        const selected = getSelectedCarts();

        if (selected.length === 0) {
            alert('Pilih minimal satu item untuk checkout.');
            return;
        }

        const params = new URLSearchParams();

        selected.forEach(checkbox => {
            params.append('cart_ids[]', checkbox.value);
        });

        window.location.href = `{{ route('checkout.index') }}?${params.toString()}`;
    }

    if (selectAll) {
        selectAll.addEventListener('change', function () {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });

            updateSummary();
        });
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSummary);
    });

    if (checkoutButtonDesktop) {
        checkoutButtonDesktop.addEventListener('click', goToCheckout);
    }

    if (checkoutButtonMobile) {
        checkoutButtonMobile.addEventListener('click', goToCheckout);
    }

    if (deleteSelectedButton) {
        deleteSelectedButton.addEventListener('click', function () {
            const selected = getSelectedCarts();

            if (selected.length === 0) {
                return;
            }

            const message = selected.length === checkboxes.length
                ? 'Yakin ingin menghapus seluruh keranjang?'
                : `Yakin ingin menghapus ${selected.length} item yang dipilih?`;

            if (!confirm(message)) {
                return;
            }

            selectedCartInputs.innerHTML = '';

            selected.forEach(checkbox => {
                const input = document.createElement('input');

                input.type = 'hidden';
                input.name = 'cart_ids[]';
                input.value = checkbox.value;

                selectedCartInputs.appendChild(input);
            });

            deleteSelectedForm.submit();
        });
    }

    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', async () => {
            const input = document.getElementById(button.dataset.target);

            if (!input) {
                return;
            }

            const form = input.closest('form');

            if (!form) {
                return;
            }

            const currentValue = Number(input.value);
            const min = Number(input.min) || 1;
            const max = Number(input.max) || Infinity;

            let newValue = currentValue;

            if (button.dataset.action === 'increase') {
                newValue = Math.min(currentValue + 1, max);
            }

            if (button.dataset.action === 'decrease') {
                newValue = Math.max(currentValue - 1, min);
            }

            if (newValue === currentValue) {
                return;
            }

            const previousValue = input.value;

            input.value = newValue;

            const buttons = form.querySelectorAll('.quantity-btn');

            buttons.forEach(item => {
                item.disabled = true;
            });

            try {
                const formData = new FormData(form);

                const csrfInput = form.querySelector('input[name="_token"]');

                if (!csrfInput) {
                throw new Error('CSRF token tidak ditemukan.');
                }

                const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                'X-CSRF-TOKEN': csrfInput.value,
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
                });


                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.message || 'Gagal memperbarui jumlah.');
                }

                input.value = data.quantity;

                const cartId = input.id.replace('quantity-', '');

                const checkbox = document.querySelector(
                    `.cart-checkbox[value="${cartId}"]`
                );

                if (checkbox) {
                    checkbox.dataset.quantity = data.quantity;
                    checkbox.dataset.price = data.price;
                }

                const subtotalElement = document.getElementById(
                    `subtotal-${cartId}`
                );

                if (subtotalElement) {
                    subtotalElement.textContent = formatRupiah(data.subtotal);
                }

                updateSummary();

            } catch (error) {
                input.value = previousValue;
                alert(error.message);
            } finally {
                buttons.forEach(item => {
                    item.disabled = false;
                });
            }
        });
    });

    function deleteCart(id) {
        if (confirm('Hapus donat ini dari keranjang?')) {
            document.getElementById(`delete-form-${id}`)?.submit();
        }
    }

    updateSummary();
</script>

@endpush