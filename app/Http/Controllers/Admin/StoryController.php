<?php

namespace App\Http\Controllers\Admin;

use App\Models\Story;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoryStoreRequest;
use App\Http\Requests\Admin\StoryUpdateRequest;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return view('admin.media.stories.index');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        return view('admin.media.stories.create');
    }

    /**
     * @param StoryStoreRequest $request
     * @return Response
     */
    public function store(StoryStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            /** @var Story $story */
            $story = Story::create($request->all());
            $story->addMediaFromRequest("image")
                ->preservingOriginal()
                ->toMediaCollection("cover");

        });
        session()->flash("success", trans("messages.success.created"));

        return redirect()->route('admin.media.stories.index');
    }

    /**
     * @param Request $request
     * @param Story $story
     * @return Response
     */
    public function edit(Request $request, Story $story)
    {
        return view('admin.media.stories.edit', compact('story'));
    }

    /**
     * @param StoryUpdateRequest $request
     * @param Story $story
     * @return Response
     */
    public function update(StoryUpdateRequest $request, Story $story)
    {
        DB::transaction(function () use ($request, $story) {
            $story->update($request->only($story->getFillable()));

            if ($request->hasFile("image")) {
                $story->clearMediaCollection("cover")
                    ->addMediaFromRequest("image")
                    ->preservingOriginal()
                    ->toMediaCollection("cover");
            }

        });

        session()->flash("success", trans("messages.success.updated"));

        return redirect()->back();
    }
}
