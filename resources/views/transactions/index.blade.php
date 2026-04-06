@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-8 flex flex-col md:flex-row justify-between items-end md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Riwayat Transaksi</h1>
            <p class="text-slate-500 mt-1 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Pantau performa penjualan secara real-time.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('transactions.export') }}"
               class="inline-flex items-center gap-2 bg-white border border-slate-200 text-slate-700 px-5 py-2.5 rounded-xl shadow-sm hover:bg-slate-50 transition-all font-semibold text-sm">
                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Export Excel
            </a>

            <a href="{{ route('transactions.create') }}"
               class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-xl shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:shadow-indigo-300 transition-all font-semibold text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Transaksi Baru
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Transaksi</p>
                <h2 class="text-3xl font-black text-slate-800">{{ number_format($transactions->count()) }}</h2>
            </div>
            <div class="w-12 h-12 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 118 0m-3.359 4.64L24 20H8l2.359-4.36M16 11l4 8H4l4-8m12 0L12 3l-8 8"/></svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Pendapatan</p>
                <h2 class="text-3xl font-black text-emerald-600">Rp {{ number_format($transactions->sum('total_price'), 0, ',', '.') }}</h2>
            </div>
            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Produk Terjual</p>
                <h2 class="text-3xl font-black text-purple-600">{{ number_format($transactions->sum('quantity')) }} <span class="text-sm font-medium text-slate-400">Pcs</span></h2>
            </div>
            <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center text-purple-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r-xl flex items-center gap-3 animate-fade-in-down">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto text-slate-600">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-slate-50/50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest">Detail Transaksi</th>
                        <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest">Informasi Produk</th>
                        <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest text-center">Jumlah</th>
                        <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest">Subtotal</th>
                        <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest">Status Pembayaran</th>
                        <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest text-right">Invoice</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($transactions as $trx)
                    <tr class="hover:bg-indigo-50/30 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="inline-block px-2 py-1 bg-slate-100 text-slate-600 rounded text-[10px] font-bold mb-1">
                                #{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                            <p class="text-xs text-slate-400 font-medium">
                                {{ $trx->created_at->format('d M Y') }} • {{ $trx->created_at->format('H:i') }}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-white transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 tracking-tight">{{ $trx->product->name }}</p>
                                    @if($trx->discount > 0)
    <span class="inline-block mt-1 px-2 py-1 bg-red-100 text-red-600 rounded text-[10px] font-bold">
        -{{ $trx->discount_type == 'percent'
            ? $trx->discount.'%'
            : 'Rp '.number_format($trx->discount,0,',','.') }}
    </span>
@endif
                                    <p class="text-[11px] text-slate-400">@ Rp {{ number_format($trx->product->price,0,',','.') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-bold text-slate-700">
                            {{ $trx->quantity }} <span class="text-[10px] text-slate-400 font-normal ml-1 whitespace-nowrap">UNIT</span>
                        </td>
                        <td class="px-6 py-4 font-black text-slate-900">
                            Rp {{ number_format($trx->total_price,0,',','.') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($trx->status == 'success')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-emerald-100 text-emerald-700 border border-emerald-200 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-amber-100 text-amber-700 border border-amber-200 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('transactions.print',$trx->id) }}"
                               target="_blank"
                               class="inline-flex items-center justify-center w-10 h-10 bg-white border border-slate-200 text-slate-500 rounded-xl hover:text-indigo-600 hover:border-indigo-200 hover:bg-indigo-50 transition-all shadow-sm active:scale-90">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                </div>
                                <h3 class="text-slate-500 font-bold">Belum Ada Transaksi</h3>
                                <p class="text-slate-400 text-sm">Aktivitas penjualan akan muncul di sini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
        <div class="px-6 py-5 bg-slate-50/50 border-t border-slate-200">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>

</div>

<style>
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-down { animation: fade-in-down 0.4s ease-out; }
</style>
@endsection