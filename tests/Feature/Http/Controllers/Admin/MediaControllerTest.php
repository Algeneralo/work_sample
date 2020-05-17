<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Medium;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\MediaController
 */
class MediaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $media = factory(Media::class, 3)->create();

        $response = $this->get(route('medium.index'));

        $response->assertOk();
        $response->assertViewIs('medium.index');
        $response->assertViewHas('media');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('medium.create'));

        $response->assertOk();
        $response->assertViewIs('medium.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\MediaController::class,
            'store',
            \App\Http\Requests\Admin\MediaStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $medium = $this->faker->word;

        $response = $this->post(route('medium.store'), [
            'medium' => $medium,
        ]);

        $media = Medium::query()
            ->where('medium', $medium)
            ->get();
        $this->assertCount(1, $media);
        $medium = $media->first();

        $response->assertRedirect(route('medium.index'));
        $response->assertSessionHas('medium.id', $medium->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $medium = factory(Media::class)->create();

        $response = $this->get(route('medium.show', $medium));

        $response->assertOk();
        $response->assertViewIs('medium.show');
        $response->assertViewHas('medium');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $medium = factory(Media::class)->create();

        $response = $this->get(route('medium.edit', $medium));

        $response->assertOk();
        $response->assertViewIs('medium.edit');
        $response->assertViewHas('medium');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\MediaController::class,
            'update',
            \App\Http\Requests\Admin\MediaUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $medium = factory(Media::class)->create();
        $medium = $this->faker->word;

        $response = $this->put(route('medium.update', $medium), [
            'medium' => $medium,
        ]);

        $response->assertRedirect(route('medium.index'));
        $response->assertSessionHas('medium.id', $medium->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $medium = factory(Media::class)->create();
        $medium = factory(Medium::class)->create();

        $response = $this->delete(route('medium.destroy', $medium));

        $response->assertRedirect(route('medium.index'));

        $this->assertDeleted($medium);
    }
}
