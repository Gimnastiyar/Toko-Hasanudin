@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
            <a href="{{ route('products.index') }}"
               class="p-2 rounded-lg bg-slate-100 hover:bg-indigo-100 transition">
                ←
            </a>

            <div>
                <h1 class="text-2xl font-bold text-slate-800">Edit Produk</h1>
                <p class="text-sm text-slate-500">Perbarui informasi produk dengan cepat</p>
            </div>
        </div>
    </div>

    <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- ERROR -->
        @if ($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg">
            <ul class="text-sm space-y-1">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid md:grid-cols-3 gap-8">

            <!-- ========================= -->
            <!-- LEFT: INFORMASI PRODUK -->
            <!-- ========================= -->
            <div class="md:col-span-2 bg-white p-8 rounded-2xl shadow border">

                <h2 class="font-semibold text-slate-700 mb-6">Informasi Produk</h2>

                <div class="space-y-5">

                    <!-- NAMA -->
                    <div>
                        <label class="text-xs text-slate-500">Nama Produk</label>
                        <input type="text" name="name"
                            value="{{ old('name',$product->name) }}"
                            class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <!-- BARCODE (HIGHLIGHT) -->
                    <div class="bg-indigo-50 border border-indigo-100 p-4 rounded-xl">
                        <label class="text-xs text-indigo-600 font-semibold">Barcode</label>
                        <input type="text" name="barcode"
                            value="{{ old('barcode',$product->barcode) }}"
                            class="w-full mt-2 px-4 py-3 rounded-xl border-2 border-indigo-200 focus:ring-2 focus:ring-indigo-500 text-lg tracking-wide">
                    </div>

                    <!-- GRID -->
                    <div class="grid md:grid-cols-2 gap-4">

                        <!-- KATEGORI -->
                        <div>
                            <label class="text-xs text-slate-500">Kategori</label>
                            <input type="text" name="category"
                                value="{{ old('category',$product->category) }}"
                                class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <!-- HARGA -->
                        <div>
                            <label class="text-xs text-slate-500">Harga</label>
                            <input type="number" name="price"
                                value="{{ old('price',$product->price) }}"
                                class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <!-- STOK -->
                        <div>
                            <label class="text-xs text-slate-500">Stok</label>
                            <input type="number" name="stock"
                                value="{{ old('stock',$product->stock) }}"
                                class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500">
                        </div>

                    </div>

                    <!-- DESKRIPSI -->
                    <div>
                        <label class="text-xs text-slate-500">Deskripsi</label>
                        <textarea name="description" rows="4"
                            class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500">{{ old('description',$product->description) }}</textarea>
                    </div>

                </div>

            </div>

            <!-- ========================= -->
            <!-- RIGHT: MEDIA -->
            <!-- ========================= -->
            <div class="bg-white p-6 rounded-2xl shadow border">

                <h2 class="font-semibold text-slate-700 mb-4">Gambar Produk</h2>

                <!-- PREVIEW -->
                <div class="w-full h-48 rounded-xl border bg-slate-50 flex items-center justify-center overflow-hidden mb-4">

                    @if($product->image)
                        <img id="previewImage"
                             src="{{ asset('storage/'.$product->image) }}"
                             class="w-full h-full object-cover">
                    @else
                        <img id="previewImage" class="hidden">
                        <span class="text-slate-400 text-sm">Belum ada gambar</span>
                    @endif

                </div>

                <!-- INPUT -->
                <input type="file"
                       name="image"
                       id="imageInput"
                       class="block w-full text-sm text-slate-500
                       file:mr-4 file:py-2 file:px-4 file:rounded-lg
                       file:border-0 file:font-semibold
                       file:bg-indigo-50 file:text-indigo-700
                       hover:file:bg-indigo-100">

                <p class="text-xs text-slate-400 mt-2">
                    Format: JPG, PNG. Maks 2MB
                </p>

            </div>

        </div>

        <!-- BUTTON -->
        <div class="flex justify-between items-center mt-10 pt-6 border-t">

            <a href="{{ route('products.index') }}"
               class="text-slate-500 hover:text-slate-700">
                ← Kembali
            </a>

            <button type="submit"
                class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-10 py-3 rounded-xl shadow hover:scale-105 transition font-semibold">
                💾 Update Produk
            </button>

        </div>

    </form>

</div>

<!-- SCRIPT -->
<script>
document.getElementById('imageInput').addEventListener('change', function(event){
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