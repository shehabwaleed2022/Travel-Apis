<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_failed_login(): void
    {
        $user = User::create([
            'name' => 'shehab',
            'email' => 'shehab@gmail.com',
            'password' => 'shehab',
        ]);

        $response = $this->post('/api/v1/login', [
            'email' => $user->email,
            'password' => 'wrongPassword',
        ]);

        $response->assertStatus(422);
    }

    public function test_success_login(): void
    {
        $user = User::create([
            'name' => 'shehab',
            'email' => 'shehab@gmail.com',
            'password' => 'shehab',
        ]);

        $response = $this->post('/api/v1/login', [
            'email' => $user->email,
            'password' => 'shehab',
        ]);

        $response->assertStatus(200);
    }
}
