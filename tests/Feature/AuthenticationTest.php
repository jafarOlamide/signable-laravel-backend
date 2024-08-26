<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function unauthenticated_users_cannot_access_protected_route()
    {
        $response = $this->getJson(route('messages.index'));

        $response->assertStatus(401);
    }

    public function authenticated_users_can_access_protected_route()
    {
        // Create a user
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user, 'sanctum');

        $response = $this->getJson(route('messages.index'));

        $response->assertStatus(204);
    }
}
