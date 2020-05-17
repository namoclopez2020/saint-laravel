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

Route::get('/', 'indexController@index')->name('/');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('provider', 'ProviderController');

Route::resource('client', 'ClientController');

Route::resource('categorie', 'CategorieController');

Route::resource('office', 'OfficeController');

Route::resource('warehouse', 'WarehouseController');

Route::resource('user', 'UserController');

Route::PATCH('/password/{user}','UserController@password')->name('user.password');

Route::PATCH('/status/{user}','UserController@status')->name('user.status');

Route::get('/product/list/{empaque}','ProductController@empaque');

Route::get('/product/impuesto/{impuesto}','ProductController@impuesto');

Route::resource('product', 'ProductController');


