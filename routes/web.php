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

// download interventi aperti
Route::get('/interventions/open/export/csv', 'InterventionController@openExportCSV');
Route::get('/interventions/open/export/json', 'InterventionController@openExportJSON');

// download interventi conclusi negli ultimi 30 giorni
Route::get('/interventions/latests/export/csv', 'InterventionController@latestsExportCSV');
Route::get('/interventions/latests/export/json', 'InterventionController@latestsExportJSON');

// download interventi aperti o conclusi in una data specifica
Route::get('/interventions/{date}/export/csv', 'InterventionController@dateExportCSV');
Route::get('/interventions/{date}/export/json', 'InterventionController@dateExportJSON');

// download tecnici liberi
Route::get('/technicians/free/export/csv', 'UserController@freeExportCSV');
Route::get('/technicians/free/export/json', 'UserController@freeExportJSON');


Route::get("{any?}", function() {
    return view("front");
})->where("any", ".*");
