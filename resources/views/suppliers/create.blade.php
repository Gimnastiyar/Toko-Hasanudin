@extends('layouts.app')

@section('title', 'Tambah Supplier Baru')

@section('content')
<div class="max-w-4xl mx-auto pb-20 px-4 sm:px-6">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-10">
        <div class="flex items-center gap-5">
            <a href="{{ route('suppliers.index') }}" 
               aria-label="Kembali ke daftar supplier"
               class="group flex items-center justify-center w-11 h-11 bg-white border border-slate-200 rounded-xl text-slate-400 hover:text-indigo-600 hover:border-indigo-200 hover:shadow-sm transition-all duration-200">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <nav class="flex mb-1">
                    <ol class="flex items-center space-x-2 text-xs font-medium text-slate-400 uppercase tracking-wider">
                        <li>Supplier</li>
                        <li>&rsaquo;</li>
                        <li class="text-indigo-600">Tambah</li>
                    </ol>
                </nav>
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    Tambah Supplier
                </h1>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/40 border border-slate-100 overflow-hidden">

        <form method="POST" action="{{ route('suppliers.store') }}">
            @csrf

            @if(session('success'))
                <div class="mx-8 mt-8 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center gap-3">
                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
            <div class="mx-8 mt-8 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl flex gap-3">
                <svg class="w-5 h-5 text-rose-500 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                <ul class="text-sm flex flex-col gap-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="p-8">
                <div class="mb-8 pb-5 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-slate-800">
                        Informasi Supplier
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Isi kelengkapan data operasional dan kontak supplier.
                    </p>
                </div>

                @include('suppliers._form')

            </div>

            <div class="bg-slate-50/80 border-t border-slate-100 px-8 py-5 flex items-center justify-end gap-3">
                <a href="{{ route('suppliers.index') }}"
                   class="px-6 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:bg-slate-200/50 hover:text-slate-900 transition-colors">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:scale-95 text-white text-sm font-bold rounded-xl shadow-lg shadow-indigo-200 transition-all">
                    Simpan Data
                </button>
            </div>

        </form>
    </div>

    <p class="text-center mt-6 text-slate-400 text-sm">
        Field bertanda <span class="text-rose-500 font-bold">*</span> wajib diisi
    </p>

</div>
@endsection