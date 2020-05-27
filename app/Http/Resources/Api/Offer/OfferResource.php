<?php

namespace App\Http\Resources\Api\Offer;

use App\Http\Resources\ApiPaginationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends ApiPaginationResource
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
            "data" => OfferJsonResource::collection($this->collection),
            "pagination" => $this->pagination
        ];
    }
}
