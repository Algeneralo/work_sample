<?php

namespace App\Http\Resources\Api\Team;

use App\Http\Resources\ApiPaginationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends ApiPaginationResource
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
            "data" => TeamJsonResource::collection($this->collection),
            "pagination" => $this->pagination
        ];
    }
}
