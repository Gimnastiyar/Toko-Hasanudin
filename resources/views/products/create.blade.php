@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-3">
            <a href="{{ route('products.index') }}"
               class="p-2 rounded-lg bg-slate-100 hover:bg-indigo-100 transition">
                ←
            </a>

            <div>
                <h1 class="text-2xl font-bold text-slate-800">Tambah Produk</h1>
                <p class="text-sm text-slate-500">Tambahkan produk baru ke sistem</p>
            </div>
        </div>
    </div>

    <!-- CARD -->
    <div class="bg-white p-10 rounded-2xl shadow-lg border border-slate-100">

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

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

            <!-- BARCODE (HIGHLIGHT SECTION) -->
            <div class="mb-8 bg-gradient-to-r from-indigo-50 to-purple-50 border border-indigo-100 p-6 rounded-xl">
                <label class="text-sm font-semibold text-indigo-700 block mb-2">
                    Scan / Input Barcode
                </label>

                <input type="text"
                       name="barcode"
                       value="{{ old('barcode') }}"
                       class="w-full px-5 py-3 rounded-xl border-2 border-indigo-200 focus:ring-2 focus:ring-indigo-500 focus:outline-none text-lg tracking-wide"
                       placeholder="Scan barcode di sini..."
                       required>

                <p class="text-xs text-indigo-400 mt-2">
                    Scanner otomatis akan mengisi dan submit (jika pakai barcode scanner)
                </p>
            </div>

            <!-- GRID -->
            <div class="grid md:grid-cols-2 gap-6">

                <!-- NAMA -->
                <div class="col-span-2">
                    <label class="text-xs text-slate-500">Nama Produk</label>
                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500"
                           placeholder="Contoh: Indomie Goreng">
                </div>

                <!-- KATEGORI -->
                <div>
                    <label class="text-xs text-slate-500">Kategori</label>
                    <select name="category"
                        class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500">

                        <option>Makanan</option>
                        <option>Minuman</option>
                        <option>Kerajinan</option>
                        <option>Pakaian</option>
                        <option>Elektronik</option>
                        <option>Lainnya</option>

                    </select>
                </div>

                <!-- HARGA -->
                <div>
                    <label class="text-xs text-slate-500">Harga</label>
                    <input type="number"
                           name="price"
                           value="{{ old('price') }}"
                           class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500"
                           placeholder="Rp 0">
                </div>

                <!-- STOK -->
                <div>
                    <label class="text-xs text-slate-500">Stok</label>
                    <input type="number"
                           name="stock"
                           value="{{ old('stock') }}"
                           class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500"
                           placeholder="0">
                </div>

                <!-- UPLOAD -->
                <div class="col-span-2">
                    <label class="text-xs text-slate-500">Upload Gambar</label>

                    <div class="flex items-center gap-6 mt-2">

                        <input type="file"
                               name="image"
                               id="imageInput"
                               class="block w-full text-sm text-slate-500
                               file:mr-4 file:py-2 file:px-4 file:rounded-lg
                               file:border-0 file:font-semibold
                               file:bg-indigo-50 file:text-indigo-700
                               hover:file:bg-indigo-100">

                        <!-- PREVIEW BOX -->
                        <div class="w-28 h-28 rounded-xl border bg-slate-50 flex items-center justify-center overflow-hidden">
                            <img id="previewImage" class="hidden w-full h-full object-cover"/>
                            <span class="text-xs text-slate-400">Preview</span>
                        </div>

                    </div>
                </div>

                <!-- DESKRIPSI -->
                <div class="col-span-2">
                    <label class="text-xs text-slate-500">Deskripsi</label>
                    <textarea name="description"
                              rows="4"
                              class="w-full mt-1 px-4 py-3 rounded-xl border focus:ring-2 focus:ring-indigo-500"
                              placeholder="Deskripsi produk...">{{ old('description') }}</textarea>
                </div>

            </div>

            <!-- BUTTON -->
            <div class="flex justify-between items-center mt-10 pt-6 border-t">

                <a href="{{ route('products.index') }}"
                   class="text-slate-500 hover:text-slate-700">
                    ← Kembali
                </a>

                <button type="submit"
                        class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-8 py-3 rounded-xl shadow-md hover:scale-105 transition">
                    🚀 Simpan Produk
                </button>

            </div>

        </form>

    </div>

</div>

<!-- SCRIPT PREVIEW -->
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