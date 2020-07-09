<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\View\View;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\Admin\TopicStoreRequest;
use App\Models\Forum;
use App\Models\Topic;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Throwable;
use App\Http\Requests\Admin\TopicUpdateRequest;
use Illuminate\Contracts\Foundation\Application;

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
        DB::transaction(function () use ($request, $forum) {
            /** @var Topic $topic */
            $topic = $forum->topics()->create($request->all());
            if ($request->hasFile("image"))
                $topic->addMediaFromRequest("image")
                    ->preservingOriginal()
                    ->toMediaCollection("cover");
        });

        session()->flash("success", trans("messages.success.created"));

        return redirect()->route("admin.forum.show", $forum->id);
    }

    /**
     * @param Forum $forum
     * @param Topic $topic
     * @return Application|Factory|View
     */
    public function edit(Forum $forum, Topic $topic)
    {
        return view("admin.forum.topics.edit", compact("topic"));
    }

    /**
     * @param TopicUpdateRequest $request
     * @param Forum $forum
     * @param Topic $topic
     */
    public function update(TopicUpdateRequest $request, Forum $forum, Topic $topic)
    {
        DB::transaction(function () use ($request, $topic) {
            $topic->update($request->only($topic->getFillable()));
            if ($request->hasFile("image"))
                $topic->clearMediaCollection("cover")
                    ->addMediaFromRequest("image")
                    ->preservingOriginal()
                    ->toMediaCollection("cover");
        });
        session()->flash("success", trans("messages.success.updated"));

        return redirect()->back();
    }
}
