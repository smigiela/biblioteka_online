<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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
    return view('welcome');
});

// auth -all
Route::group(['middleware'=>['auth']], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/catalogOfBooks', [DashboardController::class, 'catalogOfBooks'])->name('dashboard.catalogOfBooks');
    Route::post('/addToCart', [CartController::class, 'store']);
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/deleteCart/{id}', [CartController::class, 'destroy']);
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::get('/submitOrder', [OrderController::class, 'submitOrder']);
    Route::get('/detailOrder/{id}', [OrderController::class, 'detailOrder']);
});

// auth -admin
Route::group(['middleware'=>['auth','role:admin']], function(){
    Route::get('/dashboard/adminPanel', [DashboardController::class, 'adminPanel'])->name('dashboard.adminPanel');
});

// auth -user
Route::group(['middleware'=>['auth','role:user|admin']], function(){

});

require __DIR__.'/auth.php';
