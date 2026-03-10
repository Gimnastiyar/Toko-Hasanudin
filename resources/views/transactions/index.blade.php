@extends('layouts.app')

@section('content')

{{-- =====================================================
   HEADER HALAMAN
   Berisi judul halaman + tombol aksi
===================================================== --}}
<div class="mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">

    {{-- Judul halaman --}}
    <h1 class="text-2xl font-bold text-slate-800">
        Riwayat Transaksi
    </h1>

    {{-- Tombol Aksi --}}
    <div class="flex space-x-3">

        {{-- ===============================
           Tombol Export Excel
        ================================ --}}
        <a href="{{ route('transactions.export') }}"
           class="bg-emerald-600 text-white px-5 py-2 rounded-lg
                  hover:bg-emerald-700 transition flex items-center shadow-md">

            {{-- Icon Download --}}
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7
                         a2 2 0 01-2-2V5a2 2 0 012-2h5.586
                         a1 1 0 01.707.293l5.414 5.414
                         a1 1 0 01.293.707V19
                         a2 2 0 01-2 2z">
                </path>
            </svg>

            Export Excel

        </a>


        {{-- ===============================
           Tombol Tambah Transaksi
        ================================ --}}
        <a href="{{ route('transactions.create') }}"
           class="bg-indigo-600 text-white px-5 py-2 rounded-lg
                  hover:bg-indigo-700 transition flex items-center shadow-md">

            {{-- Icon Tambah --}}
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                </path>

            </svg>

            Transaksi Baru

        </a>

    </div>

</div>



{{-- =====================================================
   ALERT NOTIFIKASI BERHASIL
===================================================== --}}
@if(session('success'))

<div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded mb-4">

    {{ session('success') }}

</div>

@endif



{{-- =====================================================
   TABEL DATA TRANSAKSI
===================================================== --}}
<div class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">

<table class="w-full text-left border-collapse">

{{-- ===============================
   HEADER TABEL
================================ --}}
<thead class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">

<tr>

<th class="px-6 py-4 font-semibold">Tanggal</th>

<th class="px-6 py-4 font-semibold">Produk</th>

<th class="px-6 py-4 font-semibold">Qty</th>

<th class="px-6 py-4 font-semibold">Total Harga</th>

<th class="px-6 py-4 font-semibold">Status</th>

<th class="px-6 py-4 font-semibold text-right">Aksi</th>

</tr>

</thead>



{{-- ===============================
   BODY TABEL
================================ --}}
<tbody class="divide-y divide-slate-100">

@forelse($transactions as $trx)

<tr class="hover:bg-slate-50 transition">

{{-- Tanggal transaksi --}}
<td class="px-6 py-4 text-slate-500 text-sm">

{{ $trx->created_at->format('d M Y, H:i') }}

</td>


{{-- Nama produk --}}
<td class="px-6 py-4">

<span class="font-medium text-slate-800">
{{ $trx->product->name }}
</span>

<br>

<span class="text-xs text-slate-500">
@ Rp {{ number_format($trx->product->price,0,',','.') }}
</span>

</td>


{{-- Quantity --}}
<td class="px-6 py-4 text-slate-700 font-bold">

x {{ $trx->quantity }}

</td>


{{-- Total Harga --}}
<td class="px-6 py-4 font-bold text-indigo-600">

Rp {{ number_format($trx->total_price,0,',','.') }}

</td>


{{-- Status transaksi --}}
<td class="px-6 py-4">

<span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded text-xs font-bold uppercase">

{{ $trx->status }}

</span>

</td>


{{-- Tombol aksi --}}
<td class="px-6 py-4 text-right">

{{-- Cetak Struk --}}
<a href="{{ route('transactions.print',$trx->id) }}"
   target="_blank"
   class="text-indigo-600 hover:text-indigo-900 border border-indigo-200
          bg-indigo-50 hover:bg-indigo-100 px-3 py-1 rounded-md text-sm
          transition flex items-center justify-center w-fit">

<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
     viewBox="0 0 24 24">

<path stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M17 17h2a2 2 0 002-2v-4
         a2 2 0 00-2-2H5a2 2 0 00-2 2v4
         a2 2 0 002 2h2m2
         4h6a2 2 0 002-2v-4
         a2 2 0 00-2-2H9
         a2 2 0 00-2 2v4
         a2 2 0 002 2zm8-12V5
         a2 2 0 00-2-2H9
         a2 2 0 00-2 2v4h10z">
</path>

</svg>

Cetak

</a>

</td>

</tr>

@empty

{{-- Jika tidak ada transaksi --}}
<tr>

<td colspan="6" class="px-6 py-10 text-center text-slate-400">

Belum ada transaksi penjualan.

</td>

</tr>

@endforelse

</tbody>

</table>



{{-- =====================================================
   PAGINATION
===================================================== --}}
<div class="px-6 py-4 border-t border-slate-100">

{{ $transactions->links() }}

</div>

</div>

@endsection