<?php

namespace App\Http\Resources\Api\Event;

use Illuminate\Http\Resources\Json\JsonResource;

class EventJsonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->name,
            "date" => $this->date->format("d.m.Y"),
            "time" => $this->from_to_time,
            "cover" => $this->cover,
            //get only those values if it's a show method
            $this->mergeWhen($request->has("show"), [
                "rate" => $this->rate,
                "details" => $this->details,
                "free_places" => $this->max_participants ? $this->max_participants - $this->participants()->count() : null,
                "reviews_count" => $this->reviews->count(),
                "reviews" => EventReviewsJsonResources::collection($this->reviews),
                "participants" => EventParticipantsJsonResources::collection($this->participants),
            ]),
        ];
    }
}
