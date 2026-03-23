@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">Manajemen Produk</h1>
            <p class="text-sm text-slate-500">Kelola produk dengan mudah & cepat</p>
        </div>

        <div class="flex gap-3 items-center">

            <!-- SEARCH -->
            <form method="GET" action="{{ route('products.index') }}" class="relative">
                <input type="text" name="search"
                    placeholder="Cari produk..."
                    class="pl-10 pr-4 py-2 border rounded-xl text-sm focus:ring-2 focus:ring-indigo-500">

                <span class="absolute left-3 top-2.5 text-slate-400">🔍</span>
            </form>

            <!-- ADD -->
            <a href="{{ route('products.create') }}"
               class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-5 py-2 rounded-xl shadow hover:scale-105 transition flex items-center gap-2">

                ➕ Tambah
            </a>

        </div>
    </div>


    <!-- SUCCESS -->
    @if(session('success'))
    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
    @endif


    <!-- TABLE CARD -->
    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
                    <tr>
                        <th class="px-6 py-4">Produk</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Harga</th>
                        <th class="px-6 py-4">Stok</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                @forelse ($products as $product)

                <tr class="hover:bg-slate-50 transition">

                    <!-- PRODUK -->
                    <td class="px-6 py-4 flex items-center gap-4">

                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}"
                                 class="h-12 w-12 rounded-lg object-cover border">
                        @else
                            <div class="h-12 w-12 bg-slate-200 flex items-center justify-center text-xs rounded-lg">
                                IMG
                            </div>
                        @endif

                        <div>
                            <p class="font-semibold text-slate-800">
                                {{ $product->name }}
                            </p>
                            <p class="text-xs text-slate-400">
                                {{ $product->barcode }}
                            </p>
                        </div>

                    </td>


                    <!-- KATEGORI -->
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium
                            @if($product->category == 'Makanan') bg-orange-100 text-orange-700
                            @elseif($product->category == 'Minuman') bg-blue-100 text-blue-700
                            @elseif($product->category == 'Elektronik') bg-purple-100 text-purple-700
                            @else bg-slate-100 text-slate-700
                            @endif
                        ">
                            {{ $product->category }}
                        </span>
                    </td>


                    <!-- HARGA -->
                    <td class="px-6 py-4 font-semibold text-slate-700">
                        Rp {{ number_format($product->price,0,',','.') }}
                    </td>


                    <!-- STOK -->
                    <td class="px-6 py-4">

                        <div class="flex flex-col gap-1">

                            <span class="text-xs font-medium
                                {{ $product->stock > 10 ? 'text-emerald-600' : 'text-red-600' }}">
                                {{ $product->stock }} unit
                            </span>

                            <div class="w-24 h-2 bg-slate-200 rounded">
                                <div class="h-2 rounded
                                    {{ $product->stock > 10 ? 'bg-emerald-500' : 'bg-red-500' }}"
                                    style="width: {{ min($product->stock * 5,100) }}%">
                                </div>
                            </div>

                        </div>

                    </td>


                    <!-- AKSI -->
                    <td class="px-6 py-4 text-right">

                        <div class="flex justify-end gap-2">

                            <a href="{{ route('products.edit',$product->id) }}"
                               class="p-2 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200">
                                ✏️
                            </a>

                            <form action="{{ route('products.destroy',$product->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus produk ini?')">
                                @csrf
                                @method('DELETE')

                                <button class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200">
                                    🗑️
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="text-center py-12 text-slate-400">
                        📦 Belum ada produk
                    </td>
                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <!-- PAGINATION -->
        <div class="px-6 py-4 border-t">
            {{ $products->links() }}
        </div>

    </div>

</div>

@endsection