@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">

<!-- HEADER -->
<div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

<div>
<h1 class="text-2xl font-bold text-slate-800">Manajemen Produk</h1>
<p class="text-sm text-slate-500">Kelola seluruh produk yang tersedia di toko</p>
</div>

<div class="flex gap-3">

<!-- SEARCH -->
<form method="GET" action="{{ route('products.index') }}">
<input type="text"
name="search"
placeholder="Cari produk..."
class="border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-500">
</form>

<!-- TAMBAH PRODUK -->
<a href="{{ route('products.create') }}"
class="bg-emerald-600 text-white px-5 py-2 rounded-lg hover:bg-emerald-700 transition flex items-center shadow">

<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round"
stroke-width="2" d="M12 4v16m8-8H4"/>
</svg>

Tambah Produk

</a>

</div>

</div>


{{-- SUCCESS MESSAGE --}}
@if(session('success'))

<div class="bg-emerald-100 border border-emerald-400 text-emerald-700
px-4 py-3 rounded-lg mb-6">

{{ session('success') }}

</div>

@endif


<!-- CARD TABLE -->
<div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">

<div class="overflow-x-auto">

<table class="w-full text-sm text-left">

<thead class="bg-slate-100 text-slate-600 uppercase text-xs">

<tr>

<th class="px-6 py-4">Gambar</th>
<th class="px-6 py-4">Nama Produk</th>
<th class="px-6 py-4">Kategori</th>
<th class="px-6 py-4">Harga</th>
<th class="px-6 py-4">Stok</th>
<th class="px-6 py-4 text-right">Aksi</th>

</tr>

</thead>


<tbody class="divide-y">

@forelse ($products as $product)

<tr class="hover:bg-slate-50 transition">

<!-- IMAGE -->
<td class="px-6 py-4">

@if($product->image)

<img src="{{ asset('storage/'.$product->image) }}"
class="h-14 w-14 rounded-lg object-cover border">

@else

<div class="h-14 w-14 bg-slate-200 flex items-center justify-center text-xs text-slate-500 rounded-lg">
No Img
</div>

@endif

</td>


<!-- NAME -->
<td class="px-6 py-4 font-semibold text-slate-800">
{{ $product->name }}
</td>


<!-- CATEGORY -->
<td class="px-6 py-4">

<span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs">

{{ $product->category }}

</span>

</td>


<!-- PRICE -->
<td class="px-6 py-4 font-medium text-slate-700">

Rp {{ number_format($product->price,0,',','.') }}

</td>


<!-- STOCK -->
<td class="px-6 py-4">

@if($product->stock > 10)

<span class="px-2 py-1 bg-emerald-100 text-emerald-700 text-xs rounded">

{{ $product->stock }} Aman

</span>

@else

<span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded font-bold animate-pulse">

{{ $product->stock }} Hampir Habis

</span>

@endif

</td>


<!-- ACTION -->
<td class="px-6 py-4 text-right">

<div class="flex justify-end gap-2">

<a href="{{ route('products.edit',$product->id) }}"
class="bg-blue-100 text-blue-700 px-3 py-1 rounded hover:bg-blue-200 text-sm">

Edit

</a>

<form action="{{ route('products.destroy',$product->id) }}"
method="POST"
onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

@csrf
@method('DELETE')

<button
class="bg-red-100 text-red-700 px-3 py-1 rounded hover:bg-red-200 text-sm">

Hapus

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>

<td colspan="6" class="text-center py-12 text-slate-400">

Belum ada produk tersedia

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