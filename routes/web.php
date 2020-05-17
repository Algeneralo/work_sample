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
Route::redirect("/", "/admin");

Route::group(["as" => "admin.", "prefix" => "admin", "namespace" => "Admin"], function () {

    Route::get("/", "HomeController")->name("dashboard");

    //Mein Netzwerk
    Route::group(["prefix" => trans("routes.my-network"), "as" => "my-network."], function () {
        //Alumni "alle"
        Route::prefix(trans("routes.alumni"))->group(function () {
            Route::get("/", "AlumniController@index")->name("alumni.index");
            Route::get("/create", "AlumniController@create")->name("alumni.create");
            Route::post("/", "AlumniController@store")->name("alumni.store");
            Route::get("/{alumnus}/edit", "AlumniController@edit")->name("alumni.edit");
            Route::put("/{alumnus}", "AlumniController@update")->name("alumni.update");
            Route::delete("/{alumnus}", "AlumniController@destroy")->name("alumni.destroy");
            Route::patch("/{alumnus}/block", "AlumniController@block")->name("alumni.block");
        });
        //Team
        Route::prefix(trans("routes.team"))->group(function () {
            Route::get("/", "TeamController@index")->name("teams.index");
            Route::get("/create", "TeamController@create")->name("teams.create");
            Route::post("/", "TeamController@store")->name("teams.store");
            Route::get("/{team}/edit", "TeamController@edit")->name("teams.edit");
            Route::put("/{team}", "TeamController@update")->name("teams.update");
            Route::delete("/{team}", "TeamController@destroy")->name("teams.destroy");
            Route::patch("/{team}/block", "TeamController@block")->name("teams.block");
        });
    });
    //Veranstaltungen events
    Route::prefix(trans("routes.event"))->group(function () {
        Route::get("/", "EventController@index")->name("events.index");
        Route::get("/create", "EventController@create")->name("events.create");
        Route::post("/", "EventController@store")->name("events.store");
        Route::get("/{event}/edit", "EventController@edit")->name("events.edit");
        Route::put("/{event}", "EventController@update")->name("events.update");
    });

    //Forum
    Route::prefix(trans("routes.forum"))->group(function () {
        Route::view("/", "admin.forum.index")->name("forum.index");
        Route::view("/create", "admin.forum.create")->name("forum.create");
        Route::view("/{forum}/edit", "admin.forum.edit")->name("forum.edit");
        Route::view("/{forum}/" . trans('routes.subjects') . "/create", "admin.forum.subjects.create")->name("forum.subject.create");
    });

    //Schwarzes Brett
    Route::group(["prefix" => trans("routes.bulletin-board"), "as" => "bulletin-board."], function () {
        //Allgemein
        Route::prefix(trans("routes.general"))->group(function () {
            Route::view("/", "admin.bulletin-board.general.index")->name("general.index");
            Route::view("/create", "admin.bulletin-board.general.create")->name("general.create");
            Route::view("/{general}/edit", "admin.bulletin-board.general.edit")->name("general.edit");
        });

        //Jobbörse
        Route::prefix(trans("routes.job-market"))->group(function () {
            Route::view("/", "admin.bulletin-board.job-market.index")->name("job-market.index");
            Route::view("/create", "admin.bulletin-board.job-market.create")->name("job-market.create");
            Route::view("/{job}/edit", "admin.bulletin-board.job-market.edit")->name("job-market.edit");
        });
        //Suche/Biete
        Route::prefix(trans("routes.offer"))->group(function () {
            Route::view("/", "admin.bulletin-board.offer.index")->name("offers.index");
            Route::view("/create", "admin.bulletin-board.offer.create")->name("offers.create");
            Route::view("/{offer}/edit", "admin.bulletin-board.offer.edit")->name("offers.edit");
        });
    });


    //Media
    Route::prefix(trans("routes.media"))->group(function () {
        Route::view("/", "admin.media.index")->name("media.index");
        Route::view("/create", "admin.media.create")->name("media.create");
        Route::view("/{media}/edit", "admin.media.edit")->name("media.edit");
    });

    //Kalender
    Route::prefix(trans("routes.calendar"))->group(function () {
        Route::get("/", "CalendarController@index")->name("calendar.index");
        Route::get("/resources", "CalendarController@resources")->name("calendar.resources");
    });

    //Nachrichten
    Route::prefix(trans("routes.messages"))->group(function () {
        Route::view("/", "CalendarController@index")->name("messages.index");
    });

});
