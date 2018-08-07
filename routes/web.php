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
