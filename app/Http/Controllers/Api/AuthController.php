<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Actions\Auth\loginAction;
use App\Http\Requests\LoginRequest;
use App\Actions\Auth\logoutAction;
class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginAction $loginAction)
    {
        $data = $request->validated();
        $token = $loginAction->execute($data['email'], $data['password']);
        return response()->json([
            'message' => 'Login successful!',
            'token' => $token,
            'user' => auth()->user()
        ]);
    }
      public function logout(Request $request)
    {
        (new logoutAction())->execute($request);

        return response()->json(['message' => 'Logged out successfully']);
    }
}
