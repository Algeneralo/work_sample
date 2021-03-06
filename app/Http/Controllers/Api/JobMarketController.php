<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\JobMarket\JobMarketJsonResource;
use App\Http\Resources\Api\JobMarket\JobMarketResource;
use App\Models\JobMarket;
use Illuminate\Http\JsonResponse;

class JobMarketController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $jobs = new JobMarketResource(
            JobMarket::query()
                ->orderByDesc("created_at")
                ->with("contact")
                ->paginate(100)
        );
        return $this->successResponse(["jobs" => $jobs]);
    }

    /**
     * Display the specified resource.
     *
     * @param JobMarket $jobMarket
     * @return void
     */
    public function show(JobMarket $jobMarket)
    {
        request()->merge(["show" => true]);
        $jobMarket->load("contact");
        $jobMarket = new JobMarketJsonResource($jobMarket);
        return $this->successResponse(["job" => $jobMarket]);
    }

}
