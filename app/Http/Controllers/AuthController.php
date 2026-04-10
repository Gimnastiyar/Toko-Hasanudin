<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Tampilkan Halaman Login
    |--------------------------------------------------------------------------
    */

    public function showLoginForm()
    {
        // Jika user sudah login, redirect berdasarkan role
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('auth.manual-login');
    }


    /*
    |--------------------------------------------------------------------------
    | Proses Login
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {

        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Proses login
        if (Auth::attempt($credentials)) {

            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Redirect berdasarkan role
            return $this->redirectByRole(Auth::user());
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }


    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout(Request $request)
    {

        Auth::logout();

        // Hapus session
        $request->session()->invalidate();

        // Regenerate token
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    /*
    |--------------------------------------------------------------------------
    | Helper: Redirect berdasarkan role user
    |--------------------------------------------------------------------------
    */

    protected function redirectByRole($user)
    {
        if ($user->role === 'kasir') {
            return redirect()->route('kasir.dashboard');
        }

        // Default: admin ke dashboard
        return redirect()->route('dashboard');
    }

}