<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreChannelRequest;
use App\Http\Requests\UpdateChannelRequest;
use App\Http\Resources\MessagesResource;
use App\Interfaces\ChannelRepositoryInterface;
use App\Models\Channel;

class ChannelController extends Controller
{
    protected $channelRepository;

    public function __construct(ChannelRepositoryInterface $channelRepository)
    {
        $this->channelRepository = $channelRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $channels =  $this->channelRepository->all();

        return response()->json(['data' => $channels]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChannelRequest $request)
    {
        //
    }

    public function messages(Channel $channel)
    {
        $messages = $this->channelRepository->messages($channel->id);

        return response()->json(MessagesResource::collection($messages));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Channel $channel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChannelRequest $request, Channel $channel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Channel $channel)
    {
        //
    }
}
