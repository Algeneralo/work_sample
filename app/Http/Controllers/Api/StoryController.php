<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\Story\StoryJsonResource;
use App\Http\Resources\Api\Story\StoryResource;
use App\Models\Story;
use Illuminate\Http\JsonResponse;

class StoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $podcasts = new StoryResource(Story::query()->latest()->paginate(100));
        return $this->successResponse(["stories" => $podcasts]);
    }

    public function show(Story $story)
    {
        request()->merge(["show"=>true]);
        $story = new StoryJsonResource($story);
        return $this->successResponse(["story" => $story]);
    }
}
