<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'email' => 'shehab@gmail.com',
            'password' => bcrypt('shehab')
        ]);
    }

    public function test_failed_login(): void
    {

        $response = $this->post('/api/v1/login', [
            'email' => $this->user->email,
            'password' => 'wrongPassword',
        ]);

        $response->assertStatus(422);
    }

    public function test_success_login(): void
    {

        $response = $this->post('/api/v1/login', [
            'email' => $this->user->email,
            'password' => 'shehab',
        ]);

        $response->assertStatus(200);
    }
}
