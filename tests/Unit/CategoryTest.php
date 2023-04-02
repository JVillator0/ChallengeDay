<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_all_categories()
    {
        Category::factory()->count(3)->create();

        $response = $this->get('/api/categories');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /** @test */
    public function can_create_category()
    {
        $categoryData = [
            'name' => 'Test category',
            'description' => 'Test category description',
        ];

        $response = $this->post('/api/categories', $categoryData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', $categoryData);
    }

    /** @test */
    public function can_get_category_by_id()
    {
        $category = Category::factory()->create();

        $response = $this->get('/api/categories/'.$category->id);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $category->name,
            'description' => $category->description,
        ]);
    }

    /** @test */
    public function can_update_category()
    {
        $category = Category::factory()->create();

        $categoryData = [
            'name' => 'Updated name',
            'description' => 'Updated description',
        ];

        $response = $this->put('/api/categories/'.$category->id, $categoryData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', $categoryData);
    }

    /** @test */
    public function can_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->delete('/api/categories/'.$category->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
