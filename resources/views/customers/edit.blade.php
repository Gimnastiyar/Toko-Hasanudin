@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="max-w-3xl mx-auto pb-20 px-4 sm:px-6">

    <div class="mb-8">
        <a href="{{ route('customers.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-indigo-600 transition-colors mb-4 group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Edit Pelanggan</h1>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">Perbarui informasi data pelanggan "{{ $customer->nama }}".</p>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-xl shadow-slate-200/40 dark:shadow-none border border-slate-100 dark:border-slate-700 overflow-hidden">
        <form action="{{ route('customers.update', $customer->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Pelanggan <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $customer->nama) }}" required
                           class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('nama') border-rose-500 @enderror"
                           placeholder="Contoh: Budi Santoso">
                    @error('nama')
                        <p class="mt-2 text-xs font-bold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No HP -->
                <div>
                    <label for="no_hp" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nomor WhatsApp/HP <span class="text-rose-500">*</span></label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $customer->no_hp) }}" required
                           class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all @error('no_hp') border-rose-500 @enderror"
                           placeholder="Contoh: 081234567890">
                    @error('no_hp')
                        <p class="mt-2 text-xs font-bold text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Alamat (Opsional)</label>
                    <textarea name="alamat" id="alamat" rows="4"
                              class="block w-full px-4 py-3 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all"
                              placeholder="Masukkan alamat lengkap pelanggan jika diperlukan...">{{ old('alamat', $customer->alamat) }}</textarea>
                </div>
            </div>

            <div class="mt-10 flex flex-col sm:flex-row gap-3">
                <button type="submit"
                        class="flex-1 bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-200 dark:shadow-none transition-all duration-200 uppercase text-xs tracking-widest">
                    Update Pelanggan
                </button>
                <a href="{{ route('customers.index') }}"
                   class="flex-1 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-600 dark:text-slate-200 font-bold py-4 rounded-2xl text-center transition-all uppercase text-xs tracking-widest">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
