<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Offer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\OfferController
 */
class OfferControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $offers = factory(Offer::class, 3)->create();

        $response = $this->get(route('offer.index'));

        $response->assertOk();
        $response->assertViewIs('offer.index');
        $response->assertViewHas('offers');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('offer.create'));

        $response->assertOk();
        $response->assertViewIs('offer.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\OfferController::class,
            'store',
            \App\Http\Requests\Admin\OfferStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $offer = $this->faker->word;

        $response = $this->post(route('offer.store'), [
            'offer' => $offer,
        ]);

        $offers = Offer::query()
            ->where('offer', $offer)
            ->get();
        $this->assertCount(1, $offers);
        $offer = $offers->first();

        $response->assertRedirect(route('offer.index'));
        $response->assertSessionHas('offer.id', $offer->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $offer = factory(Offer::class)->create();

        $response = $this->get(route('offer.show', $offer));

        $response->assertOk();
        $response->assertViewIs('offer.show');
        $response->assertViewHas('offer');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $offer = factory(Offer::class)->create();

        $response = $this->get(route('offer.edit', $offer));

        $response->assertOk();
        $response->assertViewIs('offer.edit');
        $response->assertViewHas('offer');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\OfferController::class,
            'update',
            \App\Http\Requests\Admin\OfferUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $offer = factory(Offer::class)->create();
        $offer = $this->faker->word;

        $response = $this->put(route('offer.update', $offer), [
            'offer' => $offer,
        ]);

        $response->assertRedirect(route('offer.index'));
        $response->assertSessionHas('offer.id', $offer->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $offer = factory(Offer::class)->create();

        $response = $this->delete(route('offer.destroy', $offer));

        $response->assertRedirect(route('offer.index'));

        $this->assertDeleted($offer);
    }
}
