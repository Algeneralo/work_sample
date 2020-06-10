<?php

namespace App\Http\Resources\Api\Topic;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicJsonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "image" => $this->cover,
            "title" => $this->title,
            "date" => $this->created_at->format("d.m.Y"),
            "comments_count" => $this->comments()->count(),
            "likes_count" => $this->likersCount(),
            "details" => $this->details,
            "is_liked" => $this->isLikedBy(auth()->user())
        ];
    }
}
