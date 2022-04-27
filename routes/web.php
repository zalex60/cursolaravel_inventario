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

Route::get('verify/{token}', 'UserController@verify'); 
Route::post('verificar', 'UserController@verificar')->name('verificar.email');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'usuarios'], function () {
    Route::get('/', 'UserController@index')->name('usuarios');
    Route::post('store', 'UserController@store')->name('user.store');
    Route::post('update', 'UserController@update');
    Route::delete('destroy/{id}', 'UserController@destroy');
});

Route::group(['prefix' => 'articulos'], function () {
    Route::get('/', 'ArticuloController@index')->name('articulos');
    Route::post('store', 'ArticuloController@store');
    Route::post('update', 'ArticuloController@update');
});

