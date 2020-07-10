<?php

namespace App\Http\Controllers\Api\MyNetwork;

use App\Models\Event;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\Event\EventResource;

class AlumniEventController extends ApiController
{
    public function __invoke()
    {
        $events = new EventResource(
            Event::query()
                ->internal()
                ->whereHas("participants", function ($query) {
                    $query->where("alumnus_id", auth()->id());
                })
                ->latest("date")
                ->paginate(100)
        );
        return $this->successResponse(["events" => $events]);
    }
}