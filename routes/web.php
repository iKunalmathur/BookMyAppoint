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
})->name('index');


////////Admin//////
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

// Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login');

});
Route::middleware(['auth:admin'])->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('profile','ProfileController');

});

//////User////
Route::namespace('User')->prefix('user')->name('user.')->group(function () {

// Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login');
// Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register')->name('register');
    Route::get('home', 'HomeController@index')->name('home');

});
Route::middleware(['auth:user'])->namespace('User')->prefix('user')->name('user.')->group(function () {

    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('profile','ProfileController');

});


//////Client///////

Route::namespace('Client')->prefix('')->name('client.')->group(function () {
// Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
// Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::middleware(['auth:client'])->namespace('Client')->prefix('')->name('client.')->group(function () {

    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('profile','ProfileController');

});

////////////////////////Routes//////////////////////////////////

// LOGOUT

Route::post('logout', 'Auth\LoginController@logout')->name('logout');
