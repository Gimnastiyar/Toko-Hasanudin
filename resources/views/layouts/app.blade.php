<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>TOKO HASAN</title>


<link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

<!-- CSS Laravel -->
@vite('resources/css/app.css')

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Inter', sans-serif;
}
</style>

</head>

<body class="bg-slate-50 text-slate-800">

<div class="flex h-screen overflow-hidden">

<!-- SIDEBAR -->
<aside class="w-64 bg-slate-900 text-white hidden md:flex flex-col shadow-xl">

<!-- MENU -->
<nav class="mt-6 flex-1">

<!-- DASHBOARD -->
<a href="{{ route('dashboard') }}"
class="flex items-center px-6 py-3 bg-slate-800 text-emerald-400 border-r-4 border-emerald-500">

<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2
a2 2 0 01-2 2H6a2 2 0 01-2-2V6z
M14 6a2 2 0 012-2h2a2 2 0 012 2v2
a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z
M4 16a2 2 0 012-2h2a2 2 0 012 2v2
a2 2 0 01-2 2H6a2 2 0 01-2-2v-2z
M14 16a2 2 0 012-2h2a2 2 0 012 2v2
a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
</svg>

Dashboard
</a>

<!-- PRODUK -->
<a href="{{ route('products.index') }}"
class="flex items-center px-6 py-3 text-slate-300 hover:bg-slate-800 hover:text-white transition">

<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4
m0-10L4 7m8 4v10M4 7v10l8 4"/>
</svg>

Produk
</a>

<!-- TRANSAKSI -->
<a href="{{ route('transactions.index') }}"
class="flex items-center px-6 py-3 text-slate-300 hover:bg-slate-800 hover:text-white transition">

<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M3 10h11M9 21V3m12 18H9a2 2 0 01-2-2V7a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2z"/>
</svg>

Transaksi
</a>

<!-- LAPORAN -->
<a href="#"
class="flex items-center px-6 py-3 text-slate-300 hover:bg-slate-800 hover:text-white transition">

<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M9 17v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2
m4-4V5a2 2 0 012-2h2a2 2 0 012 2v8
m-6 0h6m6 4v2a2 2 0 01-2 2h-2
a2 2 0 01-2-2v-2m4-4V9a2 2 0 00-2-2h-2
a2 2 0 00-2 2v8"/>
</svg>

Laporan
</a>

</nav>

<!-- LOGOUT DI BAWAH SIDEBAR -->
<div class="p-6 border-t border-slate-700">

<form method="POST" action="{{ route('logout') }}">
@csrf

<button type="submit"
class="w-full flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg transition">

<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V7a4 4 0 00-8 0v10a4 4 0 008 0v-1"/>
</svg>

Logout

</button>

</form>

</div>

</aside>

<!-- CONTENT -->
<div class="flex-1 flex flex-col overflow-hidden">

<!-- HEADER -->
<header class="flex items-center justify-between py-4 px-6 bg-white border-b border-slate-200">

<div class="w-1/3"></div>

<div class="w-1/3 text-center">
<h1 class="text-2xl font-bold text-indigo-600">
TOKO HASAN
</h1>
</div>

<div class="w-1/3 flex justify-end items-center space-x-4">

<button class="text-slate-500 hover:text-indigo-600">
<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11
a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341
C7.67 6.165 6 8.388 6 11v3.159
c0 .538-.214 1.055-.595 1.436L4 17h5
m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
</svg>
</button>

<div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold">
A
</div>

</div>

</header>

<!-- MAIN -->
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-6">

@yield('content')

</main>

</div>

</div>

</body>
</html>