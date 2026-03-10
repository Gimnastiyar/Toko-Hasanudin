<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Login - Toko Hasan</title>

@vite('resources/css/app.css')

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body{
font-family:'Inter',sans-serif;
}
</style>

</head>

<body class="bg-slate-100 flex items-center justify-center h-screen">

<div class="grid md:grid-cols-2 bg-white shadow-2xl rounded-2xl overflow-hidden w-[850px]">

<!-- LEFT SIDE -->
<div class="bg-indigo-600 text-white flex flex-col justify-center items-center p-10">

<h1 class="text-3xl font-bold mb-4">
TOKO HASAN
</h1>

<p class="text-indigo-100 text-center">
Sistem Informasi Manajemen Toko
untuk mengelola produk, transaksi,
dan laporan penjualan secara mudah.
</p>

<img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png"
class="w-40 mt-8 opacity-90">

</div>

<!-- RIGHT SIDE -->
<div class="p-10">

<h2 class="text-2xl font-bold text-slate-800 mb-6 text-center">
Login Sistem
</h2>

@if ($errors->any())
<div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm text-center">
{{ $errors->first() }}
</div>
@endif

<form method="POST" action="{{ route('login.post') }}">

@csrf

<!-- EMAIL -->
<div class="mb-4">

<label class="text-sm font-medium text-slate-600">
Email
</label>

<input
type="email"
name="email"
required
class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

</div>

<!-- PASSWORD -->
<div class="mb-6">

<label class="text-sm font-medium text-slate-600">
Password
</label>

<input
type="password"
name="password"
required
class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

</div>

<!-- BUTTON -->
<button
class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition font-semibold">

Login

</button>

</form>

<p class="text-xs text-slate-400 text-center mt-6">
© {{ date('Y') }} Toko Hasan
</p>

</div>

</div>

</body>
</html>