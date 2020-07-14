<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Requests\Api\ForumStoreRequest;
use App\Http\Resources\Api\Forum\ForumResource;
use App\Models\Forum;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Api\Forum\ForumJsonResource;

class ForumController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $forums = new ForumResource(
            Forum::search(request("search"))
                ->orderByDesc("created_at")
                ->paginate(100)
        );
        return $this->successResponse(["forums" => $forums]);
    }

    public function store(ForumStoreRequest $request)
    {
        return DB::transaction(function () use ($request) {
            /** @var Forum $forum */
            $forum = Forum::create($request->all());

            if ($request->hasFile("image"))
                $forum->addMediaFromRequest("image")
                    ->preservingOriginal()
                    ->toMediaCollection("cover");
            return $this->createResponse(["forum" => new ForumJsonResource($forum)]);
        });
    }
}
