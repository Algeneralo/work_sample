<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventStoreRequest;
use App\Http\Requests\Admin\EventUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        $events = Event::all();

        return view('admin.event.index', compact('events'));
    }

    /**
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.event.create', compact("categories"));
    }

    /**
     * @param EventStoreRequest $request
     * @return Response
     */
    public function store(EventStoreRequest $request)
    {

        \DB::transaction(function () use ($request) {
            [$startTime, $endTime] = explode("~", $request->time);
            $request->merge([
                "start_time" => trim($startTime),
                "end_time" => trim($endTime),
            ]);

            /** @var Event $event */
            $event = Event::create($request->all());
            $event->participants()->attach($request->participants);
            $event->addMediaFromRequest("image")
                ->preservingOriginal()
                ->withResponsiveImages()
                ->toMediaCollection("cover");
        });

        session()->flash("success", trans("messages.success.created"));

        return redirect()->route('admin.events.index');
    }

    /**
     * @param Event $event
     * @return Response
     */
    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('admin.event.edit', compact('event', "categories"));
    }

    /**
     * @param EventUpdateRequest $request
     * @param Event $event
     * @return Response
     */
    public function update(EventUpdateRequest $request, Event $event)
    {
        \DB::transaction(function () use ($request, $event) {
            $event->update($request->only($event->getFillable()));
            if ($request->hasFile("image")) {
                $event->clearMediaCollection("cover");
                $event->addMediaFromRequest("image")
                    ->preservingOriginal()
                    ->withResponsiveImages()
                    ->toMediaCollection("cover");
            }
            $event->participants()->sync($request->participants);
        });

        session()->flash("success", trans("messages.success.updated"));

        return redirect()->back();
    }

}
