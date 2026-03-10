<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Toko Hasan</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-100 flex items-center justify-center h-screen">

<div class="bg-white p-8 rounded-xl shadow w-96">

<h2 class="text-2xl font-bold mb-6 text-center">Login Toko Hasan</h2>

<form method="POST" action="{{ route('login.manual') }}">
@csrf

<div class="mb-4">
<label class="block text-sm mb-1">Email</label>
<input type="email" name="email" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
<label class="block text-sm mb-1">Password</label>
<input type="password" name="password" class="w-full border p-2 rounded">
</div>

<button class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700">
Login
</button>

</form>

</div>

</body>
</html>