<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProtectedRoutesTest extends TestCase
{
    /** @test */
    public function cant_logout()
    {
        $response = $this->post('/api/logout');

        $response->assertStatus(401);
    }

    /** @test */
    public function can_get_categories()
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(200);

        $response = $this->get('/api/categories', [
            'Authorization' => 'Bearer ' . $response->json('token'),
        ]);

        $response->assertStatus(200);
    }
}
