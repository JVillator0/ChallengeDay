<?php

namespace Tests\Feature;

use App\Models\CategoryType;
use App\Models\Consumption;
use App\Models\Department;
use App\Models\EmissionType;
use App\Models\Place;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConsumptionTest extends TestCase
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
    public function can_get_all_consumptions()
    {
        Consumption::factory()->count(3)->create();

        $response = $this->get('/api/consumptions');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /** @test */
    public function can_create_consumption()
    {
        $categoryType = CategoryType::factory()->create();
        $emissionType = EmissionType::factory()->create();
        $place = Place::factory()->create();

        $consumptionData = [
            'amount' => 10.00,
            'category_type_id' => $categoryType->id,
            'emission_type_id' => $emissionType->id,
            'place_id' => $place->id,
        ];

        $response = $this->post('/api/consumptions', $consumptionData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('consumptions', $consumptionData);
    }

    /** @test */
    public function can_get_consumption_by_id()
    {
        $consumption = Consumption::factory()->create();

        $response = $this->get('/api/consumptions/'.$consumption->id);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            "status" => "success",
            "message" => "Consumo",
            'data' => [
                'id' => $consumption->id,
                'amount' => $consumption->amount,
                'category_type' => [
                    'id' => $consumption->categoryType->id,
                    'category' => [
                        'id' => $consumption->categoryType->category->id,
                        'name' => $consumption->categoryType->category->name,
                        'description' => $consumption->categoryType->category->description,
                    ],
                    'type' => [
                        'id' => $consumption->categoryType->type->id,
                        'name' => $consumption->categoryType->type->name,
                        'description' => $consumption->categoryType->type->description,
                        'unit' => $consumption->categoryType->type->unit,
                        'unit_abbreviation' => $consumption->categoryType->type->unit_abbreviation,
                    ],
                ],
                'emission_type' => [
                    'id' => $consumption->emissionType->id,
                    'name' => $consumption->emissionType->name,
                    'description' => $consumption->emissionType->description,
                ],
                'place' => [
                    'id' => $consumption->place->id,
                    'name' => $consumption->place->name,
                    'description' => $consumption->place->description,
                    'address' => $consumption->place->address,
                    'location_url' => $consumption->place->location_url,
                ],
                'created_at' => $consumption->created_at->format('Y-m-d H:i:s'),
                'last_update' => $consumption->updated_at->format('Y-m-d H:i:s'),
            ],
        ]);
    }

    /** @test */
    public function can_update_consumption()
    {
        $consumption = Consumption::factory()->create();

        $categoryType = CategoryType::factory()->create();
        $emissionType = EmissionType::factory()->create();
        $place = Place::factory()->create();

        $consumptionData = [
            'amount' => 20.00,
            'category_type_id' => $categoryType->id,
            'emission_type_id' => $emissionType->id,
            'place_id' => $place->id,
        ];

        $response = $this->put('/api/consumptions/'.$consumption->id, $consumptionData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('consumptions', $consumptionData);
    }

    /** @test */
    public function can_delete_consumption()
    {
        $consumption = Consumption::factory()->create();

        $response = $this->delete('/api/consumptions/'.$consumption->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('consumptions', ['id' => $consumption->id, 'deleted_at' => null]);
    }
}
