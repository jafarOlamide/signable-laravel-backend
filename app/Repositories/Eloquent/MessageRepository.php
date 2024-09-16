<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\MessageRepositoryInterface;
use App\Models\Message;

class MessageRepository implements MessageRepositoryInterface
{
    private $model;

    public function __construct(Message $model)
    {
        $this->model = $model;
    }

    public function generalChatMessages()
    {
        return Message::where('channel_id', null)->with('sender')->orderBy('created_at', 'ASC')->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }
}
