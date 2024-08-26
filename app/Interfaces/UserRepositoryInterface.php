<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function find($id);
}
