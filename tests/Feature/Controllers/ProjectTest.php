<?php

namespace Tests\Feature\Controllers;

use App\Events\ProjectCreatedEvent;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_project()
    {
        $this->actingAs(User::factory()->create());
        Event::fake();
        $response = $this->post(route('project.store'), [
                'name' => 'Project Name',
                'url'  => 'http://project.com',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('projects', [
                'name' => 'Project Name',
                'url'  => 'http://project.com',
        ]);

        Event::assertDispatched(ProjectCreatedEvent::class);

    }

    /** @test */
    public function it_can_lists_all_projects()
    {
        $this->actingAs($user = User::factory()->create());
        $project = Project::factory(3)->create([
                'user_id' => $user->id,
        ]);
        $notMine = Project::factory()->create();

        $response = $this->get(route('project.index'));

        $response->assertStatus(200);
        $response->assertJsonStructure([
                'data' => [
                        '*' => [
                                'id',
                                'name',
                                'url',
                                'created_at',
                                'updated_at',
                        ],
                ],
        ]);
        $response->assertJsonCount(3,'data');
    }
}