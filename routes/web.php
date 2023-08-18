<?php

use GuzzleHttp\Middleware;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
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




// Route::view('/', 'welcome');
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/producers','ProducersController@index')->name('productores');
Route::get('/producers/store','ProducersController@store')->name('producers.store');
Route::get('/producers/update','ProducersController@update')->name('producers.update');

// Route::get('/veterinaries','VeterinariesController@index')->name('veterinaries.index');
Route::get('/veterinaries/export','VeterinariesController@export')->name('veterinaries.export');
// Route::post('/veterinaries/store','VeterinariesController@store')->name('veterinaries.store');
// Route::post('/veterinaries/update','VeterinariesController@update')->name('veterinaries.update');
// Route::delete('/veterinaries/{veterinarie}','VeterinariesController@destroy')->name('veterinaries.destroy');
Route::resource('veterinaries','VeterinariesController');

Route::resource('users','UsersController');

// Route::get('/users','UsersadminController@index')->name('usuarios');