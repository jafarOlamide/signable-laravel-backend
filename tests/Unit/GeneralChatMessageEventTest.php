<?php

namespace Tests\Unit;

use App\Events\GeneralChatMessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\TestCase;

class GeneralChatMessageEventTest extends TestCase
{

    private $message;

    private GeneralChatMessageSent $event;

    protected function setUp(): void
    {
        parent::setUp();

        $this->message = new Message();
        $this->event = new GeneralChatMessageSent($this->message);
    }

    public function test_constructor_sets_message_model_as_property()
    {
        $this->assertSame($this->message, $this->event->message);
    }

    public function test_broadcast_on_returns_correct_channel_route()
    {
        $channels = $this->event->broadcastOn();

        $this->assertIsArray($channels);
        $this->assertCount(1, $channels);
        $this->assertInstanceOf(PrivateChannel::class, $channels[0]);
        $this->assertEquals('private-generalchat', $channels[0]->name);
    }
}
