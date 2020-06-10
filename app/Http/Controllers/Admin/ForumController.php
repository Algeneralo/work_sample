<?php

namespace App\Http\Controllers\Admin;

use App\Models\Forum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ForumStoreRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;

class ForumController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return view('admin.forum.index');
    }

    /**
     * @return Response
     */
    public function create()
    {
        return view('admin.forum.create');
    }

    /**
     * @param ForumStoreRequest $request
     * @return Response
     * @throws Throwable
     */
    public function store(ForumStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            /** @var Forum $forum */
            $forum = Forum::create($request->all());
            $forum->addMediaFromRequest("image")
                ->preservingOriginal()
                ->withResponsiveImages()
                ->toMediaCollection("cover");
        });

        session()->flash("success", trans("messages.success.created"));

        return redirect()->route('admin.forum.index');
    }

    /**
     * @param \App\Models\forum $forum
     * @return Response
     */
    public function show(Forum $forum)
    {
        return view('admin.forum.show', compact('forum'));
    }

}
