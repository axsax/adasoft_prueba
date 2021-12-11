<?php

use App\Http\Controllers\Backend\InvoicesController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Backend\ShopController;
use App\Http\Controllers\Backend\StocksController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PageController;
use App\Models\Invoice;
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

Route::get('/', [PageController::class,'products']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('products', ProductsController::class)->middleware('auth');
Route::resource('stocks', StocksController::class)->middleware('auth')->except('show');
Route::resource('invoices', InvoicesController::class)->middleware('auth');
Route::resource('shops', ShopController::class)->middleware('auth');
Route::resource('carts', CartController::class)->middleware('auth');
