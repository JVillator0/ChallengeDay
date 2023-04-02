<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\EmissionType;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TripTest extends TestCase
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
    public function can_get_all_trips()
    {
        Trip::factory()->count(3)->create();

        $response = $this->get('/api/trips');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /** @test */
    public function can_create_trip()
    {
        $department = Department::factory()->create();
        $emissionType = EmissionType::factory()->create();

        $tripData = [
            'department_id' => $department->id,
            'emission_type_id' => $emissionType->id,
            'trip_date' => '2021-01-01',
        ];

        $response = $this->post('/api/trips', $tripData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('trips', $tripData);
    }

    /** @test */
    public function can_get_trip_by_id()
    {
        $trip = Trip::factory()->create();

        $response = $this->get('/api/trips/'.$trip->id);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            "status" => "success",
            "message" => "Viaje listado correctamente",
            'data' => [
                'id' => $trip->id,
                'department' => [
                    'id' => $trip->department->id,
                    'name' => $trip->department->name,
                    'description' => $trip->department->description,
                ],
                'emission_type' => [
                    'id' => $trip->emissionType->id,
                    'name' => $trip->emissionType->name,
                    'description' => $trip->emissionType->description,
                ],
                'trip_date' => $trip->trip_date->format('Y-m-d'),
            ],
        ]);
    }

    /** @test */
    public function can_update_trip()
    {
        $trip = Trip::factory()->create();

        $department = Department::factory()->create();
        $emissionType = EmissionType::factory()->create();

        $tripData = [
            'department_id' => $department->id,
            'emission_type_id' => $emissionType->id,
            'trip_date' => '2021-01-01',
        ];

        $response = $this->put('/api/trips/'.$trip->id, $tripData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('trips', $tripData);
    }

    /** @test */
    public function can_delete_trip()
    {
        $trip = Trip::factory()->create();

        $response = $this->delete('/api/trips/'.$trip->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('trips', ['id' => $trip->id, 'deleted_at' => null]);
    }
}
