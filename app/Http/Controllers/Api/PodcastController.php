<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\Podcast\PodcastJsonResource;
use App\Http\Resources\Api\Podcast\PodcastResource;
use App\Models\Podcast;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use FFMpeg\FFMpeg;

class PodcastController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $podcasts = new PodcastResource(Podcast::query()->paginate(20));
        return $this->successResponse(["podcasts" => $podcasts]);
    }


    /**
     * Display the specified resource.
     *
     * @param Podcast $podcast
     * @return JsonResponse
     */
    public function show(Podcast $podcast)
    {
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => config('medialibrary.ffmpeg_path'),
            'ffprobe.binaries' => config('medialibrary.ffprobe_path'),
        ]);

        $video = $ffmpeg->open($file);
        $duration = $ffmpeg->getFFProbe()->format($file)->get('duration');
        dd($podcast->getFirstMedia("podcast")->getDuration());
        request()->merge(["show" => true]);
        return $this->successResponse(["gallery" => new PodcastJsonResource($podcast)]);
    }

}
