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

Route::group(['prefix' => 'admin', 'middleware' =>  ['auth', 'role:admin']], function () {

    //Dashboard
    Route::get('dashboard', 'Admin\HomeController@index');

    //Loan
    Route::get('loans', 'Admin\LoanController@index');
    Route::get('loan/{id}/{status}/update', 'Admin\LoanController@update_status');
    Route::get('loan/{id}/view', 'Admin\LoanController@get_view');

    //Profile
    Route::get('user/profile', 'Admin\UserController@get_profile');
    Route::post('user/profile', 'Admin\UserController@post_profile');
    Route::get('user/delete-image', 'Admin\UserController@delete_image');

    //Option
    Route::get('options', 'Admin\OptionController@get_edit');
    Route::post('options', 'Admin\OptionController@post_edit');
    Route::get('options/delete-favicon', 'Admin\OptionController@delete_favicon');
    Route::get('options/delete-logo', 'Admin\OptionController@delete_logo');

    Route::get('cache/flush', 'Admin\HomeController@cache_flush');

});

Route::group(['prefix' => 'customer', 'middleware' => 'auth'], function () {

    //Dashboard
    Route::get('dashboard', 'Admin\HomeController@index');

    //User
    Route::get('user/profile', 'Admin\UserController@get_profile');
    Route::post('user/profile', 'Admin\UserController@post_profile');
    Route::get('user/delete-image', 'Admin\UserController@delete_image');

    //Loan
    Route::get('loans', 'Admin\LoanController@index');
    Route::get('loan/apply', 'Admin\LoanController@get_apply');
    Route::post('loan/apply', 'Admin\LoanController@post_apply');
    Route::post('loan/{id}/update-payment', 'Admin\LoanController@update_payment');
    Route::get('loan/{id}/view', 'Admin\LoanController@get_view');
});

