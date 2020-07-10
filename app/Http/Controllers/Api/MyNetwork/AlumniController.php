<?php

namespace App\Http\Controllers\Api\MyNetwork;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\Alumni\AlumniResource;
use App\Models\Alumnus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AlumniController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function __invoke()
    {
        $alumni = new AlumniResource(Alumnus::search(\request("search"))
            ->where("id", "!=", auth()->id())
            ->when(\request("city"), function (Builder $query) {
                $query->where("city", "like", "%" . \request("city") . "%");
            })
            ->when(\request("alumni_year"), function (Builder $query) {
                $query->where("alumni_year", \request("alumni_year"));
            })
            ->when(\request("degree_program"), function (Builder $query) {
                $query->whereHas("degreeProgram", function (Builder $query) {
                    $query->where("name", "like", "%" . "" . "%");
                });
            })
            ->paginate(100));

        return $this->successResponse(["alumni" => $alumni]);
    }

}
