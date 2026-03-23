@extends('layouts.app')
@section('content')

<div class="max-w-5xl mx-auto mt-6">

    <!-- TITLE -->
    <h1 class="text-xl font-semibold mb-4">Tambah Transaksi</h1>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <input type="hidden" name="product_id" id="product_id">

        <div class="bg-white rounded-xl shadow p-6">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- LEFT -->
                <div class="lg:col-span-2">

                    <label class="text-xs text-gray-500 font-semibold">
                        INPUT DATA BARANG
                    </label>

                    <!-- INPUT -->
                    <div class="flex mt-2">
                        <input type="text" id="barcode"
                            class="w-full border rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            placeholder="Scan barcode..." autofocus>

                        <button type="button" onclick="checkBarcode()"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 rounded-r-lg">
                            Cari
                        </button>
                    </div>

                    <p id="status" class="text-xs text-gray-400 mt-1">
                        Menunggu input...
                    </p>

                    <!-- PRODUCT CARD -->
                    <div id="productBox"
                        class="mt-6 border rounded-xl p-6 text-center opacity-50 transition duration-300">

                        <div class="text-gray-400 text-3xl mb-2">📦</div>

                        <h2 id="name" class="font-semibold text-lg">-</h2>

                        <div class="flex justify-center gap-6 mt-3 text-sm">

                            <div>
                                <p class="text-gray-400">Harga</p>
                                <p id="price">0</p>
                            </div>

                            <div>
                                <p class="text-gray-400">Stok</p>
                                <p id="stock">0</p>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- RIGHT -->
                <div>

                    <label class="text-xs text-gray-500 font-semibold">
                        RINCIAN PEMBAYARAN
                    </label>

                    <!-- QTY -->
                    <div class="bg-gray-50 rounded-xl p-4 mt-2 text-center">

                        <p class="text-sm text-gray-500">Jumlah Barang</p>

                        <div class="flex justify-center items-center gap-4 mt-2">

                            <button type="button" onclick="changeQty(-1)"
                                class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">
                                -
                            </button>

                            <input id="qty" name="quantity" type="number" value="1"
                                class="w-16 text-center border rounded"
                                disabled>

                            <button type="button" onclick="changeQty(1)"
                                class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">
                                +
                            </button>

                        </div>

                    </div>

                    <!-- TOTAL -->
                    <div
                        class="bg-indigo-600 text-white text-center rounded-xl p-6 mt-4 shadow-lg">

                        <p class="text-indigo-200 text-sm">TOTAL TAGIHAN</p>

                        <h1 id="total" class="text-4xl font-extrabold text-white">
                            Rp 0
                        </h1>

                    </div>

                    <!-- BUTTON -->
                    <button type="submit" id="btn"
                        class="w-full bg-green-500 text-white py-3 rounded-xl mt-4 transition duration-200 opacity-50 cursor-not-allowed"
                        disabled>

                        PROSES PEMBAYARAN

                    </button>

                    <p class="text-xs text-gray-400 text-center mt-2">
                        Pastikan data sudah benar sebelum memproses
                    </p>

                </div>

            </div>

        </div>

    </form>

</div>

<script>
let currentPrice = 0;

// ENTER = AUTO SEARCH
document.getElementById('barcode').addEventListener('keypress', function(e){
    if (e.key === 'Enter') {
        e.preventDefault();
        checkBarcode();
    }
});

async function checkBarcode() {

    let code = document.getElementById('barcode').value;
    let status = document.getElementById('status');

    if (!code) return;

    status.innerText = "Mencari...";

    try {

        let res = await fetch(`/api/products/search?code=${code}`);
        let data = await res.json();

        if (data.status === 'success') {

            let p = data.data;

            document.getElementById('product_id').value = p.id;
            document.getElementById('name').innerText = p.name;
            document.getElementById('price').innerText =
                new Intl.NumberFormat('id-ID').format(p.price);
            document.getElementById('stock').innerText = p.stock;

            currentPrice = p.price;

            // AKTIFKAN UI
            document.getElementById('productBox').classList.remove('opacity-50');
            document.getElementById('qty').disabled = false;

            let btn = document.getElementById('btn');
            btn.disabled = false;
            btn.classList.remove('opacity-50', 'cursor-not-allowed');
            btn.classList.add('hover:bg-green-600');

            status.innerText = "Produk ditemukan ✓";

            calculate();

        } else {
            alert('Produk tidak ditemukan');
            resetForm();
        }

    } catch (e) {
        alert('Error sistem');
    }
}

// QTY
function changeQty(val) {
    let input = document.getElementById('qty');
    let newVal = parseInt(input.value) + val;

    if (newVal < 1) newVal = 1;

    input.value = newVal;
    calculate();
}

// TOTAL
function calculate() {
    let qty = document.getElementById('qty').value;
    let total = qty * currentPrice;

    document.getElementById('total').innerText =
        'Rp ' + new Intl.NumberFormat('id-ID').format(total);
}

// RESET
function resetForm(){
    document.getElementById('name').innerText = '-';
    document.getElementById('price').innerText = '0';
    document.getElementById('stock').innerText = '0';
    document.getElementById('total').innerText = 'Rp 0';

    document.getElementById('qty').disabled = true;
    document.getElementById('btn').disabled = true;

    document.getElementById('btn').classList.add('opacity-50', 'cursor-not-allowed');
}
</script>

@endsection