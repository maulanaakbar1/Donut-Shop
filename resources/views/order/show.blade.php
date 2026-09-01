@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')

<div class="min-h-screen bg-[#fffaf5]">

<div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">

    <div class="mb-8">

        <a
            href="{{ route('home') }}"
            class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-[#c96f32]"
        >
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Kembali ke beranda
        </a>

        <div class="mt-5 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-[#c96f32]">
                    Detail Pesanan
                </p>

                <h1 class="mt-1 text-2xl font-bold text-slate-900 sm:text-3xl">
                    {{ $order->order_code }}
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Pesanan dibuat {{ $order->created_at->format('d M Y, H:i') }}
                </p>

            </div>

            <div>

                @if($order->status === 'pending')

                    <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-600">
                        <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                        Menunggu Diproses
                    </span>

                @elseif($order->status === 'processing')

                    <span class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-2 text-xs font-semibold text-blue-600">
                        <span class="h-2 w-2 rounded-full bg-blue-500"></span>
                        Sedang Diproses
                    </span>

                @elseif($order->status === 'ready')

                    <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-600">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Siap Diambil
                    </span>

                @elseif($order->status === 'completed')

                    <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-2 text-xs font-semibold text-emerald-600">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Selesai
                    </span>

                @elseif($order->status === 'cancelled')

                    <span class="inline-flex items-center gap-2 rounded-full bg-red-50 px-3 py-2 text-xs font-semibold text-red-600">
                        <span class="h-2 w-2 rounded-full bg-red-500"></span>
                        Dibatalkan
                    </span>

                @endif

            </div>

        </div>

    </div>

    @if(session('success'))

        <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>

    @endif

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        <div class="space-y-6 lg:col-span-2">

            <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm sm:p-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-orange-50 text-[#c96f32]">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>

                    <div>
                        <h2 class="text-base font-bold text-slate-900">
                            Pesanan Kamu
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-400">
                            {{ $order->items->sum('quantity') }} item
                        </p>
                    </div>

                </div>

                <div class="mt-6 divide-y divide-slate-100">

                    @foreach($order->items as $item)

                        <div class="flex gap-4 py-4 first:pt-0 last:pb-0">

                            <div class="h-20 w-20 shrink-0 overflow-hidden rounded-xl bg-orange-50 sm:h-24 sm:w-24">

                                @if($item->donut->image)

                                    <img
                                        src="{{ asset('storage/' . $item->donut->image) }}"
                                        alt="{{ $item->donut->name }}"
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

                                        <h3 class="truncate text-sm font-bold text-slate-900 sm:text-base">
                                            {{ $item->donut->name }}
                                        </h3>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ $item->quantity }} pcs × Rp{{ number_format($item->price, 0, ',', '.') }}
                                        </p>

                                    </div>

                                    <p class="shrink-0 text-sm font-bold text-[#c96f32]">
                                        Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

            @if($order->notes)

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
                                Catatan yang kamu berikan saat checkout.
                            </p>
                        </div>

                    </div>

                    <div class="mt-5 rounded-xl bg-[#fffaf5] px-4 py-3">

                        <p class="text-sm leading-6 text-slate-600">
                            {{ $order->notes }}
                        </p>

                    </div>

                </div>

            @endif

        </div>

        <div>

            <div class="sticky top-24 rounded-2xl border border-orange-100 bg-white p-5 shadow-sm sm:p-6">

                <h2 class="text-base font-bold text-slate-900">
                    Ringkasan Pembayaran
                </h2>

                <div class="mt-5 space-y-3">

                    <div class="flex items-center justify-between text-sm">

                        <span class="text-slate-500">
                            Jumlah item
                        </span>

                        <span class="font-semibold text-slate-800">
                            {{ $order->items->sum('quantity') }}
                        </span>

                    </div>

                    <div class="flex items-center justify-between text-sm">

                        <span class="text-slate-500">
                            Subtotal
                        </span>

                        <span class="font-semibold text-slate-800">
                            Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                        </span>

                    </div>

                </div>

                <div class="my-5 border-t border-slate-100"></div>

                <div class="flex items-center justify-between gap-4">

                    <span class="text-sm font-semibold text-slate-600">
                        Total
                    </span>

                    <span class="text-xl font-bold text-[#c96f32]">
                        Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                    </span>

                </div>

                <div class="mt-5 rounded-xl border border-amber-100 bg-amber-50 px-4 py-3">

                    <div class="flex items-center gap-2">

                        <i class="fa-solid fa-clock text-amber-500"></i>

                        <span class="text-xs font-semibold text-amber-700">
                            Menunggu Pembayaran
                        </span>

                    </div>

                    <p class="mt-1 text-[11px] leading-5 text-amber-600">
                        Silakan lakukan pembayaran untuk melanjutkan proses pesanan.
                    </p>

                </div>

                <button
                    type="button"
                    disabled
                    class="mt-4 flex w-full cursor-not-allowed items-center justify-center gap-2 rounded-xl bg-slate-200 px-5 py-3.5 text-sm font-semibold text-slate-400"
                >
                    <i class="fa-solid fa-credit-card"></i>
                    Bayar Sekarang
                </button>

                <p class="mt-3 text-center text-[11px] leading-5 text-slate-400">
                    Pembayaran akan tersedia setelah sistem pembayaran terhubung.
                </p>

            </div>

        </div>

    </div>

</div>

</div>

@endsection
