<?php

namespace App\Http\Resources\Api\Topic;

use App\Http\Resources\ApiPaginationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends ApiPaginationResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "data" => TopicJsonResource::collection($this->collection),
            "pagination" => $this->pagination,
        ];
    }
}
