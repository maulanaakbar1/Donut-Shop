@extends('layouts.app')

@section('title', 'Checkout')

@section('content')

<div class="min-h-screen bg-[#fffaf5]">

```
<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

    <div class="mb-8">

        <a
            href="{{ route('cart.index') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-[#c96f32]"
        >
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Kembali ke keranjang
        </a>

        <h1 class="mt-5 text-2xl font-bold text-slate-900 sm:text-3xl">
            Checkout
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Lengkapi detail pesananmu sebelum membuat pesanan.
        </p>

    </div>

    @if(session('error'))

        <div class="mb-6 flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-medium text-red-700">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ session('error') }}
        </div>

    @endif

    @if($carts->count())

        <form
            action="{{ route('checkout.store') }}"
            method="POST"
            id="checkoutForm"
        >

            @csrf

            @foreach($carts as $cart)
                <input
                    type="hidden"
                    name="cart_ids[]"
                    value="{{ $cart->id }}"
                >
            @endforeach

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <div class="space-y-6 lg:col-span-2">

                    <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm sm:p-6">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-[#c96f32]">
                                <i class="fa-solid fa-receipt"></i>
                            </div>

                            <div>
                                <h2 class="text-base font-bold text-slate-900">
                                    Detail Pesanan
                                </h2>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Periksa kembali donat yang kamu pesan.
                                </p>
                            </div>

                        </div>

                        <div class="mt-6 divide-y divide-slate-100">

                            @foreach($carts as $cart)

                                <div class="flex gap-4 py-4 first:pt-0 last:pb-0">

                                    <div class="h-20 w-20 shrink-0 overflow-hidden rounded-xl bg-orange-50 sm:h-24 sm:w-24">

                                        @if($cart->donut->image)

                                            <img
                                                src="{{ asset('storage/' . $cart->donut->image) }}"
                                                alt="{{ $cart->donut->name }}"
                                                class="h-full w-full object-cover"
                                            >

                                        @else

                                            <div class="flex h-full w-full items-center justify-center text-[#c96f32]">
                                                <i class="fa-solid fa-cookie-bite text-xl"></i>
                                            </div>

                                        @endif

                                    </div>

                                    <div class="min-w-0 flex-1">

                                        <div class="flex items-start justify-between gap-4">

                                            <div class="min-w-0">

                                                <p class="truncate text-sm font-bold text-slate-900 sm:text-base">
                                                    {{ $cart->donut->name }}
                                                </p>

                                                <p class="mt-1 text-xs text-slate-400">
                                                    {{ $cart->quantity }} pcs × Rp{{ number_format($cart->price, 0, ',', '.') }}
                                                </p>

                                            </div>

                                            <p class="shrink-0 text-sm font-bold text-[#c96f32]">
                                                Rp{{ number_format($cart->subtotal, 0, ',', '.') }}
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    </div>

                    <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm sm:p-6">

                        <div class="flex items-center gap-3">

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-[#c96f32]">
                                <i class="fa-solid fa-note-sticky"></i>
                            </div>

                            <div>
                                <h2 class="text-base font-bold text-slate-900">
                                    Catatan Pesanan
                                </h2>

                                <p class="mt-0.5 text-xs text-slate-400">
                                    Tambahkan catatan jika diperlukan.
                                </p>
                            </div>

                        </div>

                        <div class="mt-5">

                            <textarea
                                name="notes"
                                rows="4"
                                maxlength="1000"
                                placeholder="Contoh: Tolong pisahkan donat cokelat dan donat keju."
                                class="w-full resize-none rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 outline-none transition placeholder:text-slate-300 focus:border-[#c96f32] focus:ring-2 focus:ring-orange-100"
                            >{{ old('notes') }}</textarea>

                            @error('notes')
                                <p class="mt-2 text-xs font-medium text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

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

                        <button
                            type="submit"
                            id="submitCheckout"
                            class="mt-5 flex w-full items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-5 py-3.5 text-sm font-semibold text-white shadow-lg shadow-orange-100 transition hover:bg-[#b85f27] disabled:cursor-not-allowed disabled:opacity-60"
                        >
                            <i class="fa-solid fa-check"></i>
                            Buat Pesanan
                        </button>

                        <p class="mt-3 text-center text-[11px] leading-5 text-slate-400">
                            Dengan melanjutkan, pesananmu akan dibuat dan diproses.
                        </p>

                    </div>

                </div>

            </div>

        </form>

    @else

        <div class="rounded-2xl border border-dashed border-orange-200 bg-white px-5 py-16 text-center shadow-sm">

            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-orange-50 text-[#c96f32]">
                <i class="fa-solid fa-cart-shopping text-2xl"></i>
            </div>

            <h2 class="mt-5 text-lg font-bold text-slate-800">
                Tidak ada pesanan
            </h2>

            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-400">
                Keranjangmu belum memiliki donat yang bisa diproses.
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
```

</div>

@endsection

@push('scripts')

<script>
    const checkoutForm = document.getElementById('checkoutForm');
    const submitCheckout = document.getElementById('submitCheckout');

    checkoutForm?.addEventListener('submit', () => {
        if (!submitCheckout) {
            return;
        }

        submitCheckout.disabled = true;
        submitCheckout.innerHTML = `
            <i class="fa-solid fa-spinner fa-spin"></i>
            Memproses...
        `;
    });
</script>

@endpush
