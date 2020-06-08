<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alumnus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlumnusStoreRequest;
use App\Http\Requests\Admin\AlumnusUpdateRequest;
use App\Models\DegreeProgram;
use App\Models\University;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AlumniController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        //this is using in media pages, gallery and podcast
        if (\request()->ajax()) {
            $alumni = Alumnus::search(\request("term"))->select(['id', "first_name", "last_name"])->paginate(20);
            return response()->json([
                "results" => collect($alumni->items())->map(function ($item) {
                    return [
                        "id" => $item->id,
                        "text" => $item->name
                    ];
                })->toArray(),
                "pagination" => [
                    "more" => $alumni->hasMorePages()
                ]
            ]);
        }
        return view('admin.my-network.alumni.index');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        $universities = University::all();
        $degreePrograms = DegreeProgram::all();
        return view('admin.my-network.alumni.create', compact("degreePrograms", "universities"));
    }

    /**
     * @param AlumnusStoreRequest $request
     * @return Response
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
     * @param Request $request
     * @param Alumnus $alumnus
     * @return Response
     */
    public function edit(Request $request, Alumnus $alumnus)
    {
        $universities = University::all();
        $degreePrograms = DegreeProgram::all();
        $alumnus->load("participatedEvents");
        return view('admin.my-network.alumni.edit', compact("alumnus", "degreePrograms", "universities"));
    }

    /**
     * @param AlumnusUpdateRequest $request
     * @param Alumnus $alumnus
     * @return Response
     */
    public function update(AlumnusUpdateRequest $request, Alumnus $alumnus)
    {
        if ($request->has("password") && $request->password == null)
            unset($request["password"]);

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
     * @return RedirectResponse
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
