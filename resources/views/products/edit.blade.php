@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-10">

    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('products.index') }}"
               class="group flex items-center justify-center w-11 h-11 rounded-2xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-white transition-all shadow-sm">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">Edit Produk</h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mt-1">Perbarui detail barang, harga, dan stok di etalase Anda.</p>
            </div>
        </div>
        
        <div class="hidden sm:flex items-center gap-2 bg-emerald-50 dark:bg-emerald-900/30 border border-emerald-100 dark:border-emerald-800/50 px-3 py-1.5 rounded-lg">
            <span class="relative flex h-2.5 w-2.5">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
            </span>
            <span class="text-xs font-bold text-emerald-700 dark:text-emerald-400 uppercase tracking-widest">Produk Aktif</span>
        </div>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        @if ($errors->any())
        <div class="mb-8 bg-rose-50 border border-rose-200 p-5 rounded-2xl shadow-sm animate-fade-in flex gap-4 items-start">
            <div class="p-2 bg-rose-100 rounded-xl shrink-0">
                <svg class="w-6 h-6 text-rose-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <h3 class="text-rose-800 font-bold mb-1">Gagal menyimpan perubahan!</h3>
                <ul class="text-sm text-rose-600 space-y-1 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white dark:bg-slate-800 p-6 sm:p-8 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-6 flex items-center gap-2 pb-4 border-b border-slate-100 dark:border-slate-700">
                        <div class="p-2 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        Identitas Produk
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                        
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">Nama Produk <span class="text-rose-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-indigo-900/30 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all font-medium text-slate-800 dark:text-white" required>
                        </div>

                        <div class="md:col-span-2 bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700/50 p-5 rounded-2xl relative overflow-hidden group">
                            <div class="absolute -right-4 -top-4 opacity-5 dark:opacity-10 group-focus-within:opacity-10 dark:group-focus-within:opacity-20 transition-opacity pointer-events-none">
                                <svg class="w-32 h-32 text-indigo-900 dark:text-indigo-400" fill="currentColor" viewBox="0 0 24 24"><path d="M4 6h2v12H4V6zm3 0h1v12H7V6zm2 0h3v12H9V6zm4 0h1v12h-1V6zm2 0h2v12h-2V6zm3 0h2v12h-2V6z"/></svg>
                            </div>
                            
                            <label class="block text-xs font-black text-indigo-500 dark:text-indigo-400 uppercase tracking-widest mb-1 relative z-10">Kode Barcode / SKU <span class="text-rose-500">*</span></label>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 mb-3 font-medium relative z-10">Gunakan scanner atau ketik manual kode unik barang.</p>
                            
                            <input type="text" name="barcode" value="{{ old('barcode', $product->barcode) }}"
                                class="relative z-10 w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-indigo-200 dark:focus:ring-indigo-800/50 focus:border-indigo-500 dark:focus:border-indigo-500 text-lg font-mono font-bold tracking-widest text-slate-800 dark:text-white placeholder-slate-300 dark:placeholder-slate-600 shadow-inner" required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">Kategori <span class="text-rose-500">*</span></label>
                            <select name="category" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-indigo-900/30 focus:border-indigo-500 dark:focus:border-indigo-400 transition-all font-medium text-slate-800 dark:text-slate-200 cursor-pointer appearance-none" required>
                                <option value="Makanan" {{ old('category', $product->category) == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                <option value="Minuman" {{ old('category', $product->category) == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                <option value="Sembako" {{ old('category', $product->category) == 'Sembako' ? 'selected' : '' }}>Sembako</option>
                                <option value="Pakaian" {{ old('category', $product->category) == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                                <option value="Elektronik" {{ old('category', $product->category) == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                                <option value="Lainnya" {{ old('category', $product->category) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-800 p-6 sm:p-8 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <h2 class="text-lg font-bold text-slate-800 dark:text-white mb-6 flex items-center gap-2 pb-4 border-b border-slate-100 dark:border-slate-700">
                        <div class="p-2 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        Harga & Inventaris
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-6">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">Harga Modal (HPP) <span class="text-rose-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-slate-400 dark:text-slate-500 font-bold text-sm group-focus-within:text-slate-600 dark:group-focus-within:text-slate-300 transition-colors">Rp</span>
                                </div>
                                <input type="number" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}" min="0"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-slate-200 dark:focus:ring-slate-700 focus:border-slate-500 dark:focus:border-slate-400 transition-all font-bold text-slate-700 dark:text-white" required>
                            </div>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-1.5 font-medium">Harga beli dari supplier.</p>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">Harga Jual Jual <span class="text-rose-500">*</span></label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-emerald-500 dark:text-emerald-400 font-bold text-sm">Rp</span>
                                </div>
                                <input type="number" name="price" value="{{ old('price', $product->price) }}" min="0"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-emerald-200 dark:border-emerald-800/50 bg-emerald-50/30 dark:bg-emerald-900/10 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900/50 focus:border-emerald-500 dark:focus:border-emerald-400 transition-all font-black text-emerald-700 dark:text-emerald-400 shadow-inner" required>
                            </div>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-1.5 font-medium">Harga akhir untuk pelanggan.</p>
                        </div>

                        <div class="md:col-span-2 pt-4 border-t border-slate-100 dark:border-slate-700">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">Sisa Stok Fisik <span class="text-rose-500">*</span></label>
                                    <div class="relative max-w-xs">
                                        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0"
                                            class="w-full pl-4 pr-16 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-indigo-900/30 focus:border-indigo-500 transition-all font-bold text-slate-800 dark:text-white text-lg" required>
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                            <span class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">PCS</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-2">Tgl Kedaluwarsa</label>
                                    <div class="relative max-w-xs">
                                        <input type="date" name="expired_date" value="{{ old('expired_date', $product->expired_date) }}"
                                            class="w-full pl-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-indigo-900/30 focus:border-indigo-500 transition-all font-bold text-slate-800 dark:text-white text-lg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-800 p-6 sm:p-8 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <label class="block text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-3">Deskripsi Produk (Opsional)</label>
                    <textarea name="description" rows="4"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 focus:bg-white dark:focus:bg-slate-800 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-indigo-900/30 focus:border-indigo-500 transition-all font-medium text-slate-700 dark:text-slate-200 resize-none placeholder-slate-400 dark:placeholder-slate-600"
                        placeholder="Tuliskan spesifikasi, bahan, atau catatan khusus mengenai produk ini...">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>

            <div class="space-y-6">
                
                <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-700">
                    <h2 class="text-sm font-bold text-slate-800 dark:text-white mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Foto Utama Produk
                    </h2>

                    <div class="relative group cursor-pointer w-full aspect-square rounded-2xl border-2 border-dashed border-slate-300 dark:border-slate-600 hover:border-indigo-400 dark:hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-slate-700/30 transition-all overflow-hidden flex flex-col items-center justify-center p-2 bg-slate-50 dark:bg-slate-900"
                         onclick="document.getElementById('imageInput').click()">
                        
                        <img id="previewImage"
                             src="{{ $product->image ? asset('storage/'.$product->image) : '#' }}"
                             class="{{ $product->image ? '' : 'hidden' }} absolute inset-0 w-full h-full object-cover z-10 transition-transform duration-500 group-hover:scale-105">
                        
                        <div id="image-placeholder" class="{{ $product->image ? 'hidden' : '' }} flex flex-col items-center relative z-0 p-4 text-center">
                            <div class="w-14 h-14 bg-white dark:bg-slate-800 shadow-sm border border-slate-100 dark:border-slate-700 rounded-full flex items-center justify-center text-slate-400 dark:text-slate-500 mb-3 group-hover:text-indigo-500 dark:group-hover:text-indigo-400 group-hover:scale-110 transition-all">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </div>
                            <span class="text-sm font-bold text-slate-600 dark:text-slate-300">Upload Foto Baru</span>
                            <span class="text-[10px] font-medium text-slate-400 mt-1">PNG, JPG up to 2MB</span>
                        </div>

                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-20">
                            <span class="text-white text-xs font-bold bg-slate-800/80 backdrop-blur-sm border border-slate-600 px-4 py-2 rounded-lg shadow-lg flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                Ganti Foto
                            </span>
                        </div>
                    </div>

                    <input type="file" name="image" id="imageInput" class="hidden" accept="image/png, image/jpeg, image/jpg">
                    
                    <div class="mt-4 flex items-start gap-2 p-3 bg-indigo-50/50 dark:bg-indigo-900/20 rounded-xl border border-indigo-100 dark:border-indigo-800/30">
                        <svg class="w-4 h-4 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 leading-relaxed font-medium">Gunakan foto beresolusi tinggi dengan rasio <span class="font-bold text-slate-700 dark:text-slate-300">1:1 (Kotak)</span> agar tidak terpotong di katalog kasir.</p>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-800 p-6 rounded-3xl shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col gap-3 sticky top-8">
                    
                    <h3 class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest text-center mb-2">Tindakan</h3>

                    <button type="submit" 
                        class="w-full flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white py-3.5 px-4 rounded-xl font-bold text-sm shadow-md shadow-indigo-200 transition-all hover:-translate-y-0.5 active:scale-95 focus:ring-4 focus:ring-indigo-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Perubahan
                    </button>

                    <a href="{{ route('products.index') }}" 
                        class="w-full flex items-center justify-center bg-slate-50 dark:bg-slate-900 hover:bg-slate-100 dark:hover:bg-slate-700/50 border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 py-3.5 px-4 rounded-xl font-bold text-sm transition-all active:scale-95 text-center">
                        Batal & Kembali
                    </a>
                    
                </div>
            </div>
            
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    const previewImage = document.getElementById('previewImage');
    const placeholder = document.getElementById('image-placeholder');

    imageInput.addEventListener('change', function(event) {
        const file = event.target.files[0];

        if(file) {
            // Validasi Sederhana Ukuran File (Maks 2MB)
            if(file.size > 2 * 1024 * 1024) {
                alert('Ukuran gambar melebihi 2MB. Silakan pilih gambar yang lebih kecil.');
                this.value = ''; // Kosongkan input
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewImage.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    });
});
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fadeIn 0.4s ease-out forwards; }
</style>
@endsection