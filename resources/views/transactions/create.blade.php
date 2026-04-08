@extends('layouts.app')

@section('title', 'Transaksi Kasir')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 min-h-[calc(100vh-4rem)] flex flex-col">
    
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight flex items-center gap-3">
                <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                Kasir Pintar
            </h1>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Sistem kasir cerdas untuk proses transaksi cepat.</p>
        </div>
        
        <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 px-4 py-2.5 rounded-xl shadow-sm flex items-center gap-3">
            <svg class="w-5 h-5 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span id="current-date" class="text-sm font-semibold text-slate-700 dark:text-slate-300 uppercase tracking-wide"></span>
        </div>
    </div>

    <form action="{{ route('transactions.store') }}" method="POST" class="flex-1 flex flex-col">
        @csrf
        <input type="hidden" name="product_id" id="product_id">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 flex-1">
            
            <div class="lg:col-span-8 flex flex-col gap-6">
                
                <div class="bg-white dark:bg-slate-800 p-6 sm:p-8 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 relative overflow-hidden group">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-50 dark:bg-indigo-900/10 rounded-full blur-3xl group-focus-within:bg-indigo-100 dark:group-focus-within:bg-indigo-900/20 transition-colors duration-500"></div>

                    <div class="relative z-10">
                        <label for="barcode" class="block text-sm font-bold text-slate-700 dark:text-white mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                            Pindai / Ketik Barcode
                        </label>
                        
                        <div class="flex flex-col sm:flex-row gap-4">
                            <div class="relative flex-1">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="h-6 w-6 text-slate-400 dark:text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                                <input type="text" id="barcode" autocomplete="off"
                                    class="block w-full pl-12 pr-4 py-4 bg-slate-50/50 dark:bg-slate-900/50 border-2 border-slate-200 dark:border-slate-700/50 rounded-xl focus:bg-white dark:focus:bg-slate-800 focus:ring-0 focus:border-indigo-500 dark:focus:border-indigo-400 transition-colors text-xl font-mono text-slate-800 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 shadow-inner"
                                    placeholder="Contoh: 899..." autofocus>
                            </div>
                            
                            <button type="button" onclick="checkBarcode()"
                                class="h-16 px-8 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-lg rounded-xl transition-all shadow-md shadow-indigo-200 dark:shadow-none hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2 shrink-0">
                                Cari
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                        
                        <div id="status" class="mt-4 flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-slate-400">
                            <span class="relative flex h-3 w-3">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-slate-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-3 w-3 bg-slate-500"></span>
                            </span>
                            Menunggu input barcode...
                        </div>
                    </div>
                </div>

                <div id="productBox" class="flex-1 bg-white dark:bg-slate-800 border-2 border-dashed border-slate-200 dark:border-slate-700/50 rounded-2xl p-8 sm:p-12 flex flex-col items-center justify-center transition-all duration-300 relative min-h-[300px]">
                    <svg id="placeholder-bg" class="absolute inset-0 w-full h-full text-slate-50 dark:text-slate-800/10 opacity-50 pointer-events-none" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 L0,100 Z M50,20 L80,80 L20,80 Z"/></svg>

                    <div class="relative z-10 flex flex-col items-center w-full max-w-lg mx-auto text-center">
                        <div id="product-icon-container" class="w-24 h-24 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-6 shadow-sm border border-slate-200 dark:border-slate-600 transition-colors duration-300">
                            <svg id="display-icon" class="w-12 h-12 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        
                        <h2 id="name" class="text-3xl font-black text-slate-800 dark:text-white mb-2 tracking-tight">Belum Ada Produk</h2>
                        <p id="display-barcode" class="text-base text-slate-500 dark:text-slate-400 mb-8 font-mono bg-slate-100 dark:bg-slate-700 px-4 py-1 rounded-full border border-slate-200 dark:border-slate-600 inline-block">Silakan scan barang terlebih dahulu</p>

                        <div class="grid grid-cols-2 gap-4 sm:gap-6 w-full opacity-50 grayscale transition-all duration-300" id="detail-grid">
                            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm text-center relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-full h-1 bg-indigo-500 hidden" id="price-line"></div>
                                <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Harga Satuan</p>
                                <p class="text-2xl font-black text-indigo-600 dark:text-indigo-400" id="price">Rp 0</p>
                            </div>
                            
                            <div class="bg-white dark:bg-slate-800 p-5 rounded-2xl border border-slate-200 dark:border-slate-700 shadow-sm text-center relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-full h-1 bg-emerald-500 hidden" id="stock-line"></div>
                                <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-2">Stok Tersedia</p>
                                <div class="flex items-center justify-center gap-2">
                                    <p class="text-2xl font-black text-slate-700 dark:text-slate-300" id="stock">0</p>
                                    <span class="text-sm font-medium text-slate-500 dark:text-slate-400 mt-1">Pcs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" id="btn-reset" onclick="resetForm()" class="absolute top-4 right-4 p-2 bg-red-50 dark:bg-red-900/30 text-red-500 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/50 hover:text-red-600 dark:hover:text-red-300 rounded-lg hidden transition-colors" title="Batal Pilih Produk">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-slate-900 rounded-3xl p-6 sm:p-8 shadow-2xl sticky top-8 flex flex-col h-full lg:h-auto min-h-[550px] border border-slate-800 relative overflow-hidden">
                    
                    <div class="absolute top-0 right-0 -mr-16 -mt-16 w-48 h-48 bg-indigo-500/20 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 bg-emerald-500/20 rounded-full blur-3xl"></div>

                    <div class="relative z-10 flex-1 flex flex-col">
                        <h3 class="text-lg font-bold text-white mb-6 pb-4 border-b border-slate-800 flex items-center justify-between">
                            Ringkasan Pembayaran
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </h3>

                        <div class="mb-6">
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Kuantitas Barang</label>
                            <div class="flex items-center justify-between bg-slate-800/50 p-2 rounded-2xl border border-slate-700/50 backdrop-blur-sm">
                                <button type="button" onclick="changeQty(-1)"
                                    class="w-14 h-14 flex items-center justify-center bg-slate-700 hover:bg-slate-600 text-white rounded-xl transition-colors font-bold text-2xl shadow-inner active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed" id="btn-minus" disabled>
                                    −
                                </button>
                                
                                <input id="qty" name="quantity" type="number" value="1" min="1"
                                    class="w-24 text-center bg-transparent border-none text-4xl font-black text-white focus:ring-0 p-0"
                                    onchange="calculate()" disabled readonly>

                                <button type="button" onclick="changeQty(1)"
                                    class="w-14 h-14 flex items-center justify-center bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl transition-colors font-bold text-2xl shadow-inner active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed" id="btn-plus" disabled>
                                    +
                                </button>
                            </div>
                        </div>

                        <div class="bg-slate-800/50 p-4 rounded-2xl border border-slate-700/50 backdrop-blur-sm mb-6">
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Potongan Harga (Diskon)</label>
                            <div class="grid grid-cols-2 gap-3">
                                <select id="discount_type" name="discount_type" onchange="calculate()" disabled
                                    class="w-full bg-slate-700 border border-slate-600 text-white text-sm rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <option value="nominal">Rp (Nominal)</option>
                                    <option value="percent">% (Persen)</option>
                                </select>
                                
                                <input type="number" id="discount" name="discount" value="0" min="0" oninput="calculate()" disabled
                                    class="w-full bg-slate-700 border border-slate-600 text-white text-sm rounded-xl px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed placeholder-slate-400 text-center"
                                    placeholder="0">
                            </div>
                        </div>

                        <div class="mt-auto pt-4">
                            <div class="mb-8">
                                <div class="flex justify-between items-end mb-2">
                                    <p class="text-slate-400 text-sm font-bold uppercase tracking-widest">Total Tagihan</p>
                                    <p id="discount-label" class="text-xs font-bold text-amber-400 hidden">- Diskon Rp 0</p>
                                </div>
                                <h1 id="total" class="text-4xl sm:text-5xl font-black text-emerald-400 tracking-tighter truncate" title="Rp 0">
                                    Rp 0
                                </h1>
                            </div>

                            <button type="submit" id="btn-submit"
                                class="group relative w-full bg-emerald-500 hover:bg-emerald-400 text-slate-900 py-5 rounded-2xl font-black text-xl shadow-[0_0_40px_-10px_rgba(16,185,129,0.5)] transition-all duration-300 disabled:opacity-30 disabled:hover:bg-emerald-500 disabled:cursor-not-allowed disabled:shadow-none overflow-hidden"
                                disabled>
                                <span class="relative z-10 flex items-center justify-center gap-3">
                                    BAYAR SEKARANG
                                    <svg class="w-6 h-6 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </span>
                            </button>
                        </div>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let currentPrice = 0;
