<?php

namespace App\Http\Controllers\Api\MyNetwork;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Api\Alumni\AlumniResource;
use App\Http\Resources\Api\Team\TeamResource;
use App\Models\Alumnus;
use App\Models\Team;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function __invoke()
    {
        $team = new TeamResource(Team::query()->paginate(10));

        return $this->successResponse(["team" => $team]);
    }

}
