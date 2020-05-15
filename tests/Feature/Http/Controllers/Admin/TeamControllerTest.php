<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\TeamController
 */
class TeamControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $teams = factory(Team::class, 3)->create();

        $response = $this->get(route('team.index'));

        $response->assertOk();
        $response->assertViewIs('team.index');
        $response->assertViewHas('teams');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('team.create'));

        $response->assertOk();
        $response->assertViewIs('team.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\TeamController::class,
            'store',
            \App\Http\Requests\Admin\TeamStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $team = $this->faker->word;

        $response = $this->post(route('team.store'), [
            'team' => $team,
        ]);

        $teams = Team::query()
            ->where('team', $team)
            ->get();
        $this->assertCount(1, $teams);
        $team = $teams->first();

        $response->assertRedirect(route('team.index'));
        $response->assertSessionHas('team.id', $team->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $team = factory(Team::class)->create();

        $response = $this->get(route('team.show', $team));

        $response->assertOk();
        $response->assertViewIs('team.show');
        $response->assertViewHas('team');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $team = factory(Team::class)->create();

        $response = $this->get(route('team.edit', $team));

        $response->assertOk();
        $response->assertViewIs('team.edit');
        $response->assertViewHas('team');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\TeamController::class,
            'update',
            \App\Http\Requests\Admin\TeamUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $team = factory(Team::class)->create();
        $team = $this->faker->word;

        $response = $this->put(route('team.update', $team), [
            'team' => $team,
        ]);

        $response->assertRedirect(route('team.index'));
        $response->assertSessionHas('team.id', $team->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $team = factory(Team::class)->create();

        $response = $this->delete(route('team.destroy', $team));

        $response->assertRedirect(route('team.index'));

        $this->assertDeleted($team);
    }
}
