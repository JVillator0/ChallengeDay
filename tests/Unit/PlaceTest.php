<?php

namespace Tests\Feature;

use App\Models\Place;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlaceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();

        $token = $user->createToken('TestToken')->plainTextToken;

        $this->withHeader('Authorization', "Bearer $token");
    }

    /** @test */
    public function can_get_all_places()
    {
        Place::factory()->count(3)->create();

        $response = $this->get('/api/places');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /** @test */
    public function can_create_place()
    {
        $placeData = [
            'name' => 'Test place',
            'description' => 'Test place description',
            'address' => 'Test place address',
            'location_url' => 'https://www.google.com/maps',
        ];

        $response = $this->post('/api/places', $placeData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('places', $placeData);
    }

    /** @test */
    public function can_get_place_by_id()
    {
        $place = Place::factory()->create();

        $response = $this->get('/api/places/'.$place->id);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $place->name,
            'description' => $place->description,
        ]);
    }

    /** @test */
    public function can_update_place()
    {
        $place = Place::factory()->create();

        $placeData = [
            'name' => 'Updated name',
            'description' => 'Updated description',
            'address' => 'Updated address',
            'location_url' => 'https://www.google.com/maps',
        ];

        $response = $this->put('/api/places/'.$place->id, $placeData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('places', $placeData);
    }

    /** @test */
    public function can_delete_place()
    {
        $place = Place::factory()->create();

        $response = $this->delete('/api/places/'.$place->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('places', ['id' => $place->id, 'deleted_at' => null]);
    }
}
