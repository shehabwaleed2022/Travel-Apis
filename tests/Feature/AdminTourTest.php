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
    private User $user;

    private Travel $travel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(RoleSeeder::class);
        $this->user = User::factory()->create();
        $this->travel = Travel::factory()->create();
    }

    public function test_public_user_cannot_add_tour(): void
    {
        $response = $this->postJson('/api/v1/admin/travels/'.$this->travel->slug.'/tours');

        $response->assertStatus(401);
    }

    public function test_non_admin_cannot_add_tour(): void
    {
        $this->user->roles()->attach(Role::where('name', 'editor')->value('id'));

        $response = $this->actingAs($this->user)->postJson('/api/v1/admin/travels/'.$this->travel->slug.'/tours');

        $response->assertStatus(403);
    }

    public function test_admin_can_add_tour(): void
    {
        $this->user->roles()->attach(Role::where('name', 'admin')->value('id'));

        $response = $this->actingAs($this->user)->postJson('/api/v1/admin/travels/'.$this->travel->slug.'/tours', [
            'name' => 'test',
            'starting_date' => '2023-3-3',
            'ending_date' => '2023-3-5',
            'price' => 200,
        ]);

        $response->assertStatus(201);
    }
}
