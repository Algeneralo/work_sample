<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserJsonResource extends JsonResource
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
            "avatar" => $this->avatar,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "gender" => $this->gender,
            "street" => $this->street,
            "street_number" => $this->street_number,
            "postcode" => $this->postcode,
            "city" => $this->city,
            "email" => $this->email,
            "dob" => $this->dob,
            "description" => $this->description,
            "telephone" => $this->telephone,
            "mobile" => $this->mobile,
            "is_team_member" => $this->is_team_member,
            $this->mergeWhen(!$this->is_team_member, [
                "alumni_year" => $this->alumni_year,
                "university_id" => $this->university_id,
                "university_name" => $this->university->name,
                "degree_program_id" => $this->degree_program_id,
                "degree_program_name" => $this->degreeProgram->name,
            ])
        ];
    }
}
