<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TopicStoreRequest;
use App\Models\Forum;
use App\Models\Topic;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Throwable;

class ForumTopicController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Forum $forum
     * @return Response
     */
    public function create(Forum $forum)
    {
        return view("admin.forum.topics.create", compact("forum"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TopicStoreRequest $request
     * @param Forum $forum
     * @return Response
     * @throws Throwable
     */
    public function store(TopicStoreRequest $request, Forum $forum)
    {
        \DB::transaction(function () use ($request, $forum) {
            /** @var Topic $topic */
            $topic = $forum->topics()->create($request->all());
            $topic->addMediaFromRequest("image")
                ->preservingOriginal()
                ->withResponsiveImages()
                ->toMediaCollection("cover");
        });

        session()->flash("success", trans("messages.success.created"));

        return redirect()->route("admin.forum.show", $forum->id);
    }

}
