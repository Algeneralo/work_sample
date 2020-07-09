<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Api\Forum\ForumResource;
use App\Models\Forum;
use Illuminate\Http\JsonResponse;

class ForumController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $forums = new ForumResource(
            Forum::search(request("search"))
                ->orderByDesc("created_at")
                ->paginate(100)
        );
        return $this->successResponse(["forums" => $forums]);
    }
}
