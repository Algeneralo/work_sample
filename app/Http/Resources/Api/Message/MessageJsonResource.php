<?php

namespace App\Http\Resources\Api\Message;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class MessageJsonResource extends JsonResource
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
            $this->mergeWhen(!request()->has("show"), [
                "last_message" => Str::limit($this->getLatestMessageAttribute()["body"], 40),
                "last_update" => $this->last_update,
            ]),
            $this->mergeWhen(request()->has("show"), [
                "messages" => MessageShowJsonResource::collection($this->messages()->orderBy("created_at")->get()),
            ]),
            "alumnus" => [
                "id" => $this->receiver()->id,
                "name" => $this->receiver()->name,
                "avatar" => $this->receiver()->avatar,
            ]
        ];
    }
}
