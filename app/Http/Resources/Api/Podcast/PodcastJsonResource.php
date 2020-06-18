<?php

namespace App\Http\Resources\Api\Podcast;

use Illuminate\Http\Resources\Json\JsonResource;

class PodcastJsonResource extends JsonResource
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
            "date" => $this->created_at->format("d.m.Y"),
            "podcast"=>$this->voice,
            $this->mergeWhen($request->show, function () {
                return [
                    "details" => $this->details,
                ];
            })
        ];
    }
}
