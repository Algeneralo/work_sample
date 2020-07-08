<?php

namespace App\Http\Resources\Api\Forum;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ForumJsonResource extends JsonResource
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
            "title" => $this->designation,
            "topics_count" => $this->topics()->count(),
            "comments_count" => $this->comments()->count(),
            "details" => $this->details,
            "ability_to_create_topics" => (auth()->user()->is_team_member || $this->posts_type == Forum::POST_TYPES_ALL_USERS),
        ];
    }
}
