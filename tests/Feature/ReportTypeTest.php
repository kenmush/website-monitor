<?php

namespace Tests\Feature;

use App\Events\ReportTypes\ReportTypeCreatedEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_report_type()
    {
        \Event::fake();

        $this->actingAs(User::factory()->create());

        $response = $this->post(route('report-types.store'), [
                'name' => 'SSL Report',
        ]);

        $this->assertDatabaseHas('report_types', [
                'name' => 'SSL Report',
        ]);

        \Event::assertDispatched(ReportTypeCreatedEvent::class);

        $response->assertStatus(201);

        $response->assertJsonStructure([
                'data' => [
                        'id',
                        'name',
                ],
        ]);

        $response = $this->post(route('report-types.store'), [
                'name' => 'SSL Report',
        ]);

        $response->assertSessionHasErrors(['name']);

    }
}