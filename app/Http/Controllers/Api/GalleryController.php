<?php

namespace App\Http\Controllers\Api;


use App\Http\Resources\Api\Gallery\GalleryJsonResource;
use App\Http\Resources\Api\Gallery\GalleryResource;
use App\Models\Gallery;
use Illuminate\Http\JsonResponse;

class GalleryController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $galleries = new GalleryResource(Gallery::query()->paginate(20));
        return $this->successResponse(["galleries" => $galleries]);
    }


    /**
     * Display the specified resource.
     *
     * @param Gallery $gallery
     * @return JsonResponse
     */
    public function show(Gallery $gallery)
    {
        $gallery->load("linkedFriends");
        request()->merge(["show" => true]);
        return $this->successResponse(["gallery" => new GalleryJsonResource($gallery)]);
    }


}
