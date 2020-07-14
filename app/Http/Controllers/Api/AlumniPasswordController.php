<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\UpdateAlumniPasswordRequest;

class AlumniPasswordController extends ApiController
{

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlumniPasswordRequest $request)
    {
        if (auth()->user()->update(["password" => $request->password]))
            return $this->successResponse();
        return $this->failResponse();
    }
}