<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {

        /*
        |--------------------------------------------------------------------------
        | 1. DATA RINGKASAN (CARD DASHBOARD)
        |--------------------------------------------------------------------------
        */

        $totalProducts = Product::count();

        $totalStock = Product::sum('stock');

        $totalRevenue = Transaction::where('status', 'completed')
                            ->sum('total_price');

// 2. Hitung Profit
$transactions = Transaction::with('product')->where('status', 'completed')->get();
$totalProfit = 0;
foreach ($transactions as $trx) {
if ($trx->product) {
$modal = $trx->product->cost_price * $trx->quantity;
$omzet = $trx->total_price;
$totalProfit += ($omzet - $modal);
}
}   
        /*
        |--------------------------------------------------------------------------
        | 2. DATA GRAFIK PENJUALAN PER BULAN
        |--------------------------------------------------------------------------
        */

        $salesData = Transaction::select(
                        DB::raw('MONTH(created_at) as month'),
                        DB::raw('SUM(total_price) as total')
                    )
                    ->where('status', 'completed')
                    ->whereYear('created_at', now()->year)
                    ->groupBy('month')
                    ->orderBy('month')
                    ->pluck('total', 'month');


        /*
        |--------------------------------------------------------------------------
        | NORMALISASI DATA BULAN
        | Agar bulan tanpa transaksi tetap muncul dengan nilai 0
        |--------------------------------------------------------------------------
        */

        $chartData = [];
        $months = [];

        for ($i = 1; $i <= 12; $i++) {

            $months[] = date('F', mktime(0,0,0,$i,1));

            $chartData[] = $salesData[$i] ?? 0;

        }


        /*
        |--------------------------------------------------------------------------
        | 3. TRANSAKSI TERBARU
        |--------------------------------------------------------------------------
        */

        $recentTransactions = Transaction::with('product')
                                ->latest()
                                ->limit(5)
                                ->get();


        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        return view('dashboard', [
            'totalProducts' => $totalProducts,
            'totalStock' => $totalStock,
            'totalRevenue' => $totalRevenue,
            'totalProfit' => $totalProfit,
            'recentTransactions' => $recentTransactions,
            'chartData' => $chartData,
            'months' => $months
        ]);

    }

}