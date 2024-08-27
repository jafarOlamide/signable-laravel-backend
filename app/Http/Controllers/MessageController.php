<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\StoreMessageRequest;
use App\Interfaces\MessageRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    protected $messageRepository;
    protected $userRepository;

    public function __construct(MessageRepositoryInterface $messageRepository, UserRepositoryInterface $userRepository)
    {

        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Return a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->messageRepository->all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {

        $sender_id = Auth::id();

        $stored_message = $this->messageRepository->create(['sender_id' => $sender_id, 'message' => $request->message]);

        $loaded_message = $stored_message->load('sender');

        Log::info($request->message);

        broadcast(new MessageSent($loaded_message));

        return response()->noContent();
    }
}
