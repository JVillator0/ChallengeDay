<?php

namespace Tests\Feature;

use App\Models\EmissionType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmissionTypeTest extends TestCase
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
    public function can_get_all_emission_types()
    {
        EmissionType::factory()->count(3)->create();

        $response = $this->get('/api/emissions-types');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /** @test */
    public function can_create_emission_type()
    {
        $emissiontypeData = [
            'name' => 'Test emissiontype',
            'description' => 'Test emissiontype description',
        ];

        $response = $this->post('/api/emissions-types', $emissiontypeData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('emission_types', $emissiontypeData);
    }

    /** @test */
    public function can_get_emission_type_by_id()
    {
        $emissiontype = EmissionType::factory()->create();

        $response = $this->get('/api/emissions-types/'.$emissiontype->id);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $emissiontype->name,
            'description' => $emissiontype->description,
        ]);
    }

    /** @test */
    public function can_update_emission_type()
    {
        $emissiontype = EmissionType::factory()->create();

        $emissiontypeData = [
            'name' => 'Updated name',
            'description' => 'Updated description',
        ];

        $response = $this->put('/api/emissions-types/'.$emissiontype->id, $emissiontypeData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('emission_types', $emissiontypeData);
    }

    /** @test */
    public function can_delete_emission_type()
    {
        $emissiontype = EmissionType::factory()->create();

        $response = $this->delete('/api/emissions-types/'.$emissiontype->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('emission_types', ['id' => $emissiontype->id]);
    }
}
