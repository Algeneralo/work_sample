<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EventReviewStoreRequest;
use App\Http\Resources\Api\Event\EventReviewsJsonResources;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventReviewController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param EventReviewStoreRequest $request
     * @param Event $event
     * @return JsonResponse
     */
    public function store(EventReviewStoreRequest $request, Event $event)
    {
        abort_if($event->reviews()->where("alumni_id", auth()->id())->exists(), Response::HTTP_FORBIDDEN);
        return \DB::transaction(function () use ($request, $event) {
            $request->merge(["alumni_id" => auth()->id()]);
            $review = $event->reviews()->create($request->all());
            return $this->createResponse(new EventReviewsJsonResources($review));
        });

    }


}