let maxStock = 0;

// Inisialisasi Tanggal
document.addEventListener('DOMContentLoaded', function() {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('current-date').innerText = new Intl.DateTimeFormat('id-ID', options).format(new Date());
    document.getElementById('barcode').focus();
});

// Trigger Enter pada input Barcode
document.getElementById('barcode').addEventListener('keypress', function(e){
    if (e.key === 'Enter') {
        e.preventDefault();
        checkBarcode();
    }
});

async function checkBarcode() {
    let code = document.getElementById('barcode').value.trim();
    let status = document.getElementById('status');
    
    if (!code) {
        document.getElementById('barcode').focus();
        return;
    }

    status.innerHTML = `<span class="relative flex h-3 w-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-yellow-500"></span></span> Mencari di database...`;

    try {
        let res = await fetch(`/api/products/search?code=${code}`);
        let data = await res.json();

        if (data.status === 'success') {
            let p = data.data;

            if(p.stock <= 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Stok Habis!',
                    text: `Produk ${p.name} tidak memiliki stok tersisa.`,
                    confirmButtonColor: '#4f46e5'
                });
                resetForm(false);
                return;
            }

            // Update Data ke UI
            document.getElementById('product_id').value = p.id;
            document.getElementById('name').innerText = p.name;
            document.getElementById('display-barcode').innerText = `SKU: ${code}`;
            document.getElementById('price').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(p.price);
            document.getElementById('stock').innerText = p.stock;
            
            currentPrice = p.price;
            maxStock = p.stock;
            
            // Set input qty ke 1, reset diskon ke 0
            document.getElementById('qty').value = 1;
            document.getElementById('discount').value = 0;

            // Update UI (Box jadi Biru/Aktif)
            let productBox = document.getElementById('productBox');
            let iconContainer = document.getElementById('product-icon-container');
            let displayIcon = document.getElementById('display-icon');
            let detailGrid = document.getElementById('detail-grid');

            productBox.classList.remove('border-dashed', 'border-slate-200', 'dark:border-slate-700/50');
            productBox.classList.add('border-solid', 'border-indigo-200', 'dark:border-indigo-800/50', 'bg-indigo-50/20', 'dark:bg-indigo-900/10', 'shadow-xl');
            
            iconContainer.classList.remove('bg-slate-100', 'dark:bg-slate-700');
            iconContainer.classList.add('bg-indigo-600', 'shadow-lg', 'shadow-indigo-300', 'dark:shadow-none');
            displayIcon.classList.remove('text-slate-400', 'dark:text-slate-500');
            displayIcon.classList.add('text-white');
            displayIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>`;

            detailGrid.classList.remove('opacity-50', 'grayscale');
            document.getElementById('price-line').classList.remove('hidden');
            document.getElementById('stock-line').classList.remove('hidden');
            document.getElementById('btn-reset').classList.remove('hidden');

            // Aktifkan Semua Kontrol (Termasuk Diskon)
            document.getElementById('qty').disabled = false;
            document.getElementById('btn-minus').disabled = false;
            document.getElementById('btn-plus').disabled = false;
            document.getElementById('discount_type').disabled = false;
            document.getElementById('discount').disabled = false;
            document.getElementById('btn-submit').disabled = false;
            
            status.innerHTML = `<span class="relative flex h-3 w-3"><span class="absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span></span> Produk siap dibayar!`;
            
            calculate();

        } else {
            Swal.fire({ 
                icon: 'error', 
                title: 'Tidak Ditemukan', 
                text: `Barcode ${code} tidak terdaftar di sistem.`,
                confirmButtonColor: '#4f46e5'
            });
            resetForm(true); 
        }
    } catch (e) {
        status.innerHTML = `<span class="relative flex h-3 w-3"><span class="absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span></span> Kesalahan jaringan / server.`;
    }
}

