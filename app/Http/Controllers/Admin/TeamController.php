<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeamStoreRequest;
use App\Http\Requests\Admin\TeamUpdateRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return view('admin.my-network.team.index', compact("teams"));
    }

    /**
     * @return Response
     */
    public function create()
    {
        return view('admin.my-network.team.create');
    }

    /**
     * @param TeamStoreRequest $request
     * @return Response
     * @throws Throwable
     */
    public function store(TeamStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $team = Team::create($request->all());
            $team->addMediaFromRequest("image")
                ->preservingOriginal()
                ->toMediaCollection("avatar");
        });
        session()->flash("success", trans("messages.success.created"));
        return redirect()->route('admin.my-network.teams.index');
    }

    /**
     * @param Team $team
     * @return Response
     */
    public function edit(Team $team)
    {
        return view('admin.my-network.team.edit', compact("team"));
    }

    /**
     * @param TeamUpdateRequest $request
     * @param Team $team
     * @return Response
     */
    public function update(TeamUpdateRequest $request, Team $team)
    {
        if ($request->has("password") && $request->password == null)
            unset($request["password"]);
        $team->update($request->only($team->getFillable()));
        if ($request->hasFile("image")) {
            //delete old avatar
            $team->clearMediaCollection("avatar");

            $team->addMediaFromRequest("image")
                ->preservingOriginal()
                ->toMediaCollection("avatar");
        }
        session()->flash("success", trans("messages.success.updated"));

        return redirect()->back();
    }

    public function destroy(Team $team)
    {
        if ($team->delete()) {
            session()->flash("success", trans("messages.success.deleted"));
            return redirect()->route('admin.my-network.teams.index');
        }
        session()->flash("error", trans(trans("messages.error.title")));
        return redirect()->route('admin.my-network.teams.index');
    }

    public function block(Team $team)
    {
        $blocked = $team->blocked ^= 1;
        $status = $team->update([
            "blocked" => "$blocked",
        ]);

        if ($status) {
            session()->flash("success", trans("messages.success.updated"));
            return redirect()->back();
        }

        session()->flash("error", trans(trans("messages.error.title")));
        return redirect()->route('admin.my-network.teams.index');
    }
}
