<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Podcast;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\PodcastController
 */
class PodcastControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $podcasts = factory(Podcast::class, 3)->create();

        $response = $this->get(route('podcast.index'));

        $response->assertOk();
        $response->assertViewIs('podcast.index');
        $response->assertViewHas('podcasts');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('podcast.create'));

        $response->assertOk();
        $response->assertViewIs('podcast.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\PodcastController::class,
            'store',
            \App\Http\Requests\Admin\PodcastStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $podcast = $this->faker->word;

        $response = $this->post(route('podcast.store'), [
            'podcast' => $podcast,
        ]);

        $podcasts = Podcast::query()
            ->where('podcast', $podcast)
            ->get();
        $this->assertCount(1, $podcasts);
        $podcast = $podcasts->first();

        $response->assertRedirect(route('podcast.index'));
        $response->assertSessionHas('podcast.id', $podcast->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $podcast = factory(Podcast::class)->create();

        $response = $this->get(route('podcast.show', $podcast));

        $response->assertOk();
        $response->assertViewIs('podcast.show');
        $response->assertViewHas('podcast');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $podcast = factory(Podcast::class)->create();

        $response = $this->get(route('podcast.edit', $podcast));

        $response->assertOk();
        $response->assertViewIs('podcast.edit');
        $response->assertViewHas('podcast');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\PodcastController::class,
            'update',
            \App\Http\Requests\Admin\PodcastUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $podcast = factory(Podcast::class)->create();
        $podcast = $this->faker->word;

        $response = $this->put(route('podcast.update', $podcast), [
            'podcast' => $podcast,
        ]);

        $response->assertRedirect(route('podcast.index'));
        $response->assertSessionHas('podcast.id', $podcast->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $podcast = factory(Podcast::class)->create();

        $response = $this->delete(route('podcast.destroy', $podcast));

        $response->assertRedirect(route('podcast.index'));

        $this->assertDeleted($podcast);
    }
}
