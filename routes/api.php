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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/servico', 'ServiceController@indexAPI');
Route::post('/servico', 'ServiceController@store');
Route::get('/servico/{id}', 'Api\\ApiServiceController@edit');
Route::put('/servico/{id}', 'Api\\ApiServiceController@update');
Route::delete('/servico/{id}', 'Api\\ApiServiceController@destroy');
Route::get('/cliente/{getName}', 'ClientController@getName');
Route::post('/order', 'ServiceController@store');

