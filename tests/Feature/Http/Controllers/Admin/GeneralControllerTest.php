<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\General;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\GeneralController
 */
class GeneralControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $generals = factory(General::class, 3)->create();

        $response = $this->get(route('general.index'));

        $response->assertOk();
        $response->assertViewIs('general.index');
        $response->assertViewHas('generals');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('general.create'));

        $response->assertOk();
        $response->assertViewIs('general.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\GeneralController::class,
            'store',
            \App\Http\Requests\Admin\GeneralStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $general = $this->faker->word;

        $response = $this->post(route('general.store'), [
            'general' => $general,
        ]);

        $generals = General::query()
            ->where('general', $general)
            ->get();
        $this->assertCount(1, $generals);
        $general = $generals->first();

        $response->assertRedirect(route('general.index'));
        $response->assertSessionHas('general.id', $general->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $general = factory(General::class)->create();

        $response = $this->get(route('general.show', $general));

        $response->assertOk();
        $response->assertViewIs('general.show');
        $response->assertViewHas('general');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $general = factory(General::class)->create();

        $response = $this->get(route('general.edit', $general));

        $response->assertOk();
        $response->assertViewIs('general.edit');
        $response->assertViewHas('general');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\GeneralController::class,
            'update',
            \App\Http\Requests\Admin\GeneralUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $general = factory(General::class)->create();
        $general = $this->faker->word;

        $response = $this->put(route('general.update', $general), [
            'general' => $general,
        ]);

        $response->assertRedirect(route('general.index'));
        $response->assertSessionHas('general.id', $general->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $general = factory(General::class)->create();

        $response = $this->delete(route('general.destroy', $general));

        $response->assertRedirect(route('general.index'));

        $this->assertDeleted($general);
    }
}
