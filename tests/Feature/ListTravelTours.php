<?php

namespace Tests\Feature;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListTravelTours extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_tours_list_correctly_for_travel_slug(): void
    {
        $travel = Travel::factory()->create();
        $tours = Tour::factory(15)->create(['travel_id' => $travel->id]);

        $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours');

        $response->assertJsonFragment(['id' => $tours->id]);
        $response->assertJsonCount(15, 'data');
        $response->assertJsonFragment(['travel_id' => $travel->id]);
        $response->assertStatus(200);
    }
}
