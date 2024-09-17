<?php

namespace App\Http\Controllers;

use App\Events\GeneralChatMessageSent;
use App\Events\MessageSent;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Resources\MessagesResource;
use App\Interfaces\MessageRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    protected $messageRepository;
    protected $userRepository;

    public function __construct(MessageRepositoryInterface $messageRepository)
    {

        $this->messageRepository = $messageRepository;
    }

    /**
     * Return a listing of the resource.
     */
    public function index()
    {
        $messages = $this->messageRepository->generalChatMessages();

        return response()->json(MessagesResource::collection($messages));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        $sender_id = Auth::id();

        $stored_message = $this->messageRepository->create(['sender_id' => $sender_id, 'message' => $request->message]);

        $loaded_message = $stored_message->load('sender');

        // broadcast(new MessageSent($loaded_message));
        broadcast(new GeneralChatMessageSent($loaded_message));


        return response()->noContent();
    }
}
