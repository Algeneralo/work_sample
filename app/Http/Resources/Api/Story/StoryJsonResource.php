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
            "file" => $this->cover,
            "file_type" => $this->cover_type,
            "title" => $this->title,
            "date" => $this->created_at->diffForHumans(),
            "alumnus" => [
                $this->alumnus->name,
                $this->alumnus->avatar,
            ],
            $this->mergeWhen(!$request->has("show"), [
                "short_details" => mb_strimwidth(strip_tags($this->details), 0, 300, '....'),
            ]),
            $this->mergeWhen($request->show, function () {
                return [
                    "details" => $this->details,
                ];
            }),
        ];
    }
}
