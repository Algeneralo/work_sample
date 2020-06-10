<?php

namespace App\Http\Resources\Api\Comment;

use App\Http\Resources\ApiPaginationResource;

class CommentResource extends ApiPaginationResource
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
            "data" => CommentJsonResource::collection($this->collection),
            "pagination" => $this->pagination,
        ];
    }
}
