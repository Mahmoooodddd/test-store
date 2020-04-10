<?php

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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/basket/', 'BasketController@index');
Route::post('/basket/add', 'BasketController@add');
Route::post('/basket/delete', 'BasketController@delete');
Route::post('/basket/update', 'BasketController@update');
Route::post('/order/finish', 'OrderController@finish')->middleware('auth');
Route::get('/order/my-orders', 'OrderController@myOrders')->name('my_orders')->middleware('auth');
Route::get('/order/products', 'OrderController@products')->name('order_products')->middleware('auth');
Route::post('/product/like', 'FavoriteController@like')->name('product_like')->middleware('auth');
Route::post('/product/unlike', 'FavoriteController@unLike')->name('product_unLike')->middleware('auth');
Route::get('/favoriteProducts/my-favorites', 'FavoriteController@myFavorites')->name('my_favorites')->middleware('auth');
Route::get('/favoriteProducts/favorites', 'FavoriteController@favorites')->name('favorites')->middleware('auth');
Route::get('/product/index/{page?}', 'ProductController@index')->middleware('auth');
Route::get('/product/new', 'ProductController@newProduct')->middleware('auth');
Route::post('/product/create', 'ProductController@create')->middleware('auth');
Route::get('/product/delete/{id}', 'ProductController@delete')->middleware('auth');
Route::get('/product/edit/{id}', 'ProductController@edit')->middleware('auth');
Route::post('/product/update/{id}', 'ProductController@update')->middleware('auth');








Auth::routes();

