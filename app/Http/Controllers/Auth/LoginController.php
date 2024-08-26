<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'message' => ['Incorrect username or password'],
            ]);
        }

        $token = $request->user()->createToken('apiToken')->plainTextToken;

        $user = Auth::user();
        return response()->json(['user' => $user, 'token' => $token]);
    }
}
