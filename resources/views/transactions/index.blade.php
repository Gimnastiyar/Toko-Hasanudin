@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-8 flex flex-col md:flex-row justify-between items-end md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Riwayat Transaksi</h1>
                <p class="text-slate-500 dark:text-slate-400 mt-1 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Pantau performa penjualan secara real-time.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('transactions.export') }}"
                    class="inline-flex items-center gap-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 px-5 py-2.5 rounded-xl shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition-all font-semibold text-sm">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export Excel
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div
                class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Total
                        Transaksi</p>
                    <h2 class="text-3xl font-black text-slate-800 dark:text-white">
                        {{ number_format($transactions->count()) }}</h2>
                </div>
                <div
                    class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 118 0m-3.359 4.64L24 20H8l2.359-4.36M16 11l4 8H4l4-8m12 0L12 3l-8 8" />
                    </svg>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Total
                        Pendapatan</p>
                    <h2 class="text-3xl font-black text-emerald-600 dark:text-emerald-400">Rp
                        {{ number_format($transactions->sum('total_price'), 0, ',', '.') }}</h2>
                </div>
                <div
                    class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <div
                class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-1">Produk
                        Terjual</p>
                    <h2 class="text-3xl font-black text-purple-600 dark:text-purple-400">
                        {{ number_format($transactions->getCollection()->sum(function($t) { return $t->details->sum('quantity'); })) }} <span
                            class="text-sm font-medium text-slate-400 dark:text-slate-500">Pcs</span></h2>
                </div>
                <div
                    class="w-12 h-12 bg-purple-50 dark:bg-purple-900/30 rounded-xl flex items-center justify-center text-purple-600 dark:text-purple-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div
                class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r-xl flex items-center gap-3 animate-fade-in-down">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Filter & Search Bar -->
        <div class="mb-6 bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm">
            <form action="{{ route('transactions.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div class="md:col-span-2">
                    <label for="search" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Cari ID / Kasir / Pelanggan</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </span>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Contoh: #00001, Kasir, atau Pelanggan..."
                            class="w-full h-10 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl pl-10 pr-3 text-xs text-slate-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 font-medium">
                    </div>
                </div>

                <div class="md:col-span-1">
                    <label for="date" class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Tanggal</label>
                    <input type="date" name="date" id="date" value="{{ request('date') }}"
                        class="w-full h-10 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl px-3 text-xs text-slate-800 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 font-medium cursor-pointer">
                </div>

                <div class="md:col-span-1 flex gap-2">
                    <button type="submit"
                        class="flex-1 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs h-10 rounded-xl transition-all shadow-sm flex items-center justify-center gap-1.5 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                        Filter
                    </button>
                    @if(request('search') || request('date'))
                        <a href="{{ route('transactions.index') }}"
                            class="flex-1 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 font-bold text-xs h-10 rounded-xl transition-all flex items-center justify-center active:scale-95"
                            title="Reset Filter">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div
            class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto text-slate-600 dark:text-slate-300">
                <table class="w-full text-sm text-left border-collapse">
                    <thead class="bg-slate-50/50 dark:bg-slate-800/80 border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest">Detail Transaksi</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest">Pelanggan</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest">Informasi Produk</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest">Kasir</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest text-center">Jumlah</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest">Subtotal</th>
                            <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest">Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($transactions as $trx)
                            <tr class="hover:bg-indigo-50/30 dark:hover:bg-indigo-900/10 transition-colors group">
                                <td class="px-6 py-4">
                                    <span class="inline-block px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded text-[10px] font-bold mb-1">
                                        #{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <p class="text-xs text-slate-400 dark:text-slate-500 font-medium">
                                        {{ $trx->created_at->format('d M Y') }} • {{ $trx->created_at->format('H:i') }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($trx->customer)
                                        <div class="font-bold text-slate-800 dark:text-white text-xs">
                                            {{ $trx->customer->nama }}
                                        </div>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 mt-1 border border-indigo-100 dark:border-indigo-800/50 uppercase tracking-wider">
                                            {{ $trx->customer->status_customer }}
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400 dark:text-slate-500 font-medium">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-2">
                                        @foreach($trx->details as $detail)
                                            <div class="flex items-center gap-2">
                                                <div class="w-6 h-6 rounded bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400 dark:text-slate-500 text-[10px] font-bold shrink-0">
                                                    {{ substr($detail->product->name ?? '?', 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="font-bold text-slate-800 dark:text-white text-xs">
                                                        {{ $detail->product->name ?? 'Produk Dihapus' }}
                                                        <span class="text-indigo-600 dark:text-indigo-400 font-black ml-1">x{{ $detail->quantity }}</span>
                                                    </p>
                                                    <p class="text-[10px] text-slate-400 dark:text-slate-500 font-mono">@ Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if($trx->discount > 0)
                                            <span class="inline-block mt-1 px-2 py-0.5 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded text-[9px] font-bold self-start">
                                                Diskon: -{{ $trx->discount_type == 'percent' ? $trx->discount . '%' : 'Rp ' . number_format($trx->discount, 0, ',', '.') }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 text-[10px] font-bold">
                                            {{ strtoupper(substr($trx->user->name ?? '?', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-xs font-bold text-slate-700 dark:text-slate-200">
                                                {{ $trx->user->name ?? '-' }}
                                            </p>
                                            <p class="text-[10px] text-slate-400 uppercase font-medium">
                                                {{ $trx->user->role ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center font-bold text-slate-700 dark:text-slate-300">
                                    {{ $trx->details->sum('quantity') }} <span
                                        class="text-[10px] text-slate-400 dark:text-slate-500 font-normal ml-1 whitespace-nowrap">UNIT</span>
                                </td>
                                <td class="px-6 py-4 font-black text-slate-900 dark:text-white">
                                    Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($trx->status == 'success' || $trx->status == 'completed')
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            Selesai
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50 shadow-sm">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Pending
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-20 h-20 bg-slate-50 dark:bg-slate-800/50 rounded-full flex items-center justify-center mb-4">
                                            <svg class="w-10 h-10 text-slate-200 dark:text-slate-700" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                        </div>
                                        <h3 class="text-slate-500 dark:text-slate-400 font-bold">Belum Ada Transaksi</h3>
                                        <p class="text-slate-400 dark:text-slate-500 text-sm">Aktivitas penjualan akan muncul di
                                            sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($transactions->hasPages())
                <div class="px-6 py-5 bg-slate-50/50 dark:bg-slate-800/80 border-t border-slate-200 dark:border-slate-700">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>

    </div>

    <style>
        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.4s ease-out;
        }
    </style>
@endsection