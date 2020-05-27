<?php

namespace App\Http\Resources\Api\JobMarket;

use App\Http\Resources\ApiPaginationResource;

class JobMarketResource extends ApiPaginationResource
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
            "data" => JobMarketJsonResource::collection($this->collection),
            "pagination" => $this->pagination
        ];
    }
}
