<?php

namespace App\Http\Resources\Api\Alumni;

use App\Http\Resources\ApiPaginationResource;

class AlumniResource extends ApiPaginationResource
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
            "data" => AlumniJsonResource::collection($this->collection),
            "pagination" => $this->pagination
        ];
    }

}
