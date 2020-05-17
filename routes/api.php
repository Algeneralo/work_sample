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

Route::group(['prefix' => 'v1', "namespace" => "Api"], function () {

    Route::group(['prefix' => 'user', "namespace" => "Auth"], function () {
        Route::get('register', 'RegisterController@create');
        Route::post('register', 'RegisterController@store');

        Route::put('activate', 'ActivateController@activate');
        Route::put('activate/send', 'ActivateController@sendAgain');

        Route::post('login', 'LoginController@login');
        Route::post('refresh-token', 'LoginController@refreshToken');

        Route::post('forgot-password', 'ForgotPasswordController@forgotPassword');
        Route::post('token-verification', 'ForgotPasswordController@tokenVerification');
        Route::post('reset-password', 'ForgotPasswordController@resetPassword');

    });

    Route::group(['prefix' => 'user', "middleware" => ['auth:api', "DenyIfBlocked"]], function () {
        Route::get('register', 'RegisterController@create');

        Route::get('profile', 'AlumniProfileController@edit');
        Route::put('profile', 'AlumniProfileController@update');
        Route::post('profile/image', 'AlumniProfileController@updateImage');

    });
});