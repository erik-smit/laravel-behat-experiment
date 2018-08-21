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

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// $this->post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

// User
Route::get('/user', 'UserController@index')->name('user');
Route::get('/user/create', 'UserController@create')->name('user-create');
Route::post('/user', 'UserController@store');
Route::get('/user/{user}', 'UserController@show')->name('user-show');
Route::get('/user/{user}/edit', 'UserController@edit')->name('user-edit');
Route::patch('/user/{user}', 'UserController@update')->name('user-patch');
Route::get('/user/{user}/delete', 'UserController@delete')->name('user-delete');
Route::delete('/user/{user}', 'UserController@destroy')->name('user-destroy');

// Customer
Route::get('/customer', 'CustomerController@index')->name('customer');
Route::get('/customer/create', 'CustomerController@create')->name('customer-create');
Route::post('/customer', 'CustomerController@store');
Route::get('/customer/{customer}', 'CustomerController@show')->name('customer-show');
Route::get('/customer/{customer}/edit', 'CustomerController@edit')->name('customer-edit');
Route::patch('/customer/{customer}', 'CustomerController@update')->name('customer-patch');
Route::get('/customer/{customer}/delete', 'CustomerController@delete')->name('customer-delete');
Route::delete('/customer/{customer}', 'CustomerController@destroy')->name('customer-destroy');

// InvoiceOrder
Route::get('/invoiceorder', 'InvoiceOrderController@index')->name('invoiceorder');
Route::get('/invoiceorder/create', 'InvoiceOrderController@create')->name('invoiceorder-create');
Route::post('/invoiceorder', 'InvoiceOrderController@store');
Route::get('/invoiceorder/{invoiceOrder}', 'InvoiceOrderController@show')->name('invoiceorder-show');
Route::get('/invoiceorder/{invoiceOrder}/edit', 'InvoiceOrderController@edit')->name('invoiceorder-edit');
Route::patch('/invoiceorder/{invoiceOrder}', 'InvoiceOrderController@update')->name('invoiceorder-patch');
Route::post('/invoiceorder/process', 'InvoiceOrderController@process')->name('invoiceorder-process');
Route::get('/invoiceorder/{invoiceOrder}/delete', 'InvoiceOrderController@delete')->name('invoiceorder-delete');
Route::delete('/invoiceorder/{invoiceOrder}', 'InvoiceOrderController@destroy')->name('invoiceorder-destroy');

// Invoice
Route::get('/invoice', 'InvoiceController@index')->name('invoice');
Route::get('/invoice/{invoice}', 'InvoiceController@show')->name('invoice-show');
Route::get('/invoice/{invoice}/pdf', 'InvoiceController@showPDF')->name('invoice-showPDF');

// Password
Route::get('/password', 'PasswordController@index')->name('password');
Route::get('/password/edit', 'PasswordController@edit')->name('password-edit');
Route::patch('/password', 'PasswordController@update')->name('password-patch');