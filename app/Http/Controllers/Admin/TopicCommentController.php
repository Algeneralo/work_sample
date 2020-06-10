<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Forum;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Forum $forum
     * @param \App\Models\Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function index(Forum $forum, Topic $topic)
    {
        $comments = $topic->comments()->with("alumnus:id,first_name,last_name")->paginate(1);
        return response()->json([
            "data" => $comments->items(),
            "hasNext" => $comments->hasMorePages()
        ]);
    }


}
