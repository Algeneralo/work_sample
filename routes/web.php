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
Route::group(["as" => "admin.", "prefix" => "admin", "namespace" => "Admin", "middleware" => ["auth:alumni"]], function () {

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
        Route::get("/", "ForumController@index")->name("forum.index");
        Route::get("/create", "ForumController@create")->name("forum.create");
        Route::post("/", "ForumController@store")->name("forum.store");
        Route::get("/{forum}/show", "ForumController@show")->name("forum.show");
        Route::get("/{forum}", "ForumController@edit")->name("forum.edit");
        Route::put("/{forum}", "ForumController@update")->name("forum.update");

        //Themen/Topic
        Route::group(["prefix" => "/{forum}/" . trans("routes.topics"), "as" => "forum."], function () {
            Route::get("/", "ForumTopicController@index")->name("topics.index");
            Route::get("/create", "ForumTopicController@create")->name("topics.create");
            Route::post("/", "ForumTopicController@store")->name("topics.store");
            Route::get("/{topic}", "ForumTopicController@edit")->name("topics.edit");
            Route::put("/{topic}", "ForumTopicController@update")->name("topics.update");

            Route::get("/{topic}/comments", "TopicCommentController@index")->name("topics.comments.index");
        });
    });

    //Schwarzes Brett
    Route::group(["prefix" => trans("routes.bulletin-board"), "as" => "bulletin-board."], function () {
        //Allgemein
//        Route::prefix(trans("routes.general"))->group(function () {
//            Route::get("/", "GeneralController@index")->name("general.index");
//            Route::get("/create", "GeneralController@create")->name("general.create");
//            Route::post("/", "GeneralController@store")->name("general.store");
//            Route::get("/{general}/edit", "GeneralController@edit")->name("general.edit");
//            Route::put("/{general}", "GeneralController@update")->name("general.update");
//            Route::delete("/{general}", "GeneralController@destroy")->name("general.destroy");
//        });

        //Jobbörse
        Route::prefix(trans("routes.job-market"))->group(function () {
            Route::get("/", "JobMarketController@index")->name("job-market.index");
            Route::get("/create", "JobMarketController@create")->name("job-market.create");
            Route::post("/", "JobMarketController@store")->name("job-market.store");
            Route::get("/{jobMarket}/edit", "JobMarketController@edit")->name("job-market.edit");
            Route::put("/{jobMarket}", "JobMarketController@update")->name("job-market.update");
            Route::delete("/{jobMarket}", "JobMarketController@destroy")->name("job-market.destroy");
        });

        //Suche/Biete
        Route::prefix(trans("routes.offer"))->group(function () {
            Route::get("/", "OfferController@index")->name("offers.index");
            Route::get("/create", "OfferController@create")->name("offers.create");
            Route::post("/", "OfferController@store")->name("offers.store");
            Route::get("/{offer}/edit", "OfferController@edit")->name("offers.edit");
            Route::put("/{offer}", "OfferController@update")->name("offers.update");
            Route::delete("/{offer}", "OfferController@destroy")->name("offers.destroy");
            Route::delete("/image/{image}", "OfferController@imageDestroy")->name("offers.image.destroy");
        });
    });


    //Media
    Route::group(["prefix" => trans("routes.media"), "as" => "media."], function () {
        Route::prefix(trans("routes.gallery"))->group(function () {
            Route::get("/", "GalleryController@index")->name("gallery.index");
            Route::get("/create", "GalleryController@create")->name("gallery.create");
            Route::post("/", "GalleryController@store")->name("gallery.store");
            Route::get("/{gallery}/edit", "GalleryController@edit")->name("gallery.edit");
            Route::put("/{gallery}", "GalleryController@update")->name("gallery.update");
//            Route::delete("/{gallery}", "GalleryController@destroy")->name("gallery.destroy");
        });
        Route::prefix(trans("routes.podcast"))->group(function () {
            Route::get("/", "PodcastController@index")->name("podcast.index");
            Route::get("/create", "PodcastController@create")->name("podcast.create");
            Route::post("/", "PodcastController@store")->name("podcast.store");
            Route::get("/{podcast}/edit", "PodcastController@edit")->name("podcast.edit");
            Route::put("/{podcast}", "PodcastController@update")->name("podcast.update");
            Route::delete("/{podcast}", "PodcastController@destroy")->name("podcast.destroy");
        });

        Route::prefix(trans("routes.stories"))->group(function () {
            Route::get("/", "StoryController@index")->name("stories.index");
            Route::get("/create", "StoryController@create")->name("stories.create");
            Route::post("/", "StoryController@store")->name("stories.store");
            Route::get("/{story}/edit", "StoryController@edit")->name("stories.edit");
            Route::put("/{story}", "StoryController@update")->name("stories.update");
        });
    });

    //Kalender
    Route::prefix(trans("routes.calendar"))->group(function () {
        Route::get("/", "CalendarController@index")->name("calendar.index");
        Route::get("/resources", "CalendarController@resources")->name("calendar.resources");
    });

    //Nachrichten
    Route::prefix(trans("routes.messages"))->group(function () {
        Route::view("/", "admin.messages.index")->name("messages.index");
    });

});
Auth::routes(["register" => false]);