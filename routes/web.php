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
Route::get('login','HomeController@login')->name('login');
Route::post('getLogin','HomeController@getLogin');
Route::get('logout','HomeController@logout');
Route::get('register','HomeController@register');
Route::post('get-register','HomeController@storeRegister');

Route::group(['middleware' => ['auth']], function () {
Route::get('/','HomeController@index');
Route::get('delete/{a}','HomeController@destroy');
Route::get('edit/{a}','HomeController@edit');
Route::post('save', 'HomeController@store');
Route::post('update/{a}', 'HomeController@update');
});
