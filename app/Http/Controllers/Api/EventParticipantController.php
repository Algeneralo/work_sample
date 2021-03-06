<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EventParticipantController extends ApiController
{
    /**
     * toggle event participate
     *
     * @param Event $event
     * @return JsonResponse
     */
    public function update(Event $event)
    {
        abort_if($event->type == Event::EXTERNAL_EVENTS,Response::HTTP_FORBIDDEN);
        if ($event->participants->contains(auth()->id()))
            $event->participants()->detach(auth()->id());
        else {
            //abort if there's no places left
            abort_if($event->max_participants && ($event->free_places) == 0, Response::HTTP_FORBIDDEN);
            $event->participants()->attach(auth()->id());
        }
        $event->refresh();
        return $this->successResponse([
            "is_participated" => $event->participants->contains(auth()->id()),
            "free_places" => $event->free_places,
        ]);
    }

}
