<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('welcome');

Auth::routes();

Route::resource('shopping_cart_products', 'ProductShoppingCartsController', [
    'only' => ['store', 'destroy']
]);

Route::get('/cart', 'ShoppingCartsController@index')->name('cart');
Route::resource('cart', 'ShoppingCartsController', [
    'only' => ['show']
]);
Route::resource('orders', 'OrdersController', [
    'only' => ['index', 'update']
]);

Route::group(['middleware' => 'auth'], function() {
    Route::resource('products', 'ProductsController');
    
    Route::get('/home', 'HomeController@home')->name('home');
    Route::get('/payments', 'ShoppingCartsController@payment')->name('pay');
    Route::get('/payments/store', 'PaymentsController@store');
});
