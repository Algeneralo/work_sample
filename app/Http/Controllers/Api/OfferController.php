<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\OfferStoreRequest;
use App\Http\Resources\Api\Offer\OfferJsonResource;
use App\Http\Resources\Api\Offer\OfferResource;
use App\Models\Offer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OfferController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $offers = new OfferResource(
            Offer::query()
                ->orderByDesc("created_at")
                ->when(\request("type"), function ($query) {
                    $query->where("type", \request("type"));
                })
                ->paginate(100)
        );
        return $this->successResponse(["offers" => $offers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OfferStoreRequest $request
     * @return void
     */
    public function store(OfferStoreRequest $request)
    {
        return \DB::transaction(function () use ($request) {
            $request->merge(["alumni_id" => auth()->id()]);
            /** @var Offer $offer */
            $offer = Offer::query()->create($request->all());
            $offer->addMultipleMediaFromRequest(["image"])
                ->each(function ($fileAdder) {
                    $fileAdder->preservingOriginal()
                        ->toMediaCollection("images");
                });
            return $this->createResponse(["offer" => collect($offer)->except("media", "updated_at", "created_at")]);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param Offer $offer
     * @return Response
     */
    public function show(Offer $offer)
    {
        \request()->merge(["show" => true]);
        $offer = new OfferJsonResource($offer);
        return $this->successResponse(["offer" => $offer]);
    }

}
