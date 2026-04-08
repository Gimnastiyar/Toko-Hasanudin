@extends('layouts.app')

@section('title', 'Dashboard Overview')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col gap-8">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
        
        <div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                Dashboard Overview
            </h1>
            <div class="text-sm text-slate-500 mt-1.5 flex items-center gap-2.5">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path></svg>
                    Selamat datang kembali!
                </span>
                <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                <span class="font-medium text-slate-600">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>

        <div class="flex items-center gap-3 w-full sm:w-auto">
            <a href="{{ route('products.create') }}"
               class="flex-1 sm:flex-none flex items-center justify-center gap-2 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-200 border border-slate-200 dark:border-slate-700 px-5 py-2.5 rounded-xl shadow-sm transition-all font-medium text-sm focus:ring-4 focus:ring-slate-100">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                Produk Baru
            </a>

            <a href="{{ route('transactions.create') }}"
               class="flex-1 sm:flex-none flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl shadow-sm shadow-indigo-200 transition-all font-medium text-sm focus:ring-4 focus:ring-indigo-500/20 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Transaksi Kasir
            </a>
        </div>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 text-white p-6 rounded-2xl shadow-lg shadow-indigo-200 relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 transform translate-x-4 -translate-y-4 group-hover:scale-110 group-hover:rotate-12 transition-transform duration-500 pointer-events-none">
                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
            </div>
            <div class="relative z-10 flex flex-col h-full justify-between">
                <p class="text-sm text-indigo-100 font-medium tracking-wide uppercase">Total Pendapatan</p>
                <div class="mt-4">
                    <h2 class="text-3xl font-black tracking-tight">Rp {{ number_format($totalRevenue,0,',','.') }}</h2>
                    <p class="text-xs text-indigo-200 mt-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        Akumulasi seluruh transaksi sukses
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-md hover:border-emerald-200 dark:hover:border-emerald-600 transition-all duration-300 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500 dark:text-slate-400 font-bold tracking-wide uppercase mb-4">Keuntungan Bersih</p>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">
                        Rp {{ number_format($totalProfit, 0, ',', '.') }}
                    </h2>
                </div>
                <div class="p-3.5 rounded-2xl bg-emerald-50 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
            <p class="text-xs text-slate-400 mt-3">Pendapatan dikurangi total harga modal</p>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-md hover:border-sky-200 dark:hover:border-sky-600 transition-all duration-300 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500 dark:text-slate-400 font-bold tracking-wide uppercase mb-4">Total Produk Etalase</p>
                    <div class="flex items-baseline gap-2">
                        <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">{{ $totalProducts }}</h2>
                        <span class="text-sm font-semibold text-slate-400">Item</span>
                    </div>
                </div>
                <div class="p-3.5 rounded-2xl bg-sky-50 dark:bg-sky-900/40 text-sky-600 dark:text-sky-400 group-hover:bg-sky-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                </div>
            </div>
            <p class="text-xs text-slate-400 mt-3">Total jenis barang yang terdaftar di sistem</p>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white dark:bg-slate-800 p-6 sm:p-8 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="font-bold text-slate-900 dark:text-white text-lg">Grafik Pendapatan</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Performa penjualan bulanan</p>
                </div>
                <span class="text-xs font-bold bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 px-3 py-1.5 rounded-lg border border-slate-200 dark:border-slate-600">
                    Tahun {{ date('Y') }}
                </span>
            </div>
            
            <div class="relative flex-1 w-full min-h-[300px]">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
                <h3 class="font-bold text-slate-900 dark:text-white">Insight Cepat</h3>
                <p class="text-xs text-slate-500 mt-0.5">Ringkasan aktivitas hari ini</p>
            </div>
            
            <div class="p-6 space-y-4 flex-1 bg-white dark:bg-slate-800">
                
                <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-700 hover:border-indigo-100 dark:hover:border-indigo-800 transition-colors group">
                    <div class="flex items-center gap-4">
                        <div class="p-2.5 bg-white dark:bg-slate-800 shadow-sm text-indigo-600 rounded-xl group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-700 dark:text-slate-200">Produk Terjual</span>
                    </div>
                    <span class="font-black text-indigo-600 text-xl">
                        {{ $recentTransactions->sum('quantity') }}
                    </span>
                </div>

                <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-700 hover:border-emerald-100 dark:hover:border-emerald-800 transition-colors group">
                    <div class="flex items-center gap-4">
                        <div class="p-2.5 bg-white dark:bg-slate-800 shadow-sm text-emerald-600 rounded-xl group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-700 dark:text-slate-200">Transaksi Aktif</span>
                    </div>
                    <span class="font-black text-emerald-600 text-xl">
                        {{ $recentTransactions->count() }}
                    </span>
                </div>

                <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border border-slate-100 dark:border-slate-700 hover:border-purple-100 dark:hover:border-purple-800 transition-colors group">
                    <div class="flex items-center gap-4">
                        <div class="p-2.5 bg-white dark:bg-slate-800 shadow-sm text-purple-600 rounded-xl group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="text-sm font-bold text-slate-700 dark:text-slate-200">Status Mayoritas</span>
                    </div>
                    <span class="font-bold text-purple-700 dark:text-purple-300 text-xs tracking-wider uppercase bg-purple-100 dark:bg-purple-900/30 border border-purple-200 dark:border-purple-800 px-2.5 py-1.5 rounded-lg shadow-sm">
                        Success
                    </span>
                </div>

            </div>
        </div>

    </div>

    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden mb-8">

        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50">
            <div>
                <h3 class="font-bold text-slate-900 dark:text-white">Transaksi Terakhir</h3>
                <p class="text-xs text-slate-500 mt-0.5">Daftar penjualan terbaru di sistem</p>
            </div>
            <a href="{{ route('transactions.index') }}"
               class="text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/40 hover:bg-indigo-100 dark:hover:bg-indigo-900/60 px-4 py-2 rounded-xl flex items-center gap-1.5 transition-colors group">
                Lihat Semua
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white dark:bg-slate-800 border-b border-slate-100 dark:border-slate-700 text-xs uppercase tracking-widest text-slate-400 font-bold">
                        <th class="px-6 py-4">Produk</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4 text-center">Qty</th>
                        <th class="px-6 py-4 text-right">Total Nominal</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700 text-sm">

                    @forelse($recentTransactions as $trx)
                    <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-700/50 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 flex items-center justify-center text-slate-500 dark:text-slate-400 font-bold shrink-0">
                                    {{ substr($trx->product->name ?? '?', 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 dark:text-white">{{ $trx->product->name ?? 'Produk Dihapus' }}</div>
                                    <div class="text-[11px] font-mono text-slate-400 mt-0.5">ID: #TRX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-slate-700 dark:text-slate-300 font-medium">{{ $trx->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-slate-400">{{ $trx->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center">
                                <span class="bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold px-3 py-1 rounded-lg border border-slate-200 dark:border-slate-600">
                                    {{ $trx->quantity }}
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-black text-slate-800 dark:text-slate-100 text-right">
                            Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($trx->status == 'completed' || $trx->status == 'success')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-full bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Sukses
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-bold rounded-full bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                    Pending
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center justify-center text-slate-400 dark:text-slate-500">
                                <div class="w-16 h-16 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-2xl flex items-center justify-center mb-4 shadow-sm">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <h3 class="font-bold text-slate-700 dark:text-slate-300 mb-1">Belum Ada Transaksi</h3>
                                <p class="text-sm">Data transaksi terbaru akan muncul di sini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        
        // Membuat Gradient yang cantik untuk area di bawah kurva garis
        let gradient = ctx.createLinearGradient(0, 0, 0, 350);
        gradient.addColorStop(0, 'rgba(79, 70, 229, 0.4)'); // Indigo-600 transparansi
        gradient.addColorStop(1, 'rgba(79, 70, 229, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: @json($chartData),
                    borderColor: '#4f46e5', // Warna garis Indigo-600
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#4f46e5',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    tension: 0.4, // Melengkungkan garis (spline) secara halus
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, 
                plugins: {
                    legend: { display: false }, // Disembunyikan karena sudah jelas
                    tooltip: {
                        backgroundColor: '#0f172a', // Slate-900
                        padding: 12,
                        cornerRadius: 8,
                        titleFont: { size: 13, family: "'Inter', sans-serif" },
                        bodyFont: { size: 14, family: "'Inter', sans-serif", weight: 'bold' },
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) { label += ': '; }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: { display: false, drawBorder: false }, // Area sumbu X lebih bersih
                        ticks: { font: { family: "'Inter', sans-serif", size: 12 }, color: '#64748b' }
                    },
                    y: {
                        grid: { color: '#f1f5f9', drawBorder: false }, // Garis horizontal sangat tipis
                        beginAtZero: true,
                        ticks: {
                            font: { family: "'Inter', sans-serif", size: 12 }, 
                            color: '#64748b',
                            padding: 10,
                            callback: function(value) {
                                // Memformat angka di sumbu Y (Misal: 1Jt, 500Rb)
                                if (value >= 1000000) return (value / 1000000) + ' Jt';
                                if (value >= 1000) return (value / 1000) + ' Rb';
                                return value;
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
            }
        });
    });
</script>

@endsection