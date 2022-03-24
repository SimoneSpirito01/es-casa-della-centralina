<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// interventi aperti
Route::get('/interventions/open', 'Api\InterventionController@open');
// interventi conclusi negli ultimi 30gg
Route::get('/interventions/latests', 'Api\InterventionController@latests');
// interventi conclusi o aperti in una data specifica
Route::get('/interventions/{date}', 'Api\InterventionController@date');
// nuovo intervento
Route::post('/interventions/store', 'Api\InterventionController@store');


// tecnici liberi
Route::get('/technicians/free', 'Api\UserController@free');
// lista tecnici
Route::get('/technicians', 'Api\UserController@index');
