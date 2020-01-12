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

Route::get('/', 'ItemController@index')->name('item.index');
Route::get('/detail/{id}', 'ItemController@detail')->name('item.detail');
Route::get('/cart', 'CartController@cart')->name('cart.index');

Route::group(['prefix' => 'admin'], function() {
	Route::get('/', function() { return redirect('/admin/home'); });
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::get('home', 'Admin\ItemController@index')->name('admin.home');
	//新規作成
	Route::post('home', 'Admin\ItemController@create')->name('admin.home');//DB保存
	Route::get('item/add', 'Admin\ItemController@add')->name('admin.add');//追加form

	Route::get('item/detail/{id}', 'Admin\ItemController@detail')->name('admin.detail');//商品詳細
	//編集
	Route::get('item/edit/{id}', 'Admin\ItemController@edit')->name('admin.edit');//編集form
	Route::post('item/edit/{id}', 'Admin\ItemController@update')->name('admin.edit');//編集情報保存

	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
});
Auth::routes();


