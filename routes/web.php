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

Route::resource('buy', 'BuyController');


Route::get('/buy/provider/{query}','BuyController@proveedor');

Route::resource('TmpCompra', 'TmpCompraController');

Route::get('/TmpCompra/pago/{pago}','TmpCompraController@pago');

Route::get('/TmpCompra/delete/{tmp_compra}','TmpCompraController@borrar');

Route::get('/buy/detalles/{buy}','BuyController@detalle');

Route::resource('payment', 'PaymentController');

Route::get('buy/cuentas/pagar','BuyController@cuentasPorPagar')->name('buy.cuentas');

Route::get('buy/pagar/{buy}','BuyController@pagar');

//rutas para configuraciones generales con variables de sesion
Route::resource('/select','SesionesController');

Route::resource('general', 'GeneralController');


//rutas para datatable
Route::get('/almacenes','DataTableController@almacen');
Route::get('/sucursal','DataTableController@sucursal');
Route::get('/proveedor','DataTableController@proveedor');
Route::get('/usuario','DataTableController@usuario');
Route::get('/producto','DataTableController@producto');
Route::get('/compras','DataTableController@compras');
Route::get('/cuentasPorPagar','DataTableController@cuentasPorPagar');