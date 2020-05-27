<?php


namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Passport;

class LoginController extends AuthController
{

    /**
     * Login user and create token
     *
     * @param Request $request
     * @return JsonResponse [string] access_token
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => "required|string|email|exists:" . self::$TABLE,
            'password' => 'required|string',
        ]);
        $this->checkIfBlocked($request->email);

        $response = $this->sendPassportRequest("password");
        return \response()->json($response->json(), $response->status());
    }


    /**
     * Refresh user token
     *
     * @param Request $request
     * @return JsonResponse [string] access_token
     * @throws ValidationException
     */
    public function refreshToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:' . self::$TABLE,
        ]);

        $response = $this->sendPassportRequest("refresh_token");
        return \response()->json($response->json(), $response->status());
    }

    /**
     * Check if the user account is blocked or not
     * and abort if blocked
     * @param $email
     */
    private function checkIfBlocked($email): void
    {
        self::$MODEL::query()
            ->withoutGlobalScope("is_team_member")
            ->where("email", $email)
            ->where("blocked", 0)
            ->firstOr(function () {
                abort(Response::HTTP_FORBIDDEN, trans("messages.blocked"));
            });
    }
}