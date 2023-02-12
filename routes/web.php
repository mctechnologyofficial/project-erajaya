<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Sales\TransactionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// force logout routes, temporary for debugging
Route::get('/force/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:Sales']], function () {
    Route::controller(TransactionController::class)->group(function(){
        Route::get('/transaction', 'index')->name('sales.transaction.index');
        Route::get('/transaction/create-customer', 'createCustomer')->name('sales.transaction.createcustomer');
        Route::post('/transaction/store-customer', 'storeCustomer')->name('sales.transaction.storecustomer');
        Route::get('/transaction/create-transaction', 'createTransaction')->name('sales.transaction.createtransaction');
        Route::post('/transaction/store-transaction', 'storeTransaction')->name('sales.transaction.storetransaction');
        Route::get('/transaction/getprice/{id}', 'getPrice');
    });
});

Route::group(['middleware' => ['role:Admin']], function () {

    // User Routes
    Route::controller(UserController::class)->group(function(){
        Route::get('/user', 'index')->name('admin.user.index');
        Route::get('/user/create', 'create')->name('admin.user.create');
        Route::post('/user/store', 'store')->name('admin.user.store');
        Route::get('/user/{id}/edit', 'edit')->name('admin.user.edit');
        Route::put('/user/{id}/update', 'update')->name('admin.user.update');
        Route::delete('/user/{id}/destroy', 'destroy')->name('admin.user.destroy');
    });

    // Product Routes
    Route::controller(ProductController::class)->group(function(){
        Route::get('/product', 'index')->name('admin.product.index');
        Route::get('/product/create', 'create')->name('admin.product.create');
        Route::post('/product/store', 'store')->name('admin.product.store');
        Route::get('/product/{id}/edit', 'edit')->name('admin.product.edit');
        Route::put('/product/{id}/update', 'update')->name('admin.product.update');
        Route::delete('/product/{id}/destroy', 'destroy')->name('admin.product.destroy');
    });
});
