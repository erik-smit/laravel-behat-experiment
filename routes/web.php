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

Auth::routes();
/*Route::get('register', 'Auth\RegisterController@showRegistrationForm', [ 
    'middleware' => ['auth', 'roles'],
    'uses' => 'UserController@index',
    'roles' => ['admin']
])->name('register');

Route::post('register', 'Auth\RegisterController@register', [ 
    'middleware' => ['auth', 'roles'],
    'uses' => 'UserController@index',
    'roles' => ['admin']
]);*/

Route::get('/home', 'HomeController@index')->name('home');
