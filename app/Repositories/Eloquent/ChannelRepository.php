<?php

namespace App\Repositories\Eloquent;

use App\Interfaces\ChannelRepositoryInterface;
use App\Models\Channel;
use App\Models\Message;

class  ChannelRepository implements ChannelRepositoryInterface
{
    private $model;

    public function __construct(Channel $model, Message $messageModel)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function messages($id)
    {
        return Message::where('channel_id', $id)->with('sender')->orderBy('created_at', 'ASC')->get();
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
