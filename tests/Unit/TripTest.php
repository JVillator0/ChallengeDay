<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Deparment;
use App\Models\EmissionType;
use App\Models\Trip;
use App\Models\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TripTest extends TestCase
{
    use RefreshDatabase;

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
        $deparment = Deparment::factory()->create();
        $emissionType = EmissionType::factory()->create();

        $tripData = [
            'deparment_id' => $deparment->id,
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

        // $response->assertJsonFragment([
        //     "status" => "success",
        //     "message" => "Viaje listado correctamente",
        //     'data' => [
        //         'id' => $trip->id,
        //         'department' => [
        //             'id' => $trip->deparment->id,
        //             'name' => $trip->deparment->name,
        //             'description' => $trip->deparment->description,
        //         ],
        //         'emission_type' => [
        //             'id' => $trip->emissionType->id,
        //             'name' => $trip->emissionType->name,
        //             'description' => $trip->emissionType->description,
        //         ],
        //         'trip_date' => $trip->trip_date->format('Y-m-d'),
        //     ],
        // ]);

        $response->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'id',
                'department',
                'emission_type',
                'trip_date',
            ],
        ]);
    }

    /** @test */
    public function can_update_trip()
    {
        $trip = Trip::factory()->create();

        $deparment = Deparment::factory()->create();
        $emissionType = EmissionType::factory()->create();

        $tripData = [
            'deparment_id' => $deparment->id,
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
        $this->assertDatabaseMissing('trips', ['id' => $trip->id]);
    }
}
