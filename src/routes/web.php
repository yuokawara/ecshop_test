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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin'], function() {
    Route::get('shop/create', 'Admin\ShopController@add')->middleware('auth');
    Route::post('shop/create', 'Admin\ShopController@create')->middleware('auth');
    Route::get('shop', 'Admin\ShopController@index')->middleware('auth');
    Route::get('shop/edit', 'Admin\ShopController@edit')->middleware('auth'); // 追記
    Route::post('shop/edit', 'Admin\ShopController@update')->middleware('auth'); // 追記
    Route::get('shop/delete', 'Admin\ShopController@delete')->middleware('auth');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
