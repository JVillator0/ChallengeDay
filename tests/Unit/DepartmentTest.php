<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepartmentTest extends TestCase
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
    public function can_get_all_departments()
    {
        Department::factory()->count(3)->create();

        $response = $this->get('/api/departments');

        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }

    /** @test */
    public function can_create_department()
    {
        $departmentData = [
            'name' => 'Test department',
            'description' => 'Test department description',
        ];

        $response = $this->post('/api/departments', $departmentData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('departments', $departmentData);
    }

    /** @test */
    public function can_get_department_by_id()
    {
        $department = Department::factory()->create();

        $response = $this->get('/api/departments/'.$department->id);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $department->name,
            'description' => $department->description,
        ]);
    }

    /** @test */
    public function can_update_department()
    {
        $department = Department::factory()->create();

        $departmentData = [
            'name' => 'Updated name',
            'description' => 'Updated description',
        ];

        $response = $this->put('/api/departments/'.$department->id, $departmentData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('departments', $departmentData);
    }

    /** @test */
    public function can_delete_department()
    {
        $department = Department::factory()->create();

        $response = $this->delete('/api/departments/'.$department->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }
}
