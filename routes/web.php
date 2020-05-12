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

Route::group(["as" => "admin.", "prefix" => "admin"], function () {

    Route::view("/", "admin.dashboard")->name("dashboard");

    //Profil
    Route::prefix(trans("routes.alumni"))->group(function () {
        Route::view("/", "admin.alumni.index")->name("alumni.index");
        Route::view("/create", "admin.alumni.create")->name("alumni.create");
        Route::view("/{alumni}/edit", "admin.alumni.edit")->name("alumni.edit");
    });

    //Veranstaltungen
    Route::prefix(trans("routes.event"))->group(function () {
        Route::view("/", "admin.events.index")->name("events.index");
        Route::view("/create", "admin.events.create")->name("events.create");
        Route::view("/{event}/edit", "admin.events.edit")->name("events.edit");
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

    //Mein Netzwerk
    Route::group(["prefix" => trans("routes.my-network"), "as" => "my-network."], function () {

        Route::view("/", "admin.my-network.index")->name("index");
        Route::view("/{id}/edit", "admin.my-network.edit")->name("edit");
        //Team
        Route::prefix(trans("routes.team"))->group(function () {
            Route::view("/", "admin.my-network.teams.index")->name("teams.index");
//            Route::view("/create", "admin.my-network.teams.create")->name("teams.create");
//            Route::view("/{team}/edit", "admin.my-network.teams.edit")->name("teams.edit");
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
        Route::view("/", "admin.calendar.index")->name("calendar.index");
    });

    //Nachrichten
    Route::prefix(trans("routes.messages"))->group(function () {
        Route::view("/", "admin.messages.index")->name("messages.index");
    });


    //for testing papoose, should be deleted after start working with backend
    //@todo delete
    Route::match(["put", "post"], trans("routes.event"), function () {
        if (app()->environment() == "production")
            return redirect()->back();
        dump(request()->file("image"));
        dd(request()->all());
    })->name("test");

});
