<?php
namespace App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Supplier;

class ReportController extends Controller
{
public function index(Request $request)
{
    // 1. Tanggal
    $startDate = $request->input('start_date') 
        ? Carbon::parse($request->start_date)->startOfDay() 
        : Carbon::now()->startOfMonth();

    $endDate = $request->input('end_date') 
        ? Carbon::parse($request->end_date)->endOfDay()
        : Carbon::now()->endOfDay();

    // 2. Ambil transaksi
    $transactions = Transaction::with('product')
        ->where('status', 'completed')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->latest()
        ->get();

    // 3. Hitung keuangan
    $totalRevenue = 0;
    $totalCost = 0;
    $totalProfit = 0;
    $totalDiscount = 0;

    foreach ($transactions as $trx) {
    if ($trx->product) {

        $price = $trx->product->price;
        $qty = $trx->quantity;

        $subtotal = $price * $qty;

        $discount = $trx->discount ?? 0;

        //  HITUNG DISKON
        if ($trx->discount_type == 'percent') {
            $discountValue = ($discount / 100) * $subtotal;
        } else {
            $discountValue = $discount;
        }

        //  TOTAL SUDAH DIKURANGI DISKON
        $revenue = $trx->total_price;

        $cost = $trx->product->cost_price * $qty;

        $profit = $revenue - $cost;

        $totalRevenue += $revenue;
        $totalCost += $cost;
        $totalProfit += $profit;
        $totalDiscount += $discountValue;
    }
}

    //  HUTANG SUPPLIER
    $totalHutangSupplier = Supplier::sum('saldo_hutang');

    $suppliers = Supplier::where('saldo_hutang', '>', 0)->get();

    //  BARU HITUNG NET PROFIT (SETELAH SEMUA ADA)
    $netProfit = $totalProfit - $totalHutangSupplier;

    //  RETURN (SUDAH BENAR)
    return view('reports.index', compact(
        'transactions',
        'totalRevenue',
        'totalCost',
        'totalProfit',
        'startDate',
        'endDate',
        'totalHutangSupplier',
        'suppliers',
        'netProfit',
        'totalDiscount',
    ));
}
}
