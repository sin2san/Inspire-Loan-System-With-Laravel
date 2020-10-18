<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {

    //Home
    Route::get('/', 'Site\HomeController@index');

    //Login
    Route::get('login', ['as' => 'login', 'uses' => 'Site\AuthController@get_login']);
    Route::post('login', 'Site\AuthController@post_login');
    Route::get('logout', 'Site\AuthController@get_logout');

});
