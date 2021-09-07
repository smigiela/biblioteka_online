<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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
});

// auth -admin
Route::group(['middleware'=>['auth','role:admin']], function(){
    Route::get('/dashboard/book', [DashboardController::class, 'book'])->name('dashboard.book');
});

// auth -user
Route::group(['middleware'=>['auth','role:user|admin']], function(){
    Route::get('/dashboard/catalogOfBooks', [DashboardController::class, 'catalogOfBooks'])->name('dashboard.catalogOfBooks');
});

require __DIR__.'/auth.php';
