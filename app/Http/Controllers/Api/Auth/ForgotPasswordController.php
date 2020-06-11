<?php


namespace App\Http\Controllers\Api\Auth;


use App\Models\PasswordReset;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ForgotPasswordController extends AuthController
{
    public function __construct()
    {
        parent::__construct();
        if (app()->environment() != "local") {
            //sending activation code only 3 time every 10 minutes
            $this->middleware('throttle:3,10')->only("forgotPassword");
        }
    }

    /**
     * Creates PIN and sends to user email address
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws Throwable
     */
    public function forgotPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:' . self::$TABLE
        ]);

        return DB::transaction(function () use ($request) {
            PasswordReset::query()
                ->updateOrCreate(
                    ['email' => $request->input('email')],
                    ['token' => $token = Str::random(5), 'created_at' => now()]
                );

            Notification::route('mail', $request->input('email'))
                ->notify(new ResetPasswordNotification($token));

            return $this->successResponse([], 'Email Sent successfully');
        });

    }

    /**
     * Check giving token before move to reset page
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function tokenVerification(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'token' => 'required',
        ]);

        return DB::transaction(function () use ($request) {
            $exists = PasswordReset::query()
                ->where('token', $request->input('token'))
                ->where('email', $request->input('email'))
                ->first();

            if (!$exists || (isset($exists->expired) && $exists->expired)) {
                return $this->failResponse(Response::HTTP_UNPROCESSABLE_ENTITY, 'invalid_pin');
            }
            return $this->successResponse(['email' => $exists->email]);
        });

    }

    public function resetPassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);

        return DB::transaction(function () use ($request) {
            //delete token from DB
            PasswordReset::query()
                ->where('email', $request->input('email'))
                ->firstOr(function () {
                    abort(Response::HTTP_UNPROCESSABLE_ENTITY,'no_token');
                })->delete();

            $user = self::$MODEL::query()
                ->where('email', $request->input('email'))
                ->firstOrFail();

            $user->update(['password' => $request->input('password')]);

            return $this->noContentResponse();
        });
    }

}