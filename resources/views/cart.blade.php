@extends('layouts.app')

@section('title', 'Keranjang')

@section('content')

<div class="min-h-screen bg-[#fffaf5]">

    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

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
                Periksa kembali pesananmu sebelum lanjut ke checkout.
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

                    @foreach($carts as $cart)

                        <div class="rounded-2xl border border-orange-100 bg-white p-4 shadow-sm sm:p-5">

                            <div class="flex gap-4">

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

                                        <form
                                            action="{{ route('cart.destroy', $cart) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-red-50 hover:text-red-500"
                                                title="Hapus"
                                            >
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </form>

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

                                        <p class="text-sm font-bold text-[#c96f32] sm:text-base">
                                            Rp{{ number_format($cart->subtotal, 0, ',', '.') }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                    <div class="flex justify-end">
                        <form
                            action="{{ route('cart.clear') }}"
                            method="POST"
                            onsubmit="return confirm('Kosongkan seluruh keranjang?')"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="inline-flex items-center gap-2 text-xs font-semibold text-red-500 transition hover:text-red-600"
                            >
                                <i class="fa-solid fa-trash-can"></i>
                                Kosongkan Keranjang
                            </button>
                        </form>
                    </div>

                </div>

                <div>

                    <div class="sticky top-24 rounded-2xl border border-orange-100 bg-white p-5 shadow-sm sm:p-6">

                        <h2 class="text-base font-bold text-slate-900">
                            Ringkasan Pesanan
                        </h2>

                        <div class="mt-5 space-y-3">

                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">
                                    Jumlah item
                                </span>

                                <span class="font-semibold text-slate-800">
                                    {{ $carts->sum('quantity') }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500">
                                    Subtotal
                                </span>

                                <span class="font-semibold text-slate-800">
                                    Rp{{ number_format($subtotal, 0, ',', '.') }}
                                </span>
                            </div>

                        </div>

                        <div class="my-5 border-t border-slate-100"></div>

                        <div class="flex items-center justify-between gap-4">

                            <span class="text-sm font-semibold text-slate-600">
                                Total
                            </span>

                            <span class="text-xl font-bold text-[#c96f32]">
                                Rp{{ number_format($subtotal, 0, ',', '.') }}
                            </span>

                        </div>

                        <a
                            href="#"
                            class="mt-5 flex w-full items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-orange-100 transition hover:bg-[#b85f27]"
                        >
                            Lanjut Checkout
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>

                        <p class="mt-3 text-center text-[11px] leading-5 text-slate-400">
                            Checkout akan kita sambungkan setelah alur keranjang selesai.
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

@endsection

@push('scripts')

<script>
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', () => {
            const input = document.getElementById(button.dataset.target);

            if (!input) {
                return;
            }

            const currentValue = Number(input.value);
            const min = Number(input.min) || 1;
            const max = Number(input.max) || Infinity;

            if (button.dataset.action === 'increase') {
                input.value = Math.min(currentValue + 1, max);
            }

            if (button.dataset.action === 'decrease') {
                input.value = Math.max(currentValue - 1, min);
            }

            input.closest('form')?.submit();
        });
    });
</script>

@endpush