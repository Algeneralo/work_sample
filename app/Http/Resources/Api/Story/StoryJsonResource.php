<?php

namespace App\Http\Resources\Api\Story;

use Illuminate\Http\Resources\Json\JsonResource;

class StoryJsonResource extends JsonResource
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
            "cover" => $this->cover,
            "title" => $this->title,
            "alumnus" => [
                $this->alumnus->name,
                $this->alumnus->avatar,
            ],
            $this->mergeWhen($request->show, function () {
                return [
                    "details" => $this->details,
                ];
            }),
        ];
    }
}
