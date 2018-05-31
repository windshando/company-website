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

use App\Http\Controllers\web;

Route::namespace('web')->group(function () {
    Route::auth();
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/home', 'web\HomeController@index');
    Route::get('logout', 'web\Auth\LoginController@logout');
    Route::resource('/content', 'web\ContentController');
    Route::post('/content', 'web\ContentController@create');
    Route::put('/content/{id}', 'web\ContentController@update');
    Route::delete('/content/{id}', 'web\ContentController@delete');
    Route::put('/content/disable/{id}', 'web\ContentController@disable');
    
    Route::get('logout', 'web\Auth\LoginController@logout');
});

