<?php

namespace App\Http\Controllers\Admin;

use App\Models\Podcast;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PodcastStoreRequest;
use App\Http\Requests\Admin\PodcastUpdateRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PodcastController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        return view('admin.media.podcast.index');
    }

    /**
     * @return Response
     */
    public function create()
    {
        return view('admin.media.podcast.create');
    }

    /**
     * @param PodcastStoreRequest $request
     * @return Response
     * @throws \Throwable
     */
    public function store(PodcastStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            /** @var Podcast $podcast */
            $podcast = Podcast::query()->create($request->all());
            $podcast->addMediaFromRequest("image")
                ->preservingOriginal()
                ->withResponsiveImages()
                ->toMediaCollection("cover");

            $podcast->addMediaFromRequest("voice")
                ->preservingOriginal()
                ->toMediaCollection("podcast");

        });

        session()->flash("success", trans("messages.success.created"));

        return redirect()->route('admin.media.podcast.index');
    }

    /**
     * @param \App\Models\podcast $podcast
     * @return Response
     */
    public function edit(Podcast $podcast)
    {
        return view('admin.media.podcast.edit', compact('podcast'));
    }

    /**
     * @param PodcastUpdateRequest $request
     * @param \App\Models\podcast $podcast
     * @return Response
     */
    public function update(PodcastUpdateRequest $request, Podcast $podcast)
    {
        DB::transaction(function () use ($request, $podcast) {
            $podcast->update($request->only($podcast->getFillable()));
            if ($request->hasFile("image")) {
                $podcast->clearMediaCollection("cover");
                $podcast->addMediaFromRequest("image")
                    ->preservingOriginal()
                    ->withResponsiveImages()
                    ->toMediaCollection("cover");
            }

            if ($request->hasFile("voice")) {
                $podcast->clearMediaCollection("podcast");
                $podcast->addMediaFromRequest("voice")
                    ->preservingOriginal()
                    ->toMediaCollection("podcast");
            }

        });

        session()->flash("success", trans("messages.success.updated"));
        return redirect()->back();
    }

    /**
     * @param \App\Models\podcast $podcast
     * @return Response
     * @throws \Exception
     */
    public function destroy(Podcast $podcast)
    {
        $podcast->delete();

        return redirect()->route('podcast.index');
    }
}
