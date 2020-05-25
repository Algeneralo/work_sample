<?php

namespace App\Http\Resources\Api\Alumni;

use Illuminate\Http\Resources\Json\JsonResource;

class AlumniJsonResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "avatar" => $this->avatar
        ];
    }

}
