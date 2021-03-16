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

Route::resource('users', 'UserController');


Route::resource('houses', 'Framing\HouseController')->middleware('auth');

Route::get('/orders/{id}', 'Framing\OrderController@index')->middleware('auth');

Route::get('/orders/{id}/create', 'Framing\OrderController@create')->middleware('auth');

Route::post('/orders/{id}/store', 'Framing\OrderController@store')->middleware('auth');

Route::get('/orders/{id}/{house_id}/edit', 'Framing\OrderController@edit')->middleware('auth');

Route::post('/orders/{id}/{house_id}/update', 'Framing\OrderController@update')->middleware('auth');

Route::delete('/orders/{id}/{house_id}', 'Framing\OrderController@destroy')->middleware('auth');



Route::get('/search', 'HouseController@search');
