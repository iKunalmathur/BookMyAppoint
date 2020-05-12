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

// Route::get('/', function () {
//     return view('welcome');
// })->name('index');

Route::get('/','welcomeController@index')->name('index');

// Route::resource('bookappointment','bookappointController');
Route::resource('bookappointment','bookappointController')->middleware(['auth:client']);

////////////Admin/////////////

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

// Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login');

});
Route::middleware(['auth:admin'])->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('home', 'HomeController@index')->name('home');
    Route::resource('profile','ProfileController');
    Route::resource('users','UserController');
    Route::resource('clients','ClientController');


});

//////////User/////////////

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
    Route::resource('slot','SlotController');
    Route::resource('service','ServiceController');
    Route::resource('appointment','AppointmentController');
    Route::get('changestatus/{data?}', 'AppointmentController@changestatus')->name('changestatus');
    Route::get('opnclsstatus','ProfileController@opnclsstatus')->name('opnclsstatus');
});


////////////Client///////////

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
    Route::resource('appointment','AppointmentController');
    Route::get('getslots/{data?}','AppointmentController@getslots')->name('getslots');
    Route::get('getservices/{data?}','AppointmentController@getservices')->name('getservices');
});

//////////////////////////////Routes//////////////////////////////////

// LOGOUT

Route::post('logout', 'Client\Auth\LoginController@logout')->name('logout');

// Map routes
Route::get('getstates/{data?}', 'MapController@getStates')->name('map.getstates');

Route::get('getcities/{data?}', 'MapController@getCities')->name('map.getcities');
