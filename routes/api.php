<?php

use Illuminate\Http\Request;

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

Route::group(['namespace' => 'Api'], function () {
    Route::post('/login', 'ApiController@login');

    Route::group(['middleware' => 'auth.jwt'], function () {
        Route::post('/logout', 'ApiController@logout');

        Route::get('/users', 'UserController@index')->middleware('auth.jwt.admin');
        Route::get('/account', 'UserController@show');
    });
});
