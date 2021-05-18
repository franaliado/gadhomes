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

Route::post('/users/store', 'UserController@store')->middleware('auth');

Route::get('/users/password', 'UserController@password')->middleware('auth');

Route::post('/users/passwordchange/{id}', 'UserController@passwordchange')->middleware('auth');

Route::get('/users/{id}/reset', 'UserController@reset')->middleware('auth');

Route::resource('users', 'UserController');



Route::resource('houses', 'Framing\HouseController')->middleware('auth');

//Orders

Route::get('/orders/{id}', 'Framing\OrderController@index')->middleware('auth');

Route::get('/orders/{id}/create', 'Framing\OrderController@create')->middleware('auth');

Route::post('/orders/{id}/store', 'Framing\OrderController@store')->middleware('auth');

Route::get('/orders/{id}/{house_id}/edit', 'Framing\OrderController@edit')->middleware('auth');

Route::post('/orders/{id}/{house_id}/update', 'Framing\OrderController@update')->middleware('auth');

Route::delete('/orders/{id}/{house_id}', 'Framing\OrderController@destroy')->middleware('auth');

//DescriptionPO

Route::get('/descriptionpo/{order_id}/{house_id}', 'Framing\DescriptionController@index')->middleware('auth');

Route::get('/descriptionpo/{order_id}/{house_id}/create', 'Framing\DescriptionController@create')->middleware('auth');

Route::post('/descriptionpo/{order_id}/{house_id}/store', 'Framing\DescriptionController@store')->middleware('auth');

Route::get('/descriptionpo/{id}/{order_id}/{house_id}/edit', 'Framing\DescriptionController@edit')->middleware('auth');

Route::post('/descriptionpo/{id}/{order_id}/{house_id}/update', 'Framing\DescriptionController@update')->middleware('auth');

Route::delete('/descriptionpo/{id}/{order_id}/{house_id}', 'Framing\DescriptionController@destroy')->middleware('auth');

//Invoice

Route::get('/invoice/{id}/{house_id}', 'Framing\InvoiceController@index')->middleware('auth');

Route::get('/invoicePdf/{id}', 'Framing\InvoiceController@invoicePdf')->middleware('auth');

//Subcontractors

Route::resource('subcontractors', 'Framing\SubcontractorController')->middleware('auth');

Route::resource('subcontractor_amount', 'Framing\SubcontractorAmountController')->middleware('auth');

//Additional

Route::get('/additional/{house_id}', 'Framing\AdditionalController@index')->middleware('auth');

Route::get('/additional/{house_id}/create', 'Framing\AdditionalController@create')->middleware('auth');

Route::post('/additional/{house_id}/store', 'Framing\AdditionalController@store')->middleware('auth');

Route::delete('/additional/{id}/{house_id}', 'Framing\AdditionalController@destroy')->middleware('auth');

Route::get('/additional/{id}/{house_id}/edit', 'Framing\AdditionalController@edit')->middleware('auth');

Route::post('/additional/{id}/{house_id}/update', 'Framing\AdditionalController@update')->middleware('auth');

//Tools

Route::get('/tools/{subcontractor_id}', 'Framing\ToolController@index')->middleware('auth');

Route::get('/tools/{subcontractor_id}/create', 'Framing\ToolController@create')->middleware('auth');

Route::post('/tools/{subcontractor_id}/store', 'Framing\ToolController@store')->middleware('auth');

Route::delete('/tools/{id}/{subcontractor_id}', 'Framing\ToolController@destroy')->middleware('auth');

Route::get('/tools/{id}/{subcontractor_id}/edit', 'Framing\ToolController@edit')->middleware('auth');

Route::post('/tools/{id}/{subcontractor_id}/update', 'Framing\ToolController@update')->middleware('auth');

//Payments

Route::get('/payments/{subcontractor_id}', 'Framing\PaymentController@index')->middleware('auth');

Route::get('/payments/{subcontractor_id}/create', 'Framing\PaymentController@create')->middleware('auth');

Route::post('/payments/{subcontractor_id}/store', 'Framing\PaymentController@store')->middleware('auth');

Route::delete('/payments/{id}/{subcontractor_id}', 'Framing\PaymentController@destroy')->middleware('auth');

Route::get('/payments/{id}/{subcontractor_id}/edit', 'Framing\PaymentController@edit')->middleware('auth');

Route::post('/payments/{id}/{subcontractor_id}/update', 'Framing\PaymentController@update')->middleware('auth');

//Resume

Route::get('/resume/{subcontractor_id}/{totalhouses}', 'Framing\ResumeController@index')->middleware('auth');

Route::get('/resumePdf/{subcontractor_id}/{totalhouses}', 'Framing\ResumeController@resumePdf')->middleware('auth');


//Expenses

Route::get('/expenses/{user_id}', 'Framing\ExpenseController@index')->middleware('auth');

Route::get('/expenses/{user_id}/create', 'Framing\ExpenseController@create')->middleware('auth');

Route::post('/expenses/{user_id}/store', 'Framing\ExpenseController@store')->middleware('auth');

Route::delete('/expenses/{id}/{user_id}', 'Framing\ExpenseController@destroy')->middleware('auth');

Route::get('/expenses/{id}/{user_id}/edit', 'Framing\ExpenseController@edit')->middleware('auth');

Route::post('/expenses/{id}/{user_id}/update', 'Framing\ExpenseController@update')->middleware('auth');

//Reports

Route::get('/rep_houses', 'Framing\ReportsController@rep_houses')->middleware('auth');

Route::get('/report_houses_options', 'Framing\ReportsController@report_houses_options')->middleware('auth');

Route::get('/rep_houses_com_PDF/{status}/{community}', 'Framing\ReportsController@rep_houses_com_PDF')->middleware('auth');

Route::get('/rep_houses_subc_PDF/{status}/{subcontractor}', 'Framing\ReportsController@rep_houses_subc_PDF')->middleware('auth');

Route::get('/rep_subcontractors', 'Framing\ReportsController@rep_subcontractors')->middleware('auth');

Route::get('/report_subcontractors', 'Framing\ReportsController@report_subcontractors')->middleware('auth');

Route::get('/rep_subcontractor_subc_PDF/{subcontractor}/{FromDate}/{ToDate}', 'Framing\ReportsController@rep_subcontractor_subc_PDF')->middleware('auth');

Route::get('/rep_expenses', 'Framing\ReportsController@rep_expenses')->middleware('auth');

Route::post('/report_expenses', 'Framing\ReportsController@report_expenses')->middleware('auth');

Route::get('/rep_expenses_PDF/{users}/{type_expense}/{type_pay}/{FromDate}/{ToDate}', 'Framing\ReportsController@rep_expenses_PDF')->middleware('auth');
