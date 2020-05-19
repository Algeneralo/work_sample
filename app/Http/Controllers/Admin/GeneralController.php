<?php

namespace App\Http\Controllers\Admin;

use App\Models\General;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GeneralStoreRequest;
use App\Http\Requests\Admin\GeneralUpdateRequest;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GeneralController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $generals = General::all();

        return view('admin.bulletin-board.general.index', compact('generals'));
    }

    /**
     * @return Response
     */
    public function create()
    {
        return view('admin.bulletin-board.general.create');
    }

    /**
     * @param GeneralStoreRequest $request
     * @return Response
     */
    public function store(GeneralStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            /** @var General $general */
            $general = General::query()->create($request->all());
            $general->addMediaFromRequest("image")
                ->preservingOriginal()
                ->withResponsiveImages()
                ->toMediaCollection("cover");
        });

        session()->flash("success", trans("messages.success.created"));

        return redirect()->route('admin.bulletin-board.general.index');
    }

    /**
     * @param General $general
     * @return Response
     */
    public function edit(General $general)
    {
        return view('admin.bulletin-board.general.edit', compact('general'));
    }

    /**
     * @param GeneralUpdateRequest $request
     * @param General $general
     * @return Response
     */
    public function update(GeneralUpdateRequest $request, General $general)
    {
        DB::transaction(function () use ($request, $general) {
            $general->update($request->only($general->getFillable()));

            if ($request->hasFile("image")) {
                $general->clearMediaCollection("cover");
                $general->addMediaFromRequest("image")
                    ->preservingOriginal()
                    ->withResponsiveImages()
                    ->toMediaCollection("cover");
            }

        });

        session()->flash("success", trans("messages.success.updated"));

        return redirect()->back();
    }

    /**
     * @param General $general
     * @return Response
     * @throws Exception
     */
    public function destroy(General $general)
    {
        $general->delete();
        session()->flash("success", trans("messages.success.deleted"));

        return redirect()->route('admin.bulletin-board.general.index');
    }
}
