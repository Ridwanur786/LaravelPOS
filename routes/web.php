<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\TransactionController;

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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('orders',OrderController::class);
Route::resource('order_details',OrderDetailController::class);
Route::resource('/Pos_system/public/products',ProductController::class);
Route::resource('companies',CompanyController::class);
Route::resource('settings',SettingController::class);
Route::resource('vendors',VendorController::class);
Route::resource('suppliers',SupplierController::class);
Route::resource('transactions',TransactionController::class);
Route::resource('users',UserController::class);
Route::get('barcode', 'App\Http\Controllers\ProductController@GetProductBarcodes')->name('products.barcode');
