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
     * @param Event $event
     * @return JsonResponse
     */
    public function update(Event $event)
    {
        if ($event->participants->contains(auth()->id()))
            $event->participants()->detach(auth()->id());
        else {
            //abort if there's no places left
            abort_if($event->max_participants && ($event->max_participants - $event->participants()->count()) == 0, Response::HTTP_FORBIDDEN);
            $event->participants()->attach(auth()->id());
        }

        return $this->noContentResponse();
    }

}
