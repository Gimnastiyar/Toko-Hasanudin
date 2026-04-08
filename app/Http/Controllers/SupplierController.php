<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    // Menampilkan daftar semua supplier
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        return view('suppliers.index', compact('suppliers'));
    }

    // Menampilkan form untuk menambah supplier baru
    public function create()
    {
        return view('suppliers.create');
    }

    // Menyimpan data supplier baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required',
        ]);

        Supplier::create($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit data supplier
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    // Memperbarui data supplier di database
    public function update(Request $request, Supplier $supplier)
    {
        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diupdate');
    }

    // Menghapus data supplier dari database
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return back()->with('success', 'Supplier dihapus');
    }

    // Memproses pembayaran hutang kepada supplier
    public function bayar(Request $request)
    {
        $supplier = Supplier::find($request->supplier_id);

        if ($request->jumlah_bayar > $supplier->saldo_hutang) {
            return back()->with('error', 'Pembayaran melebihi hutang!');
        }

        $supplier->saldo_hutang -= $request->jumlah_bayar;
        $supplier->save();

        return back()->with('success', 'Pembayaran berhasil');
    }
}
