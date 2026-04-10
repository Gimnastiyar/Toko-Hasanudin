@extends('layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10 antialiased font-sans text-slate-800 dark:text-slate-200">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-6 print:mb-8">
        <div>
            <div class="flex items-center gap-2.5 mb-2.5 print:hidden">
                <span class="flex h-2.5 w-2.5 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Dashboard Keuangan</span>
            </div>
            
            <h1 class="text-3xl lg:text-4xl font-black text-slate-900 dark:text-white tracking-tight print:hidden">Ringkasan Laporan</h1>
            
            <div class="hidden print:block">
                <h1 class="text-3xl font-black text-slate-900 uppercase tracking-widest border-b-2 border-slate-900 pb-2 mb-2">Laporan Keuangan</h1>
                <p class="text-sm text-slate-600 font-bold">PT. TOKO HASAN SEJAHTERA</p>
            </div>

            <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm font-medium">Periode Laporan: <span class="font-bold text-slate-800 dark:text-slate-200 bg-slate-100 dark:bg-slate-800 px-2 py-1 rounded-md print:bg-transparent print:px-0">{{ $startDate->format('d M Y') }} — {{ $endDate->format('d M Y') }}</span></p>
        </div>

        <div class="flex items-center gap-3 w-full md:w-auto print:hidden">
            <button onclick="window.print()" class="w-full md:w-auto group inline-flex items-center justify-center bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-6 py-2.5 rounded-xl text-sm font-bold text-slate-700 dark:text-slate-300 shadow-sm hover:shadow-md hover:border-slate-300 dark:hover:border-slate-600 transition-all focus:ring-4 focus:ring-slate-100 dark:focus:ring-slate-700 active:scale-95">
                <svg class="w-5 h-5 mr-2.5 text-slate-400 dark:text-slate-500 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Dokumen
            </button>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-2.5 mb-10 print:hidden relative z-10">
        <form action="{{ route('reports.index') }}" method="GET" class="flex flex-col lg:flex-row items-center gap-2.5">
            
            <div class="flex-1 w-full flex flex-col sm:flex-row items-center gap-2 bg-slate-50/80 dark:bg-slate-900/50 p-1.5 rounded-xl border border-slate-100 dark:border-slate-700">
                <div class="relative w-full flex items-center bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-600 hover:border-indigo-300 dark:hover:border-indigo-500 focus-within:ring-2 focus-within:ring-indigo-100 dark:focus-within:ring-indigo-900 focus-within:border-indigo-400 transition-all group">
                    <div class="pl-4 pr-2 text-slate-400 dark:text-slate-500 group-focus-within:text-indigo-500 dark:group-focus-within:text-indigo-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="flex flex-col flex-1 py-1.5 pr-3">
                        <label class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest leading-none mb-0.5">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="w-full border-0 p-0 text-sm font-bold text-slate-700 dark:text-white focus:ring-0 bg-transparent cursor-pointer [color-scheme:light] dark:[color-scheme:dark]">
                    </div>
                </div>

                <div class="hidden sm:flex items-center justify-center text-slate-300 dark:text-slate-600 px-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>

                <div class="relative w-full flex items-center bg-white dark:bg-slate-800 rounded-lg border border-slate-200 dark:border-slate-600 hover:border-indigo-300 dark:hover:border-indigo-500 focus-within:ring-2 focus-within:ring-indigo-100 dark:focus-within:ring-indigo-900 focus-within:border-indigo-400 transition-all group">
                    <div class="pl-4 pr-2 text-slate-400 dark:text-slate-500 group-focus-within:text-indigo-500 dark:group-focus-within:text-indigo-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div class="flex flex-col flex-1 py-1.5 pr-3">
                        <label class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest leading-none mb-0.5">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="w-full border-0 p-0 text-sm font-bold text-slate-700 dark:text-white focus:ring-0 bg-transparent cursor-pointer [color-scheme:light] dark:[color-scheme:dark]">
                    </div>
                </div>
            </div>

            <div class="flex w-full lg:w-auto gap-2 px-1">
                <button type="submit" class="flex-1 lg:flex-none inline-flex justify-center items-center bg-slate-900 dark:bg-indigo-600 text-white px-8 py-3.5 rounded-xl hover:bg-indigo-600 dark:hover:bg-indigo-700 transition-colors font-bold text-sm shadow-md">
                    Terapkan Filter
                </button>
                <a href="{{ route('reports.index') }}" class="inline-flex justify-center items-center p-3.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-600 text-slate-400 dark:text-slate-500 hover:bg-red-50 dark:hover:bg-red-900/30 hover:text-red-500 dark:hover:text-red-400 hover:border-red-200 dark:hover:border-red-800/50 rounded-xl transition-all" title="Reset Filter">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </a>
            </div>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 print:gap-4 print:mb-8">
        
        <div class="bg-white dark:bg-slate-800 p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm relative overflow-hidden group hover:border-indigo-200 dark:hover:border-indigo-500 transition-colors">
            <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 dark:group-hover:opacity-20 transition-opacity pointer-events-none">
                <svg class="w-24 h-24 text-indigo-900 dark:text-indigo-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>
            </div>
            <p class="text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-3">Total Omzet</p>
            <div class="flex items-baseline gap-2 relative z-10 flex-wrap">
                <span class="text-lg font-bold text-slate-400 dark:text-slate-500">Rp</span>
                <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-slate-900 dark:text-white tabular-nums tracking-tighter break-words">
                    {{ number_format($totalRevenue,0,',','.') }}
                </h2>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-800 p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-sm relative overflow-hidden group hover:border-slate-300 dark:hover:border-slate-500 transition-colors">
            <p class="text-sm font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-3">Total Modal (HPP)</p>
            <div class="flex items-baseline gap-2 relative z-10 flex-wrap">
                <span class="text-lg font-bold text-slate-400 dark:text-slate-500">Rp</span>
                <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-slate-700 dark:text-slate-200 tabular-nums tracking-tighter break-words">
                    {{ number_format($totalCost,0,',','.') }}
                </h2>
            </div>
        </div>

        <div class="print:hidden bg-slate-900 p-6 sm:p-8 rounded-3xl shadow-xl shadow-slate-900/20 border border-slate-800 relative overflow-hidden group">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-indigo-500/10"></div>
            <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:opacity-20 transition-opacity">
                <svg class="w-32 h-32 text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
            </div>
            <div class="relative z-10">
                <div class="flex justify-between items-start mb-3">
                    <p class="text-sm font-bold text-emerald-400 uppercase tracking-widest">Laba Bersih</p>
                    @php $margin = $totalRevenue > 0 ? ($netProfit / $totalRevenue) * 100 : 0; @endphp
                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                        {{ round($margin, 1) }}% Margin
                    </span>
                </div>
                <div class="flex items-baseline gap-2 flex-wrap">
                    <span class="text-lg font-bold text-slate-400">Rp</span>
                    <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-white tabular-nums tracking-tighter break-words">
                        {{ number_format($netProfit,0,',','.') }}
                    </h2>
                </div>
            </div>
        </div>

        <div class="hidden print:block bg-white p-6 rounded-3xl border-2 border-slate-800 relative overflow-hidden">
            <div class="flex justify-between items-start mb-2">
                <p class="text-sm font-bold text-slate-800 uppercase tracking-widest">Laba Bersih</p>
                <span class="text-xs font-bold text-slate-600">
                    Margin: {{ round($margin, 1) }}%
                </span>
            </div>
            <div class="flex items-baseline gap-2 flex-wrap">
                <span class="text-lg font-bold text-slate-600">Rp</span>
                <h2 class="text-3xl lg:text-4xl xl:text-5xl font-black text-slate-900 tabular-nums tracking-tighter break-words">
                    {{ number_format($netProfit,0,',','.') }}
                </h2>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 print:block print:space-y-8">
        
        <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col overflow-hidden print:shadow-none print:border-none">
            <div class="px-6 py-6 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/80 print:bg-transparent print:px-0 print:border-b-2 print:border-slate-800">
                <h3 class="font-black text-slate-800 dark:text-white text-xl uppercase tracking-tight">Rincian Penjualan</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 font-bold mt-1 print:hidden">Detail per item pada periode terpilih</p>
            </div>

            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white border-b border-slate-200 text-slate-400 text-xs uppercase tracking-widest">
                            <th class="px-6 py-5 font-bold w-32 print:px-2">Tanggal</th>
                            <th class="px-6 py-5 font-bold print:px-2">Produk</th>
                            <th class="px-6 py-5 font-bold text-right print:px-2">Harga</th>
                            <th class="px-6 py-5 font-bold text-center print:px-2">Qty</th>
                            <th class="px-6 py-5 font-bold text-right print:px-2">Profit</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($transactions as $trx)
                        @php
                            $profit = ($trx->product->price - $trx->product->cost_price) * $trx->quantity;
                        @endphp
                        <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-700/50 transition-colors group">
                            <td class="px-6 py-5 whitespace-nowrap print:px-2">
                                <div class="text-sm font-bold text-slate-700 dark:text-slate-300">{{ $trx->created_at->format('d M Y') }}</div>
                                <div class="text-xs text-slate-400 dark:text-slate-500 mt-0.5 print:hidden">{{ $trx->created_at->format('H:i') }} WIB</div>
                            </td>
                            <td class="px-6 py-5 print:px-2">
                                <span class="text-sm font-bold text-slate-800 dark:text-white">{{ $trx->product->name }}</span>
                            </td>
                            <td class="px-6 py-5 text-right print:px-2">
                                <span class="text-sm text-slate-600 dark:text-slate-400 font-mono tabular-nums">{{ number_format($trx->product->price,0,',','.') }}</span>
                            </td>
                            <td class="px-6 py-5 text-center print:px-2">
                                <span class="inline-flex items-center justify-center min-w-[2.5rem] px-2 py-1 rounded-md text-sm font-bold bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-slate-600 print:bg-transparent print:border-none">
                                    {{ $trx->quantity }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-right print:px-2">
                                <span class="text-sm font-bold text-emerald-600 dark:text-emerald-400 font-mono tabular-nums print:text-slate-900">
                                    +{{ number_format($profit,0,',','.') }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center text-slate-400">
                                    <svg class="w-16 h-16 mb-4 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <p class="text-base font-bold text-slate-500">Tidak ada transaksi pada periode ini.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex flex-col gap-8 print:mt-10">
            
            <div class="bg-amber-50/70 dark:bg-amber-900/10 p-6 sm:p-8 rounded-3xl border border-amber-200 dark:border-amber-800/50 shadow-sm relative overflow-hidden group hover:border-amber-300 dark:hover:border-amber-700 transition-colors print:bg-white print:border-slate-200">
                <div class="absolute -right-6 -top-6 opacity-5 group-hover:opacity-10 transition-opacity pointer-events-none">
                    <svg class="w-32 h-32 text-amber-500" fill="currentColor" viewBox="0 0 24 24"><path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"/></svg>
                </div>
                <p class="text-sm font-bold text-amber-600 dark:text-amber-500 uppercase tracking-widest mb-3 print:text-slate-500">Total Diskon</p>
                <div class="flex items-baseline gap-2 relative z-10 flex-wrap">
                    <span class="text-lg font-bold text-amber-500 print:text-slate-500">Rp</span>
                    <h2 class="text-3xl lg:text-4xl font-black text-amber-700 dark:text-amber-500 tabular-nums tracking-tighter break-words print:text-slate-900">
                        {{ number_format($totalDiscount,0,',','.') }}
                    </h2>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col flex-1 overflow-hidden print:shadow-none print:border-none">
                
                <div class="px-6 py-6 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/80 print:bg-transparent print:px-0 print:border-b-2 print:border-slate-800">
                    <h3 class="font-black text-slate-800 dark:text-white text-xl uppercase tracking-tight">Kewajiban Hutang</h3>
                </div>

                <div class="p-6 bg-red-50/40 dark:bg-red-900/10 border-b border-red-100 dark:border-red-900/30 relative overflow-hidden print:hidden">
                    <div class="absolute top-0 right-0 w-2 h-full bg-red-500"></div>
                    <p class="text-xs font-bold text-red-400 uppercase tracking-widest mb-1">Total Hutang Aktif</p>
                    <div class="flex items-baseline gap-1.5 flex-wrap">
                        <span class="text-sm font-bold text-red-400">Rp</span>
                        <h2 class="text-3xl font-black text-red-600 dark:text-red-500 tabular-nums tracking-tighter break-words">
                            {{ number_format($totalHutangSupplier,0,',','.') }}
                        </h2>
                    </div>
                </div>

                <div class="flex-1 p-2 print:p-0">
                    @forelse($suppliers as $s)
                    <div class="flex items-center justify-between p-4 border-b border-slate-50 dark:border-slate-700/50 last:border-0 print:px-2 print:border-slate-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-700 border border-slate-200 dark:border-slate-600 flex items-center justify-center text-slate-500 dark:text-slate-400 font-bold text-sm print:hidden shrink-0">
                                {{ substr($s->nama_supplier, 0, 1) }}
                            </div>
                            <span class="text-sm font-bold text-slate-800 dark:text-white">{{ $s->nama_supplier }}</span>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold font-mono tabular-nums {{ $s->saldo_hutang > 0 ? 'text-red-600 dark:text-red-500 print:text-slate-900' : 'text-slate-400 dark:text-slate-500' }}">
                                {{ number_format($s->saldo_hutang,0,',','.') }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-12 px-4 flex flex-col items-center">
                        <svg class="w-12 h-12 text-emerald-200 dark:text-emerald-900 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="text-sm font-bold text-slate-400 dark:text-slate-500">Semua hutang supplier lunas.</span>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
    
    <div class="hidden print:block mt-24 pt-8 border-t border-slate-400">
        <div class="flex justify-between items-end">
            <div>
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1">Dokumen Internal Resmi</p>
                <p class="text-sm font-bold text-slate-900">Dicetak pada: {{ now()->format('d F Y, H:i') }} WIB</p>
                <p class="text-xs text-slate-500 mt-1">Sistem Informasi Manajemen Toko Hasan</p>
            </div>
            <div class="text-center">
                <p class="text-sm font-bold text-slate-900 mb-16">Mengetahui, Pimpinan</p>
                <div class="w-48 border-b border-slate-800 mb-2 mx-auto"></div>
                <p class="text-xs font-bold text-slate-500 uppercase tracking-widest">( ........................................ )</p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Hilangkan panah default pada input date */
    input[type="date"]::-webkit-inner-spin-button,
    input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    
    @media print {
        @page { 
            margin: 1cm; 
            size: auto;
        }
        body { 
            background: white !important; 
            color: black !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .shadow-sm, .shadow-md, .shadow-xl, .shadow-lg { box-shadow: none !important; }
        .bg-slate-50, .bg-slate-100, .bg-slate-900, .bg-indigo-600 { background-color: transparent !important; }
        
        /* Pastikan teks terlihat saat diprint */
        h1, h2, h3, p, span, td, th {
            color: black !important;
        }
        
        .dark h1, .dark h2, .dark h3, .dark p, .dark span, .dark td, .dark th {
            color: black !important;
        }

        table, tr, td, th {
            page-break-inside: avoid;
            border-color: #e2e8f0 !important;
        }
        
        .bg-slate-900 {
            border: 2px solid black !important;
        }
    }
</style>
@endsection