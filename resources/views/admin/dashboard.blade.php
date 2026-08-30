@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="space-y-6">

<div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
    <div>
        <p class="text-sm font-medium text-orange-500">
            Nona Donat
        </p>

        <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
            Dashboard
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Pantau pesanan, penjualan, dan aktivitas toko hari ini.
        </p>
    </div>

    <div class="flex items-center gap-2 rounded-xl border border-orange-100 bg-white px-4 py-2.5 shadow-sm">
        <i class="fa-regular fa-calendar text-orange-500"></i>
        <span class="text-sm font-medium text-slate-600">
            {{ now()->translatedFormat('d F Y') }}
        </span>
    </div>
</div>

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

    <div class="rounded-2xl border border-orange-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">
                    Total Pesanan
                </p>

                <h3 class="mt-2 text-2xl font-bold text-slate-900">
                    128
                </h3>

                <div class="mt-2 flex items-center gap-1.5 text-xs font-semibold text-emerald-600">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    <span>12.5% dari bulan lalu</span>
                </div>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                <i class="fa-solid fa-bag-shopping text-lg"></i>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-amber-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">
                    Pesanan Pending
                </p>

                <h3 class="mt-2 text-2xl font-bold text-slate-900">
                    18
                </h3>

                <p class="mt-2 text-xs font-medium text-amber-600">
                    Perlu diproses
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-500">
                <i class="fa-solid fa-clock text-lg"></i>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-emerald-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">
                    Pesanan Selesai
                </p>

                <h3 class="mt-2 text-2xl font-bold text-slate-900">
                    96
                </h3>

                <p class="mt-2 text-xs font-medium text-emerald-600">
                    75% dari total pesanan
                </p>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-500">
                <i class="fa-solid fa-circle-check text-lg"></i>
            </div>
        </div>
    </div>

    <div class="rounded-2xl border border-sky-100 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-sm font-medium text-slate-500">
                    Pendapatan
                </p>

                <h3 class="mt-2 text-2xl font-bold text-slate-900">
                    Rp8,45jt
                </h3>

                <div class="mt-2 flex items-center gap-1.5 text-xs font-semibold text-emerald-600">
                    <i class="fa-solid fa-arrow-trend-up"></i>
                    <span>8.2% bulan ini</span>
                </div>
            </div>

            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-50 text-sky-500">
                <i class="fa-solid fa-wallet text-lg"></i>
            </div>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm xl:col-span-2">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">
                    Penjualan
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Performa penjualan 7 hari terakhir
                </p>
            </div>

            <select class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600 outline-none focus:border-orange-300 focus:ring-2 focus:ring-orange-100">
                <option>7 Hari</option>
                <option>30 Hari</option>
                <option>3 Bulan</option>
            </select>
        </div>

        <div class="mt-6 h-72">
            <canvas id="salesChart"></canvas>
        </div>

    </div>

    <div class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">

        <div>
            <h2 class="text-base font-bold text-slate-900">
                Status Pesanan
            </h2>

            <p class="mt-1 text-xs text-slate-500">
                Ringkasan pesanan saat ini
            </p>
        </div>

        <div class="mt-6 flex justify-center">
            <div class="relative h-48 w-48">
                <canvas id="orderStatusChart"></canvas>
            </div>
        </div>

        <div class="mt-6 space-y-3">

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-amber-400"></span>
                    <span class="text-sm text-slate-600">Pending</span>
                </div>

                <span class="text-sm font-semibold text-slate-900">
                    18
                </span>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-sky-400"></span>
                    <span class="text-sm text-slate-600">Diproses</span>
                </div>

                <span class="text-sm font-semibold text-slate-900">
                    14
                </span>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-emerald-400"></span>
                    <span class="text-sm text-slate-600">Selesai</span>
                </div>

                <span class="text-sm font-semibold text-slate-900">
                    96
                </span>
            </div>

        </div>

    </div>

</div>

