<?php

namespace App\Http\Resources\Api\Gallery;

use App\Http\Resources\ApiPaginationResource;

class GalleryResource extends ApiPaginationResource
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
            "data" => GalleryJsonResource::collection($this->collection),
            "pagination" => $this->pagination,
        ];
    }
}
