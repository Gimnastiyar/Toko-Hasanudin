<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOKO HASAN - Kasir</title>
    
    <!-- Favicon aplikasi -->
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Asset CSS dari Vite -->
    @vite('resources/css/app.css')

    <!-- Font Google: Inter untuk tipografi modern -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Style global -->
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    <!-- Dark mode prevention -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="bg-[#f8fafc] dark:bg-slate-900 text-slate-800 dark:text-slate-200 antialiased selection:bg-indigo-100 selection:text-indigo-700 dark:selection:bg-indigo-900/50 dark:selection:text-indigo-300">

<div class="flex min-h-screen">

    <!-- Sidebar Kasir (minimalis) -->
    <aside class="w-64 bg-[#0f172a] dark:bg-slate-950 text-slate-300 hidden md:flex flex-col border-r border-slate-800 dark:border-slate-900 transition-all duration-300 shadow-2xl z-20 print:hidden">
        
        <!-- Header sidebar -->
        <div class="h-16 flex items-center px-6 border-b border-slate-800/60">
            <div class="flex items-center gap-3">
                <div class="h-8 w-8 rounded-lg bg-emerald-600/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <span class="text-slate-400 font-medium text-sm tracking-wider uppercase">Kasir Panel</span>
            </div>
        </div>

        <!-- Menu navigasi kasir -->
        <nav class="mt-6 flex-1 px-4 space-y-1.5">

            <!-- Dashboard Kasir -->
            <a href="{{ route('kasir.dashboard') }}"
               class="flex items-center px-4 py-3 {{ request()->routeIs('kasir.dashboard') ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'hover:bg-slate-800/80 hover:text-white border-transparent' }} rounded-xl transition-all duration-200 group border shadow-sm">
                <svg class="w-5 h-5 mr-3 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium text-sm">Dashboard</span>
            </a>

            <!-- Transaksi Kasir -->
            <a href="{{ route('kasir.transaksi') }}"
               class="flex items-center px-4 py-3 {{ request()->routeIs('kasir.transaksi') ? 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20' : 'hover:bg-slate-800/80 hover:text-white border-transparent' }} rounded-xl transition-all duration-200 group border shadow-sm">
                <svg class="w-5 h-5 mr-3 transition-transform duration-200 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span class="font-medium text-sm">Transaksi</span>
            </a>

        </nav>

        <!-- Footer sidebar: user info + logout -->
        <div class="p-4 border-t border-slate-800/60">
            <div class="flex items-center gap-3 px-3 py-2 mb-3">
                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold text-xs shadow-md">
                    {{ strtoupper(substr(auth()->user()->name ?? 'K', 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-200 leading-tight truncate max-w-[140px]">{{ auth()->user()->name ?? 'Kasir' }}</p>
                    <p class="text-[10px] text-slate-500 font-medium uppercase tracking-wider">Kasir</p>
                </div>
            </div>
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

        <!-- Header -->
        <header class="flex items-center justify-between h-16 px-6 lg:px-8 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200/60 dark:border-slate-800 sticky top-0 z-10 shadow-sm transition-colors print:hidden">
            
            <div class="w-1/3"></div>

            <div class="w-1/3 flex justify-center">
                <h1 class="text-2xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-400 dark:to-teal-400 drop-shadow-sm">
                    TOKO HASAN
                </h1>
            </div>

            <div class="w-1/3 flex justify-end items-center space-x-5">
                <!-- Dark Mode Toggle -->
                <button id="theme-toggle" type="button" class="text-slate-400 hover:text-indigo-600 dark:hover:text-amber-400 transition-colors p-2 rounded-lg" aria-label="Toggle Dark Mode">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <div class="flex items-center gap-3 pl-5 border-l border-slate-200 dark:border-slate-700">
                    <div class="hidden md:block text-right">
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 leading-tight">{{ auth()->user()->name ?? 'Kasir' }}</p>
                        <p class="text-[11px] text-emerald-600 dark:text-emerald-400 font-bold tracking-wide uppercase">Kasir</p>
                    </div>
                    <div class="h-9 w-9 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold shadow-md ring-2 ring-white dark:ring-slate-800">
                        {{ strtoupper(substr(auth()->user()->name ?? 'K', 0, 1)) }}
                    </div>
                </div>
            </div>

        </header>

        <!-- Main content -->
        <main class="flex-1 overflow-y-auto p-6 lg:p-8 print:overflow-visible print:p-0">
            
            <div class="max-w-6xl mx-auto">
                @yield('content')
            </div>
            
        </main>

    </div>

</div>

<script>
    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleLightIcon.classList.remove('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
    }

    var themeToggleBtn = document.getElementById('theme-toggle');
    themeToggleBtn.addEventListener('click', function() {
        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');
        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }
        } else {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }
    });
</script>

</body>
</html>
