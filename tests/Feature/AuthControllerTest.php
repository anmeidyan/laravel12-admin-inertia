<?php

namespace Tests\Feature;

use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_post()
    {
        $user = User::factory()->make([
            'name' => 'user',
            'email' => 'user@example.com',
        ]);

        $this->mock(AuthServiceInterface::class, function ($mock) use ($user) {
            $mock->shouldReceive('register')
                    ->once()
                    ->andReturn($user);
        });

        $response = $this->post(route('admin.registerPost'),[
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => 'password123',
            'password_confirm' => 'password123',
        ]);

        $response->assertRedirect(route('admin.login'));
    }

    public function test_login_post()
    {
        $this->mock(AuthServiceInterface::class, function ($mock) {
            $mock->shouldReceive('login')
                    ->once()
                    ->andReturn(true);
        });

        $response = $this->post(route('admin.loginPost'),[
            'email' => 'user@example.com',
            'password' => 'password123',
            'status' => 1,
        ]);

        $response->assertRedirect(route('admin.dashboard'));
    }
}
