<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Product;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KasirController;

/*
|--------------------------------------------------------------------------
| API BARCODE SEARCH
|--------------------------------------------------------------------------
*/

Route::get('/api/products/search', function (Request $request) {

    $product = Product::where('barcode', $request->code)->first();

    if ($product) {
        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);
    }

    return response()->json([
        'status' => 'not_found'
    ], 404);

})->name('api.product.search');


/*
|--------------------------------------------------------------------------
| ROUTE UNTUK TAMU
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

});


/*
|--------------------------------------------------------------------------
| ROUTE YANG HARUS LOGIN (ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Produk
    Route::resource('products', ProductController::class);

    /*
    |-----------------------------------------
    | EXPORT EXCEL
    |-----------------------------------------
    */
    Route::get('/transactions/export', [TransactionController::class, 'export'])
        ->name('transactions.export');

    /*
    |-----------------------------------------
    | TRANSAKSI (ADMIN)
    |-----------------------------------------
    */
    Route::resource('transactions', TransactionController::class);

    /*
    |-----------------------------------------
    | SUPPLIER
    |-----------------------------------------
    */
    Route::resource('suppliers', SupplierController::class);
    Route::post('/suppliers/bayar', [SupplierController::class, 'bayar'])
        ->name('suppliers.bayar');

    /*
    |-----------------------------------------
    | PELANGGAN
    |-----------------------------------------
    */
    Route::resource('customers', CustomerController::class);

    /*
    |-----------------------------------------
    | PRINT STRUK
    |-----------------------------------------
    */
    Route::get('/transactions/{transaction}/print', [TransactionController::class, 'print'])
        ->name('transactions.print');

    /*
    |-----------------------------------------
    | UPDATE STATUS PEMBAYARAN MANUAL
    |-----------------------------------------
    */
    Route::patch('/transactions/{transaction}/status', [TransactionController::class, 'updateStatus'])
        ->name('transactions.updateStatus');

    /*
    |-----------------------------------------
    | LAPORAN
    |-----------------------------------------
    */
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

});


/*
|--------------------------------------------------------------------------
| ROUTE UNTUK KASIR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->group(function () {

    // Dashboard Kasir
    Route::get('/', [KasirController::class, 'dashboard'])
        ->name('kasir.dashboard');

    // Halaman Transaksi Kasir (riwayat + form)
    Route::get('/transaksi', [KasirController::class, 'transaksi'])
        ->name('kasir.transaksi');

    // Proses simpan transaksi (reuse TransactionController)
    Route::post('/transaksi', [TransactionController::class, 'store'])
        ->name('kasir.transaksi.store');

    // Print struk (kasir bisa cetak struk miliknya)
    Route::get('/transaksi/{transaction}/print', [TransactionController::class, 'print'])
        ->name('kasir.transaksi.print');

});


/*
|--------------------------------------------------------------------------
| ROUTE UMUM (AUTH TANPA ROLE KHUSUS)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Logout (semua role bisa logout)
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});


/*
|--------------------------------------------------------------------------
| ROOT WEBSITE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});