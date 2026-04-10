@extends('layouts.kasir')

@section('title', 'Dashboard Kasir')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 flex flex-col gap-8">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-6">
        <div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                Selamat Datang, {{ auth()->user()->name }}!
            </h1>
            <div class="text-sm text-slate-500 mt-1.5 flex items-center gap-2.5">
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path></svg>
                    Panel Kasir
                </span>
                <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                <span class="font-medium text-slate-600">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>

        <a href="{{ route('kasir.transaksi') }}"
           class="flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl shadow-lg shadow-emerald-200 dark:shadow-none transition-all font-bold text-sm hover:-translate-y-0.5 active:translate-y-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Transaksi Baru
        </a>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-gradient-to-br from-emerald-600 to-teal-700 text-white p-6 rounded-2xl shadow-lg shadow-emerald-200 dark:shadow-none relative overflow-hidden group">
            <div class="absolute top-0 right-0 p-4 opacity-10 transform translate-x-4 -translate-y-4 group-hover:scale-110 group-hover:rotate-12 transition-transform duration-500 pointer-events-none">
                <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
            </div>
            <div class="relative z-10">
                <p class="text-sm text-emerald-100 font-medium tracking-wide uppercase">Pendapatan Hari Ini</p>
                <h2 class="text-3xl font-black tracking-tight mt-3">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</h2>
                <p class="text-xs text-emerald-200 mt-1 flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-md transition-all duration-300 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500 font-bold tracking-wide uppercase mb-4">Transaksi Hari Ini</p>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">{{ $todayTransactions }}</h2>
                </div>
                <div class="p-3.5 rounded-2xl bg-sky-50 dark:bg-sky-900/40 text-sky-600 dark:text-sky-400 group-hover:bg-sky-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
            </div>
            <p class="text-xs text-slate-400 mt-3">Jumlah transaksi yang kamu lakukan hari ini</p>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-md transition-all duration-300 group">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm text-slate-500 font-bold tracking-wide uppercase mb-4">Total Transaksi</p>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white tracking-tight">{{ $totalTransactions }}</h2>
                </div>
                <div class="p-3.5 rounded-2xl bg-purple-50 dark:bg-purple-900/40 text-purple-600 dark:text-purple-400 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300 shadow-sm">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
            <p class="text-xs text-slate-400 mt-3">Seluruh transaksi yang pernah kamu lakukan</p>
        </div>

    </div>

    <!-- Transaksi Terakhir -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">

        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center bg-slate-50/50 dark:bg-slate-800/50">
            <div>
                <h3 class="font-bold text-slate-900 dark:text-white">Transaksi Terakhir</h3>
                <p class="text-xs text-slate-500 mt-0.5">Riwayat 5 transaksi terakhir Anda</p>
            </div>
            <a href="{{ route('kasir.transaksi') }}"
               class="text-sm font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 bg-emerald-50 dark:bg-emerald-900/40 hover:bg-emerald-100 px-4 py-2 rounded-xl flex items-center gap-1.5 transition-colors group">
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
                        <th class="px-6 py-4 text-right">Total</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700 text-sm">

                    @forelse($recentTransactions as $trx)
                    <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-700/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 flex items-center justify-center text-slate-500 font-bold shrink-0">
                                    {{ substr($trx->product->name ?? '?', 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900 dark:text-white">{{ $trx->product->name ?? 'Produk Dihapus' }}</div>
                                    <div class="text-[11px] font-mono text-slate-400 mt-0.5">#TRX-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-slate-700 dark:text-slate-300 font-medium">{{ $trx->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-slate-400">{{ $trx->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-200 font-bold px-3 py-1 rounded-lg border border-slate-200 dark:border-slate-600">
                                {{ $trx->quantity }}
                            </span>
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
                            <div class="flex flex-col items-center text-slate-400">
                                <div class="w-16 h-16 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-2xl flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <h3 class="font-bold text-slate-700 dark:text-slate-300 mb-1">Belum Ada Transaksi</h3>
                                <p class="text-sm">Mulai transaksi pertamamu hari ini!</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
