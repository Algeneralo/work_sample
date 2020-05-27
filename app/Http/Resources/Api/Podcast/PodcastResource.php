<?php

namespace App\Http\Resources\Api\Podcast;

use App\Http\Resources\ApiPaginationResource;

class PodcastResource extends ApiPaginationResource
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
            "data" => PodcastJsonResource::collection($this->collection),
            "pagination" => $this->pagination,
        ];
    }
}
