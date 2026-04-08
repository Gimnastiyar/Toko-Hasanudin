<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Toko Hasan</title>
    @vite('resources/css/app.css')

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="bg-slate-100 dark:bg-slate-900 flex items-center justify-center h-screen transition-colors duration-300">

    <div class="bg-white dark:bg-slate-800 p-8 rounded-xl shadow-xl border border-transparent dark:border-slate-700 w-96">

        <h2 class="text-2xl font-bold mb-6 text-center text-slate-900 dark:text-white">Login Toko Hasan</h2>

        <form method="POST" action="{{ route('login.manual') }}">
            @csrf

            <!-- Input Email -->
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2 text-slate-700 dark:text-slate-300">Email</label>
                <input type="email" name="email" class="w-full border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white p-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-colors">
            </div>

            <!-- Input Password -->
            <div class="mb-6">
                <label class="block text-sm font-bold mb-2 text-slate-700 dark:text-slate-300">Password</label>
                <input type="password" name="password" class="w-full border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-white p-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none transition-colors">
            </div>

            <!-- Tombol Login -->
            <button class="w-full bg-indigo-600 dark:bg-indigo-500 text-white font-bold py-2.5 rounded-lg hover:bg-indigo-700 dark:hover:bg-indigo-600 transition-colors shadow-md">
                Login
            </button>

        </form>

    </div>

</body>
</html>