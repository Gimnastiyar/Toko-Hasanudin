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
| ROUTE YANG HARUS LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

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
    | TRANSAKSI
    |-----------------------------------------
    */
    Route::resource('transactions', TransactionController::class);
/*
|-----------------------------------------
| SUPPLIER
|-----------------------------------------
*/
Route::resource('suppliers', SupplierController::class);
Route::post('/suppliers/bayar', [SupplierController::class, 'bayar'])->name('suppliers.bayar');
    /*
    |-----------------------------------------
    | PRINT STRUK
    |-----------------------------------------
    */
    Route::get('/transactions/{transaction}/print', [TransactionController::class, 'print'])
        ->name('transactions.print');
    // Route Laporan
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    /*
    |-----------------------------------------
    | LOGOUT
    |-----------------------------------------
    */
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