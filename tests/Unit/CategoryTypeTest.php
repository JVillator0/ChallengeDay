<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\CategoryType;
use App\Models\Type;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTypeTest extends TestCase
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
    public function can_get_all_category_types()
    {
        CategoryType::factory()->count(3)->create();

        $response = $this->get('/api/category-types');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /** @test */
    public function can_create_category_type()
    {
        $category = Category::factory()->create();
        $type = Type::factory()->create();

        $categoryTypeData = [
            'category_id' => $category->id,
            'type_id' => $type->id,
        ];

        $response = $this->post('/api/category-types', $categoryTypeData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('category_types', $categoryTypeData);
    }

    /** @test */
    public function can_get_category_type_by_id()
    {
        $categoryType = CategoryType::factory()->create();

        $response = $this->get('/api/category-types/'.$categoryType->id);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'status' => 'success',
            'message' => 'Categoria de consumo',
            'data' => [
                'id' => $categoryType->id,
                'category' => [
                    'id' => $categoryType->category->id,
                    'name' => $categoryType->category->name,
                    'description' => $categoryType->category->description,
                ],
                'type' => [
                    'id' => $categoryType->type->id,
                    'name' => $categoryType->type->name,
                    'description' => $categoryType->type->description,
                    'unit' => $categoryType->type->unit,
                    'unit_abbreviation' => $categoryType->type->unit_abbreviation,
                ],
            ],
        ]);
    }

    /** @test */
    public function can_update_category_type()
    {
        $categoryType = CategoryType::factory()->create();

        $category = Category::factory()->create();
        $type = Type::factory()->create();

        $categoryTypeData = [
            'category_id' => $category->id,
            'type_id' => $type->id,
        ];

        $response = $this->put('/api/category-types/'.$categoryType->id, $categoryTypeData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('category_types', $categoryTypeData);
    }

    /** @test */
    public function can_delete_category_type()
    {
        $categoryType = CategoryType::factory()->create();

        $response = $this->delete('/api/category-types/'.$categoryType->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('category_types', ['id' => $categoryType->id, 'deleted_at' => null]);
    }
}
