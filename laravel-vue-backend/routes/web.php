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

Auth::routes(['register' => false]);

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::get('products/{id}/gallery', 'ProductController@gallery')->name('products.gallery');
Route::get('transactions/{id}/set-status', 'TransactionController@setStatus')->name('transactions.status');

Route::resource('products', ProductController::class);
Route::resource('product-galleries', ProductGalleryController::class);
Route::resource('transactions', TransactionController::class);