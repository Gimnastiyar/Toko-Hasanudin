@extends('layouts.app')

@section('title', 'Data Supplier')

@section('content')
<div class="max-w-7xl mx-auto pb-20 px-4 sm:px-6">

    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Data Supplier</h1>
            <p class="text-sm text-slate-500 mt-2">Kelola daftar pemasok barang, kontak, dan catatan hutang Anda.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
            <div class="relative w-full sm:w-72 group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" 
                       class="block w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm placeholder-slate-400 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all shadow-sm" 
                       placeholder="Cari nama supplier...">
            </div>

            <a href="{{ route('suppliers.create') }}"
               class="w-full sm:w-auto flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 active:scale-95 text-white px-6 py-2.5 rounded-xl shadow-lg shadow-indigo-200 font-semibold transition-all duration-200 uppercase text-xs tracking-widest">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah
            </a>
        </div>
    </div>

    <div class="bg-gradient-to-br from-slate-50 to-white p-6 sm:p-8 rounded-3xl shadow-sm border border-slate-200 mb-10 flex flex-col xl:flex-row gap-6 items-start xl:items-center justify-between relative overflow-hidden">
        <div class="absolute -right-20 -top-20 w-64 h-64 bg-emerald-50 rounded-full blur-3xl opacity-60 pointer-events-none"></div>

        <div class="relative z-10">
            <h2 class="text-lg font-bold text-slate-800 flex items-center gap-2 mb-1">
                <div class="p-1.5 bg-emerald-100 text-emerald-600 rounded-lg">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                Bayar Hutang Supplier
            </h2>
            <p class="text-sm text-slate-500">Catat pembayaran tagihan ke pemasok dengan cepat.</p>
        </div>

        <form method="POST" action="{{ route('suppliers.bayar') }}" class="w-full xl:w-auto flex flex-col sm:flex-row gap-3 relative z-10">
            @csrf
            
            <div class="flex-1 sm:w-64">
                <select name="supplier_id" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 shadow-sm transition-all appearance-none cursor-pointer">
                    <option value="" disabled selected>-- Pilih Supplier --</option>
                    @foreach($suppliers as $s)
                        <option value="{{ $s->id }}">
                            {{ $s->nama_supplier }} (Hutang: Rp {{ number_format($s->saldo_hutang, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1 sm:w-48 relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-slate-400 text-sm font-medium">Rp</div>
                <input type="number" name="jumlah_bayar"
                       placeholder="0"
                       class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-sm focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 shadow-sm transition-all font-medium">
            </div>

            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white px-6 py-2.5 rounded-xl font-bold shadow-md shadow-emerald-200 transition-all duration-200 uppercase text-xs tracking-widest whitespace-nowrap">
                Proses Bayar
            </button>
        </form>
    </div>

    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden">
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50/80 text-slate-400 text-xs uppercase font-bold tracking-wider border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-5">Info Supplier</th>
                        <th scope="col" class="px-6 py-5">Kontak</th>
                        <th scope="col" class="px-6 py-5 text-right">Saldo Hutang</th>
                        <th scope="col" class="px-6 py-5 text-center">Status</th>
                        <th scope="col" class="px-6 py-5 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-slate-600">
                    @forelse($suppliers as $s)
                    <tr class="hover:bg-slate-50/50 transition-colors duration-200 group">
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-indigo-700 bg-indigo-50 font-bold shrink-0 shadow-sm border border-indigo-100/50">
                                    {{ strtoupper(substr($s->nama_supplier, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-900">{{ $s->nama_supplier }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5">{{ $s->nama_perusahaan ?? 'Personal' }}</div>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2 text-slate-600 font-medium">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>{{ $s->no_telp ?? 'Belum ada kontak' }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            @if($s->saldo_hutang > 0)
                                <div class="font-bold text-red-600 tracking-tight">
                                    Rp {{ number_format($s->saldo_hutang, 0, ',', '.') }}
                                </div>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-red-50 text-red-600 mt-1 border border-red-100 uppercase tracking-wide">
                                    Tunggakan
                                </span>
                            @else
                                <div class="font-bold text-slate-400 tracking-tight">
                                    Rp 0
                                </div>
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold bg-emerald-50 text-emerald-600 mt-1 border border-emerald-100 uppercase tracking-wide">
                                    Lunas
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($s->status == 'aktif')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-bold bg-slate-50 text-slate-600 border border-slate-200 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-center gap-2 opacity-100 lg:opacity-0 lg:group-hover:opacity-100 transition-opacity duration-200">
                                
                                <a href="{{ route('suppliers.edit', $s->id) }}" 
                                   class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors"
                                   title="Edit Data">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>

                                <form action="{{ route('suppliers.destroy', $s->id) }}" method="POST" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors"
                                            title="Hapus Supplier"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data supplier ini? Data yang dihapus tidak dapat dikembalikan.')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-slate-50 border border-slate-100 rounded-3xl flex items-center justify-center text-slate-400 mb-5 shadow-inner">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                </div>
                                <h3 class="text-lg font-extrabold text-slate-900 mb-1">Belum Ada Supplier</h3>
                                <p class="text-sm text-slate-500 max-w-sm mx-auto mb-6">Anda belum menambahkan data pemasok barang. Mulai kelola mitra bisnis Anda sekarang.</p>
                                <a href="{{ route('suppliers.create') }}" class="inline-flex items-center gap-2 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-3 rounded-xl shadow-md transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                    Tambah Supplier Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($suppliers, 'links') && $suppliers->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $suppliers->links() }}
        </div>
        @endif

    </div>

</div>
@endsection