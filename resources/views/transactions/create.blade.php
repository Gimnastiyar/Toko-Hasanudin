@extends('layouts.app')

@section('content')

{{-- ======================================================
   CONTAINER HALAMAN TRANSAKSI
====================================================== --}}
<div class="max-w-3xl mx-auto">


{{-- ======================================================
   HEADER HALAMAN
====================================================== --}}
<div class="mb-6 flex items-center">

    {{-- Tombol kembali --}}
    <a href="{{ route('dashboard') }}"
       class="text-slate-500 hover:text-indigo-600 mr-4 transition">

        <svg class="w-6 h-6" fill="none" stroke="currentColor"
             viewBox="0 0 24 24">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>

        </svg>

    </a>

    <h1 class="text-2xl font-bold text-slate-800">
        Kasir / Transaksi Baru
    </h1>

</div>



{{-- ======================================================
   NOTIFIKASI ERROR
====================================================== --}}
@if(session('error'))

<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
    {{ session('error') }}
</div>

@endif



{{-- ======================================================
   FORM TRANSAKSI
====================================================== --}}
<div class="bg-white rounded-xl shadow-lg border border-slate-100 overflow-hidden">

<div class="p-6 sm:p-8">

<form action="{{ route('transactions.store') }}" method="POST">

@csrf


<div class="space-y-6">

{{-- ============================================
   PILIH PRODUK
============================================ --}}
<div>

<label class="block text-sm font-medium text-slate-700 mb-2">
Pilih Produk
</label>

<select id="product_id"
        name="product_id"
        class="w-full rounded-lg border-slate-200 border px-4 py-3
               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500
               transition text-slate-700"
        required
        onchange="updatePrice()">

<option value="" data-price="0" data-stock="0">
-- Pilih Produk --
</option>

@foreach($products as $product)

<option value="{{ $product->id }}"
        data-price="{{ $product->price }}"
        data-stock="{{ $product->stock }}">

{{ $product->name }} (Stok: {{ $product->stock }})

</option>

@endforeach

</select>

</div>



{{-- ============================================
   INFORMASI HARGA DAN JUMLAH
============================================ --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6
            p-4 bg-slate-50 rounded-lg border border-slate-200">

{{-- Harga satuan --}}
<div>

<p class="text-sm text-slate-500 mb-1">
Harga Satuan
</p>

<p class="text-lg font-semibold text-slate-800" id="price_display">
Rp 0
</p>

</div>



{{-- Jumlah beli --}}
<div>

<label class="block text-sm font-medium text-slate-700 mb-2">
Jumlah Beli
</label>

<input type="number"
       id="quantity"
       name="quantity"
       min="1"
       value="1"
       class="w-full rounded-lg border-slate-200 border px-4 py-2
              focus:ring-2 focus:ring-indigo-500 transition"
       required
       oninput="updateTotal()">

<p class="text-xs text-red-500 mt-1 hidden" id="stock_warning">
Stok tidak cukup!
</p>

</div>

</div>



{{-- ============================================
   TOTAL PEMBAYARAN
============================================ --}}
<div class="text-right border-t border-slate-100 pt-6">

<p class="text-slate-500 mb-1">
Total Yang Harus Dibayar
</p>

<h2 class="text-4xl font-bold text-indigo-600" id="total_display">
Rp 0
</h2>

</div>

</div>



{{-- ============================================
   TOMBOL PROSES PEMBAYARAN
============================================ --}}
<div class="flex justify-end mt-8">

<button type="submit"
        class="w-full md:w-auto bg-indigo-600 text-white px-8 py-3
               rounded-lg hover:bg-indigo-700 shadow-lg hover:shadow-xl
               transition font-medium flex justify-center items-center">

<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
     viewBox="0 0 24 24">

<path stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M17 9V7a2 2 0 00-2-2H5
         a2 2 0 00-2 2v6
         a2 2 0 002 2h2
         m2 4h10a2 2 0 002-2v-6
         a2 2 0 00-2-2H9
         a2 2 0 00-2 2v6
         a2 2 0 002 2zm7-5
         a2 2 0 11-4 0
         2 2 0 014 0z">
</path>

</svg>

Proses Pembayaran

</button>

</div>

</form>

</div>

</div>

</div>



{{-- ======================================================
   SCRIPT PERHITUNGAN TRANSAKSI
====================================================== --}}
<script>

/*
|--------------------------------------------------------------------------
| Fungsi updatePrice()
|--------------------------------------------------------------------------
| Mengambil harga produk dari option yang dipilih
| lalu menampilkan harga satuan
*/

function updatePrice() {

const select = document.getElementById('product_id');

const price = select.options[select.selectedIndex].getAttribute('data-price');

document.getElementById('price_display').innerText =
'Rp ' + new Intl.NumberFormat('id-ID').format(price);

updateTotal();

}



/*
|--------------------------------------------------------------------------
| Fungsi updateTotal()
|--------------------------------------------------------------------------
| Menghitung total harga berdasarkan
| harga produk dan jumlah pembelian
*/

function updateTotal() {

const select = document.getElementById('product_id');

const price = select.options[select.selectedIndex].getAttribute('data-price') || 0;

const stock = parseInt(select.options[select.selectedIndex].getAttribute('data-stock')) || 0;

const qty = document.getElementById('quantity').value || 0;



// Validasi stok
const warning = document.getElementById('stock_warning');

if(qty > stock){

warning.classList.remove('hidden');

warning.innerText = 'Melebihi sisa stok (' + stock + ')';

}else{

warning.classList.add('hidden');

}



// Hitung total harga
const total = price * qty;

document.getElementById('total_display').innerText =
'Rp ' + new Intl.NumberFormat('id-ID').format(total);

}

</script>

@endsection