<?php

namespace Tests\Unit;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    private AuthService $authService;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->authService = new AuthService($this->userRepository);
    }

    public function test_signup_creates_user()
    {
        $userData = ['name' => 'Test User', 'email' => 'test@example.com', 'password' => 'password'];
        $mockUser = new User($userData);
        $mockUser->password = Hash::make($userData['password']);

        $this->userRepository->method('createUser')->willReturn($mockUser);

        $user = $this->authService->signup($userData);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['email'], $user->email);
    }

    public function test_signin_invalid_credentials()
    {
        $this->userRepository->method('findByEmail')->willReturn(null);

        $this->expectException(ValidationException::class);

        $this->authService->signin(['email' => 'test@example.com', 'password' => 'wrongpassword']);
    }
}
