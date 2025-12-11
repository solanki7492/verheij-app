<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

Class LoginController extends Controller
{
    /**
     * Handle the login request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $data = request()->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($data)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        // Revoke existing tokens if using Sanctum/Passport (optional)
        if (method_exists($user, 'tokens')) {
            $user->tokens()->delete();
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }
}