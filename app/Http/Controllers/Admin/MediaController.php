<?php

namespace App\Http\Controllers\Admin;

use App\Models\Media;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MediaStoreRequest;
use App\Http\Requests\Admin\MediaUpdateRequest;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.media.index');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * @param \App\Http\Requests\Admin\MediaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaStoreRequest $request)
    {
        $medium = Media::create($request->all());

        $request->session()->flash('admin.media.id', $medium->id);

        return redirect()->route('admin.media.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param Media $medium
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Media $medium)
    {
        return view('admin.media.show', compact('admin.media'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Admin\admin.media $medium
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Media $medium)
    {
        return view('admin.media.edit', compact('admin.media'));
    }

    /**
     * @param \App\Http\Requests\Admin\MediaUpdateRequest $request
     * @param \App\Admin\admin.media $medium
     * @return \Illuminate\Http\Response
     */
    public function update(MediaUpdateRequest $request, Media $medium)
    {
        $medium->update([]);

        $request->session()->flash('admin.media.id', $medium->id);

        return redirect()->route('admin.media.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Admin\admin.media $medium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Media $medium)
    {
        $medium->delete();

        return redirect()->route('admin.media.index');
    }
}
