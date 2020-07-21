<?php

namespace App\Http\Controllers\Api\MyNetwork;

use App\Models\Experience;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\Alumni\AlumniResource;
use App\Models\Alumnus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Api\User\UserJsonResource;

class AlumniController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $alumni = new AlumniResource(Alumnus::search(\request("search"))
            ->where("id", "!=", auth()->id())
            ->when(\request("city"), function (Builder $query) {
                $query->where("city", "like", "%" . \request("city") . "%");
            })
            ->when(\request("alumni_year"), function (Builder $query) {
                $query->where("alumni_year", \request("alumni_year"));
            })
            ->when(\request("education_type") && in_array(\request("education_type"), ["education", "voluntary", "apprenticeship"]), function (Builder $query) {
                $query->whereHas("experiences", function (Builder $query) {
                    $query->where("type", request("education_type"));
                });
            })
            //search by university name
            ->when(request("university"), function (Builder $query) {
                $query->whereHas("experiences", function (Builder $query) {
                    $query->where("type", Experience::EDUCATION_EXPERIENCE)
                        ->where("place", "like", "%" . request("university") . "%");
                });
            })
            ->paginate(100));

        return $this->successResponse(["alumni" => $alumni]);
    }

    public function show(Alumnus $alumnus)
    {
        return $this->successResponse(["alumnus" => new UserJsonResource($alumnus)]);
    }
}