function changeQty(val) {
    let input = document.getElementById('qty');
    let newVal = parseInt(input.value) + val;
    
    if (newVal < 1) newVal = 1;
    
    if (newVal > maxStock) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'warning',
            title: 'Melebihi batas stok tersedia!',
            showConfirmButton: false,
            timer: 2000
        });
        newVal = maxStock;
    }
    
    input.value = newVal;
    calculate();
}

function calculate() {
    let qty = parseInt(document.getElementById('qty').value) || 0;
    let subtotal = qty * currentPrice;
    
    // Ambil Nilai Diskon
    let discountType = document.getElementById('discount_type').value;
    let discountValue = parseFloat(document.getElementById('discount').value) || 0;
    let discountAmount = 0;

    // Hitung Logika Diskon
    if (discountType === 'percent') {
        // Jangan biarkan diskon lebih dari 100%
        if (discountValue > 100) {
            document.getElementById('discount').value = 100;
            discountValue = 100;
        }
        discountAmount = subtotal * (discountValue / 100);
    } else {
        // Nominal
        discountAmount = discountValue;
    }

    // Hitung Total Akhir (Jangan sampai minus)
    let grandTotal = subtotal - discountAmount;
    if (grandTotal < 0) grandTotal = 0;

    // Tampilkan Potongan Diskon (Teks Kuning)
    let discountLabel = document.getElementById('discount-label');
    if (discountAmount > 0) {
        discountLabel.innerText = `- Diskon Rp ${new Intl.NumberFormat('id-ID').format(discountAmount)}`;
        discountLabel.classList.remove('hidden');
    } else {
        discountLabel.classList.add('hidden');
    }

    // Update Angka Besar Tagihan
    let displayTotal = document.getElementById('total');
    displayTotal.classList.add('scale-105', 'text-white');
    displayTotal.classList.remove('text-emerald-400');
    
    setTimeout(() => {
        displayTotal.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);
        displayTotal.classList.remove('scale-105', 'text-white');
        displayTotal.classList.add('text-emerald-400');
    }, 150);
}

