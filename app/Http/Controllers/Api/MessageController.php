<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\MessageStoreRequest;
use App\Http\Resources\Api\Message\MessageJsonResource;
use App\Http\Resources\Api\Message\MessageResource;
use App\Models\ApiAuth;
use App\Models\CustomThread as Thread;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Models;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MessageController extends ApiController
{

    public function __construct()
    {
        Models::setUserModel(ApiAuth::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $conversations = new MessageResource(
            Thread::getAllLatest()
                ->forUSer(auth()->id())
                ->has("messages")
                ->paginate(100)
        );

        return $this->successResponse(["conversations" => $conversations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MessageStoreRequest $request
     * @return Response
     */
    public function store(MessageStoreRequest $request)
    {

        return \DB::transaction(function () use ($request) {
            request()->merge(["show" => true]);
            $receiver = $request->receiver_id;
            $thread = Thread::forUser(auth()->id())
                ->latest('updated_at')
                ->whereHas("users", function ($query) use ($receiver) {
                    $query->where("user_id", $receiver);
                })->firstOr(function () use ($receiver) {
                    return Thread::createThread($receiver);
                });
            Message::create([
                'thread_id' => $thread->id,
                'user_id' => auth()->id(),
                'body' => $request->message,
            ]);
            if ($thread)
                return $this->createResponse([
                    "conversation" => new MessageJsonResource($thread)
                ]);
            return $this->failResponse();
        });
    }

    /**
     * Display the specified resource.
     *
     * @param Thread $thread
     * @return JsonResponse
     */
    public function show(Thread $thread)
    {
        \request()->merge(["show" => true]);
        return $this->successResponse([
            "conversation" => new MessageJsonResource($thread)
        ]);
    }
}
