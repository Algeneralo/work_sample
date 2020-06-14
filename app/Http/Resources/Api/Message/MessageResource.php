<?php

namespace App\Http\Resources\Api\Message;

use App\Http\Resources\ApiPaginationResource;
use Illuminate\Http\Request;

class MessageResource extends ApiPaginationResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "data" => MessageJsonResource::collection($this->collection),
            "pagination" => $this->pagination
        ];
    }
}
