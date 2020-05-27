<?php

namespace App\Http\Controllers\Admin;

use App\Models\Offer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OfferStoreRequest;
use App\Http\Requests\Admin\OfferUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\Models\Media;

class OfferController extends Controller
{
    /**
     * @return Response
     */
    public function index()
    {

        return view('admin.bulletin-board.offer.index');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create()
    {
        return view('admin.bulletin-board.offer.create');
    }

    /**
     * @param OfferStoreRequest $request
     * @return Response
     */
    public function store(OfferStoreRequest $request)
    {
        \DB::transaction(function () use ($request) {
            /** @var Offer $offer */
            $offer = Offer::create($request->all());
            $offer->addMultipleMediaFromRequest(["image"])
                ->each(function ($fileAdder) {
                    $fileAdder
                        ->preservingOriginal()
                        ->withResponsiveImages()
                        ->toMediaCollection("images");
                });
        });

        session()->flash("success", trans("messages.success.updated"));

        return redirect()->route('admin.bulletin-board.offers.index');
    }


    /**
     * @param \App\Models\offer $offer
     * @return Response
     */
    public function edit(Offer $offer)
    {
        $offer->load("alumnus");
        return view('admin.bulletin-board.offer.edit', compact('offer'));
    }

    /**
     * @param OfferUpdateRequest $request
     * @param \App\Models\offer $offer
     * @return Response
     */
    public function update(OfferUpdateRequest $request, Offer $offer)
    {
        \DB::transaction(function () use ($request, $offer) {
            $offer->update($request->only($offer->getFillable()));
            if ($request->hasFile("image")) {
                $offer->clearMediaCollection("cover");
                $offer->addMultipleMediaFromRequest(["image"])
                    ->each(function ($fileAdder) {
                        $fileAdder->preservingOriginal()
                            ->withResponsiveImages()
                            ->toMediaCollection("images");
                    });
            }
        });

        session()->flash("success", trans("messages.success.updated"));

        return redirect()->back();
    }

    /**
     * @param \App\Models\offer $offer
     * @return Response
     * @throws \Exception
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();

        session()->flash("success", trans("messages.success.deleted"));

        return redirect()->route('admin.bulletin-board.offers.index');
    }

    public function imageDestroy(Media $image)
    {
        if ($image->delete())
            return \response()->json();
        return \response()->json([], 500);
    }
}
