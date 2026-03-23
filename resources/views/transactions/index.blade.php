@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8 flex flex-col md:flex-row justify-between items-center gap-4">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">Riwayat Transaksi</h1>
            <p class="text-sm text-slate-500">Pantau semua aktivitas penjualan</p>
        </div>

        <div class="flex gap-3">

            <!-- EXPORT -->
            <a href="{{ route('transactions.export') }}"
               class="bg-emerald-500 text-white px-5 py-2 rounded-xl shadow hover:scale-105 transition flex items-center gap-2">
                ⬇️ Export
            </a>

            <!-- TAMBAH -->
            <a href="{{ route('transactions.create') }}"
               class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-5 py-2 rounded-xl shadow hover:scale-105 transition flex items-center gap-2">
                ➕ Transaksi
            </a>

        </div>

    </div>


    <!-- SUMMARY CARD -->
    <div class="grid md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white p-6 rounded-xl shadow border">
            <p class="text-sm text-slate-500">Total Transaksi</p>
            <h2 class="text-2xl font-bold text-indigo-600">
                {{ $transactions->count() }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-xl shadow border">
            <p class="text-sm text-slate-500">Total Pendapatan</p>
            <h2 class="text-2xl font-bold text-emerald-600">
                Rp {{ number_format($transactions->sum('total_price'),0,',','.') }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-xl shadow border">
            <p class="text-sm text-slate-500">Produk Terjual</p>
            <h2 class="text-2xl font-bold text-purple-600">
                {{ $transactions->sum('quantity') }}
            </h2>
        </div>

    </div>


    <!-- ALERT -->
    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif


    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow-lg border overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
                    <tr>
                        <th class="px-6 py-4">Transaksi</th>
                        <th class="px-6 py-4">Produk</th>
                        <th class="px-6 py-4">Qty</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                @forelse($transactions as $trx)

                <tr class="hover:bg-slate-50 transition">

                    <!-- TRANSAKSI -->
                    <td class="px-6 py-4">
                        <p class="font-semibold text-slate-800">
                            #TRX{{ $trx->id }}
                        </p>
                        <p class="text-xs text-slate-400">
                            {{ $trx->created_at->format('d M Y, H:i') }}
                        </p>
                    </td>

                    <!-- PRODUK -->
                    <td class="px-6 py-4">
                        <p class="font-medium text-slate-800">
                            {{ $trx->product->name }}
                        </p>
                        <p class="text-xs text-slate-400">
                            Rp {{ number_format($trx->product->price,0,',','.') }}
                        </p>
                    </td>

                    <!-- QTY -->
                    <td class="px-6 py-4 font-bold text-slate-700">
                        x{{ $trx->quantity }}
                    </td>

                    <!-- TOTAL -->
                    <td class="px-6 py-4 font-bold text-indigo-600">
                        Rp {{ number_format($trx->total_price,0,',','.') }}
                    </td>

                    <!-- STATUS -->
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $trx->status == 'success' ? 'bg-emerald-100 text-emerald-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $trx->status }}
                        </span>
                    </td>

                    <!-- AKSI -->
                    <td class="px-6 py-4 text-right">

                        <a href="{{ route('transactions.print',$trx->id) }}"
                           target="_blank"
                           class="p-2 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200">
                            🧾
                        </a>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6" class="text-center py-12 text-slate-400">
                        📦 Belum ada transaksi
                    </td>
                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        <div class="px-6 py-4 border-t">
            {{ $transactions->links() }}
        </div>

    </div>

</div>

@endsection