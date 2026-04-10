@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
<div class="max-w-7xl mx-auto pb-20 px-4 sm:px-6">

    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Data Pelanggan</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">Kelola daftar pelanggan tetap, kontak, dan alamat pengiriman Anda.</p>
        </div>
        
        <div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto">
            <form action="{{ route('customers.index') }}" method="GET" class="relative w-full sm:w-72 group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                       class="block w-full pl-10 pr-4 py-2.5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-700 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all shadow-sm" 
                       placeholder="Cari nama atau no HP...">
            </form>

            <a href="{{ route('customers.create') }}"
               class="w-full sm:w-auto flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 active:scale-95 text-white px-6 py-2.5 rounded-xl shadow-lg shadow-indigo-200 font-semibold transition-all duration-200 uppercase text-xs tracking-widest">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800/50 rounded-2xl flex items-center gap-3 text-emerald-700 dark:text-emerald-400 shadow-sm animate-fade-in">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span class="text-sm font-bold">{{ session('success') }}</span>
    </div>
    @endif

    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl shadow-slate-200/40 dark:shadow-none border border-slate-100 dark:border-slate-700 overflow-hidden">
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50/80 dark:bg-slate-800/80 text-slate-400 dark:text-slate-500 text-xs uppercase font-bold tracking-wider border-b border-slate-100 dark:border-slate-700">
                    <tr>
                        <th scope="col" class="px-6 py-5">Info Pelanggan</th>
                        <th scope="col" class="px-6 py-5">Kontak</th>
                        <th scope="col" class="px-6 py-5">Alamat</th>
                        <th scope="col" class="px-6 py-5 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 dark:divide-slate-700 text-slate-600 dark:text-slate-300">
                    @forelse($customers as $c)
                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-700/50 transition-colors duration-200 group">
                        
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-indigo-700 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-900/30 font-bold shrink-0 shadow-sm border border-indigo-100/50 dark:border-indigo-800/50">
                                    {{ strtoupper(substr($c->nama, 0, 1)) }}
                                </div>
                                <div class="font-bold text-slate-900 dark:text-white">{{ $c->nama }}</div>
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-2 text-slate-600 dark:text-slate-400 font-medium">
                                <svg class="w-4 h-4 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>{{ $c->no_hp }}</span>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-slate-600 dark:text-slate-400 max-w-xs truncate" title="{{ $c->alamat }}">
                                {{ $c->alamat ?? '-' }}
                            </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center justify-center gap-2">
                                
                                <a href="{{ route('customers.edit', $c->id) }}" 
                                   class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors"
                                   title="Edit Data">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>

                                <form action="{{ route('customers.destroy', $c->id) }}" method="POST" class="inline-block">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-colors"
                                            title="Hapus Pelanggan"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data pelanggan ini?')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-slate-50 dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-3xl flex items-center justify-center text-slate-400 dark:text-slate-500 mb-5 shadow-inner">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <h3 class="text-lg font-extrabold text-slate-900 dark:text-white mb-1">{{ request('search') ? 'Pencarian Tidak Ditemukan' : 'Belum Ada Pelanggan' }}</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400 max-w-sm mx-auto mb-6">{{ request('search') ? 'Tidak ada data pelanggan yang cocok dengan keyword pencarian Anda.' : 'Anda belum menambahkan data pelanggan tetap. Mulai kelola basis pelanggan Anda sekarang.' }}</p>
                                <a href="{{ route('customers.create') }}" class="inline-flex items-center gap-2 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-3 rounded-xl shadow-md transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                                    {{ request('search') ? 'Lihat Semua' : 'Tambah Pelanggan Pertama' }}
                                </a>
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
