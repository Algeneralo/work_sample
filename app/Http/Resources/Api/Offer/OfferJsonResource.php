<?php

namespace App\Http\Resources\Api\Offer;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferJsonResource extends JsonResource
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
            "title" => $this->title,
            "from" => $this->created_at->diffForHumans(),
            $this->mergeWhen(!$request->has("show"), [
                "short_details" => mb_strimwidth(strip_tags($this->details), 0, 300, '....'),
            ]),
            $this->mergeWhen($request->has("show"), [
                "details" => $this->details,
                "images" => $this->images,
                "alumni" => [
                    "id" => $this->alumnus->id,
                    "name" => $this->alumnus->name,
                    "avatar" => $this->alumnus->avatar,
                ]
            ]),
        ];
    }
}
