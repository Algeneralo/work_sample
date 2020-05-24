<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alumnus;
use App\Models\Gallery;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryStoreRequest;
use App\Http\Requests\Admin\GalleryUpdateRequest;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GalleryController extends Controller
{
    public function index()
    {
        return view('admin.media.gallery.index');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $alumni = Alumnus::query()->select(["id", "first_name", "last_name"])->get();
        return view('admin.media.gallery.create', compact("alumni"));
    }

    /**
     * @param GalleryStoreRequest $request
     * @return Response
     */
    public function store(GalleryStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            /** @var Gallery $gallery */
            $gallery = Gallery::query()->create($request->all());
            if ($request->linkedFriends)
                $gallery->linkedFriends()->sync($request->linkedFriends);
            $gallery->addMediaFromRequest("image")
                ->preservingOriginal()
                ->withResponsiveImages()
                ->toMediaCollection("cover");
        });

        session()->flash("success", trans("messages.success.created"));

        return redirect()->route('admin.media.gallery.index');
    }

    /**
     * @param \App\Models\gallery $gallery
     * @return Response
     */
    public function edit(Gallery $gallery)
    {
        $gallery->load("linkedFriends");
        return view('admin.media.gallery.edit', compact('gallery'));
    }

    /**
     * @param GalleryUpdateRequest $request
     * @param \App\Models\gallery $gallery
     * @return Response
     */
    public function update(GalleryUpdateRequest $request, Gallery $gallery)
    {
        DB::transaction(function () use ($request, $gallery) {
            $gallery->update($request->only($gallery->getFillable()));
            if ($request->linkedFriends)
                $gallery->linkedFriends()->sync($request->linkedFriends);
            if ($request->hasFile("image")) {
                $gallery->clearMediaCollection("cover");
                $gallery->addMediaFromRequest("image")
                    ->preservingOriginal()
                    ->withResponsiveImages()
                    ->toMediaCollection("cover");
            }
        });
        session()->flash("success", trans("messages.success.updated"));
        return redirect()->back();

    }

    /**
     * @param Request $request
     * @param Gallery $gallery
     * @return Response
     * @throws Exception
     */
    public function destroy(Request $request, Gallery $gallery)
    {
        $gallery->delete();
        session()->flash("success", trans("messages.success.deleted"));

        return redirect()->route('admin.media.gallery.index');
    }
}
