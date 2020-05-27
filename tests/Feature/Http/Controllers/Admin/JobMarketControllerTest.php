<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\JobMarket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\JobMarketController
 */
class JobMarketControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $jobMarkets = factory(JobMarket::class, 3)->create();

        $response = $this->get(route('job-market.index'));

        $response->assertOk();
        $response->assertViewIs('jobMarket.index');
        $response->assertViewHas('jobMarkets');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('job-market.create'));

        $response->assertOk();
        $response->assertViewIs('jobMarket.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\JobMarketController::class,
            'store',
            \App\Http\Requests\Admin\JobMarketStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $jobMarket = $this->faker->word;

        $response = $this->post(route('job-market.store'), [
            'jobMarket' => $jobMarket,
        ]);

        $jobMarkets = JobMarket::query()
            ->where('jobMarket', $jobMarket)
            ->get();
        $this->assertCount(1, $jobMarkets);
        $jobMarket = $jobMarkets->first();

        $response->assertRedirect(route('jobMarket.index'));
        $response->assertSessionHas('jobMarket.id', $jobMarket->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $jobMarket = factory(JobMarket::class)->create();

        $response = $this->get(route('job-market.show', $jobMarket));

        $response->assertOk();
        $response->assertViewIs('jobMarket.show');
        $response->assertViewHas('jobMarket');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $jobMarket = factory(JobMarket::class)->create();

        $response = $this->get(route('job-market.edit', $jobMarket));

        $response->assertOk();
        $response->assertViewIs('jobMarket.edit');
        $response->assertViewHas('jobMarket');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\JobMarketController::class,
            'update',
            \App\Http\Requests\Admin\JobMarketUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $jobMarket = factory(JobMarket::class)->create();
        $jobMarket = $this->faker->word;

        $response = $this->put(route('job-market.update', $jobMarket), [
            'jobMarket' => $jobMarket,
        ]);

        $response->assertRedirect(route('jobMarket.index'));
        $response->assertSessionHas('jobMarket.id', $jobMarket->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $jobMarket = factory(JobMarket::class)->create();

        $response = $this->delete(route('job-market.destroy', $jobMarket));

        $response->assertRedirect(route('jobMarket.index'));

        $this->assertDeleted($jobMarket);
    }
}
