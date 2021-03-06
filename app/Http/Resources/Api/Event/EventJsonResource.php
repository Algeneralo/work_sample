<?php

namespace App\Http\Resources\Api\Event;

use App\Models\Event;
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
            "formatted_date" => $this->date->format("d.m.Y"),
            "formatted_time" => $this->from_to_time,
            "date" => $this->date->format("Y-m-d"),
            "start_time" => $this->start_time->format("H:i:s"),
            "end_time" => $this->start_time->format("H:i:s"),
            "cover" => $this->cover,
            //get only those values if it's a show method
            $this->mergeWhen($request->has("show"), function () {
                return [
                    "details" => $this->details,
                ];
            }),
            $this->mergeWhen(($request->has("show") && $this->type == Event::INTERNAL_EVENTS), function () {
                return [
                    "rate" => $this->rate,
                    "is_participated" => $this->participants->contains(auth()->id()),
                    "free_places" => $this->free_places,
                    "reviews_count" => $this->reviews->count(),
                    "reviews" => EventReviewsJsonResources::collection($this->reviews),
                    "participants" => EventParticipantsJsonResources::collection($this->participants),
                ];
            }),
        ];
    }
}
