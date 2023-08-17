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

Route::get('/veterinaries','VeterinariesController@index')->name('vacunadores');
Route::get('/veterinaries/export','VeterinariesController@export')->name('exportarExcel');
Route::get('/veterinaries/store','VeterinariesController@store')->name('nuevoVeterinario');
Route::delete('/veterinaries/{id}','VeterinariesController@destroy')->name('eliminarVeterinario');

Route::get('/users','UsersController@index')->name('usuarios');