<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\Podcast\PodcastJsonResource;
use App\Http\Resources\Api\Podcast\PodcastResource;
use App\Models\Podcast;
use Illuminate\Http\JsonResponse;

class PodcastController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $podcasts = new PodcastResource(Podcast::query()->paginate(100));
        return $this->successResponse(["podcasts" => $podcasts]);
    }

}
