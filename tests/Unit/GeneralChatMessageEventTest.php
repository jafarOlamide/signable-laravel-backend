<?php

namespace Tests\Unit;

use App\Events\GeneralChatMessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use PHPUnit\Framework\TestCase;

class GeneralChatMessageEventTest extends TestCase
{
    public function test_constructor_sets_message_model_as_property()
    {
        $message = new Message();
        $event = new GeneralChatMessageSent($message);

        $this->assertSame($message, $event->message);
    }

    public function test_broadcast_on_returns_correct_channel_route()
    {
        $message = new Message();
        $event = new GeneralChatMessageSent($message);

        $channels = $event->broadcastOn();

        $this->assertIsArray($channels);
        $this->assertCount(1, $channels);
        $this->assertInstanceOf(PrivateChannel::class, $channels[0]);
        $this->assertEquals('private-generalchat', $channels[0]->name);
    }
}
