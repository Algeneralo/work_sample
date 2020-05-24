<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumnus;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Media;
use App\Models\Podcast;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $alumniCount = Alumnus::query()->count();
        $eventsCount = Event::query()->count();
        $mediaCount = Gallery::query()->count() + Podcast::query()->count();
        return view("admin.dashboard", compact("alumniCount", "eventsCount", "mediaCount"));
    }
}
