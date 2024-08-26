<?php

namespace App\Interfaces;

interface MessageRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function find($id);
}
