<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Traits\AuthenticatesUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUser;

    public function __invoke(LoginRequest $request)
    {
        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'message' => ['Incorrect username or password'],
            ]);
        }

        $token = $this->createAuthToken($request);

        $user = Auth::user();
        return response()->json(['user' => $user, 'token' => $token]);
    }
}
