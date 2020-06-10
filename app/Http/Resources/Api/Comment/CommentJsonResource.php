<?php

namespace App\Http\Resources\Api\Comment;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentJsonResource extends JsonResource
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
            "comment" => $this->comment,
            "from" => $this->created_at->diffForHumans(),
            "likes_count" => $this->likersCount(),
            "is_liked" => $this->isLikedBy(auth()->user()),
            "alumnus" => [
                "name" => $this->alumnus->name,
                "image" => $this->alumnus->avatar,
            ],
        ];
    }
}
