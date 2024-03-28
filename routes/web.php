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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    Route::group(['middleware' => ['guest'], 'namespace' => 'Auth' ], function() {

        Route::get('/auth', 'AuthController@show')->name('auth.show');
        Route::post('/auth', 'AuthController@auth')->name('auth.perform');

    });

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/', 'HomeController@index')->name('main');
        Route::post('/', 'HomeController@answerToQuestion')->name('question');
    });
});
