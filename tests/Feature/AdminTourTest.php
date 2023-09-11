<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Travel;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Tests\TestCase;

class AdminTourTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_public_user_cannot_add_tour(): void
    {
        $travel = Travel::factory()->create();

        $response = $this->postJson('/api/v1/admin/travels/'.$travel->slug.'/tours');

        $response->assertStatus(401);
    }

    public function test_non_admin_cannot_add_tour(): void
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', 'editor')->value('id'));

        $travel = Travel::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/admin/travels/'.$travel->slug.'/tours');

        $response->assertStatus(403);
    }

    public function test_admin_can_add_tour(): void
    {
        $this->seed(RoleSeeder::class);
        $user = User::factory()->create();
        $user->roles()->attach(Role::where('name', 'admin')->value('id'));

        $travel = Travel::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/v1/admin/travels/'.$travel->slug.'/tours',[
            'name' => 'test',
            'starting_date' => '2023-3-3',
            'ending_date' => '2023-3-5',
            'price' => 200
        ]);

        $response->assertStatus(201);
    }
}
