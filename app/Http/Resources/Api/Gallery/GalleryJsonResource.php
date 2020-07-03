<?php

namespace App\Http\Resources\Api\Gallery;

use App\Http\Resources\Api\Alumni\AlumniJsonResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryJsonResource extends JsonResource
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
            "date" => $this->created_at->format("d.m.Y"),
            $this->mergeWhen($request->show, function () {
                return [
                    "details" => $this->details,
                    "linked_friends" => AlumniJsonResource::collection($this->linkedFriends),
                ];
            }),
        ];
    }
}
