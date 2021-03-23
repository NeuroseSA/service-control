<?php

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



Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', function () {
        return view('index');
    })->name('index');

    Route::prefix('cliente')->group(function () {
        //GET
        Route::get('/', 'ClientController@index')->name('client.index');
        Route::get('/editar/{id}', 'ClientController@edit')->name('client.edit');
        Route::get('/novo', 'ClientController@create')->name('client.new');
        Route::get('/apagar/{id}', 'ClientController@destroy')->name('client.delete');
        Route::get('/exportar', 'ClientController@export')->name('client.export');
        Route::get('/show/{id}', 'ClientController@show');
        

        //POST
        Route::post('/novo', 'ClientController@store');
        Route::post('/{id}', 'ClientController@update');
    });

    Route::prefix('servico')->group(function () {
        //GET
        Route::get('/', 'ServiceController@index')->name('service.index');
        Route::get('/filtros', 'ServiceController@listFilter');
        Route::get('/novo', 'ServiceController@create')->name('service.new');

        //POST
        Route::post('/novo', 'ServiceController@store');
        Route::post('/exportar', 'ServiceController@export')->name('service.export');
    });

    Route::prefix('usuario')->group(function () {
       Route::get('/', 'UserController@index')->name('user.index');
        Route::get('/novo', 'UserController@create')->name('user.new');
        Route::get('/editar/{id}', 'UserController@edit')->name('user.edit');
        Route::post('/{id}', 'UserController@update')->name('user.update');
        Route::post('/novo', 'UserController@store');
        Route::get('/logout', 'LoginController@logout')->name('user.logout');
        Route::get('/apagar/{id}', 'UserController@destroy')->name('user.delete');
    });
});

Route::get('/login', 'LoginController@login')->name('user.login');
Route::post('/', 'LoginController@authenticate');

