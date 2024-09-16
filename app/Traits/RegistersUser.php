<?php


namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait RegistersUser
{

    protected function create(array $data)
    {
        return User::create([
            'username' => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
        ]);
    }
}
