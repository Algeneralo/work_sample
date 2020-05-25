<?php

namespace App\Http\Resources\Api\Event;

use App\Http\Resources\ApiPaginationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends ApiPaginationResource
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
            "data" => EventJsonResource::collection($this->collection),
            "pagination" => $this->pagination
        ];
    }
}
