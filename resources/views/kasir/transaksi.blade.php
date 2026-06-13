@extends('layouts.kasir')

@section('title', 'Transaksi Kasir')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 min-h-[calc(100vh-4rem)] flex flex-col">
    
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                <svg class="w-8 h-8 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Kasir Pintar
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Scan barcode produk untuk memulai transaksi.</p>
        </div>
        
        <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-4 py-2.5 rounded-xl shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span id="current-date" class="text-sm font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wide"></span>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 dark:bg-emerald-900/20 border-l-4 border-emerald-500 text-emerald-700 dark:text-emerald-400 p-4 rounded-r-xl flex items-center gap-3 animate-fade-in-down">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 text-red-700 dark:text-red-400 p-4 rounded-r-xl flex items-center gap-3">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
        <span class="font-medium">{{ session('error') }}</span>
    </div>
    @endif

    <form action="{{ route('kasir.transaksi.store') }}" method="POST" class="flex-1 flex flex-col" id="checkout-form">
        @csrf
        <div id="hidden-cart-inputs"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 flex-1">
            
            <!-- LEFT: Barcode + Shopping Cart List -->
            <div class="lg:col-span-7 flex flex-col gap-6">
                
                <!-- Barcode Scanner -->
                <div class="bg-white dark:bg-slate-800 p-5 sm:p-6 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 relative overflow-hidden group">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-50 dark:bg-emerald-900/10 rounded-full blur-3xl group-focus-within:bg-emerald-100 dark:group-focus-within:bg-emerald-900/20 transition-colors duration-500"></div>
                    <div class="relative z-10">
                        <label for="barcode" class="block text-sm font-bold text-slate-700 dark:text-white mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                            Pindai / Ketik Barcode
                        </label>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-6 w-6 text-slate-400 dark:text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </div>
                                <input type="text" id="barcode" autocomplete="off"
                                    class="block w-full pl-12 pr-4 py-4 bg-slate-50/50 dark:bg-slate-900/50 border-2 border-slate-200 dark:border-slate-700/50 rounded-xl focus:bg-white dark:focus:bg-slate-800 focus:ring-0 focus:border-emerald-500 dark:focus:border-emerald-400 transition-colors text-xl font-mono text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 shadow-inner"
                                    placeholder="Scan barcode di sini..." autofocus>
                            </div>
                            <button type="button" onclick="checkBarcode()"
                                class="h-16 px-8 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-lg rounded-xl transition-all shadow-md shadow-emerald-200 dark:shadow-none hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2 shrink-0">
                                Cari
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                        <div id="status" class="mt-4 flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-slate-400">
                            <span class="relative flex h-3 w-3">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-slate-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-3 w-3 bg-slate-500"></span>
                            </span>
                            Menunggu input barcode...
                        </div>
                    </div>
                </div>

                <!-- Shopping Cart Container -->
                <div id="cartBox" class="flex-1 bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700/50 rounded-2xl p-6 flex flex-col transition-all duration-300 relative min-h-[350px]">
                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-700/60 pb-4 mb-4">
                        <h2 class="text-xl font-black text-slate-800 dark:text-white tracking-tight flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            Daftar Belanja
                        </h2>
                        <span id="cart-item-count" class="px-3 py-1 bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 rounded-full text-xs font-black">0 Barang</span>
                    </div>

                    <!-- Cart Table -->
                    <div class="overflow-x-auto flex-1" id="cart-items-wrapper">
                        <table class="w-full text-sm text-left border-collapse hidden" id="cart-table">
                            <thead>
                                <tr class="border-b border-slate-100 dark:border-slate-700/60 text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-widest">
                                    <th class="py-3 px-2">Produk</th>
                                    <th class="py-3 px-2 text-right w-24">Harga</th>
                                    <th class="py-3 px-2 text-center w-28">Qty</th>
                                    <th class="py-3 px-2 text-right w-24">Subtotal</th>
                                    <th class="py-3 px-2 text-center w-12">Hapus</th>
                                </tr>
                            </thead>
                            <tbody id="cart-table-body" class="divide-y divide-slate-100 dark:divide-slate-700/50 text-slate-700 dark:text-slate-300">
                                <!-- JS dynamically inserts rows here -->
                            </tbody>
                        </table>
                        
                        <!-- Empty State -->
                        <div id="cart-empty-state" class="py-16 flex flex-col items-center justify-center text-center">
                            <div class="w-16 h-16 bg-slate-50 dark:bg-slate-700/30 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-slate-300 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            </div>
                            <h4 class="font-bold text-slate-700 dark:text-slate-300 mb-1">Keranjang Belanja Kosong</h4>
                            <p class="text-xs text-slate-400 dark:text-slate-500">Scan barcode atau klik tombol cari untuk menambah barang.</p>
                        </div>
                    </div>

                    <button type="button" id="btn-reset" onclick="resetForm()" class="absolute top-4 right-4 p-2 bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/50 hover:text-red-600 dark:hover:text-red-300 rounded-lg hidden transition-colors" title="Batal Transaksi / Kosongkan Keranjang">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            </div>

            <!-- RIGHT: Payment Panel -->
            <div class="lg:col-span-5">
                <div class="bg-slate-900 rounded-3xl p-5 shadow-2xl sticky top-8 flex flex-col h-full lg:h-auto min-h-[500px] border border-slate-800 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-32 h-32 bg-emerald-500/20 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-32 h-32 bg-teal-500/20 rounded-full blur-3xl"></div>

                    <div class="relative z-10 flex-1 flex flex-col">
                        <h3 class="text-base font-bold text-white mb-4 pb-3 border-b border-slate-800 flex items-center justify-between">
                            Ringkasan Pembayaran
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </h3>

                        <div class="mb-4">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Subtotal Belanja</label>
                            <div class="bg-slate-800/50 px-4 py-3 rounded-xl border border-slate-700/50 backdrop-blur-sm flex justify-between items-center">
                                <span class="text-slate-400 text-xs font-semibold">Total Kotor</span>
                                <span id="subtotal-display" class="text-lg font-black text-white">Rp 0</span>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 p-3 rounded-xl border border-slate-700/50 backdrop-blur-sm mb-4">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Potongan Harga (Diskon)</label>
                            <div class="grid grid-cols-2 gap-2">
                                <select id="discount_type" name="discount_type" onchange="calculate()" disabled
                                    class="w-full bg-slate-700 border border-slate-600 text-white text-[11px] rounded-lg px-2 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <option value="nominal">Rp (Nom)</option>
                                    <option value="percent">% (Pct)</option>
                                </select>
                                <input type="number" id="discount" name="discount" value="0" min="0" oninput="calculate()" disabled
                                    class="w-full bg-slate-700 border border-slate-600 text-white text-[11px] rounded-lg px-2 py-2 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 disabled:opacity-50 disabled:cursor-not-allowed placeholder-slate-400 text-center"
                                    placeholder="0">
                            </div>
                        </div>

                        <!-- Customer Langganan -->
                        <div class="bg-slate-800/50 p-3 rounded-xl border border-slate-700/50 backdrop-blur-sm mb-4">
                            <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">No HP Pelanggan</label>
                            <div class="flex gap-2">
                                <input type="text" id="customer_phone" placeholder="Contoh: 0812..." 
                                    class="w-full bg-slate-700 border border-slate-600 text-white text-[11px] rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 placeholder-slate-400 font-medium">
                                <button type="button" onclick="searchCustomerByPhone()"
                                    class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-[11px] px-4 rounded-lg transition-colors flex items-center justify-center shrink-0">
                                    Cari
                                </button>
                            </div>
                            <input type="hidden" name="customer_id" id="customer_id">
                            <div id="customer_info" class="hidden text-xs mt-3 bg-slate-800/80 p-3 rounded-lg border border-slate-700/60">
                                <p class="text-slate-400 font-semibold mb-1">Data Pelanggan:</p>
                                <p class="text-white font-bold text-sm" id="customer_name_display">-</p>
                                <p class="text-emerald-400 font-bold mt-0.5" id="customer_status_display">-</p>
                            </div>
                            <div id="customer_error" class="hidden text-xs mt-3 text-rose-400 font-bold bg-rose-500/10 p-3 rounded-lg border border-rose-500/20">
                                Customer belum terdaftar, silakan hubungi admin
                            </div>
                        </div>

                        <div class="mt-auto pt-3">
                            <div class="mb-6">
                                <div class="flex justify-between items-end mb-1">
                                    <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Total Tagihan</p>
                                    <p id="discount-label" class="text-[10px] font-bold text-amber-400 hidden">- Diskon Rp 0</p>
                                </div>
                                <h1 id="total" class="text-3xl sm:text-4xl font-black text-emerald-400 tracking-tighter truncate" title="Rp 0">
                                    Rp 0
                                </h1>
                            </div>

                            <button type="submit" id="btn-submit"
                                class="group relative w-full bg-emerald-500 hover:bg-emerald-400 text-slate-900 py-4 rounded-xl font-black text-lg shadow-[0_0_30px_-10px_rgba(16,185,129,0.5)] transition-all duration-300 disabled:opacity-30 disabled:hover:bg-emerald-500 disabled:cursor-not-allowed disabled:shadow-none overflow-hidden"
                                disabled>
                                <span class="relative z-10 flex items-center justify-center gap-2">
                                    BAYAR SEKARANG
                                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </form>

    <!-- Riwayat Transaksi Saya -->
    <div class="mt-8 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/50">
            <h3 class="font-bold text-slate-900 dark:text-white">Riwayat Transaksi Saya</h3>
            <p class="text-xs text-slate-500 mt-0.5">Hanya menampilkan transaksi yang Anda lakukan</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-slate-50/50 dark:bg-slate-800/80 border-b border-slate-200 dark:border-slate-700">
                    <tr>
                        <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest">Detail</th>
                        <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest">Daftar Produk</th>
                        <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest text-center">Total Qty</th>
                        <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest">Total Pembayaran</th>
                        <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest text-center">Status</th>
                        <th class="px-6 py-4 font-bold text-slate-500 uppercase text-[11px] tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700 text-slate-600 dark:text-slate-300">
                    @forelse($transactions as $trx)
                    <tr class="hover:bg-emerald-50/30 dark:hover:bg-emerald-900/10 transition-colors">
                        <td class="px-6 py-4">
                            <span class="inline-block px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded text-[10px] font-bold mb-1">
                                #{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                            <p class="text-xs text-slate-400 dark:text-slate-500 font-medium">
                                {{ $trx->created_at->format('d M Y') }} • {{ $trx->created_at->format('H:i') }}
                            </p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-2">
                                @foreach($trx->details as $detail)
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400 text-xs font-bold shrink-0">
                                            {{ substr($detail->product->name ?? '?', 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 dark:text-white text-xs">
                                                {{ $detail->product->name ?? 'Produk Dihapus' }}
                                                <span class="text-emerald-600 dark:text-emerald-400 font-black ml-1">x{{ $detail->quantity }}</span>
                                            </p>
                                            <p class="text-[10px] text-slate-400">@ Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                @endforeach
                                @if($trx->customer)
                                    <div class="mt-1 flex items-center gap-1.5">
                                        <span class="inline-block px-1.5 py-0.5 bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 rounded text-[9px] font-bold">
                                            👤 {{ $trx->customer->nama }} ({{ ucfirst($trx->customer->status_customer) }})
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center font-bold">{{ $trx->details->sum('quantity') }}</td>
                        <td class="px-6 py-4 font-black text-slate-900 dark:text-white">
                            Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                            @if($trx->discount > 0)
                                <span class="block text-[10px] text-amber-500 font-bold mt-0.5">
                                    Diskon: {{ $trx->discount_type === 'percent' ? $trx->discount.'%' : 'Rp '.number_format($trx->discount, 0, ',', '.') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($trx->status == 'success' || $trx->status == 'completed')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Selesai
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black uppercase bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border border-amber-200 dark:border-amber-800/50">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('kasir.transaksi.print', $trx->id) }}" target="_blank"
                               class="inline-flex items-center justify-center w-10 h-10 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 rounded-xl hover:text-emerald-600 hover:border-emerald-200 hover:bg-emerald-50 transition-all shadow-sm active:scale-90"
                               title="Print Struk">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-16 text-center">
                            <div class="flex flex-col items-center text-slate-400">
                                <div class="w-16 h-16 bg-slate-50 dark:bg-slate-800/50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-200 dark:text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                </div>
                                <h3 class="font-bold text-slate-700 dark:text-slate-300 mb-1">Belum Ada Transaksi</h3>
                                <p class="text-sm">Scan barcode di atas untuk memulai!</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let cart = [];

document.addEventListener('DOMContentLoaded', function() {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('current-date').innerText = new Intl.DateTimeFormat('id-ID', options).format(new Date());
    document.getElementById('barcode').focus();
    renderCart();
});

document.getElementById('barcode').addEventListener('keypress', function(e){
    if (e.key === 'Enter') {
        e.preventDefault();
        checkBarcode();
    }
});

async function checkBarcode() {
    let code = document.getElementById('barcode').value.trim();
    let status = document.getElementById('status');
    
    if (!code) {
        document.getElementById('barcode').focus();
        return;
    }

    status.innerHTML = `<span class="relative flex h-3 w-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500"></span></span> Mencari di database...`;

    try {
        let res = await fetch(`/api/products/search?code=${code}`);
        let data = await res.json();

        if (data.status === 'success') {
            let product = data.data;

            if (product.stock <= 0) {
                Swal.fire({ icon: 'warning', title: 'Stok Habis!', text: `Produk ${product.name} tidak memiliki stok tersisa.`, confirmButtonColor: '#059669' });
                status.innerHTML = `<span class="relative flex h-3 w-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-slate-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-slate-500"></span></span> Menunggu input barcode...`;
                document.getElementById('barcode').value = "";
                document.getElementById('barcode').focus();
                return;
            }

            addToCart(product);
            document.getElementById('barcode').value = "";
            document.getElementById('barcode').focus();
            status.innerHTML = `<span class="relative flex h-3 w-3"><span class="absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span></span> Produk ditambahkan!`;
        } else {
            Swal.fire({ icon: 'error', title: 'Tidak Ditemukan', text: `Barcode ${code} tidak terdaftar di sistem.`, confirmButtonColor: '#059669' });
            document.getElementById('barcode').value = "";
            document.getElementById('barcode').focus();
            status.innerHTML = `<span class="relative flex h-3 w-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-slate-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-slate-500"></span></span> Menunggu input barcode...`;
        }
    } catch (e) {
        status.innerHTML = `<span class="relative flex h-3 w-3"><span class="absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span></span> Kesalahan jaringan / server.`;
    }
}

function addToCart(product) {
    let existingItem = cart.find(item => item.id === product.id);

    if (existingItem) {
        if (existingItem.qty >= product.stock) {
            Swal.fire({ toast: true, position: 'top-end', icon: 'warning', title: 'Melebihi batas stok tersedia!', showConfirmButton: false, timer: 2000 });
            return;
        }
        existingItem.qty += 1;
    } else {
        cart.push({
            id: product.id,
            name: product.name,
            price: product.price,
            stock: product.stock,
            qty: 1
        });
    }

    renderCart();
}

function updateQty(index, newQty) {
    let item = cart[index];
    newQty = parseInt(newQty) || 0;

    if (newQty < 1) newQty = 1;
    if (newQty > item.stock) {
        Swal.fire({ toast: true, position: 'top-end', icon: 'warning', title: 'Melebihi batas stok tersedia!', showConfirmButton: false, timer: 2000 });
        newQty = item.stock;
    }

    item.qty = newQty;
    renderCart();
}

function changeItemQty(index, val) {
    let item = cart[index];
    let newQty = item.qty + val;
    updateQty(index, newQty);
}

function deleteItem(index) {
    cart.splice(index, 1);
    renderCart();
}

function renderCart() {
    let tbody = document.getElementById('cart-table-body');
    let emptyState = document.getElementById('cart-empty-state');
    let countBadge = document.getElementById('cart-item-count');
    let hiddenContainer = document.getElementById('hidden-cart-inputs');
    
    tbody.innerHTML = '';
    hiddenContainer.innerHTML = '';

    if (cart.length === 0) {
        emptyState.classList.remove('hidden');
        document.getElementById('cart-table').classList.add('hidden');
        document.getElementById('btn-reset').classList.add('hidden');
        countBadge.innerText = '0 Barang';
        
        document.getElementById('discount_type').disabled = true;
        document.getElementById('discount').disabled = true;
        document.getElementById('btn-submit').disabled = true;
        
        document.getElementById('subtotal-display').innerText = 'Rp 0';
        document.getElementById('total').innerText = 'Rp 0';
        document.getElementById('discount-label').classList.add('hidden');
        return;
    }

    emptyState.classList.add('hidden');
    document.getElementById('cart-table').classList.remove('hidden');
    document.getElementById('btn-reset').classList.remove('hidden');
    countBadge.innerText = `${cart.length} Barang`;

    document.getElementById('discount_type').disabled = false;
    document.getElementById('discount').disabled = false;
    document.getElementById('btn-submit').disabled = false;

    let subtotal = 0;

    cart.forEach((item, index) => {
        let itemSubtotal = item.price * item.qty;
        subtotal += itemSubtotal;

        // Render row in table
        tbody.innerHTML += `
            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/20 transition-colors">
                <td class="py-3 px-2 font-semibold text-slate-800 dark:text-white">
                    <p class="text-sm font-bold">${item.name}</p>
                    <p class="text-[10px] text-slate-400 dark:text-slate-500 font-mono">Stok: ${item.stock} pcs</p>
                </td>
                <td class="py-3 px-2 text-right text-xs font-mono text-slate-600 dark:text-slate-400">
                    Rp ${new Intl.NumberFormat('id-ID').format(item.price)}
                </td>
                <td class="py-3 px-2 text-center">
                    <div class="inline-flex items-center bg-slate-100 dark:bg-slate-700 rounded-lg p-0.5 border border-slate-200 dark:border-slate-600">
                        <button type="button" onclick="changeItemQty(${index}, -1)" 
                            class="w-6 h-6 flex items-center justify-center text-slate-500 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-600 rounded transition-colors font-bold">-</button>
                        <input type="number" value="${item.qty}" min="1" max="${item.stock}" onchange="updateQty(${index}, this.value)"
                            class="w-8 text-center bg-transparent border-0 p-0 text-xs font-bold text-slate-800 dark:text-white focus:ring-0">
                        <button type="button" onclick="changeItemQty(${index}, 1)" 
                            class="w-6 h-6 flex items-center justify-center text-slate-500 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-600 rounded transition-colors font-bold">+</button>
                    </div>
                </td>
                <td class="py-3 px-2 text-right font-mono text-sm font-bold text-slate-800 dark:text-white">
                    Rp ${new Intl.NumberFormat('id-ID').format(itemSubtotal)}
                </td>
                <td class="py-3 px-2 text-center">
                    <button type="button" onclick="deleteItem(${index})" 
                        class="p-1 text-slate-400 dark:text-slate-500 hover:text-red-500 dark:hover:text-red-400 rounded transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </td>
            </tr>
        `;

        // Render hidden input fields inside the form
        hiddenContainer.innerHTML += `
            <input type="hidden" name="items[${index}][product_id]" value="${item.id}">
            <input type="hidden" name="items[${index}][quantity]" value="${item.qty}">
        `;
    });

    calculate(subtotal);
}

function calculate(subtotalVal = null) {
    let subtotal = subtotalVal;
    if (subtotal === null) {
        subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
    }

    document.getElementById('subtotal-display').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);

    let discountType = document.getElementById('discount_type').value;
    let discountValue = parseFloat(document.getElementById('discount').value) || 0;
    let discountAmount = 0;

    if (discountType === 'percent') {
        if (discountValue > 100) { 
            document.getElementById('discount').value = 100; 
            discountValue = 100; 
        }
        discountAmount = subtotal * (discountValue / 100);
    } else {
        discountAmount = discountValue;
    }

    let grandTotal = subtotal - discountAmount;
    if (grandTotal < 0) grandTotal = 0;

    let discountLabel = document.getElementById('discount-label');
    if (discountAmount > 0) {
        discountLabel.innerText = `- Diskon Rp ${new Intl.NumberFormat('id-ID').format(discountAmount)}`;
        discountLabel.classList.remove('hidden');
    } else {
        discountLabel.classList.add('hidden');
    }

    let displayTotal = document.getElementById('total');
    displayTotal.classList.add('scale-105', 'text-white');
    displayTotal.classList.remove('text-emerald-400');
    setTimeout(() => {
        displayTotal.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);
        displayTotal.classList.remove('scale-105', 'text-white');
        displayTotal.classList.add('text-emerald-400');
    }, 150);
}

async function searchCustomerByPhone() {
    let phone = document.getElementById('customer_phone').value.trim();
    let idInput = document.getElementById('customer_id');
    let infoDiv = document.getElementById('customer_info');
    let errorDiv = document.getElementById('customer_error');
    
    idInput.value = "";
    infoDiv.classList.add('hidden');
    errorDiv.classList.add('hidden');

    if (!phone) {
        return;
    }

    try {
        let res = await fetch(`/kasir/customers/search?no_hp=${phone}`);
        let data = await res.json();

        if (data.status === 'success') {
            idInput.value = data.data.id;
            document.getElementById('customer_name_display').innerText = `Nama: ${data.data.nama}`;
            document.getElementById('customer_status_display').innerText = `Status: ${data.data.status_customer}`;
            infoDiv.classList.remove('hidden');
        } else {
            errorDiv.classList.remove('hidden');
        }
    } catch (e) {
        errorDiv.classList.remove('hidden');
    }
}

function resetForm(){
    cart = [];
    document.getElementById('customer_phone').value = "";
    document.getElementById('customer_id').value = "";
    document.getElementById('customer_info').classList.add('hidden');
    document.getElementById('customer_error').classList.add('hidden');
    document.getElementById('discount').value = "0";
    document.getElementById('discount_type').value = "nominal";
    
    renderCart();
    
    let inputBarcode = document.getElementById('barcode');
    inputBarcode.value = "";
    inputBarcode.focus();
}
</script>

<style>
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-down { animation: fade-in-down 0.4s ease-out; }
    
    /* Remove input spinner arrows */
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none; 
        margin: 0; 
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

@endsection
