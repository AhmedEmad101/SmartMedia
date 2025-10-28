<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Auth\loginAction;
use App\Http\Requests\LoginRequest;
class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginAction $loginAction)
    {
        $data = $request->validated();
        $token = $loginAction->execute($data['email'], $data['password']);
        return response()->json([
            'message' => 'Login successful!',
            'token' => $token,
        ]);
    }
}
