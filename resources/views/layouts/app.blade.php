<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOKO HASAN - Dashboard</title>
    
    <!-- Favicon aplikasi -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Asset CSS dari Vite -->
    @vite('resources/css/app.css')

    <!-- Font Google: Inter untuk tipografi modern -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Style global: pengaturan font dasar -->
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-[#f8fafc] text-slate-800 antialiased selection:bg-indigo-100 selection:text-indigo-700">

<div class="flex min-h-screen">

    <!-- Sidebar: navigasi utama aplikasi (hidden pada mobile) -->
    <aside class="w-64 bg-[#0f172a] text-slate-300 hidden md:flex flex-col border-r border-slate-800 transition-all duration-300 shadow-2xl z-20">
        
        <!-- Header sidebar: nama toko / brand -->
        <div class="h-16 flex items-center px-6 border-b border-slate-800/60">
            <div class="flex items-center gap-3">
                <div class="h-8 w-8 rounded-lg bg-indigo-600/20r">
                   
                </div>
                <span class="text-slate-400 font-medium text-sm tracking-wider uppercase">Hasanudin</span>
            </div>
        </div>

        <!-- Menu navigasi utama -->
        <nav class="mt-6 flex-1 px-4 space-y-1.5">

            <!-- Menu Dashboard -->
            <a href="{{ route('dashboard') }}"
               class="flex items-center px-4 py-3 bg-indigo-500/10 text-indigo-400 rounded-xl transition-all duration-200 group border border-indigo-500/20 shadow-sm">
                <svg class="w-5 h-5 mr-3 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium text-sm">Dashboard</span>
            </a>

            <!-- Menu Produk -->
            <a href="{{ route('products.index') }}"
               class="flex items-center px-4 py-3 hover:bg-slate-800/80 hover:text-white rounded-xl transition-all duration-200 group border border-transparent">
                <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <span class="font-medium text-sm">Produk</span>
            </a>

            <!-- Menu Transaksi -->
            <a href="{{ route('transactions.index') }}"
               class="flex items-center px-4 py-3 hover:bg-slate-800/80 hover:text-white rounded-xl transition-all duration-200 group border border-transparent">
                <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21V3m12 18H9a2 2 0 01-2-2V7a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2z"/>
                </svg>
                <span class="font-medium text-sm">Transaksi</span>
            </a>
<!-- Menu Supplier -->
<a href="{{ route('suppliers.index') }}"
   class="flex items-center px-4 py-3 hover:bg-slate-800/80 hover:text-white rounded-xl transition-all duration-200 group border border-transparent">
    
    <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V7a2 2 0 00-2-2h-4l-2-2H6a2 2 0 00-2 2v6m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4"></path>
    </svg>

    <span class="font-medium text-sm">Supplier</span>
</a>
            <!-- Menu Laporan -->
            <a href="{{ route('reports.index') }}"
class="flex items-center px-6 py-3 text-slate-300 hover:bg-slate-800 hover:text-white transition">
                <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2m4-4V5a2 2 0 012-2h2a2 2 0 012 2v8m-6 0h6m6 4v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2m4-4V9a2 2 0 00-2-2h-2a2 2 0 00-2 2v8"/>
                </svg>
                <span class="font-medium text-sm">Laporan</span>
            </a>

        </nav>

        <!-- Footer sidebar: tombol logout -->
        <div class="p-4 border-t border-slate-800/60">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-slate-800/40 hover:bg-red-500/10 text-slate-400 hover:text-red-400 hover:border-red-500/30 border border-transparent py-2.5 rounded-xl transition-all duration-200 group">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V7a4 4 0 00-8 0v10a4 4 0 008 0v-1"/>
                    </svg>
                    <span class="font-medium text-sm">Logout</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- Container konten utama -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Header: navbar atas dengan judul toko dan info user -->
        <header class="flex items-center justify-between h-16 px-6 lg:px-8 bg-white/80 backdrop-blur-md border-b border-slate-200/60 sticky top-0 z-10 shadow-sm">
            
            <!-- Spacer kiri untuk menjaga keseimbangan layout -->
            <div class="w-1/3"></div>

            <!-- Judul toko di tengah header -->
            <div class="w-1/3 flex justify-center">
                <h1 class="text-2xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600 drop-shadow-sm">
                    TOKO HASAN
                </h1>
            </div>

            <!-- Area kanan header: notifikasi dan profil user -->
            <div class="w-1/3 flex justify-end items-center space-x-5">
                
                <!-- Tombol notifikasi dengan indikator -->
                <button class="text-slate-400 hover:text-indigo-600 transition-colors relative">
                    <span class="absolute 1 top-0 right-0 w-2 h-2 bg-rose-500 rounded-full border-2 border-white"></span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>

                <!-- Info user dan avatar -->
                <div class="flex items-center gap-3 pl-5 border-l border-slate-200">
                    <div class="hidden md:block text-right">
                        <p class="text-sm font-semibold text-slate-700 leading-tight">Admin Hasan</p>
                        <p class="text-[11px] text-slate-500 font-medium tracking-wide">ADMINISTRATOR</p>
                    </div>
                    <div class="h-9 w-9 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white font-bold shadow-md cursor-pointer hover:shadow-lg hover:scale-105 transition-all ring-2 ring-white">
                        A
                    </div>
                </div>

            </div>

        </header>

        <!-- Main content: area dinamis untuk konten halaman -->
        <main class="flex-1 overflow-y-auto p-6 lg:p-8">
            
            <div class="max-w-6xl mx-auto">
                
                <!-- Konten spesifik halaman akan diinjeksi di sini -->
                @yield('content')
                
            </div>
            
        </main>

    </div>

</div>

</body>
</html>