<?php

namespace App\Http\Resources\Api\Forum;

use App\Http\Resources\ApiPaginationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ForumResource extends ApiPaginationResource
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
            "data" => ForumJsonResource::collection($this->collection),
            "pagination" => $this->pagination,

        ];
    }
}
