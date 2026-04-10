<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;

class KasirController extends Controller
{
    /**
     * Dashboard Kasir - ringkasan transaksi kasir yang login
     */
    public function dashboard()
    {
        $user = auth()->user();

        $todayTransactions = Transaction::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->count();

        $todayRevenue = Transaction::where('user_id', $user->id)
            ->whereDate('created_at', today())
            ->whereIn('status', ['completed', 'success'])
            ->sum('total_price');

        $totalTransactions = Transaction::where('user_id', $user->id)->count();

        $recentTransactions = Transaction::with('product')
            ->where('user_id', $user->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('kasir.dashboard', compact(
            'todayTransactions',
            'todayRevenue',
            'totalTransactions',
            'recentTransactions'
        ));
    }

    /**
     * Halaman transaksi kasir (menampilkan form + riwayat miliknya)
     */
    public function transaksi()
    {
        $user = auth()->user();
        $products = Product::where('stock', '>', 0)->get();

        $transactions = Transaction::with('product')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('kasir.transaksi', compact('products', 'transactions'));
    }
}
