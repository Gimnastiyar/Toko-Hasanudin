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

    // Tampilkan daftar transaksi (Admin Monitoring)
    public function index(Request $request)
    {
        $query = Transaction::with(['details.product', 'user', 'customer']);

        // Filter Pencarian (ID Transaksi, Nama Kasir, Nama Pelanggan)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            // Clean up search query for padded ID (e.g., #00001 -> 1)
            $cleanSearchId = ltrim(str_replace('#', '', $search), '0');

            $query->where(function($q) use ($search, $cleanSearchId) {
                $q->where('id', 'like', "%{$search}%");
                if ($cleanSearchId !== '') {
                    $q->orWhere('id', '=', $cleanSearchId);
                }
                $q->orWhereHas('user', function($uq) use ($search) {
                       $uq->where('name', 'like', "%{$search}%");
                   })
                   ->orWhereHas('customer', function($cq) use ($search) {
                       $cq->where('nama', 'like', "%{$search}%");
                   });
            });
        }

        // Filter Tanggal
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', $request->date);
        }

        $transactions = $query->latest()->paginate(10)->withQueryString();

        return view('transactions.index', compact('transactions'));
    }


    // Pencarian customer berdasarkan no HP (untuk Kasir)
    public function searchCustomer(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string',
        ]);

        $customer = \App\Models\Customer::where('no_hp', $request->no_hp)->first();

        if ($customer) {
            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $customer->id,
                    'nama' => $customer->nama,
                    'status_customer' => ucfirst($customer->status_customer),
                ]
            ]);
        }

        return response()->json([
            'status' => 'not_found',
            'message' => 'Customer belum terdaftar, silakan hubungi admin'
        ], 404);
    }

    // Simpan transaksi
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'discount' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:percent,nominal',
            'customer_id' => 'nullable|exists:customers,id',
            'cash_paid' => 'required|numeric|min:0'
        ]);

        try {
            return \DB::transaction(function() use ($request) {
                $subtotal = 0;
                $detailsToCreate = [];

                foreach ($request->items as $item) {
                    $product = Product::findOrFail($item['product_id']);
                    $qty = (int)$item['quantity'];

                    if ($qty > $product->stock) {
                        throw new \Exception("Stok produk '{$product->name}' tidak mencukupi! Sisa stok: {$product->stock}");
                    }

                    // kurangi stok
                    $product->stock -= $qty;
                    $product->save();

                    $itemSubtotal = $product->price * $qty;
                    $subtotal += $itemSubtotal;

                    $detailsToCreate[] = [
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'price' => $product->price,
                        'cost_price' => $product->cost_price,
                        'subtotal' => $itemSubtotal,
                    ];
                }

                $discount = $request->discount ?? 0;
                $discountType = $request->discount_type ?? 'nominal';

                if ($discountType == 'percent') {
                    $discountValue = ($discount / 100) * $subtotal;
                } else {
                    $discountValue = $discount;
                }

                $total = max(0, $subtotal - $discountValue);
                $cashPaid = (float)$request->cash_paid;

                if ($cashPaid < $total) {
                    throw new \Exception("Uang bayar tidak mencukupi! Total tagihan: Rp " . number_format($total, 0, ',', '.') . ", Uang bayar: Rp " . number_format($cashPaid, 0, ',', '.'));
                }

                $changeAmount = $cashPaid - $total;

                // Buat transaksi utama
                $transaction = Transaction::create([
                    'user_id' => auth()->id(),
                    'customer_id' => $request->customer_id,
                    'product_id' => null,
                    'quantity' => null,
                    'subtotal' => $subtotal,
                    'total_price' => $total,
                    'cash_paid' => $cashPaid,
                    'change_amount' => $changeAmount,
                    'discount' => $discount,
                    'discount_type' => $discountType,
                    'status' => 'success'
                ]);

                // Buat detail transaksi
                foreach ($detailsToCreate as $detail) {
                    $transaction->details()->create($detail);
                }

                // Redirect berdasarkan role
                if (auth()->user()->role === 'kasir') {
                    return redirect()->route('kasir.transaksi')->with('success', 'Transaksi berhasil disimpan');
                }

                return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan');
            });
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    // Update status pembayaran secara manual (Diotorisasi via Middleware)
    public function updateStatus(Transaction $transaction, Request $request)
    {
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
        $transaction->load(['details.product', 'user', 'customer']);
        return view('transactions.print', compact('transaction'));
    }
}