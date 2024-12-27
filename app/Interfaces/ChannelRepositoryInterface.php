<?php

namespace App\Interfaces;

interface ChannelRepositoryInterface
{
    public function create(array $data);

    public function find($id);

    public function messages($id);

    public function all();
}
