<?php

namespace App\Http\Resources\Api\Story;

use App\Http\Resources\ApiPaginationResource;

class StoryResource extends ApiPaginationResource
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
            "data" => StoryJsonResource::collection($this->collection),
            "pagination" => $this->pagination,
        ];
    }
}
