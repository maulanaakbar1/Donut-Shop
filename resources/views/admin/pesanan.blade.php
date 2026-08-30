@extends('layouts.admin')

@section('title', 'Pesanan')
@section('page-title', 'Pesanan')

@section('content')

<div class="space-y-6">

    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-sm font-semibold text-[#c96f32]">
                Transaksi
            </p>

            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Pesanan
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Kelola dan pantau seluruh pesanan yang masuk.
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 xl:grid-cols-6">

        <div class="rounded-2xl border border-slate-100 bg-white p-4 shadow-sm">
            <p class="text-xs font-medium text-slate-400">
                Semua
            </p>
            <p class="mt-2 text-2xl font-bold text-slate-900">
                {{ $orderCounts['all'] }}
            </p>
        </div>

        <div class="rounded-2xl border border-amber-100 bg-white p-4 shadow-sm">
            <p class="text-xs font-medium text-slate-400">
                Menunggu
            </p>
            <p class="mt-2 text-2xl font-bold text-amber-500">
                {{ $orderCounts['pending'] }}
            </p>
        </div>

        <div class="rounded-2xl border border-sky-100 bg-white p-4 shadow-sm">
            <p class="text-xs font-medium text-slate-400">
                Diproses
            </p>
            <p class="mt-2 text-2xl font-bold text-sky-500">
                {{ $orderCounts['processing'] }}
            </p>
        </div>

        <div class="rounded-2xl border border-violet-100 bg-white p-4 shadow-sm">
            <p class="text-xs font-medium text-slate-400">
                Siap Diambil
            </p>
            <p class="mt-2 text-2xl font-bold text-violet-500">
                {{ $orderCounts['ready'] }}
            </p>
        </div>

        <div class="rounded-2xl border border-emerald-100 bg-white p-4 shadow-sm">
            <p class="text-xs font-medium text-slate-400">
                Selesai
            </p>
            <p class="mt-2 text-2xl font-bold text-emerald-500">
                {{ $orderCounts['completed'] }}
            </p>
        </div>

        <div class="rounded-2xl border border-red-100 bg-white p-4 shadow-sm">
            <p class="text-xs font-medium text-slate-400">
                Dibatalkan
            </p>
            <p class="mt-2 text-2xl font-bold text-red-500">
                {{ $orderCounts['cancelled'] }}
            </p>
        </div>

    </div>

    <div class="overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">

            <form
                action="{{ route('admin.order.index') }}"
                method="GET"
                class="flex flex-col gap-3 lg:flex-row lg:items-center"
            >

                <div class="relative flex-1">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-xs text-slate-400"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari kode pesanan, nama, atau email..."
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-xs text-slate-700 outline-none transition focus:border-orange-300 focus:ring-4 focus:ring-orange-50"
                    >
                </div>

                <select
                    name="status"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-medium text-slate-600 outline-none transition focus:border-orange-300 focus:ring-4 focus:ring-orange-50"
                >
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Diproses</option>
                    <option value="ready" {{ request('status') === 'ready' ? 'selected' : '' }}>Siap Diambil</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>

                <select
                    name="payment_status"
                    class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-xs font-medium text-slate-600 outline-none transition focus:border-orange-300 focus:ring-4 focus:ring-orange-50"
                >
                    <option value="">Semua Pembayaran</option>
                    <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="paid" {{ request('payment_status') === 'paid' ? 'selected' : '' }}>Lunas</option>
                    <option value="failed" {{ request('payment_status') === 'failed' ? 'selected' : '' }}>Gagal</option>
                    <option value="refunded" {{ request('payment_status') === 'refunded' ? 'selected' : '' }}>Dikembalikan</option>
                </select>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-5 py-2.5 text-xs font-semibold text-white transition hover:bg-[#b85f27]"
                >
                    <i class="fa-solid fa-filter"></i>
                    Filter
                </button>

                @if(request()->hasAny(['search', 'status', 'payment_status']))
                    <a
                        href="{{ route('admin.order.index') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 px-5 py-2.5 text-xs font-semibold text-slate-500 transition hover:bg-slate-50"
                    >
                        <i class="fa-solid fa-rotate-left"></i>
                        Reset
                    </a>
                @endif

            </form>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead>
                    <tr class="border-b border-slate-100 bg-slate-50/70">

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Pesanan
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Customer
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Item
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Total
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Pembayaran
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Status
                        </th>

                        <th class="px-5 py-4 text-right text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Aksi
                        </th>

                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($orders as $order)

                        <tr class="transition hover:bg-orange-50/40">

                            <td class="px-5 py-4">
                                <div>
                                    <p class="text-sm font-bold text-slate-800">
                                        {{ $order->order_code }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $order->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <div>
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ $order->user->name }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ $order->user->email }}
                                    </p>
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                <span class="text-sm font-semibold text-slate-700">
                                    {{ $order->items->sum('quantity') }}
                                </span>

                                <span class="ml-1 text-xs text-slate-400">
                                    item
                                </span>
                            </td>

                            <td class="px-5 py-4">
                                <span class="whitespace-nowrap text-sm font-bold text-slate-800">
                                    Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                                </span>
                            </td>

                            <td class="px-5 py-4">

                                @if($order->payment_status === 'paid')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Lunas
                                    </span>

                                @elseif($order->payment_status === 'failed')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-600">
                                        Gagal
                                    </span>

                                @elseif($order->payment_status === 'refunded')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-violet-50 px-2.5 py-1 text-xs font-semibold text-violet-600">
                                        Dikembalikan
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-600">
                                        Menunggu
                                    </span>

                                @endif

                            </td>

                            <td class="px-5 py-4">

                                @if($order->status === 'pending')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-600">
                                        Menunggu
                                    </span>

                                @elseif($order->status === 'processing')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-sky-50 px-2.5 py-1 text-xs font-semibold text-sky-600">
                                        Diproses
                                    </span>

                                @elseif($order->status === 'ready')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-violet-50 px-2.5 py-1 text-xs font-semibold text-violet-600">
                                        Siap Diambil
                                    </span>

                                @elseif($order->status === 'completed')

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">
                                        Selesai
                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-600">
                                        Dibatalkan
                                    </span>

                                @endif

                            </td>

                            <td class="px-5 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    <button
                                        type="button"
                                        onclick='openOrderDetail(@json($order))'
                                        class="flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 text-slate-500 transition hover:border-orange-200 hover:bg-orange-50 hover:text-[#c96f32]"
                                        title="Lihat detail"
                                    >
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center">

                                <div class="mx-auto flex max-w-sm flex-col items-center">

                                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50 text-xl text-[#c96f32]">
                                        <i class="fa-solid fa-bag-shopping"></i>
                                    </div>

                                    <h3 class="mt-4 text-sm font-bold text-slate-800">
                                        Belum ada pesanan
                                    </h3>

                                    <p class="mt-1 text-xs leading-5 text-slate-400">
                                        Pesanan yang masuk akan muncul di sini.
                                    </p>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<div
    id="orderDetailModal"
    class="fixed inset-0 z-[100] hidden items-center justify-center bg-slate-900/50 px-4 py-6 backdrop-blur-sm"
>

    <div
        id="orderDetailModalContent"
        class="max-h-[92vh] w-full max-w-2xl scale-95 overflow-y-auto rounded-2xl bg-white shadow-2xl transition-transform duration-200"
    >

        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4 sm:px-6">

            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-[#c96f32]">
                    Detail Pesanan
                </p>

                <h2
                    id="orderDetailCode"
                    class="mt-1 text-lg font-bold text-slate-900"
                >
                    -
                </h2>
            </div>

            <button
                type="button"
                onclick="closeOrderDetail()"
                class="flex h-9 w-9 items-center justify-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-700"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>

        <div class="space-y-5 px-5 py-5 sm:px-6">

            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs text-slate-400">
                        Customer
                    </p>

                    <p id="orderDetailCustomer" class="mt-1 text-sm font-bold text-slate-800">
                        -
                    </p>

                    <p id="orderDetailEmail" class="mt-1 text-xs text-slate-400">
                        -
                    </p>
                </div>

                <div class="rounded-xl bg-slate-50 p-4">
                    <p class="text-xs text-slate-400">
                        Waktu Pesanan
                    </p>

                    <p id="orderDetailDate" class="mt-1 text-sm font-bold text-slate-800">
                        -
                    </p>
                </div>

            </div>

            <div>
                <div class="mb-3 flex items-center justify-between">
                    <h3 class="text-sm font-bold text-slate-800">
                        Item Pesanan
                    </h3>

                    <span
                        id="orderDetailItemCount"
                        class="text-xs text-slate-400"
                    >
                        0 item
                    </span>
                </div>

                <div
                    id="orderDetailItems"
                    class="divide-y divide-slate-100 rounded-xl border border-slate-100"
                ></div>
            </div>

            <div
                id="orderDetailNotesWrapper"
                class="hidden rounded-xl border border-orange-100 bg-orange-50/60 p-4"
            >
                <p class="text-xs font-semibold text-[#c96f32]">
                    Catatan Customer
                </p>

                <p
                    id="orderDetailNotes"
                    class="mt-1 text-sm leading-6 text-slate-600"
                ></p>
            </div>

            <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">

                <div class="rounded-xl border border-slate-100 p-4">
                    <p class="text-xs text-slate-400">
                        Pembayaran
                    </p>

                    <p
                        id="orderDetailPayment"
                        class="mt-1 text-sm font-bold text-slate-800"
                    >
                        -
                    </p>
                </div>

                <div class="rounded-xl border border-slate-100 p-4">
                    <p class="text-xs text-slate-400">
                        Total
                    </p>

                    <p
                        id="orderDetailTotal"
                        class="mt-1 text-lg font-bold text-[#c96f32]"
                    >
                        Rp0
                    </p>
                </div>

            </div>

            <div class="rounded-xl border border-slate-100 bg-slate-50/70 p-4">

                <p class="mb-2 text-xs font-semibold text-slate-500">
                    Status Pesanan
                </p>

                <form
                    id="orderStatusForm"
                    method="POST"
                >
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col gap-3 sm:flex-row">

                        <select
                            id="orderDetailStatus"
                            name="status"
                            class="flex-1 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-medium text-slate-700 outline-none transition focus:border-orange-300 focus:ring-4 focus:ring-orange-50"
                        >
                            <option value="pending">Menunggu</option>
                            <option value="processing">Diproses</option>
                            <option value="ready">Siap Diambil</option>
                            <option value="completed">Selesai</option>
                            <option value="cancelled">Dibatalkan</option>
                        </select>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#c96f32] px-5 py-3 text-sm font-semibold text-white transition hover:bg-[#b85f27]"
                        >
                            <i class="fa-solid fa-check"></i>
                            Perbarui Status
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>
    const orderDetailModal = document.getElementById('orderDetailModal');
    const orderDetailModalContent = document.getElementById('orderDetailModalContent');
    const orderDetailCode = document.getElementById('orderDetailCode');
    const orderDetailCustomer = document.getElementById('orderDetailCustomer');
    const orderDetailEmail = document.getElementById('orderDetailEmail');
    const orderDetailDate = document.getElementById('orderDetailDate');
    const orderDetailItemCount = document.getElementById('orderDetailItemCount');
    const orderDetailItems = document.getElementById('orderDetailItems');
    const orderDetailNotesWrapper = document.getElementById('orderDetailNotesWrapper');
    const orderDetailNotes = document.getElementById('orderDetailNotes');
    const orderDetailPayment = document.getElementById('orderDetailPayment');
    const orderDetailTotal = document.getElementById('orderDetailTotal');
    const orderDetailStatus = document.getElementById('orderDetailStatus');
    const orderStatusForm = document.getElementById('orderStatusForm');

    function formatRupiah(value) {
        return 'Rp' + Number(value).toLocaleString('id-ID');
    }

    function formatDate(dateString) {
        const date = new Date(dateString);

        return date.toLocaleString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    function getPaymentLabel(status) {
        const labels = {
            pending: 'Menunggu',
            paid: 'Lunas',
            failed: 'Gagal',
            refunded: 'Dikembalikan'
        };

        return labels[status] || status;
    }

    function getStatusLabel(status) {
        const labels = {
            pending: 'Menunggu',
            processing: 'Diproses',
            ready: 'Siap Diambil',
            completed: 'Selesai',
            cancelled: 'Dibatalkan'
        };

        return labels[status] || status;
    }

    function openOrderDetail(order) {
        orderDetailCode.textContent = order.order_code;
        orderDetailCustomer.textContent = order.user?.name || '-';
        orderDetailEmail.textContent = order.user?.email || '-';
        orderDetailDate.textContent = formatDate(order.created_at);

        orderDetailItemCount.textContent = `${order.items?.reduce((total, item) => total + Number(item.quantity), 0) || 0} item`;

        orderDetailItems.innerHTML = '';

        if (order.items?.length) {
            order.items.forEach(item => {
                const donutName = item.donut?.name || 'Produk';
                const quantity = Number(item.quantity);
                const price = Number(item.price);
                const subtotal = Number(item.subtotal);

                orderDetailItems.insertAdjacentHTML('beforeend', `
                    <div class="flex items-center justify-between gap-4 px-4 py-3">
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-slate-800">
                                ${donutName}
                            </p>
                            <p class="mt-1 text-xs text-slate-400">
                                ${quantity} x ${formatRupiah(price)}
                            </p>
                        </div>

                        <p class="shrink-0 text-sm font-bold text-slate-800">
                            ${formatRupiah(subtotal)}
                        </p>
                    </div>
                `);
            });
        } else {
            orderDetailItems.innerHTML = `
                <div class="px-4 py-8 text-center text-xs text-slate-400">
                    Tidak ada item pesanan.
                </div>
            `;
        }

        if (order.notes) {
            orderDetailNotesWrapper.classList.remove('hidden');
            orderDetailNotes.textContent = order.notes;
        } else {
            orderDetailNotesWrapper.classList.add('hidden');
            orderDetailNotes.textContent = '';
        }

        orderDetailPayment.textContent = getPaymentLabel(order.payment_status);
        orderDetailTotal.textContent = formatRupiah(order.total_amount);
        orderDetailStatus.value = order.status;
        orderStatusForm.action = "{{ url('admin/pesanan') }}/" + order.id;

        orderDetailModal.classList.remove('hidden');
        orderDetailModal.classList.add('flex');

        requestAnimationFrame(() => {
            orderDetailModalContent.classList.remove('scale-95');
            orderDetailModalContent.classList.add('scale-100');
        });

        document.body.classList.add('overflow-hidden');
    }

    function closeOrderDetail() {
        orderDetailModalContent.classList.remove('scale-100');
        orderDetailModalContent.classList.add('scale-95');

        setTimeout(() => {
            orderDetailModal.classList.add('hidden');
            orderDetailModal.classList.remove('flex');
            document.body.classList.remove('overflow-hidden');
        }, 150);
    }

    orderDetailModal?.addEventListener('click', function(event) {
        if (event.target === orderDetailModal) {
            closeOrderDetail();
        }
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && !orderDetailModal.classList.contains('hidden')) {
            closeOrderDetail();
        }
    });
</script>

@endpush