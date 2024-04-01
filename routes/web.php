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

/* Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
 */

Route::get('/about', 'App\Http\Controllers\HomeController@about')->name("home.about");
Route::get('/', 'App\Http\Controllers\ProductController@index')->name("product.index");
Route::get('/products/{id}', 'App\Http\Controllers\ProductController@show')->name("product.show");

Route::get('/buscar', 'App\Http\Controllers\ProductController@index1')->name("product.buscar"); //*Para buscar por Familia
Route::post('/product/buscarFamilia', 'App\Http\Controllers\ProductController@buscarFamilia')->name('product.buscarFamilia');
Route::post('product/{id}/comentarios', 'App\Http\Controllers\ProductController@comentarios')->name('product.comentarios');
Route::delete('/product/borrarComentario/{id}/{idComentario}', 'App\Http\Controllers\ProductController@borrarComentario')->name('product.borrarComentario');

Route::middleware('admin')->group(function () {
    Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
    Route::get('/admin/products', 'App\Http\Controllers\Admin\AdminProductController@index')->name("admin.product.index");
    Route::post('/admin/products/store', 'App\Http\Controllers\Admin\AdminProductController@store')->name("admin.product.store");
    Route::delete('/admin/products/{id}/delete', 'App\Http\Controllers\Admin\AdminProductController@delete')->name("admin.product.delete");
    Route::get('/admin/products/{id}/edit', 'App\Http\Controllers\Admin\AdminProductController@edit')->name("admin.product.edit");
    Route::put('/admin/products/{id}/update', 'App\Http\Controllers\Admin\AdminProductController@update')->name("admin.product.update");
});


/* Route::get('/product/scroll', 'App\Http\Controllers\ProductController@scroll')->name("product.scroll"); //*Para la pagina del Scroll */

//Genera automaticamente las rutas relacionadas con la autentificacion de usuarios
Auth::routes();
