<?php


namespace App\Http\Controllers\Api\Auth;


use App\Notifications\SendEmailVerificationNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class ActivateController extends AuthController
{

    public function __construct()
    {
        parent::__construct();

        if (app()->environment() != "local") {
            $this->middleware('throttle:4,10')->only("activate");
            //sending activation code only 1 time every 10 minutes
            $this->middleware('throttle:1,10')->only("sendAgain");
        }
    }

    public function activate(Request $request)
    {
        $this->validate($request, [
            "email" => "required|email|exists:" . self::$TABLE,
            "activation_code" => "required|exists:" . self::$TABLE
        ]);

        return \DB::transaction(function () use ($request) {
            $user = self::$MODEL::query()
                ->where("email", $request->email)
                ->where("activation_code", $request->activation_code)
                ->firstOrFail();
            $user->activation_code = null;
            $user->save();

            return $this->noContentResponse();
        });
    }

    public function sendAgain(Request $request)
    {
        $this->validate($request, [
            "email" => "required|email|exists:" . self::$TABLE,
        ]);

        return \DB::transaction(function () use ($request) {
            $user = self::$MODEL::query()
                ->where("email", $request->email)
                ->firstOrFail();
            //@todo change email template and pass the token
            $user->activation_code = Str::random(self::$ACTIVATION_CODE_LENGTH);
            Notification::route("mail", $user->email)->notify(new SendEmailVerificationNotification($user->activation_code));
            $user->save();

            return $this->noContentResponse();
        });
    }
}