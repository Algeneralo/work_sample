<?php

namespace App\Http\Controllers\Api;


use App\Models\Experience;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Resources\Api\User\UserJsonResource;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlumniProfileController extends ApiController
{
    public function edit()
    {
        return $this->successResponse([
            "user" => new UserJsonResource(auth()->user()),
        ]);
    }

    public function update(Request $request)
    {
        $validated = $this->validate($request, $this->rules());
        return \DB::transaction(function () use ($request) {
            auth()->user()->update($request->only(auth()->user()->getFillable()));

            if ($request->has("work_experiences")) {
                auth()->user()->experiences()->where("type", Experience::WORK_EXPERIENCE)->delete();
                auth()->user()->experiences()->createMany(json_decode($request->input("work_experiences"), true));
            }
            if ($request->has("education_experiences")) {
                auth()->user()->experiences()->where("type", Experience::EDUCATION_EXPERIENCE)->delete();
                auth()->user()->experiences()->createMany(json_decode($request->input("education_experiences"), true));
            }
            if ($request->has("voluntary_experiences")) {
                auth()->user()->experiences()->where("type", Experience::VOLUNTARY_EXPERIENCE)->delete();
                auth()->user()->experiences()->createMany(json_decode($request->input("voluntary_experiences"), true));
            }

            return $this->successResponse([
                "user" => new UserJsonResource(auth()->user()),
            ]);
        });
    }

    private function rules()
    {
        return [
            "email" => "required|email|unique:alumni,email," . auth()->id(),
            'first_name' => 'required|max:40',
            'last_name' => 'required|max:40',
            'gender' => 'required|in:m,f',
            'street' => 'required|max:80',
            'street_number' => 'required|max:40',
            'postcode' => 'required|max:40',
            'city' => 'required|max:40',
            'dob' => 'required',
            'education_experiences' => 'json|sometimes',
            'work_experiences' => 'json|sometimes',
            'alumni_year' => [Rule::requiredIf(!auth()->user()->is_team_member)],
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
            Media::query()->where("model_id", auth()->id())->delete();
            auth()->user()->addMediaFromRequest("image")
                ->preservingOriginal()
                ->toMediaCollection("avatar");
            return $this->successResponse([
                "image" => auth()->user()->avatar,
            ]);
        });
    }
}
