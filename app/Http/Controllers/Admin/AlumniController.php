<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alumnus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlumnusStoreRequest;
use App\Http\Requests\Admin\AlumnusUpdateRequest;
use App\Models\DegreeProgram;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumniController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.my-network.alumni.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $universities = University::all();
        $degreePrograms = DegreeProgram::all();
        return view('admin.my-network.alumni.create', compact("degreePrograms", "universities"));
    }

    /**
     * @param \App\Http\Requests\Admin\AlumnusStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlumnusStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $alumnus = Alumnus::create($request->all());
            $alumnus->addMediaFromRequest("image")
                ->preservingOriginal()
                ->withResponsiveImages()
                ->toMediaCollection("avatar");
        });
        session()->flash("success", trans("messages.success.created"));
        return redirect()->route('admin.my-network.alumni.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Alumnus $alumnus
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Alumnus $alumnus)
    {
        $universities = University::all();
        $degreePrograms = DegreeProgram::all();
        return view('admin.my-network.alumni.edit', compact("alumnus", "degreePrograms", "universities"));
    }

    /**
     * @param \App\Http\Requests\Admin\AlumnusUpdateRequest $request
     * @param \App\Models\Alumnus $alumnus
     * @return \Illuminate\Http\Response
     */
    public function update(AlumnusUpdateRequest $request, Alumnus $alumnus)
    {
        $alumnus->update($request->only($alumnus->getFillable()));
        if ($request->hasFile("image")) {
            //delete old avatar
            $alumnus->clearMediaCollection("avatar");

            $alumnus->addMediaFromRequest("image")
                ->preservingOriginal()
                ->withResponsiveImages()
                ->toMediaCollection("avatar");
        }
        session()->flash("success", trans("messages.success.updated"));

        return redirect()->back();
    }

    public function destroy(Alumnus $alumnus)
    {
        if ($alumnus->delete()) {
            session()->flash("success", trans("messages.success.deleted"));
            return redirect()->route('admin.my-network.alumni.index');
        }
        session()->flash("error", trans(trans("messages.error.title")));
        return redirect()->route('admin.my-network.alumni.index');
    }

    /**
     * Block/unblock alumnus
     * @param Alumnus $alumnus
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block(Alumnus $alumnus)
    {
        $blocked = $alumnus->blocked ^= 1;
        $status = $alumnus->update([
            "blocked" => "$blocked",
        ]);

        if ($status) {
            session()->flash("success", trans("messages.success.updated"));
            return redirect()->back();
        }

        session()->flash("error", trans(trans("messages.error.title")));
        return redirect()->route('admin.my-network.alumni.index');
    }
}
