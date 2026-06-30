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
        $validated = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'nama_perusahaan' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'kota' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:20',
            'saldo_hutang' => 'nullable|numeric|min:0',
            'jatuh_tempo' => 'nullable|integer|min:0',
            'status' => 'nullable|in:aktif,nonaktif',
        ]);

        $validated['saldo_hutang'] = $validated['saldo_hutang'] ?? 0;
        $validated['jatuh_tempo'] = $validated['jatuh_tempo'] ?? 0;

        Supplier::create($validated);

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
        $validated = $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'nama_perusahaan' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
            'kota' => 'nullable|string|max:255',
            'kode_pos' => 'nullable|string|max:20',
            'saldo_hutang' => 'nullable|numeric|min:0',
            'jatuh_tempo' => 'nullable|integer|min:0',
            'status' => 'nullable|in:aktif,nonaktif',
        ]);

        $validated['saldo_hutang'] = $validated['saldo_hutang'] ?? 0;
        $validated['jatuh_tempo'] = $validated['jatuh_tempo'] ?? 0;

        $supplier->update($validated);

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
