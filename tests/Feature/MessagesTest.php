<?php

namespace Tests\Feature;

use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class MessagesTest extends TestCase
{
    use RefreshDatabase;


    public function test_list_of_general_chat_messages_are_returned(): void
    {
        //Get Authentication Token for user to access protected route
        Sanctum::actingAs(
            User::factory()->create(),
        );

        $response = $this->get(route('messages.index'));

        //Create random user and messages
        User::factory()->count(3)->create();
        Message::factory()->count(5)->create();

        $response->assertJsonStructure([
            '*' => [
                'id',
                'message',
                'sender' => [
                    'id',
                    'username',
                ],
                'created_at',
            ],
        ]);
    }
}
