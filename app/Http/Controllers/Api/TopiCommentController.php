<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Response;
use App\Http\Requests\Api\CommentStoreRequest;
use App\Http\Resources\Api\Comment\CommentJsonResource;
use App\Http\Resources\Api\Comment\CommentResource;
use App\Models\Comment;
use App\Models\Forum;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopiCommentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @param Forum $forum
     * @param Topic $topic
     * @return void
     */
    public function index(Forum $forum, Topic $topic)
    {
        $comments = new CommentResource(
            Comment::search(request("search"))
                ->where("topic_id", $topic->id)
                ->orderByDesc("created_at")
                ->with("alumnus")
                ->paginate(100)
        );
        return $this->successResponse(["comments" => $comments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CommentStoreRequest $request
     * @param Forum $forum
     * @param Topic $topic
     * @return void
     */
    public function store(CommentStoreRequest $request, Forum $forum, Topic $topic)
    {
        abort_if((!auth()->user()->is_team_member && $forum->posts_type == Forum::POST_TYPES_ADMINS), Response::HTTP_FORBIDDEN);
        return \DB::transaction(function () use ($request, $topic) {
            $comment = Comment::query()->create([
                "comment" => $request->comment,
                "topic_id" => $topic->id,
                "alumnus_id" => auth()->id(),
            ]);
            if ($comment)
                return $this->createResponse(["comment" => new CommentJsonResource($comment)]);
            return $this->failResponse();
        });
    }

    public function toggleLike(Forum $forum, Topic $topic, Comment $comment)
    {
        auth()->user()->toggleLike($comment);
        return $this->successResponse([
            "comment_id" => $comment->id,
            "is_liked" => auth()->user()->hasLiked($comment),
        ]);
    }
}
