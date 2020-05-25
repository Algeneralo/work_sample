<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EventStoreRequest;
use App\Http\Resources\Api\Event\EventJsonResource;
use App\Http\Resources\Api\Event\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = new EventResource(Event::query()->paginate(10));
        return $this->successResponse(["events" => $events]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventStoreRequest $request)
    {
        return \DB::transaction(function () use ($request) {
            /** @var Event $event */
            $event = Event::query()->create($request->all());
            $event->addMediaFromRequest("image")
                ->preservingOriginal()
                ->withResponsiveImages()
                ->toMediaCollection("cover");
            return $this->createResponse($event);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        \request()->merge(["show" => true]);
        $event = new EventJsonResource($event);
        return $this->successResponse(["event" => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

}
