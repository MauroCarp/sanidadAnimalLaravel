<?php

use App\Http\Controllers\BruturController;
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
Route::get('/', 'BruturController@alerts');
Route::get('/home', 'BruturController@alerts')->name('home');

Auth::routes();

Route::resource('producers', 'ProducersController');

Route::get('/veterinaries/export','VeterinariesController@export')->name('veterinaries.export');
Route::resource('veterinaries','VeterinariesController');

Route::resource('users','UsersController');

Route::get('/brutur/notifieds','BruturController@notifieds')->name('brutur.notifieds');
Route::get('/brutur/pending','BruturController@pending')->name('brutur.pending');
Route::get('/brutur/informeSenasa','BruturController@exportSenasa')->name('brutur.informeSenasa');
Route::post('/brutur/generalReport','BruturController@generalReport')->name('brutur.informeGeneral');
Route::delete('/brutur/updateStatus/record/{id}','RecordsController@destroy');
Route::delete('/brutur/record/{id}','RecordsController@deleteRecord');
Route::post('/brutur/notify','BruturController@notify')->name('brutur.notificar');

Route::resource('brutur/updateStatus','BruturController');
Route::post('/brutur/setCertificate','BruturController@setCertificate')->name('brutur.asignarCertificado');

Route::resource('/aftosa/receptions','ReceptionsController');

Route::get('/aftosa/distributions','DistributionsController@index')->name('distributions.index');
Route::post('/aftosa/distributions','DistributionsController@store')->name('distributions.store');
Route::delete('/aftosa/distributions/{id}','DistributionsController@destroy')->name('distributions.destroy');
Route::post('/aftosa/distributions/showDistributions','DistributionsController@showDistributions')->name('distributions.showDistributions');

Route::get('/aftosa/notVaccinated','AftosaController@notVaccinated')->name('aftosa.notVaccinated');
Route::get('/aftosa/diffSearch','AftosaController@diffSearch')->name('aftosa.diferencia');
Route::get('/aftosa/parcialDiffSearch','AftosaController@parcialDiffSearch')->name('aftosa.diferenciaParcial');
Route::post('/aftosa/actasByProducer','AftosaController@actasByProducer')->name('aftosa.actasProductor');
Route::post('/aftosa/producerSituation','AftosaController@producerSituation')->name('aftosa.situacionProductor');

Route::post('/aftosa/reports/email','ReportsController@sendSchedule')->name('reports.enviarCronograma');
Route::get('/aftosa/reports/reports','ReportsController@index')->name('reports.informes');
Route::post('/aftosa/reports/schedule','ReportsController@schedule')->name('reports.cronograma');
Route::get('/aftosa/reports/{key}','ReportsController@reportPdf');
Route::post('/aftosa/reports/{key}','ReportsController@reportPdf');

Route::resource('aftosa/acta','ActasController');

Route::resource('campaign','CampaignController');

Route::resource('backups','BackupsController');
