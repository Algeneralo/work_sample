<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Models\PasswordReset;
use App\Notifications\ResetApiPasswordNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Passport;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class AuthController extends ApiController
{
    /**
     *  Client Id for passport auth
     * @var int
     */
    static $CLIENT_ID;
    /**
     *  Client Secret for passport auth
     * @var String
     */
    static $CLIENT_SECRET;

    /**
     * Used model for authentication
     * @var Model
     */
    static $MODEL = "App\Models\ApiAuth";
    /**
     * Table Name
     * @var string
     */
    static $TABLE = "";

    /**
     * Activation code length
     * @var int
     */
    static $ACTIVATION_CODE_LENGTH = 5;

    /**
     *
     * AuthController constructor.
     */
    public function __construct()
    {
        self::$TABLE = (new self::$MODEL())->getTable();

        //Get the client Id and secret to pass it for auth
        $client = Passport::client()
            ->where(["password_client" => 1])
            ->firstOr(function () {
                return $this->generatePassportClient();
            });

        self::$CLIENT_ID = $client["id"];
        self::$CLIENT_SECRET = $client["secret"];

    }


    /**
     * Generate new passport client
     * @return \Laravel\Passport\Client
     */
    protected function generatePassportClient()
    {
        $client = Passport::client()->forceFill([
            'user_id' => null,
            'name' => "Ruhrtalent Password Grant Client",
            'secret' => Str::random(40),
            'provider' => self::$TABLE,
            'redirect' => config("app.url"),
            'personal_access_client' => 0,
            'password_client' => 1,
            'revoked' => false,
        ]);
        $client->save();
        return $client;
    }

    /**
     * Send Passport request to get user token
     * @param string $type
     * @return \Illuminate\Http\Client\Response
     */
    protected function sendPassportRequest(string $type)
    {
        //this is using because of php built-in single thread server
        $url = app()->environment() == "local" ? "http://127.0.0.1:9000/api/v1/token" : route("passport.token");

        return Http::withHeaders([
            'Accept' => 'application/json',
        ])->post($url, [
            "grant_type" => $type,
            "client_id" => self::$CLIENT_ID,
            "client_secret" => self::$CLIENT_SECRET,
            "username" => \request()->input("email"),
            //those 2 fields will send depend on giving grant type
            "password" => \request()->input("password"),
            "refresh_token" => \request()->input("refresh_token"),
        ]);
    }
}
