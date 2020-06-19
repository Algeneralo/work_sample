<?php

namespace App\Http\Controllers\Api\MyNetwork;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\Message\MessageJsonResource;
use App\Models\Alumnus;
use App\Models\ApiAuth;
use App\Models\CustomThread as Thread;
use Cmgmyr\Messenger\Models\Models;
use Illuminate\Http\JsonResponse;

class AlumniConversationController extends ApiController
{

    /**
     * Display the specified resource.
     *
     * @param Alumnus $alumnus
     * @return JsonResponse
     */
    public function show(Alumnus $alumnus)
    {
        Models::setUserModel(ApiAuth::class);

        request()->merge(["show" => true]);
        $thread = Thread::getUserFirstThread($alumnus->id);
        return $this->successResponse([
            "conversation" => new MessageJsonResource($thread)
        ]);
    }

}
