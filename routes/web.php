<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/cart', function () {
    return view('cart');
});
// Route::get('/', [CartController::class, 'index']);
// Route::post('/cart', [CartController::class, 'store']);

Route::post('/calculate', 'App\Http\Controllers\ProductController@calculate')->name('calculate');

// Route::get('/', function () {
//     return view('welcome');
// });




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
