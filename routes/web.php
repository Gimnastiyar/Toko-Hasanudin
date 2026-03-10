<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

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
    | PRINT STRUK
    |-----------------------------------------
    */

    Route::get('/transactions/{transaction}/print', [TransactionController::class, 'print'])
        ->name('transactions.print');


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