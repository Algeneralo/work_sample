<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Admin\TopicStoreRequest;
use App\Http\Resources\Api\Topic\TopicJsonResource;
use App\Http\Resources\Api\Topic\TopicResource;
use App\Models\ApiAuth;
use App\Models\Forum;
use App\Models\Topic;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class ForumTopicController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Forum $forum
     * @return JsonResponse
     */
    public function index(Forum $forum)
    {
        $topics = new TopicResource(
            Topic::search(request("search"))
                ->with("forum:id,posts_type")
                ->where("forum_id", $forum->id)
                ->orderByDesc("created_at")
                ->paginate(10)
        );
        return $this->successResponse(["topics" => $topics]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TopicStoreRequest $request
     * @param Forum $forum
     * @return void
     * @throws Throwable
     */
    public function store(TopicStoreRequest $request, Forum $forum)
    {
        abort_if((!auth()->user()->is_team_member && $forum->posts_type == Forum::POST_TYPES_ADMINS), Response::HTTP_FORBIDDEN);

        return DB::transaction(function () use ($request, $forum) {
            $request->merge(["forum_id" => $forum->id]);
            /** @var Topic $topic */
            $topic = Topic::query()->create($request->all());
            $topic->addMediaFromRequest("image")
                ->toMediaCollection("cover");
            if ($topic) {
                $topic->load("forum:id,posts_type");
                return $this->createResponse(["topic" => new TopicJsonResource($topic)]);
            }
            return $this->failResponse();
        });
    }

    public function toggleLike(Forum $forum, Topic $topic)
    {
        auth()->user()->toggleLike($topic);
        return $this->successResponse([
            "topic_id" => $topic->id,
            "is_liked" => auth()->user()->hasLiked($topic),
        ]);
    }
}
