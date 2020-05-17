<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumnus;
use App\Models\Media;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $alumniCount = Alumnus::query()->count();
        $eventsCount = Alumnus::query()->count();
        $mediaCount = Media::query()->count();
        return view("admin.dashboard", compact("alumniCount", "eventsCount", "mediaCount"));
    }
}
