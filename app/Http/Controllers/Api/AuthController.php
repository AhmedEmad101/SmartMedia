<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Auth\loginAction;

class AuthController extends Controller
{
    public function login(Request $request, LoginAction $loginAction)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $token = $loginAction->execute($data['email'], $data['password']);

        return response()->json([
            'message' => 'Login successful!',
            'token' => $token,
        ]);
    }
}
