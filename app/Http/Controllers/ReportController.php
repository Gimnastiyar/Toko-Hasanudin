<?php
namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Supplier;
use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $transactions = Transaction::with('details.product')
            ->whereIn('status', ['completed', 'success'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        // 3. Hitung keuangan
        $totalRevenue = 0;
        $totalCost = 0;
        $totalProfit = 0;
        $totalDiscount = 0;

        foreach ($transactions as $trx) {
            $subtotal = $trx->details->sum('subtotal');
            $discount = $trx->discount ?? 0;

            //  HITUNG DISKON
            if ($trx->discount_type == 'percent') {
                $discountValue = ($discount / 100) * $subtotal;
            } else {
                $discountValue = $discount;
            }

            //  TOTAL SUDAH DIKURANGI DISKON
            $revenue = $trx->total_price;

            $cost = 0;
            foreach ($trx->details as $detail) {
                $cost += ($detail->cost_price ?? 0) * $detail->quantity;
            }

            $profit = $revenue - $cost;

            $totalRevenue += $revenue;
            $totalCost += $cost;
            $totalProfit += $profit;
            $totalDiscount += $discountValue;
        }

        //  HUTANG SUPPLIER (Sebagai informasi kewajiban/liabilitas di neraca)
        $totalHutangSupplier = Supplier::sum('saldo_hutang');

        $suppliers = Supplier::where('saldo_hutang', '>', 0)->get();

        //  HITUNG LABA BERSIH OPERASIONAL
        //  Catatan Sidang: Secara akuntansi, laba bersih transaksi dihitung dari Total Omzet dikurangi HPP (totalCost).
        //  Hutang supplier adalah liabilitas (kewajiban neraca), bukan pengurang laba-rugi operasional periode berjalan.
        $netProfit = $totalProfit;

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
            'totalDiscount'
        ));
    }

    /**
     * Ekspor Laporan Keuangan ke format Excel
     */
    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date')
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth();

        $endDate = $request->input('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfDay();

        return Excel::download(new ReportsExport($startDate, $endDate), 'laporan-keuangan.xlsx');
    }

    /**
     * Tampilkan lembar laporan cetak PDF (A4)
     */
    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date')
            ? Carbon::parse($request->start_date)->startOfDay()
            : Carbon::now()->startOfMonth();

        $endDate = $request->input('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : Carbon::now()->endOfDay();

        $transactions = Transaction::with('details.product')
            ->whereIn('status', ['completed', 'success'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->latest()
            ->get();

        $totalRevenue = 0;
        $totalCost = 0;
        $totalProfit = 0;
        $totalDiscount = 0;

        foreach ($transactions as $trx) {
            $subtotal = $trx->details->sum('subtotal');
            $discount = $trx->discount ?? 0;

            if ($trx->discount_type == 'percent') {
                $discountValue = ($discount / 100) * $subtotal;
            } else {
                $discountValue = $discount;
            }

            $revenue = $trx->total_price;
            
            $cost = 0;
            foreach ($trx->details as $detail) {
                $cost += ($detail->cost_price ?? 0) * $detail->quantity;
            }
            
            $profit = $revenue - $cost;

            $totalRevenue += $revenue;
            $totalCost += $cost;
            $totalProfit += $profit;
            $totalDiscount += $discountValue;
        }

        $totalHutangSupplier = Supplier::sum('saldo_hutang');
        $netProfit = $totalProfit;

        return view('reports.pdf', compact(
            'transactions',
            'totalRevenue',
            'totalCost',
            'totalProfit',
            'startDate',
            'endDate',
            'totalHutangSupplier',
            'netProfit',
            'totalDiscount'
        ));
    }
}
