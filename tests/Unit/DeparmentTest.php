<?php

namespace Tests\Feature;

use App\Models\Deparment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeparmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_all_deparments()
    {
        Deparment::factory()->count(3)->create();

        $response = $this->get('/api/deparments');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /** @test */
    public function can_create_deparment()
    {
        $deparmentData = [
            'name' => 'Test deparment',
            'description' => 'Test deparment description',
        ];

        $response = $this->post('/api/deparments', $deparmentData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('deparments', $deparmentData);
    }

    /** @test */
    public function can_get_deparment_by_id()
    {
        $deparment = Deparment::factory()->create();

        $response = $this->get('/api/deparments/'.$deparment->id);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $deparment->name,
            'description' => $deparment->description,
        ]);
    }

    /** @test */
    public function can_update_deparment()
    {
        $deparment = Deparment::factory()->create();

        $deparmentData = [
            'name' => 'Updated name',
            'description' => 'Updated description',
        ];

        $response = $this->put('/api/deparments/'.$deparment->id, $deparmentData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('deparments', $deparmentData);
    }

    /** @test */
    public function can_delete_deparment()
    {
        $deparment = Deparment::factory()->create();

        $response = $this->delete('/api/deparments/'.$deparment->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('deparments', ['id' => $deparment->id]);
    }
}
