<?php

namespace Tests\Feature;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListTravelToursTest extends TestCase
{
    use RefreshDatabase;

    public function test_tours_list_correctly_for_travel_slug(): void
    {
        $travel = Travel::factory()->create();
        $tours = Tour::factory(15)->create(['travel_id' => $travel->id]);

        $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours');

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $tours->first()->id]);
        $response->assertJsonCount(15, 'data');
        $response->assertJsonFragment(['travel_id' => $travel->id]);
    }

    public function test_tours_list_filters(): void
    {
        $travel = Travel::factory()->create();
        $tourWithPrice120 = Tour::factory()->create([
            'travel_id' => $travel->id,
            'price' => 120 * 100,
        ]);
        $tourWithPrice400 = Tour::factory()->create([
            'travel_id' => $travel->id,
            'price' => 400 * 100,
        ]);

        // Test price filter
        $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours?priceFrom=110&priceTo=300');
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['id' => $tourWithPrice120->id]);

        $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours?priceFrom=150&priceTo=500');
        $response->assertStatus(200);
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['id' => $tourWithPrice400->id]);
        // Test date filter

    }

    // Test ordering filter
}
