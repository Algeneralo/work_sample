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

        Route::post('login', 'LoginController@login')->name("api.login");
        Route::post('refresh-token', 'LoginController@refreshToken')->name("api.refresh-token");

        Route::post('forgot-password', 'ForgotPasswordController@forgotPassword');
        Route::post('token-verification', 'ForgotPasswordController@tokenVerification');
        Route::post('reset-password', 'ForgotPasswordController@resetPassword');

    });

    Route::middleware(['auth:api', "DenyIfBlocked"])->group(function () {

        Route::prefix("user")->group(function () {
            Route::get('profile', 'AlumniProfileController@edit');
            Route::put('profile', 'AlumniProfileController@update');
            Route::post('profile/image', 'AlumniProfileController@updateImage');
        });

        Route::group(["prefix" => "my-network", "namespace" => "MyNetwork"], function () {
            Route::get('alumni', 'AlumniController');
            Route::get('team', 'TeamController');
        });

        Route::apiResource("events", "EventController")->except(["update", "destroy"]);
        Route::post("events/{event}/reviews", "EventReviewController@store");


        Route::prefix("bulletin-board")->group(function () {
            Route::apiResource("general", "GeneralController")->only(["index", "show"]);
            Route::apiResource("job-market", "JobMarketController")->only(["index", "show"]);
        });
    });

});