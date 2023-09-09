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

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $tours->id]);
        $response->assertJsonCount(15, 'data');
        $response->assertJsonFragment(['travel_id' => $travel->id]);
    }

    public function test_tours_list_filters(): void
    {
        $travel = Travel::factory()->create();
        $tourWithPrice120 = Tour::factory()->create([
            'travel_id' => $travel->id,
            'price' => 120,
        ]);
        $tourWithPrice400 = Tour::factory()->create([
            'travel_id' => $travel->id,
            'price' => 400,
        ]);

        // Test price filter
        $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours?priceFrom=110');
        $response->assertStatus(200);
        $response->assertJsonCount(1,'data');
        $response->assertJsonFragment(['id' => $tourWithPrice120->id]);

        $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours?priceFrom=150');
        $response->assertStatus(200);
        $response->assertJsonCount(1,'data');
        $response->assertJsonFragment(['id' => $tourWithPrice120->id]);
        // Test date filter

    }

    // Test ordering filter
}
