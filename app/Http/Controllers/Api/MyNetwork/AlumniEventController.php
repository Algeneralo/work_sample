<?php

namespace App\Http\Controllers\Api\MyNetwork;

use App\Models\Event;
use App\Models\Alumnus;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\Event\EventResource;

class AlumniEventController extends ApiController
{
    public function __invoke(Alumnus $alumnus)
    {
        $events = new EventResource(
            Event::query()
                ->internal()
                ->whereHas("participants", function ($query) use ($alumnus) {
                    $query->where("alumnus_id", $alumnus->id);
                })
                ->latest("date")
                ->paginate(100)
        );
        return $this->successResponse(["events" => $events]);
    }
}