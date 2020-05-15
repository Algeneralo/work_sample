<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CalendarEvents;
use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::query()->select(["id", "name", "date", "start_time", "end_time"])->get();

        if(\request()->ajax()){
            $collection = CalendarEvents::collection($events);
            return response()->json($collection);
        }
        return view("admin.calendar.index", compact("events"));
    }

    public function resources()
    {
        $collection = CalendarEvents::collection(Event::query()->select(["id", "name", "date", "start_time", "end_time"])->get());
        return response()->json($collection);
    }
}
