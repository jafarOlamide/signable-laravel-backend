<?php

namespace Tests\Feature;

use App\Events\GeneralChatMessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class GeneralChatMessagesTest extends TestCase
{

    use RefreshDatabase;

    private $message;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake([
            GeneralChatMessageSent::class
        ]);


        User::factory()->create();
        $this->message = Message::factory()->create();
    }

    public function test_message_sent_on_general_chat_is_dispatched(): void
    {
        event(new GeneralChatMessageSent($this->message));

        Event::assertDispatched(GeneralChatMessageSent::class);
    }

    public function test_new_message_notification_event_broadcasted()
    {
        event(new GeneralChatMessageSent($this->message));

        Event::assertDispatched(GeneralChatMessageSent::class, function ($event) {
            $channels = $event->broadcastOn();

            $channel_names = array_map(fn($channel): string => $channel->name, $channels);

            return in_array('private-generalchat', $channel_names);
        });
    }
}
