<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListTravelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_travel_retireved_successfully(): void
    {
        Travel::factory(20)->create(['is_public' => true]);
        Travel::factory(1)->create(['is_public' => false]);

        $response = $this->get('api/v1/travels/public');

        $response->assertStatus(200);
        $response->assertJsonCount(20, 'data');
    }
}
