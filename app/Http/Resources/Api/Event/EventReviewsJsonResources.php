<?php


namespace App\Http\Resources\Api\Event;


use Illuminate\Http\Resources\Json\JsonResource;

class EventReviewsJsonResources extends JsonResource
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
            "name" => $this->alumnus->name,
            "avatar" => $this->alumnus->avatar,
            "title" => $this->title,
            "details" => $this->details,
            "rate" => $this->rate,
            "date" => $this->created_at->format("d.m.Y")
        ];
    }
}