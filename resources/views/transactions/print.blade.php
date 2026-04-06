<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Struk #{{ $transaction->id }}</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>

@page{
margin:0;
}

body{
font-family: "Courier New", monospace;
font-size:12px;
}

</style>

</head>
@php
$price = $transaction->product->price;
$qty = $transaction->quantity;

$subtotal = $price * $qty;

$discount = $transaction->discount ?? 0;
$type = $transaction->discount_type ?? 'nominal';

if ($type == 'percent') {
    $discountValue = ($discount / 100) * $subtotal;
} else {
    $discountValue = $discount;
}

$total = $subtotal - $discountValue;
@endphp
<body onload="window.print()" class="flex justify-center bg-gray-100 py-10">

<div class="bg-white w-[80mm] p-4 shadow">

<!-- HEADER -->
<div class="text-center border-b border-dashed pb-2 mb-2">

<h1 class="font-bold text-lg uppercase">
TOKO HASAN
</h1>

<p>Jl. Subang No.123</p>
<p>Telp: 0812-3456789</p>

</div>


<!-- INFO TRANSAKSI -->

<div class="mb-2">

<div class="flex justify-between">
<span>No Transaksi</span>
<span>#{{ $transaction->id }}</span>
</div>

<div class="flex justify-between">
<span>Tanggal</span>
<span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
</div>

<div class="flex justify-between">
<span>Kasir</span>
<span>Admin</span>
</div>

</div>


<div class="border-b border-dashed my-2"></div>


<!-- ITEM -->

<div class="mb-2">

<div class="font-bold">
{{ $transaction->product->name }}
</div>

<div class="flex justify-between">

<span>
{{ $transaction->quantity }} x
{{ number_format($transaction->product->price,0,',','.') }}
</span>

<span>
Rp {{ number_format($subtotal,0,',','.') }}
</span>

</div>

</div>


<div class="border-b border-dashed my-2"></div>

<div class="text-[11px]">

<div class="flex justify-between">
<span>Subtotal</span>
<span>Rp {{ number_format($subtotal,0,',','.') }}</span>
</div>

@if($discount > 0)

<div class="flex justify-between">
<span>Diskon</span>
<span>
{{ $type == 'percent'
    ? $discount.'%'
    : 'Rp '.number_format($discount,0,',','.') }}
</span>
</div>

<div class="flex justify-between text-red-500">
<span>Potongan</span>
<span>- Rp {{ number_format($discountValue,0,',','.') }}</span>
</div>

@endif

</div>
<!-- TOTAL -->

<div class="flex justify-between font-bold text-sm">

<span>TOTAL</span>

<span>
Rp {{ number_format($total,0,',','.') }}
</span>

</div>


<div class="border-b border-dashed my-2"></div>


<!-- FOOTER -->

<div class="text-center mt-3 text-[10px]">

<p>Terima kasih sudah berbelanja</p>
<p>Barang yang sudah dibeli</p>
<p>tidak dapat dikembalikan</p>

</div>


</div>

</body>
</html>