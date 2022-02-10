<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends ApiController
{
    public function login(LoginRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->respondNotFound('Invalid Credentails');
         }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('User-Token')->plainTextToken
        ]);
    }
}
