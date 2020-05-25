<?php

namespace App\Http\Resources\Api\General;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class GeneralJsonResource extends JsonResource
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
            $this->mergeWhen(!$request->has("show"), [
                "short_details" => mb_strimwidth(strip_tags($this->details), 0, 50, '....'),
            ]),
            "cover" => $this->cover,
            "from" => $this->date->diffForHumans(),
            $this->mergeWhen($request->has("show"), [
                "details" => $this->details,
            ]),
        ];
    }
}
