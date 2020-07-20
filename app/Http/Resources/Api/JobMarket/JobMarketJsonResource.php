<?php

namespace App\Http\Resources\Api\JobMarket;

use Illuminate\Http\Resources\Json\JsonResource;

class JobMarketJsonResource extends JsonResource
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
            "title" => $this->offer,
            "employer" => $this->employer,
            "category" => $this->category,
            "from" => $this->created_at->diffForHumans(),
            "working_type" => $this->working_hours_string,
            "city" => $this->city,
            $this->mergeWhen(!$request->has("show"), [
                "short_details" => mb_strimwidth(strip_tags($this->details), 0, 300, '....'),
            ]),
            "cover" => $this->cover,
            $this->mergeWhen($request->has("show"), [
                "beginning" => $this->beginning,
                "duration" => $this->duration,
                "link" => $this->link,
                "details" => $this->details,
                "contact" => [
                    "name" => $this->contact->name,
                    "company_name" => $this->contact->company_name,
                    "email" => $this->contact->email,
                    "telephone" => $this->contact->telephone,
                ],
            ]),
        ];
    }
}
