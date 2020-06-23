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
            Route::get('alumni/{alumnus}/conversation', 'AlumniConversationController@show');
            Route::get('team', 'TeamController');
        });

        Route::prefix("media")->group(function () {
            Route::apiResource("gallery", "GalleryController")->only(["index", "show"]);
            Route::apiResource("podcasts", "PodcastController")->only(["index", "show"]);
        });
        Route::get("events/create", "EventController@create");
        Route::post("events/{event}/reviews", "EventReviewController@store");
        Route::put("events/{event}/participate", "EventParticipantController@update");
        Route::apiResource("events", "EventController")->except(["update", "destroy"]);


        Route::prefix("bulletin-board")->group(function () {
            Route::apiResource("general", "GeneralController")->only(["index", "show"]);
            Route::apiResource("job-market", "JobMarketController")->only(["index", "show"]);
            Route::apiResource("offers", "OfferController")->only(["index", "show", "store"]);
        });

        Route::apiResource("forum", "ForumController")->only(["index"]);

        Route::put("forum/{forum}/topics/{topic}/like", "ForumTopicController@toggleLike");
        Route::apiResource("forum.topics", "ForumTopicController")->only(["index", "store"]);

        Route::put("forum/{forum}/topics/{topic}/comments/{comment}/like", "TopiCommentController@toggleLike");
        Route::apiResource("forum.topics.comments", "TopiCommentController")->only(["index", "store"]);

        Route::prefix("conversations")->group(function () {
            Route::get("/", "MessageController@index");
            Route::get("/{thread}", "MessageController@show");
            Route::post("/", "MessageController@store");
        });
    });

});