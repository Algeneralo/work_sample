<?php

namespace App\Http\Resources\Api\General;

use App\Http\Resources\ApiPaginationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralResource extends ApiPaginationResource
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
            "data" => GeneralJsonResource::collection($this->collection),
            "pagination" => $this->pagination
        ];
    }
}
