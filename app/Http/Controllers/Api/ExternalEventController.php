<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Models\Event;
use App\Http\Resources\Api\Event\EventResource;

class ExternalEventController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function __invoke()
    {
        $events = new EventResource(
            Event::query()
                ->external()
                ->orderBy("date", request("direction") ?? "desc")
                ->paginate(10)
        );
        return $this->successResponse(["events" => $events]);
    }

}
