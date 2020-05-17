<?php

namespace App\Http\Controllers\Api;


use App\Models\DegreeProgram;
use App\Models\University;
use Illuminate\Http\Request;

class AlumniProfileController extends ApiController
{
    public function edit()
    {
        return $this->successResponse([
            "user" => collect(auth()->user())->except(["is_team_member", "media", "blocked", "activation_code", "created_at", "updated_at", "deleted_at"]),
            "universities" => University::query()->select(["id", "name"])->get(),
            "degree_programs" => DegreeProgram::query()->select(["id", "name"])->get(),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $this->validate($request, $this->rules());
        return \DB::transaction(function () use ($validated, $request) {
            auth()->user()->update($validated);
            return $this->noContentResponse();
        });
    }

    private function rules()
    {
        return [
            "email" => "required|email|unique:alumni,id," . auth()->id(),
            'first_name' => 'required|max:40',
            'last_name' => 'required|max:40',
            'gender' => 'required|in:m,f',
            'street' => 'required|max:80',
            'street_number' => 'required|max:40',
            'postcode' => 'required|max:40',
            'city' => 'required|max:40',
            'dob' => 'required',
            'university_id' => 'required|exists:universities,id',
            'degree_program_id' => 'required|exists:degree_programs,id',
            'alumni_year' => 'required|max:4',
            'telephone' => 'required|max:50',
            'mobile' => 'required|max:50',
        ];
    }

    public function updateImage(Request $request)
    {
        $this->validate($request, [
            "image" => "required|image",
        ]);

        return \DB::transaction(function () {
            auth()->user()->clearMediaCollection("avatar");
            auth()->user()->addMediaFromRequest("image")
                ->preservingOriginal()
                ->withResponsiveImages()
                ->toMediaCollection("avatar");
            return $this->successResponse([
                "image" => auth()->user()->avatar
            ]);
        });
    }
}
