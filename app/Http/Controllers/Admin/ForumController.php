<?php

namespace App\Http\Controllers\Admin;

use App\Models\Forum;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\ForumStoreRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Http\Requests\Admin\ForumUpdateRequest;

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

            if ($request->hasFile("image"))
                $forum->addMediaFromRequest("image")
                    ->preservingOriginal()
                    ->toMediaCollection("cover");
        });

        session()->flash("success", trans("messages.success.created"));

        return redirect()->route('admin.forum.index');
    }

    /**
     * @param \App\Models\forum $forum
     * @return view
     */
    public function show(Forum $forum)
    {
        return view('admin.forum.show', compact('forum'));
    }

    /**
     * @param Forum $forum
     * @return view
     */
    public function edit(Forum $forum)
    {
        return view("admin.forum.edit", compact("forum"));
    }

    /**
     * @param ForumUpdateRequest $request
     * @param Forum $forum
     * @return RedirectResponse
     * @throws Throwable
     */
    public function update(ForumUpdateRequest $request, Forum $forum)
    {
        DB::transaction(function () use ($request, $forum) {
            $forum->update($request->only($forum->getFillable()));
            if ($request->hasFile("image"))
                $forum->clearMediaCollection("cover")
                    ->addMediaFromRequest("image")
                    ->preservingOriginal()
                    ->toMediaCollection("cover");
        });
        session()->flash("success", trans("messages.success.updated"));
        return redirect()->back();
    }
}
