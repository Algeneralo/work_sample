<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Http\Livewire\Admin\MyNetwork\Alumni\Index;
use App\Models\Alumnus;
use App\Models\DegreeProgram;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\AlumniController
 */
class AlumniControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $alumni = factory(Alumnus::class)->create();

        $response = $this->get(route('admin.my-network.alumni.index'));

        $response->assertOk();
        $response->assertViewIs('admin.my-network.alumni.index');
        Livewire::test(Index::class)
            ->assertViewHas("alumni");
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('admin.my-network.alumni.create'));

        $response->assertOk();
        $response->assertViewIs('admin.my-network.alumni.create');
        $response->assertViewHas('universities');
        $response->assertViewHas('degreePrograms');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\AlumniController::class,
            'store',
            \App\Http\Requests\Admin\AlumnusStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $alumnus = factory(Alumnus::class)->create();

        $response = $this->post(route('admin.my-network.alumni.store'), $alumnus->toArray());

        $alumni = Alumnus::all();
        $this->assertCount(1, $alumni);
    }

    /**
     * @test
     */
    public function edit_displays_view()
    {
        $alumnus = factory(Alumni::class)->create();

        $response = $this->get(route('alumnus.edit', $alumnus));

        $response->assertOk();
        $response->assertViewIs('alumnus.edit');
        $response->assertViewHas('alumnus');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\AlumniController::class,
            'update',
            \App\Http\Requests\Admin\AlumniUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $alumnus = factory(Alumni::class)->create();
        $alumnus = $this->faker->word;

        $response = $this->put(route('alumnus.update', $alumnus), [
            'alumnus' => $alumnus,
        ]);

        $response->assertRedirect(route('alumnus.index'));
        $response->assertSessionHas('alumnus.id', $alumnus->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $alumnus = factory(Alumni::class)->create();
        $alumnus = factory(Alumnus::class)->create();

        $response = $this->delete(route('alumnus.destroy', $alumnus));

        $response->assertRedirect(route('alumnus.index'));

        $this->assertDeleted($alumnus);
    }
}
