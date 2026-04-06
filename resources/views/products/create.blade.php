@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="max-w-6xl mx-auto pb-20 px-4 sm:px-6">
    @csrf

    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        
        <div class="flex items-center gap-4">
            <a href="{{ route('products.index') }}" class="group p-2.5 bg-white border border-slate-200 rounded-xl text-slate-500 hover:text-indigo-600 hover:border-indigo-300 transition-all shadow-sm">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Tambah Produk</h1>
                <p class="text-sm text-slate-500 mt-0.5">Lengkapi data untuk menambahkan produk ke etalase.</p>
            </div>
        </div>

        <div class="flex items-center gap-3 w-full sm:w-auto">
            <a href="{{ route('products.index') }}" class="flex-1 sm:flex-none px-6 py-2.5 bg-white border border-slate-200 text-slate-600 font-bold rounded-xl hover:bg-slate-50 hover:text-slate-900 transition-colors text-center shadow-sm uppercase text-xs tracking-widest">
                Batal
            </a>
            <button type="submit" class="flex-1 sm:flex-none px-8 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:scale-95 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 flex items-center justify-center gap-2 transition-all duration-200 uppercase text-xs tracking-widest">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                Simpan Produk
            </button>
        </div>
        
    </div>

    @if ($errors->any())
    <div class="mb-8 animate-in fade-in slide-in-from-top-4 duration-300">
        <div class="bg-red-50 border-l-4 border-red-500 p-5 rounded-2xl flex gap-4 items-start shadow-sm">
            <div class="bg-red-100 p-2 rounded-lg shrink-0">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-red-900 leading-none">Gagal menyimpan produk!</h3>
                <ul class="mt-2 text-sm text-red-700 space-y-1 opacity-90">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-8">

            <div class="bg-white rounded-3xl shadow-sm shadow-slate-200/50 border border-slate-100 overflow-hidden">
                <div class="px-8 py-5 border-b border-slate-50">
                    <h2 class="text-lg font-bold text-slate-800">Informasi Umum</h2>
                </div>
                
                <div class="p-8 space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Produk <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                               class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-medium text-slate-900"
                               placeholder="Contoh: Indomie Goreng Spesial" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="category" class="block text-sm font-bold text-slate-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                            <select id="category" name="category"
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all cursor-pointer font-medium text-slate-700" required>
                                <option value="" disabled {{ old('category') ? '' : 'selected' }}>Pilih Kategori...</option>
                                <option value="Makanan" {{ old('category') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="Minuman" {{ old('category') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                <option value="Sembako" {{ old('category') == 'Sembako' ? 'selected' : '' }}>Sembako</option>
                                <option value="Pakaian" {{ old('category') == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                                <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label for="supplier_id" class="block text-sm font-bold text-slate-700 mb-2">Supplier</label>
                            <select id="supplier_id" name="supplier_id"
                                    class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all cursor-pointer font-medium text-slate-700">
                                <option value="">-- Tanpa Supplier --</option>
                                @foreach($suppliers as $s)
                                    <option value="{{ $s->id }}" {{ old('supplier_id') == $s->id ? 'selected' : '' }}>
                                        {{ $s->nama_supplier }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Produk</label>
                        <textarea id="description" name="description" rows="4"
                                  class="block w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all resize-none text-slate-700"
                                  placeholder="Tuliskan detail atau deskripsi produk di sini (opsional)...">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm shadow-slate-200/50 border border-slate-100 overflow-hidden">
                <div class="px-8 py-5 border-b border-slate-50 flex items-center gap-2">
                    <div class="p-1.5 bg-emerald-100 text-emerald-600 rounded-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Harga & Inventaris</h2>
                </div>
                
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="md:col-span-1">
                            <label for="cost_price" class="block text-sm font-bold text-slate-700 mb-2">Harga Modal <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 font-bold">Rp</span>
                                <input type="number" id="cost_price" name="cost_price" value="{{ old('cost_price') }}" min="0"
                                       class="block w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-slate-900" placeholder="0" required>
                            </div>
                        </div>

                        <div class="md:col-span-1">
                            <label for="price" class="block text-sm font-bold text-slate-700 mb-2">Harga Jual <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 font-bold">Rp</span>
                                <input type="number" id="price" name="price" value="{{ old('price') }}" min="0"
                                       class="block w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all font-bold text-slate-900" placeholder="0" required>
                            </div>
                        </div>

                        <div class="md:col-span-1">
                            <label for="stock" class="block text-sm font-bold text-slate-700 mb-2">Stok Awal <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="number" id="stock" name="stock" value="{{ old('stock') }}" min="0"
                                       class="block w-full px-4 py-3 pr-12 rounded-xl border border-slate-200 bg-slate-50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all font-bold text-slate-900" placeholder="0" required>
                                <span class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 font-medium text-sm">Pcs</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="lg:col-span-1 space-y-8">

            <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 rounded-3xl shadow-lg shadow-indigo-200/50 border border-indigo-500 overflow-hidden relative">
                <div class="absolute top-0 right-0 p-4 opacity-10 text-white pointer-events-none">
                    <svg class="w-32 h-32 transform rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M4 6h2v12H4V6zm3 0h1v12H7V6zm2 0h3v12H9V6zm4 0h1v12h-1V6zm2 0h2v12h-2V6zm3 0h2v12h-2V6z"/></svg>
                </div>

                <div class="p-8 relative z-10 text-center">
                    <div class="inline-flex p-3 bg-white/20 rounded-2xl text-white mb-4 backdrop-blur-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                    </div>
                    <h2 class="text-sm font-bold text-indigo-100 uppercase tracking-widest mb-4">
                        Scan Barcode
                    </h2>
                    
                    <input type="text" id="barcode" name="barcode" value="{{ old('barcode') }}" autofocus required
                           class="block w-full px-4 py-4 rounded-2xl border-0 bg-white text-indigo-900 font-mono text-xl text-center font-bold tracking-widest focus:ring-4 focus:ring-white/30 transition-all shadow-inner placeholder-slate-300"
                           placeholder="899...">
                    
                    <p class="text-xs text-indigo-200 mt-4 leading-relaxed font-medium">
                        Klik input di atas lalu gunakan <strong>Scanner Barcode</strong> Anda.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm shadow-slate-200/50 border border-slate-100 overflow-hidden">
                <div class="px-8 py-5 border-b border-slate-50">
                    <h2 class="text-lg font-bold text-slate-800">Foto Produk</h2>
                </div>

                <div class="p-8">
                    <div class="relative w-full aspect-square bg-slate-50 border-2 border-dashed border-slate-300 rounded-2xl flex flex-col items-center justify-center overflow-hidden hover:bg-slate-100 hover:border-indigo-400 transition-colors group cursor-pointer">
                        
                        <img id="previewImage" class="hidden absolute inset-0 w-full h-full object-cover z-10" alt="Preview"/>
                        
                        <div id="placeholderText" class="text-center z-0 p-4">
                            <div class="w-14 h-14 mb-4 mx-auto bg-white rounded-2xl flex items-center justify-center shadow-sm border border-slate-200 text-slate-400 group-hover:text-indigo-500 group-hover:scale-110 transition-all duration-300">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <span class="text-sm font-bold text-slate-700 group-hover:text-indigo-600 transition-colors">Klik untuk upload foto</span>
                            <p class="text-xs text-slate-500 mt-1 font-medium">PNG, JPG up to 2MB</p>
                        </div>

                        <input id="imageInput" name="image" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20" accept="image/png, image/jpeg, image/jpg">

                        <button type="button" id="removeImageBtn" class="hidden absolute top-3 right-3 bg-white/90 backdrop-blur text-red-600 p-2 rounded-xl z-30 hover:bg-red-50 shadow-sm border border-red-100 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</form>

<script>
// [Script JS kamu tetap dipertahankan seperti aslinya, tidak ada perubahan yang dibutuhkan]
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const previewImage = document.getElementById('previewImage');
    const placeholderText = document.getElementById('placeholderText');
    const removeImageBtn = document.getElementById('removeImageBtn');

    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            if(file.size > 2 * 1024 * 1024) {
                alert('Peringatan: Ukuran gambar melebihi 2MB.');
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
                placeholderText.classList.add('hidden');
                removeImageBtn.classList.remove('hidden');
                imageInput.classList.add('hidden'); 
            }
            reader.readAsDataURL(file);
        }
    });

    removeImageBtn.addEventListener('click', function(e) {
        e.preventDefault();
        imageInput.value = ''; 
        previewImage.src = ''; 
        
        previewImage.classList.add('hidden'); 
        placeholderText.classList.remove('hidden'); 
        removeImageBtn.classList.add('hidden'); 
        imageInput.classList.remove('hidden'); 
    });
});
</script>

@endsection