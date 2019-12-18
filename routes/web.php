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

Route::group(['prefix' => 'admin'], function() {
	Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login',    'Admin\LoginController@login');
});
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::get('/home', 'Admin\HomeController@index')->name('admin.home');
	Route::post('logout',   'Admin\LoginController@logout')->name('admin.logout');
});
Auth::routes();


