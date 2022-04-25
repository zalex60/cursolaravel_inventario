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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
 * Proveedors Routes
 */
Route::resource('proveedors', 'ProveedorController');

Route::group(['prefix' => 'usuarios'], function () {
    Route::get('/', 'UserController@index');
    Route::post('store', 'UserController@store')->name('user.store');
    Route::get('/{user_id}', 'UserController@info');
    Route::post('update', 'UserController@update')->name('user.update');
    

});




Route::get('verify/{token}', 'UserController@verify'); 
Route::post('verificar', 'UserController@verificar')->name('verificar.email');