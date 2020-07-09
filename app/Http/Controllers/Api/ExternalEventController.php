<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Event;
use App\Http\Resources\Api\Event\EventResource;
use App\Http\Resources\Api\Event\EventJsonResource;

class ExternalEventController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $events = new EventResource(
            Event::query()
                ->external()
                ->orderBy("date", request("direction") ?? "desc")
                ->paginate(100)
        );
        return $this->successResponse(["events" => $events]);
    }

    public function show(Event $externalEvent)
    {
        abort_if($externalEvent->type == Event::INTERNAL_EVENTS,Response::HTTP_FORBIDDEN);
        request()->merge(["show" => true]);
        $event = new EventJsonResource($externalEvent);
        return $this->successResponse(["event" => $event]);
    }
}
