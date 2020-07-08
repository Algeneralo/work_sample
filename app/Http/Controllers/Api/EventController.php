<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Category;
use App\Http\Requests\Api\EventStoreRequest;
use App\Http\Resources\Api\Event\EventJsonResource;
use App\Http\Resources\Api\Event\EventResource;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;

class EventController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $events = new EventResource(
            Event::query()
                ->internal()
                ->when(request()->has("userEvents"), function (Builder $query) {
                    $query->whereHas("participants", function (Builder $query) {
                        $query->where("alumnus_id", auth()->id());
                        //if request has period parameter, get the event depend on it
                    })->when(request()->has("period"), function (Builder $query) {

                        $query->when(request("period") == "past", function (Builder $query) {
                            $query->whereDate("date", "<", Carbon::now()->toDateString());
                        })->when(request("period") == "future", function (Builder $query) {
                            $query->whereDate("date", ">=", Carbon::now()->toDateString());
                        });
                    });
                })
                ->when(request()->has("lastChanged"), function (Builder $query) {
                    $query->orderBy("updated_at", request("direction") ?? "desc");
                }, function (Builder $query) {
                    $query->orderBy("date", request("direction") ?? "desc");
                })
                ->paginate(10)
        );
        return $this->successResponse(["events" => $events]);
    }

    public function create()
    {
        return $this->successResponse([
            "categories" => Category::query()->select(["id", "name"])->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventStoreRequest $request
     * @return Response
     * @throws Throwable
     */
    public function store(EventStoreRequest $request)
    {
        return DB::transaction(function () use ($request) {
            /** @var Event $event */
            $event = Event::query()->create($request->all());
            $event->addMediaFromRequest("image")
                ->preservingOriginal()
                ->toMediaCollection("cover");
            return $this->createResponse([
                "event" => new EventJsonResource($event),
            ]);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return JsonResponse
     */
    public function show(Event $event)
    {
        abort_if($event->type == Event::EXTERNAL_EVENTS, Response::HTTP_FORBIDDEN);
        request()->merge(["show" => true]);
        $event = new EventJsonResource($event);
        return $this->successResponse(["event" => $event]);
    }

}
