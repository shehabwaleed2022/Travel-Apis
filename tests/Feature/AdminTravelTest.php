<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\Travel;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Tests\TestCase;

class AdminTravelTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    private User $user;
    private Travel $travel;

    protected function setUp():void{
        parent::setUp();

        $this->user = User::factory()->create();
        $this->travel = Travel::factory()->create();
    }

    public function test_public_user_cannot_access_adding_travel(): void
    {
        $response = $this->postJson('/api/v1/admin/travels');

        $response->assertStatus(401);
    }

    public function test_non_admin_user_cannot_access_adding_travel(): void
    {
        $this->seed(RoleSeeder::class);

        $this->user->roles()->attach(Role::where('name', 'editor')->value('id'));

        $response = $this->actingAs($this->user)->postJson('api/v1/admin/travels');
        $response->assertStatus(403);
    }

    public function test_admin_can_adding_travel()
    {
        $this->seed(RoleSeeder::class);

        $this->user->roles()->attach(Role::where('name', 'admin')->value('id'));

        $response = $this->actingAs($this->user)->postJson('api/v1/admin/travels', [
            'is_public' => true,
            'name' => 'test',
            'description' => 'test',
            'num_of_days' => 3,
        ]);

        $response->assertStatus(201);
    }

    public function test_updating_travel_data_successfully()
    {
        $this->seed(RoleSeeder::class);

        $this->user->roles()->attach(Role::where('name', 'editor')->value('id'));

        $response = $this->actingAs($this->user)->postJson('api/v1/admin/travels/'.$this->travel->slug, [
            '_method' => 'patch',
            'name' => 'name after update',
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'name after update']);
    }
}
