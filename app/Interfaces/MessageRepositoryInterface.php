<?php

namespace App\Interfaces;

interface MessageRepositoryInterface
{
    public function create(array $data);

    public function find($id);

    public function generalChatMessages();
}
