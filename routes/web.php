<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Models\Client;
use App\Exports\ClientsFromView;


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
    return view('index');
});

Route::get('/home', 'UserController@index');

Route::prefix('cliente')->group(function () {
    Route::get('/', 'ClientController@index')->name('client.index');
    Route::get('/novo', 'ClientController@create')->name('client.new');
    Route::post('/novo', 'ClientController@store');
    Route::get('/editar/{id}', 'ClientController@edit')->name('client.edit');
    Route::post('/{id}', 'ClientController@update');
    Route::get('/apagar/{id}', 'ClientController@destroy')->name('client.delete');
    Route::get('/exportar', 'ClientController@export')->name('client.export');
});

Route::prefix('servico')->group(function () {
    Route::get('/', 'ServiceController@index')->name('service.index');
    Route::get('/novo', 'ServiceController@create')->name('service.new');
    Route::post('/novo', 'ServiceController@store');
    Route::get('/exportar', 'ServiceController@export')->name('service.export');
});