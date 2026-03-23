@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Dashboard
            </h1>

            <p class="text-sm text-slate-500">
                Selamat datang 👋 | {{ date('d M Y') }}
            </p>
        </div>

        <!-- QUICK ACTION -->
        <div class="flex gap-3">
            <a href="{{ route('transactions.create') }}"
               class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:scale-105 transition">
                ➕ Transaksi
            </a>

            <a href="{{ route('products.create') }}"
               class="bg-emerald-500 text-white px-4 py-2 rounded-lg shadow hover:scale-105 transition">
                📦 Produk
            </a>
        </div>

    </div>


    <!-- STATISTIC -->
    <div class="grid md:grid-cols-3 gap-6 mb-8">

        <!-- REVENUE -->
        <div class="bg-gradient-to-r from-emerald-500 to-emerald-700 text-white p-6 rounded-2xl shadow-lg">
            <p class="text-sm opacity-80">Total Pendapatan</p>
            <h2 class="text-3xl font-bold mt-2">
                Rp {{ number_format($totalRevenue,0,',','.') }}
            </h2>
        </div>

        <!-- PRODUCT -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-700 text-white p-6 rounded-2xl shadow-lg">
            <p class="text-sm opacity-80">Total Produk</p>
            <h2 class="text-3xl font-bold mt-2">
                {{ $totalProducts }}
            </h2>
        </div>

        <!-- STOCK -->
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white p-6 rounded-2xl shadow-lg">
            <p class="text-sm opacity-80">Total Stok</p>
            <h2 class="text-3xl font-bold mt-2">
                {{ $totalStock }}
            </h2>
        </div>

    </div>


    <!-- CHART + SIDE -->
    <div class="grid md:grid-cols-3 gap-6 mb-8">

        <!-- CHART -->
        <div class="md:col-span-2 bg-white p-6 rounded-2xl shadow border">

            <h3 class="font-semibold text-slate-700 mb-4">
                Grafik Pendapatan Bulanan
            </h3>

            <canvas id="revenueChart"></canvas>

        </div>

        <!-- QUICK INFO -->
        <div class="bg-white p-6 rounded-2xl shadow border">

            <h3 class="font-semibold text-slate-700 mb-4">
                Insight Cepat
            </h3>

            <div class="space-y-4 text-sm">

                <div class="flex justify-between">
                    <span class="text-slate-500">Produk Terjual</span>
                    <span class="font-bold text-indigo-600">
                        {{ $recentTransactions->sum('quantity') }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Transaksi Hari Ini</span>
                    <span class="font-bold text-emerald-600">
                        {{ $recentTransactions->count() }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-slate-500">Status Terbanyak</span>
                    <span class="font-bold text-purple-600">
                        Success
                    </span>
                </div>

            </div>

        </div>

    </div>


    <!-- TRANSAKSI -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <div class="px-6 py-4 border-b flex justify-between items-center">

            <h3 class="font-bold text-slate-800">
                Transaksi Terakhir
            </h3>

            <a href="{{ route('transactions.index') }}"
               class="text-sm bg-indigo-500 text-white px-3 py-1 rounded hover:bg-indigo-600">
                Lihat Semua
            </a>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
                    <tr>
                        <th class="px-6 py-4">Produk</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4">Qty</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                @forelse($recentTransactions as $trx)

                <tr class="hover:bg-slate-50">

                    <td class="px-6 py-4 font-medium text-slate-800">
                        {{ $trx->product->name }}
                    </td>

                    <td class="px-6 py-4 text-slate-500 text-xs">
                        {{ $trx->created_at->format('d M Y') }}
                    </td>

                    <td class="px-6 py-4 font-bold">
                        {{ $trx->quantity }}
                    </td>

                    <td class="px-6 py-4 font-bold text-indigo-600">
                        Rp {{ number_format($trx->total_price,0,',','.') }}
                    </td>

                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs rounded-full
                        {{ $trx->status == 'completed'
                            ? 'bg-emerald-100 text-emerald-700'
                            : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($trx->status) }}
                        </span>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center py-10 text-slate-400">
                        Belum ada transaksi
                    </td>
                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('revenueChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($months),
        datasets: [{
            label: 'Pendapatan',
            data: @json($chartData),
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99,102,241,0.15)',
            borderWidth: 3,
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: true }
        }
    }
});

</script>

@endsection