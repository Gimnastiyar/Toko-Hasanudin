<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

class TransactionController extends Controller
{

    // Export Excel
    public function export()
    {
        return Excel::download(new TransactionsExport, 'laporan-transaksi.xlsx');
    }

    // Tampilkan daftar transaksi
    public function index()
    {
        $transactions = Transaction::with('product')->latest()->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    // Form transaksi baru
    public function create()
    {
        $products = Product::all();

        return view('transactions.create', compact('products'));
    }

    // Simpan transaksi
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $total = $product->price * $request->quantity;

        $product->stock -= $request->quantity;
        $product->save();

        Transaction::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $total,
            'status' => 'completed'
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil disimpan');
    }

    // Print struk
    public function print(Transaction $transaction)
    {
        return view('transactions.print', compact('transaction'));
    }
}