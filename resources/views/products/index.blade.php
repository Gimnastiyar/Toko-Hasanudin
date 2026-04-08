@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Katalog Produk</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 flex items-center gap-2">
                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Total {{ $products->total() }} produk terdaftar di sistem.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 items-center">
            <form method="GET" action="{{ route('products.index') }}" class="relative group w-full sm:w-64">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-4 w-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama atau barcode..."
                    class="block w-full pl-10 pr-4 py-2.5 border border-slate-200 dark:border-slate-700 rounded-xl text-sm bg-white dark:bg-slate-800 dark:text-white focus:ring-4 focus:ring-indigo-100 dark:focus:ring-indigo-900/50 focus:border-indigo-500 transition-all outline-none">
            </form>

            <a href="{{ route('products.create') }}"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-indigo-600 text-white px-6 py-2.5 rounded-xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all font-bold">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Tambah Produk
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r-xl flex items-center justify-between shadow-sm animate-fade-in">
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600 text-xl font-bold">&times;</button>
    </div>
    @endif

    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl shadow-slate-200/50 dark:shadow-none border border-slate-100 dark:border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-700">
                        <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">Informasi Produk</th>
                        <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">Supplier</th>
                        <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">Kategori</th>
                        <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">Harga Jual</th>
                        <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">Manajemen Stok</th>
                        <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400 text-right">Opsi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-700/50">
                    @forelse ($products as $product)
                    <tr class="hover:bg-indigo-50/20 dark:hover:bg-indigo-900/10 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-4">
                                <div class="relative shrink-0">
                                    @if($product->image)
                                        <img src="{{ asset('storage/'.$product->image) }}"
                                             class="h-14 w-14 rounded-2xl object-cover ring-2 ring-slate-100 dark:ring-slate-700">
                                    @else
                                        <div class="h-14 w-14 bg-slate-100 dark:bg-slate-700 rounded-2xl flex items-center justify-center text-slate-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800 dark:text-slate-100 text-sm tracking-tight group-hover:text-indigo-600 transition-colors">{{ $product->name }}</h3>
                                    <div class="flex items-center gap-2 mt-1">
                                        <code class="text-[10px] text-slate-400 bg-slate-50 dark:bg-slate-700 dark:text-slate-300 px-1.5 py-0.5 rounded border border-slate-100 dark:border-slate-600 uppercase tracking-tighter">{{ $product->barcode }}</code>
                                        @if($product->expired_date)
                                            <span class="text-[10px] text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-900/30 px-1.5 py-0.5 rounded border border-rose-100 dark:border-rose-800/50 font-bold uppercase tracking-tighter">
                                                Exp: {{ \Carbon\Carbon::parse($product->expired_date)->format('d M Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                            {{ $product->supplier->nama_supplier ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            @php
                                $colors = [
                                    'Makanan' => 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 border-amber-200 dark:border-amber-800/50',
                                    'Minuman' => 'bg-sky-100 dark:bg-sky-900/30 text-sky-700 dark:text-sky-400 border-sky-200 dark:border-sky-800/50',
                                    'Elektronik' => 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 border-purple-200 dark:border-purple-800/50'
                                ];
                                $colorClass = $colors[$product->category] ?? 'bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 border-slate-200 dark:border-slate-600';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider border {{ $colorClass }}">
                                {{ $product->category }}
                            </span>
                        </td>

                        <td class="px-6 py-4 font-black text-slate-900 dark:text-white text-sm">
                            Rp {{ number_format($product->price,0,',','.') }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1.5 min-w-[120px]">
                                <div class="flex justify-between items-end">
                                    <span class="text-xs font-black {{ $product->stock > 10 ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                        {{ $product->stock }} <span class="text-[10px] font-normal text-slate-400">tersedia</span>
                                    </span>
                                </div>
                                <div class="w-full h-1.5 bg-slate-100 dark:bg-slate-700 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-700 ease-out {{ $product->stock > 10 ? 'bg-emerald-500' : 'bg-rose-500' }}"
                                         style="width: {{ min($product->stock * 5, 100) }}%">
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="p-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl hover:text-indigo-600 hover:border-indigo-200 hover:bg-indigo-50 transition-all shadow-sm active:scale-90"
                                   title="Edit Produk">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus produk {{ $product->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="p-2.5 bg-white border border-slate-200 text-slate-600 rounded-xl hover:text-rose-600 hover:border-rose-200 hover:bg-rose-50 transition-all shadow-sm active:scale-90"
                                            title="Hapus Produk">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-24 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-slate-200 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                </div>
                                <h3 class="text-slate-500 dark:text-slate-400 font-bold">Produk Tidak Ditemukan</h3>
                                <p class="text-slate-400 dark:text-slate-500 text-sm">Coba kata kunci lain atau tambah produk baru.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
        <div class="px-6 py-5 bg-slate-50/50 border-t border-slate-100">
            {{ $products->links() }}
        </div>
        @endif
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.4s ease-out; }
</style>
@endsection