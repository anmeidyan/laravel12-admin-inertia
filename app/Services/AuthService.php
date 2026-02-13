<?php

namespace App\Services;

use App\Services\Interfaces\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    public function register(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }

    public function login(array $credentials, bool $remember = false): bool
    {
        if(Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'is_active' => true
        ], $remember)){
            request()->session()->regenerate();
            return true;
        }
        return false;
    }

    public function logout($request): void
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}