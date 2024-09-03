<?php


namespace App\Traits;

trait AuthenticatesUser
{

    public function createAuthToken($request)
    {
        $token = $request->user()->createToken('apiToken')->plainTextToken;

        return $token;
    }
}
