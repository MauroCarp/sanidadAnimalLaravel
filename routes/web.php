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

Route::resource('producers', 'ProducersController');


Route::get('/veterinaries/export','VeterinariesController@export')->name('veterinaries.export');
Route::resource('veterinaries','VeterinariesController');

Route::resource('users','UsersController');

Route::get('/brutur/notifieds','BruturController@notifieds')->name('brutur.notifieds');
Route::get('/brutur/pending','BruturController@pending')->name('brutur.pending');
Route::get('/brutur/informeSenasa','BruturController@exportSenasa')->name('brutur.informeSenasa');

// Route::resource('receptions','ReceptionsController');

Route::resource('/aftosa/receptions','ReceptionsController');

Route::get('/aftosa/distributions','DistributionsController@index')->name('distributions.index');
Route::post('/aftosa/distributions','DistributionsController@store')->name('distributions.store');
Route::delete('/aftosa/distributions/{id}','DistributionsController@destroy')->name('distributions.destroy');
Route::post('/aftosa/distributions/showDistributions','DistributionsController@showDistributions')->name('distributions.showDistributions');

Route::get('/aftosa/notVaccinated','AftosaController@notVaccinated')->name('aftosa.notVaccinated');
Route::get('/aftosa/diffSearch','AftosaController@diffSearch')->name('aftosa.diferencia');
Route::get('/aftosa/parcialDiffSearch','AftosaController@parcialDiffSearch')->name('aftosa.diferenciaParcial');
Route::get('/aftosa/reports','AftosaController@reports')->name('aftosa.informes');
Route::post('/aftosa/actasByProducer','AftosaController@actasByProducer')->name('aftosa.actasProductor');