// Fungsi Reset Form
function resetForm(clearInput = true){
    currentPrice = 0;
    maxStock = 0;

    document.getElementById('name').innerText = 'Belum Ada Produk';
    document.getElementById('display-barcode').innerText = 'Silakan scan barang terlebih dahulu';
    document.getElementById('price').innerText = 'Rp 0';
    document.getElementById('stock').innerText = '0';
    document.getElementById('total').innerText = 'Rp 0';
    document.getElementById('discount-label').classList.add('hidden');

    let productBox = document.getElementById('productBox');
    productBox.className = "flex-1 bg-white dark:bg-slate-800 border-2 border-dashed border-slate-200 dark:border-slate-700/50 rounded-2xl p-8 sm:p-12 flex flex-col items-center justify-center transition-all duration-300 relative min-h-[300px]";
    
    let iconContainer = document.getElementById('product-icon-container');
    iconContainer.className = "w-24 h-24 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-6 shadow-sm border border-slate-200 dark:border-slate-600 transition-colors duration-300";
    
    let displayIcon = document.getElementById('display-icon');
    displayIcon.className = "w-12 h-12 text-slate-400 dark:text-slate-500";
    displayIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>`;

    let detailGrid = document.getElementById('detail-grid');
    detailGrid.className = "grid grid-cols-2 gap-4 sm:gap-6 w-full opacity-50 grayscale transition-all duration-300";
    document.getElementById('price-line').classList.add('hidden');
    document.getElementById('stock-line').classList.add('hidden');
    document.getElementById('btn-reset').classList.add('hidden');

    // Matikan Semua Kontrol Kanan
    document.getElementById('qty').value = "1";
    document.getElementById('qty').disabled = true;
    document.getElementById('btn-minus').disabled = true;
    document.getElementById('btn-plus').disabled = true;
    
    document.getElementById('discount').value = "0";
    document.getElementById('discount').disabled = true;
    document.getElementById('discount_type').value = "nominal";
    document.getElementById('discount_type').disabled = true;

    document.getElementById('btn-submit').disabled = true;

    document.getElementById('status').innerHTML = `<span class="relative flex h-3 w-3"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-slate-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-slate-500"></span></span> Menunggu input barcode...`;
    
    let inputBarcode = document.getElementById('barcode');
    if(clearInput) {
        inputBarcode.value = "";
    }
    inputBarcode.focus();
}
</script>
@endsection