<div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

    <div class="rounded-2xl border border-slate-100 bg-white shadow-sm xl:col-span-2">

        <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
            <div>
                <h2 class="text-base font-bold text-slate-900">
                    Pesanan Terbaru
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Pesanan terakhir yang masuk
                </p>
            </div>

            <a href="#" class="text-xs font-semibold text-orange-500 transition hover:text-orange-600">
                Lihat Semua
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-slate-100">
                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Pesanan
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Customer
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Total
                        </th>

                        <th class="px-5 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-400">
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    <tr class="transition hover:bg-orange-50/40">
                        <td class="px-5 py-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">
                                    #ND-1028
                                </p>
                                <p class="mt-1 text-xs text-slate-400">
                                    10 menit lalu
                                </p>
                            </div>
                        </td>

                        <td class="px-5 py-4">
                            <span class="text-sm text-slate-600">
                                Aulia
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <span class="text-sm font-semibold text-slate-800">
                                Rp85.000
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <span class="inline-flex items-center rounded-full bg-amber-50 px-2.5 py-1 text-xs font-semibold text-amber-600">
                                Pending
                            </span>
                        </td>
                    </tr>

                    <tr class="transition hover:bg-orange-50/40">
                        <td class="px-5 py-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">
                                    #ND-1027
                                </p>
                                <p class="mt-1 text-xs text-slate-400">
                                    24 menit lalu
                                </p>
                            </div>
                        </td>

                        <td class="px-5 py-4">
                            <span class="text-sm text-slate-600">
                                Raka
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <span class="text-sm font-semibold text-slate-800">
                                Rp120.000
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <span class="inline-flex items-center rounded-full bg-sky-50 px-2.5 py-1 text-xs font-semibold text-sky-600">
                                Diproses
                            </span>
                        </td>
                    </tr>

                    <tr class="transition hover:bg-orange-50/40">
                        <td class="px-5 py-4">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">
                                    #ND-1026
                                </p>
                                <p class="mt-1 text-xs text-slate-400">
                                    1 jam lalu
                                </p>
                            </div>
                        </td>

                        <td class="px-5 py-4">
                            <span class="text-sm text-slate-600">
                                Nabila
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <span class="text-sm font-semibold text-slate-800">
                                Rp64.000
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-600">
                                Selesai
                            </span>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </div>

    <div class="rounded-2xl border border-slate-100 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">
            <h2 class="text-base font-bold text-slate-900">
                Produk Terlaris
            </h2>

            <p class="mt-1 text-xs text-slate-500">
                Produk dengan penjualan tertinggi
            </p>
        </div>

        <div class="space-y-4 p-5">

            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-orange-50 text-orange-500">
                    <i class="fa-solid fa-cookie-bite"></i>
                </div>

                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-semibold text-slate-800">
                        Donat Cokelat
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        84 terjual
                    </p>
                </div>

                <span class="text-sm font-bold text-slate-900">
                    Rp12jt
                </span>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-pink-50 text-pink-500">
                    <i class="fa-solid fa-cookie-bite"></i>
                </div>

                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-semibold text-slate-800">
                        Donat Strawberry
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        67 terjual
                    </p>
                </div>

                <span class="text-sm font-bold text-slate-900">
                    Rp9,8jt
                </span>
            </div>

            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-yellow-50 text-yellow-500">
                    <i class="fa-solid fa-cookie-bite"></i>
                </div>

                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-semibold text-slate-800">
                        Donat Keju
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        51 terjual
                    </p>
                </div>

                <span class="text-sm font-bold text-slate-900">
                    Rp7,2jt
                </span>
            </div>

        </div>

    </div>

</div>

</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const salesChart = document.getElementById('salesChart');

    if (salesChart) {
        new Chart(salesChart, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    data: [850000, 1200000, 950000, 1450000, 1100000, 1750000, 2150000],
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp' + (value / 1000000).toFixed(1) + 'jt';
                            }
                        }
                    }
                }
            }
        });
    }

    const orderStatusChart = document.getElementById('orderStatusChart');

    if (orderStatusChart) {
        new Chart(orderStatusChart, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Diproses', 'Selesai'],
                datasets: [{
                    data: [18, 14, 96],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    }
</script>

@endpush
