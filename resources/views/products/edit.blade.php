@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto">

<!-- HEADER -->
<div class="flex items-center mb-6">

<a href="{{ route('products.index') }}"
class="text-slate-500 hover:text-indigo-600 mr-4 transition">

<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
</svg>

</a>

<h1 class="text-2xl font-bold text-slate-800">
Edit Produk
</h1>

</div>


<!-- CARD -->
<div class="bg-white p-8 rounded-xl shadow border border-slate-200">

<form
action="{{ route('products.update',$product->id) }}"
method="POST"
enctype="multipart/form-data">

@csrf
@method('PUT')


<!-- ERROR VALIDATION -->
@if ($errors->any())

<div class="mb-6 bg-red-100 border border-red-300 text-red-700 p-3 rounded">

<ul class="list-disc pl-4 text-sm">

@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach

</ul>

</div>

@endif


<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

<!-- NAMA PRODUK -->
<div class="col-span-2">

<label class="text-sm font-medium text-slate-700 block mb-1">
Nama Produk
</label>

<input
type="text"
name="name"
value="{{ old('name',$product->name) }}"
class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">

</div>


<!-- KATEGORI -->
<div>

<label class="text-sm font-medium text-slate-700 block mb-1">
Kategori
</label>

<input
type="text"
name="category"
value="{{ old('category',$product->category) }}"
class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">

</div>


<!-- HARGA -->
<div>

<label class="text-sm font-medium text-slate-700 block mb-1">
Harga (Rp)
</label>

<input
type="number"
name="price"
value="{{ old('price',$product->price) }}"
class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">

</div>


<!-- STOK -->
<div>

<label class="text-sm font-medium text-slate-700 block mb-1">
Stok
</label>

<input
type="number"
name="stock"
value="{{ old('stock',$product->stock) }}"
class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">

</div>


<!-- FOTO -->
<div>

<label class="text-sm font-medium text-slate-700 block mb-1">
Gambar Produk
</label>

<input
type="file"
name="image"
id="imageInput"
class="w-full text-sm text-slate-500
file:mr-4 file:py-2 file:px-4 file:rounded-lg
file:border-0 file:text-sm file:font-semibold
file:bg-indigo-50 file:text-indigo-700
hover:file:bg-indigo-100">

</div>


<!-- PREVIEW GAMBAR -->
<div class="flex items-center justify-center">

@if($product->image)

<img
id="previewImage"
src="{{ asset('storage/'.$product->image) }}"
class="h-24 rounded-lg border">

@else

<img
id="previewImage"
class="h-24 rounded-lg border hidden">

@endif

</div>


<!-- DESKRIPSI -->
<div class="col-span-2">

<label class="text-sm font-medium text-slate-700 block mb-1">
Deskripsi
</label>

<textarea
name="description"
rows="3"
class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500">{{ old('description',$product->description) }}</textarea>

</div>


</div>


<!-- BUTTON -->
<div class="flex justify-end gap-3 mt-8 border-t pt-6">

<a
href="{{ route('products.index') }}"
class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-300">

Batal

</a>

<button
type="submit"
class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 shadow">

Update Produk

</button>

</div>

</form>

</div>

</div>


<!-- PREVIEW SCRIPT -->
<script>

document.getElementById('imageInput').addEventListener('change',function(event){

const file = event.target.files[0];

if(file){

const reader = new FileReader();

reader.onload = function(e){

const img = document.getElementById('previewImage');

img.src = e.target.result;

img.classList.remove('hidden');

}

reader.readAsDataURL(file);

}

});

</script>

@endsection