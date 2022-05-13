<?php

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
    return redirect('checkout/1');
});

Route::get('checkout/{id}', 'App\Http\Controllers\CartController@showOrder')->name('checkout');
Route::post('formRequest', 'App\Http\Controllers\OrderController@storeOrder')->name('formRequest.post');
Route::post('checkDiscount', 'App\Http\Controllers\OrderController@getDiscountId')->name('formRequest.checkDiscount');
Route::view('/ordered', 'ordered');
