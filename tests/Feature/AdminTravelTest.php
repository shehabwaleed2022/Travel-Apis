<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Tests\TestCase;

class AdminTravelTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_public_user_cannot_access_adding_travel(): void
    {
        $response = $this->postJson('/api/v1/admin/travels');

        $response->assertStatus(401);
    }

    public function test_non_admin_user_cannot_access_adding_travel(): void
    {
        $this->seed(RoleSeeder::class);
        $user = User::create([
            'name' => 'shehab',
            'email' => 'shehab@gmail.com',
            'password' => 'shehab',
        ]);
        $user->roles()->attach(Role::where('name', 'editor')->value('id'));

        $response = $this->actingAs($user)->postJson('api/v1/admin/travels');
        $response->assertStatus(403);
    }

    public function test_admin_can_adding_travel()
    {
        $this->seed(RoleSeeder::class);
        $user = User::create([
            'name' => 'shehab2',
            'email' => 'shehab2@gmail.com',
            'password' => 'shehab',
        ]);
        $user->roles()->attach(Role::where('name', 'admin')->value('id'));

        $response = $this->actingAs($user)->postJson('api/v1/admin/travels',[
            'is_public' => true,
            'name' => 'test',
            'description' => 'test',
            'num_of_days' => 3
        ]);

        $response->assertStatus(201);
    }
}
