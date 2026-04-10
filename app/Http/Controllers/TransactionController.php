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

    // Tampilkan daftar transaksi (filter by role)
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'kasir') {
            // Kasir hanya melihat transaksi miliknya
            $transactions = Transaction::with('product')
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(10);
        } else {
            // Admin melihat semua transaksi
            $transactions = Transaction::with('product', 'user')
                ->latest()
                ->paginate(10);
        }

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
            'quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:percent,nominal'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($request->quantity > $product->stock) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $price = $product->price;
        $qty = $request->quantity;

        $subtotal = $price * $qty;

        $discount = $request->discount ?? 0;
        $discountType = $request->discount_type ?? 'nominal';

        if ($discountType == 'percent') {
            $discountValue = ($discount / 100) * $subtotal;
        } else {
            $discountValue = $discount;
        }

        $total = max(0, $subtotal - $discountValue);

        // kurangi stok
        $product->stock -= $qty;
        $product->save();

        Transaction::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $qty,
            'total_price' => $total,
            'discount' => $discount,
            'discount_type' => $discountType,
            'status' => 'success'
        ]);

        // Redirect berdasarkan role
        if (auth()->user()->role === 'kasir') {
            return redirect()->route('kasir.transaksi')->with('success', 'Transaksi berhasil disimpan');
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan');
    }

    // Update status pembayaran secara manual
    public function updateStatus(Transaction $transaction, Request $request)
    {
        // Hanya admin yang boleh update status
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengubah status transaksi.');
        }

        $request->validate([
            'status' => 'required|in:success,pending'
        ]);

        $transaction->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    // Print struk
    public function print(Transaction $transaction)
    {
        return view('transactions.print', compact('transaction'));
    }
}