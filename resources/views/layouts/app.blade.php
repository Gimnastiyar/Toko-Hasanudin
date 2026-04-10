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
    <!-- Mencegah Flash of Unstyled Content (FOUC) saat dark mode diload -->
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

    <!-- Sidebar: navigasi utama aplikasi (hidden pada mobile) -->
    <aside class="w-64 bg-[#0f172a] dark:bg-slate-950 text-slate-300 hidden md:flex flex-col border-r border-slate-800 dark:border-slate-900 transition-all duration-300 shadow-2xl z-20 print:hidden">
        
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

            <!-- Menu Pelanggan -->
            <a href="{{ route('customers.index') }}"
               class="flex items-center px-4 py-3 hover:bg-slate-800/80 hover:text-white rounded-xl transition-all duration-200 group border border-transparent">
                <svg class="w-5 h-5 mr-3 text-slate-400 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <span class="font-medium text-sm">Pelanggan</span>
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
        <header class="flex items-center justify-between h-16 px-6 lg:px-8 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200/60 dark:border-slate-800 sticky top-0 z-10 shadow-sm transition-colors print:hidden">
            
            <!-- Spacer kiri untuk menjaga keseimbangan layout -->
            <div class="w-1/3"></div>

            <!-- Judul toko di tengah header -->
            <div class="w-1/3 flex justify-center">
                <h1 class="text-2xl font-extrabold tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600 dark:from-indigo-400 dark:to-violet-400 drop-shadow-sm">
                    TOKO HASAN
                </h1>
            </div>

            <!-- Area kanan header: notifikasi dan profil user -->
            <div class="w-1/3 flex justify-end items-center space-x-5">
                
                <!-- Dark Mode Toggle Button -->
                <button id="theme-toggle" type="button" class="text-slate-400 hover:text-indigo-600 dark:hover:text-amber-400 transition-colors p-2 rounded-lg" aria-label="Toggle Dark Mode">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <!-- Notifikasi Dropdown -->
                <div class="relative">
                    <button id="notif-btn" type="button" class="text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors relative focus:outline-none">
                        @if(isset($notifications) && $notifications->count() > 0)
                        <span class="absolute top-0 right-0 w-2 h-2 bg-rose-500 rounded-full border-2 border-white dark:border-slate-900 animate-pulse"></span>
                        @endif
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </button>

                    <!-- Dropdown Panel -->
                    <div id="notif-menu" class="hidden absolute right-0 mt-3 w-80 bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-700 overflow-hidden z-50 transform origin-top-right transition-all">
                        <div class="p-4 border-b border-slate-100 dark:border-slate-700/50 bg-slate-50/50 dark:bg-slate-800/50">
                            <h3 class="text-sm font-bold text-slate-800 dark:text-white flex justify-between items-center">
                                Notifikasi
                                @if(isset($notifications) && $notifications->count() > 0)
                                <span class="bg-rose-100 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 px-2 py-0.5 rounded-md text-xs">{{ $notifications->count() }} Baru</span>
                                @endif
                            </h3>
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            @if(isset($notifications) && $notifications->count() > 0)
                                @foreach($notifications as $notif)
                                <div class="p-4 border-b border-slate-50 dark:border-slate-700/30 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors cursor-default">
                                    <div class="flex gap-3">
                                        <div class="flex-shrink-0 mt-0.5">
                                            @if($notif['type'] == 'danger')
                                                <div class="w-8 h-8 rounded-full bg-rose-100 dark:bg-rose-900/30 flex items-center justify-center text-rose-500 dark:text-rose-400">
                                                    @if($notif['icon'] == 'clock')
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    @elseif($notif['icon'] == 'cash')
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-500 dark:text-amber-400">
                                                    @if($notif['icon'] == 'cube')
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                                    @else
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800 dark:text-slate-200">{{ $notif['title'] }}</p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 leading-relaxed">{!! $notif['message'] !!}</p>
                                            <p class="text-[10px] text-slate-400 dark:text-slate-500 mt-1.5 font-medium">{{ $notif['time'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="px-4 py-8 text-center flex flex-col items-center">
                                    <svg class="w-12 h-12 text-slate-200 dark:text-slate-700 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p class="text-sm font-bold text-slate-400 dark:text-slate-500">Tidak ada notifikasi baru.</p>
                                </div>
                            @endif
                        </div>
                        <div class="px-4 py-3 bg-slate-50/50 dark:bg-slate-800/80 border-t border-slate-100 dark:border-slate-700/50 text-center">
                            <a href="#" onclick="document.getElementById('notif-menu').classList.add('hidden'); event.preventDefault();" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300">Tutup Notifikasi</a>
                        </div>
                    </div>
                </div>

                <!-- Info user dan avatar -->
                <div class="flex items-center gap-3 pl-5 border-l border-slate-200 dark:border-slate-700">
                    <div class="hidden md:block text-right">
                        <p class="text-sm font-semibold text-slate-700 dark:text-slate-200 leading-tight">Admin Hasan</p>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium tracking-wide">ADMINISTRATOR</p>
                    </div>
                    <div class="h-9 w-9 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white font-bold shadow-md cursor-pointer hover:shadow-lg hover:scale-105 transition-all ring-2 ring-white dark:ring-slate-800">
                        A
                    </div>
                </div>

            </div>

        </header>

        <!-- Main content: area dinamis untuk konten halaman -->
        <main class="flex-1 overflow-y-auto p-6 lg:p-8 print:overflow-visible print:p-0">
            
            <div class="max-w-6xl mx-auto">
                
                <!-- Konten spesifik halaman akan diinjeksi di sini -->
                @yield('content')
                
            </div>
            
        </main>

    </div>

</div>

<script>
    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

    // Change the icons inside the button based on previous settings
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleLightIcon.classList.remove('hidden');
    } else {
        themeToggleDarkIcon.classList.remove('hidden');
    }

    var themeToggleBtn = document.getElementById('theme-toggle');

    themeToggleBtn.addEventListener('click', function() {
        // toggle icons inside button
        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');

        // if set via local storage previously
        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }
        // if NOT set via local storage previously
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

    // Dropdown Notification Toggle Logic
    var notifBtn = document.getElementById('notif-btn');
    var notifMenu = document.getElementById('notif-menu');

    if (notifBtn && notifMenu) {
        notifBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            notifMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(e) {
            // Close dropdown if click outside both button and menu
            if (!notifBtn.contains(e.target) && !notifMenu.contains(e.target)) {
                notifMenu.classList.add('hidden');
            }
        });
    }
</script>

</body>
</html>