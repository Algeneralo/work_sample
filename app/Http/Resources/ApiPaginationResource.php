<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ApiPaginationResource extends ResourceCollection
{
    protected $pagination;

    public function __construct($resource)
    {
        $this->pagination = [
            'current_page' => $resource->currentPage(),
            'last_page' => $resource->lastPage(),
            'prev_page_url' => $resource->previousPageUrl(),
            'next_page_url' => $resource->nextPageUrl(),
            'per_page' => $resource->perPage(),
            'path' => $resource->path(),
        ];
        parent::__construct($resource);
    }
}
