<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(private UserRepository $userRepository) {}

    public function signup(array $data): User
    {
        return $this->userRepository->createUser($data);
    }

    public function signin(array $data)
    {
        $user = $this->userRepository->findByEmail($data['email']);

        if (!$user?->password || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciais inválidas.'],
            ]);
        }

        $user->tokens()->delete();
        return $user->createToken('auth_token')->plainTextToken;
    }
}
