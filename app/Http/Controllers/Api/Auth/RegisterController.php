<?php


namespace App\Http\Controllers\Api\Auth;


use App\Models\DegreeProgram;
use App\Models\University;
use App\Notifications\SendEmailVerificationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class RegisterController extends AuthController
{

    private function rules()
    {
        return [
            "email" => "required|email|unique:" . self::$TABLE,
            "password" => "required|min:6|confirmed",

            'first_name' => 'required|max:40',
            'last_name' => 'required|max:40',
            'gender' => 'required|in:m,f',
            'street' => 'required|max:80',
            'street_number' => 'required|max:40',
            'postcode' => 'required|max:40',
            'city' => 'required|max:40',
            'dob' => 'required',
            'is_team_member' => 'required|boolean',
            'university_id' => 'required_if:is_team_member:1|exists:universities,id',
            'degree_program_id' => 'required_if:is_team_member:1|exists:degree_programs,id',
            'alumni_year' => 'required_if:is_team_member:1|max:4',
            'telephone' => 'required|max:50',
            'mobile' => 'required|max:50',
            "image" => "required|image",
        ];
    }

    public function create()
    {
        return $this->successResponse([
            "universities" => University::query()->select(["id", "name"])->get(),
            "degree_programs" => DegreeProgram::query()->select(["id", "name"])->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        return \DB::transaction(function () use ($request) {
            $request->merge([
                "activation_code" => $activationCode = Str::random(self::$ACTIVATION_CODE_LENGTH)
            ]);

            $user = self::$MODEL::query()->create($request->all());

            $user->addMediaFromRequest("image")
                ->preservingOriginal()
                ->toMediaCollection("avatar");
            //@todo change email template and pass the token
            Notification::route("mail", $user->email)->notify(new SendEmailVerificationNotification($activationCode));

            return $this->createResponse($user);
        });
    }

}