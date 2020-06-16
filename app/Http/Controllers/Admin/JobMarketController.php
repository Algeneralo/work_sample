<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\JobMarket;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobMarketStoreRequest;
use App\Http\Requests\Admin\JobMarketUpdateRequest;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobMarketController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {
        $jobMarkets = JobMarket::all();

        return view('admin.bulletin-board.job-market.index', compact('jobMarkets'));
    }

    /**
     * @return Response
     */
    public function create()
    {
        return view('admin.bulletin-board.job-market.create');
    }

    /**
     * @param JobMarketStoreRequest $request
     * @return Response
     */
    public function store(JobMarketStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            /** @var JobMarket $jobMarket */
            $jobMarket = JobMarket::create($request->all());
            $jobMarket->contact()->create($request->merge(["name" => $request->contact_name])->toArray());
            $jobMarket->addMediaFromRequest("image")
                ->preservingOriginal()
                ->toMediaCollection("cover");
        });

        session()->flash("success", trans("messages.success.created"));

        return redirect()->route('admin.bulletin-board.job-market.index');
    }

    /**
     * @param \App\Models\jobMarket $jobMarket
     * @return Response
     */
    public function edit(JobMarket $jobMarket)
    {
        $jobMarket->load("contact");
        return view('admin.bulletin-board.job-market.edit', compact('jobMarket'));
    }

    /**
     * @param JobMarketUpdateRequest $request
     * @param \App\Models\jobMarket $jobMarket
     * @return Response
     */
    public function update(JobMarketUpdateRequest $request, JobMarket $jobMarket)
    {
        DB::transaction(function () use ($request, $jobMarket) {
            $jobMarket->update($request->only($jobMarket->getFillable()));

            $jobMarket->contact()->updateOrCreate(
                ["job_market_id" => $jobMarket->id],
                $request->merge(["name" => $request->contact_name])->only(["name", "company_name", "email", "telephone"])
            );

            if ($request->hasFile("image")) {
                $jobMarket->clearMediaCollection("cover");
                $jobMarket->addMediaFromRequest("image")
                    ->preservingOriginal()
                    ->toMediaCollection("cover");
            }
        });

        session()->flash("success", trans("messages.success.updated"));

        return redirect()->back();
    }

    /**
     * @param \App\Models\jobMarket $jobMarket
     * @return Response
     * @throws Exception
     */
    public function destroy(JobMarket $jobMarket)
    {
        $jobMarket->delete();
        session()->flash("success", trans("messages.success.deleted"));

        return redirect()->route('admin.bulletin-board.job-market.index');
    }
}
