<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService)
    {
    }

    public function signup(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = $this->authService->signup($validated);

        return response()->json([
            'access_token' => $user->createToken('auth_token')->plainTextToken,
            'token_type' => 'Bearer',
        ], 201);
    }

    public function signin(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $token = $this->authService->signin($validated);

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user());
    }

    public function signout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Usuário deslogado com sucesso.']);
    }
}

