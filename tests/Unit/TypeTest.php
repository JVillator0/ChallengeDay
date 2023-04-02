<?php

namespace Tests\Feature;

use App\Models\Type;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TypeTest extends TestCase
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
    public function can_get_all_types()
    {
        Type::factory()->count(3)->create();

        $response = $this->get('/api/types');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /** @test */
    public function can_create_type()
    {
        $typeData = [
            'name' => 'Test type',
            'description' => 'Test type description',
            'unit' => 'Test unit',
            'unit_abbreviation' => 'Test unit abbreviation',
        ];

        $response = $this->post('/api/types', $typeData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('types', $typeData);
    }

    /** @test */
    public function can_get_type_by_id()
    {
        $type = Type::factory()->create();

        $response = $this->get('/api/types/'.$type->id);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $type->name,
            'description' => $type->description,
        ]);
    }

    /** @test */
    public function can_update_type()
    {
        $type = Type::factory()->create();

        $typeData = [
            'name' => 'Updated name',
            'description' => 'Updated description',
            'unit' => 'Updated unit',
            'unit_abbreviation' => 'Updated unit abbreviation',
        ];

        $response = $this->put('/api/types/'.$type->id, $typeData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('types', $typeData);
    }

    /** @test */
    public function can_delete_type()
    {
        $type = Type::factory()->create();

        $response = $this->delete('/api/types/'.$type->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('types', ['id' => $type->id, 'deleted_at' => null]);
    }
}
