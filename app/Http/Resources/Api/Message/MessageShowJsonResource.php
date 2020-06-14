<?php

namespace App\Http\Resources\Api\Message;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageShowJsonResource extends JsonResource
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
            "from_alumnus" => $this->user_id != auth()->id(),
            "message" => $this->body,
            "created_at" => $this->created_at
        ];
    }
}
