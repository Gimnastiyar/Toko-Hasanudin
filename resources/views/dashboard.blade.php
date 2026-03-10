@extends('layouts.app')

@section('content')

<!-- ===============================
HEADER DASHBOARD
=============================== -->

<div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Dashboard
        </h1>

        <p class="text-sm text-slate-500">
            Ringkasan aktivitas Toko Hasan
        </p>
    </div>

</div>


<!-- ===============================
STATISTIC CARDS
=============================== -->

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    <!-- TOTAL PENDAPATAN -->
    <div class="bg-gradient-to-r from-emerald-500 to-emerald-700 
                text-white rounded-xl p-6 shadow-lg 
                hover:scale-105 transition duration-300">

        <p class="text-sm opacity-80">Total Pendapatan</p>

        <p class="text-3xl font-bold mt-2">
            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
        </p>

    </div>


    <!-- TOTAL PRODUK -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 
                text-white rounded-xl p-6 shadow-lg 
                hover:scale-105 transition duration-300">

        <p class="text-sm opacity-80">Total Produk</p>

        <p class="text-3xl font-bold mt-2">
            {{ $totalProducts }} Item
        </p>

    </div>


    <!-- TOTAL STOK -->
    <div class="bg-gradient-to-r from-orange-500 to-orange-600 
                text-white rounded-xl p-6 shadow-lg 
                hover:scale-105 transition duration-300">

        <p class="text-sm opacity-80">Total Stok</p>

        <p class="text-3xl font-bold mt-2">
            {{ $totalStock }} Unit
        </p>

    </div>

</div>



<!-- ===============================
GRAFIK PENJUALAN
=============================== -->

<div class="bg-white rounded-xl shadow-lg p-6 mb-8">

    <h3 class="text-lg font-bold text-slate-800 mb-4">
        Grafik Pendapatan Bulanan ({{ date('Y') }})
    </h3>

    <div class="h-80">

        <canvas id="revenueChart"></canvas>

    </div>

</div>



<!-- ===============================
TRANSAKSI TERAKHIR
=============================== -->

<div class="bg-white rounded-xl shadow-lg overflow-hidden">

    <div class="px-6 py-4 border-b flex justify-between items-center">

        <h3 class="font-bold text-slate-800">
            Transaksi Terakhir
        </h3>

        <a href="{{ route('transactions.index') }}"
           class="text-sm bg-emerald-500 text-white px-3 py-1 rounded hover:bg-emerald-600 transition">

            Lihat Semua

        </a>

    </div>


    <div class="overflow-x-auto">

        <table class="w-full text-left">

            <thead class="bg-slate-100 text-slate-600 text-xs uppercase">

                <tr>

                    <th class="px-6 py-3">Produk</th>

                    <th class="px-6 py-3">Tanggal</th>

                    <th class="px-6 py-3">Jumlah</th>

                    <th class="px-6 py-3">Total</th>

                    <th class="px-6 py-3">Status</th>

                </tr>

            </thead>


            <tbody class="divide-y">

                @forelse($recentTransactions as $trx)

                <tr class="hover:bg-emerald-50 transition">

                    <td class="px-6 py-4 font-medium text-slate-700">
                        {{ $trx->product->name }}
                    </td>

                    <td class="px-6 py-4 text-slate-500 text-sm">
                        {{ $trx->created_at->format('d M Y') }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $trx->quantity }}
                    </td>

                    <td class="px-6 py-4 font-bold text-slate-800">
                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
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

                    <td colspan="5"
                        class="px-6 py-8 text-center text-slate-400">

                        Belum ada transaksi.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>



<!-- ===============================
CHART JS SCRIPT
=============================== -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('revenueChart').getContext('2d');

const labels = @json($months);
const data = @json($chartData);

new Chart(ctx, {

type: 'line',

data: {

labels: labels,

datasets: [{

label: 'Pendapatan (Rp)',

data: data,

borderColor: '#10b981',

backgroundColor: 'rgba(16,185,129,0.15)',

borderWidth: 3,

tension: 0.4,

fill: true,

pointBackgroundColor: '#ffffff',

pointBorderColor: '#10b981',

pointRadius: 5

}]

},

options: {

responsive: true,

plugins: {

legend: {
display: true
}

},

scales: {

y: {

beginAtZero: true

}

}

}

});

</script>

@endsection