<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | 1. MENAMPILKAN DAFTAR PRODUK
    |--------------------------------------------------------------------------
    | Method ini digunakan untuk menampilkan semua data produk
    | yang tersimpan di database dengan urutan terbaru.
    | Data ditampilkan menggunakan pagination sebanyak 10 data.
    */

    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('products.index', compact('products'));
    }


    /*
    |--------------------------------------------------------------------------
    | 2. MENAMPILKAN FORM TAMBAH PRODUK
    |--------------------------------------------------------------------------
    | Method ini hanya menampilkan halaman form untuk menambahkan
    | data produk baru ke dalam sistem.
    */

    public function create()
    {
        return view('products.create');
    }


    /*
    |--------------------------------------------------------------------------
    | 3. MENYIMPAN DATA PRODUK BARU
    |--------------------------------------------------------------------------
    | Method ini digunakan untuk memproses data dari form tambah produk,
    | melakukan validasi input, upload gambar, kemudian menyimpan data
    | ke database.
    */

    public function store(Request $request)
    {

        // Validasi input form
        $request->validate([
            'barcode' => 'required|unique:products,barcode',
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048', // maksimal 2MB
        ]);


        // Variabel untuk menyimpan path gambar
        $imagePath = null;

        // Cek apakah user upload gambar
        if ($request->hasFile('image')) {

            // Simpan gambar ke folder storage/public/products
            $imagePath = $request->file('image')->store('products', 'public');

        }


        // Simpan data produk ke database
        Product::create([
            'barcode' => $request->barcode,
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image' => $imagePath,
        ]);


        // Redirect kembali ke halaman produk
        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan!');

    }



    /*
    |--------------------------------------------------------------------------
    | 4. MENAMPILKAN FORM EDIT PRODUK
    |--------------------------------------------------------------------------
    | Method ini menampilkan halaman edit produk dengan data produk
    | yang dipilih berdasarkan ID.
    */

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }



    /*
    |--------------------------------------------------------------------------
    | 5. UPDATE DATA PRODUK
    |--------------------------------------------------------------------------
    | Method ini digunakan untuk memperbarui data produk yang sudah ada.
    | Jika user mengganti gambar maka gambar lama akan dihapus terlebih dahulu.
    */

    public function update(Request $request, Product $product)
    {

        // Validasi input (gambar optional)
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);


        // Ambil semua data kecuali gambar
        $data = $request->except('image');


        // Jika user upload gambar baru
        if ($request->hasFile('image')) {

            // Hapus gambar lama jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {

                Storage::disk('public')->delete($product->image);

            }

            // Upload gambar baru
            $data['image'] = $request->file('image')->store('products', 'public');

        }


        // Update data produk di database
        $product->update($data);


        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui!');

    }



    /*
    |--------------------------------------------------------------------------
    | 6. MENGHAPUS PRODUK
    |--------------------------------------------------------------------------
    | Method ini digunakan untuk menghapus data produk dari database.
    | Jika produk memiliki gambar, maka gambar juga akan dihapus
    | dari storage.
    */

    public function destroy(Product $product)
    {

        // Hapus gambar dari storage jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {

            Storage::disk('public')->delete($product->image);

        }


        // Hapus data produk dari database
        $product->delete();


        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus!');

    }

}