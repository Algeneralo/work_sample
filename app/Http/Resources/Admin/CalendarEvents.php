<?php

namespace App\Http\Resources\Admin;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class CalendarEvents extends JsonResource
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
            "value" => $this->id,
            "title" => $this->start_time->format("H:i") . "-" . $this->end_time->format("H:i") . " - " . $this->name,
            "text" => $this->start_time->format("H:i") . "-" . $this->end_time->format("H:i") . " - " . $this->name,
            "color" => $this->color,
            "start" => Carbon::create($this->date->format("d-m-Y") . " " . $this->start_time->format("H:i")),
            "end" => Carbon::create($this->date->format("d-m-Y") . " " . $this->end_time->format("H:i")),
        ];
    }
}
