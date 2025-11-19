<?php

namespace App\Http\Controllers\Api;

use App\Actions\Auth\loginAction;
use App\Actions\Auth\logoutAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginAction $loginAction)
    {
        $data = $request->validated();
        $token = $loginAction->execute($data['email'], $data['password']);

        return response()->json([
            'message' => 'Login successful!',
            'token' => $token,
            'user' => auth()->user(),
        ]);
    }

    public function logout(Request $request)
    {
        (new logoutAction)->execute($request);

        return response()->json(['message' => 'Logged out successfully']);
    }
}
