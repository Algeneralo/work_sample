<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\General\GeneralJsonResource;
use App\Http\Resources\Api\General\GeneralResource;
use App\Models\General;
use Illuminate\Http\Request;

class GeneralController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $general = new GeneralResource(General::query()->paginate(10));
        return $this->successResponse(["general" => $general]);
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\General $general
     * @return \Illuminate\Http\Response
     */
    public function show(General $general)
    {
        \request()->merge(["show" => true]);
        $general = new GeneralJsonResource($general);
        return $this->successResponse(["general" => $general]);
    }


}
