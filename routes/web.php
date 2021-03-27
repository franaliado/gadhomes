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

Route::post('/users/store', 'UserController@store')->middleware('auth');

Route::resource('houses', 'Framing\HouseController')->middleware('auth');

Route::get('/orders/{id}', 'Framing\OrderController@index')->middleware('auth');

Route::get('/orders/{id}/create', 'Framing\OrderController@create')->middleware('auth');

Route::post('/orders/{id}/store', 'Framing\OrderController@store')->middleware('auth');

Route::get('/orders/{id}/{house_id}/edit', 'Framing\OrderController@edit')->middleware('auth');

Route::post('/orders/{id}/{house_id}/update', 'Framing\OrderController@update')->middleware('auth');

Route::delete('/orders/{id}/{house_id}', 'Framing\OrderController@destroy')->middleware('auth');

Route::get('/descriptionpo/{order_id}/{house_id}', 'Framing\DescriptionController@index')->middleware('auth');

Route::get('/descriptionpo/{order_id}/{house_id}/create', 'Framing\DescriptionController@create')->middleware('auth');

Route::post('/descriptionpo/{order_id}/{house_id}/store', 'Framing\DescriptionController@store')->middleware('auth');

Route::get('/descriptionpo/{id}/{order_id}/{house_id}/edit', 'Framing\DescriptionController@edit')->middleware('auth');

Route::post('/descriptionpo/{id}/{order_id}/{house_id}/update', 'Framing\DescriptionController@update')->middleware('auth');

Route::delete('/descriptionpo/{id}/{order_id}/{house_id}', 'Framing\DescriptionController@destroy')->middleware('auth');


Route::get('/invoice/{id}/{house_id}', 'Framing\InvoiceController@index')->middleware('auth');

Route::get('/invoicePdf/{id}', 'Framing\InvoiceController@invoicePdf')->middleware('auth');

Route::resource('subcontractors', 'Framing\SubcontractorController')->middleware('auth');

Route::resource('subcontractor_amount', 'Framing\SubcontractorAmountController')->middleware('auth');

Route::get('/additional/{house_id}', 'Framing\AdditionalController@index')->middleware('auth');

Route::get('/additional/{house_id}/create', 'Framing\AdditionalController@create')->middleware('auth');

Route::post('/additional/{house_id}/store', 'Framing\AdditionalController@store')->middleware('auth');

Route::delete('/additional/{id}/{house_id}', 'Framing\AdditionalController@destroy')->middleware('auth');

Route::get('/additional/{id}/{house_id}/edit', 'Framing\AdditionalController@edit')->middleware('auth');

Route::post('/additional/{id}/{house_id}/update', 'Framing\AdditionalController@update')->middleware('auth');


Route::get('/search', 'HouseController@search');
