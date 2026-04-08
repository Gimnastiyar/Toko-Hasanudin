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

<script>
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
</script>

</head>

<body class="bg-slate-100 dark:bg-slate-900 flex items-center justify-center h-screen transition-colors duration-300">

<div class="grid md:grid-cols-2 bg-white dark:bg-slate-800 shadow-2xl dark:shadow-slate-900/50 rounded-2xl overflow-hidden w-[850px] border border-transparent dark:border-slate-700">

<!-- LEFT SIDE -->
<div class="bg-indigo-600 dark:bg-indigo-900 text-white flex flex-col justify-center items-center p-10 relative overflow-hidden">
<div class="absolute inset-0 bg-gradient-to-b from-transparent to-black/20 dark:to-black/40"></div>
<div class="relative z-10 flex flex-col items-center">

<h1 class="text-3xl font-bold mb-4 tracking-tight">
TOKO HASAN
</h1>

<p class="text-indigo-100 dark:text-indigo-200 text-center leading-relaxed">
Sistem Informasi Manajemen Toko
untuk mengelola produk, transaksi,
dan laporan penjualan secara mudah.
</p>

<img src="https://cdn-icons-png.flaticon.com/512/3081/3081559.png"
class="w-40 mt-8 opacity-90 drop-shadow-xl filter dark:brightness-110">

</div>
</div>

<!-- RIGHT SIDE -->
<div class="p-10 flex flex-col justify-center">

<h2 class="text-2xl font-bold text-slate-800 dark:text-white mb-6 text-center tracking-tight">
Login Sistem
</h2>

@if ($errors->any())
<div class="bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 border border-red-200 dark:border-red-800/50 p-3 rounded-lg mb-4 text-sm text-center">
{{ $errors->first() }}
</div>
@endif

<form method="POST" action="{{ route('login.post') }}">

@csrf

<!-- EMAIL -->
<div class="mb-4">

<label class="text-sm font-bold text-slate-600 dark:text-slate-300">
Email
</label>

<input
type="email"
name="email"
required
class="w-full mt-1 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-indigo-500 dark:focus:border-indigo-400 focus:outline-none transition-colors">

</div>

<!-- PASSWORD -->
<div class="mb-8">

<label class="text-sm font-bold text-slate-600 dark:text-slate-300">
Password
</label>

<input
type="password"
name="password"
required
class="w-full mt-1 border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white rounded-lg px-3 py-2.5 focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400 focus:border-indigo-500 dark:focus:border-indigo-400 focus:outline-none transition-colors">

</div>

<!-- BUTTON -->
<button
class="w-full bg-indigo-600 dark:bg-indigo-500 text-white py-2.5 rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-600 transition-colors font-bold shadow-md hover:shadow-lg">

Login

</button>

</form>

<p class="text-xs text-slate-400 dark:text-slate-500 text-center mt-8">
© {{ date('Y') }} Toko Hasan
</p>

</div>

</div>

</body>
</html>