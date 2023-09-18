<?php

use App\Models\Tour;
use App\Models\Travel;


test('tours list correctly for travel slug', function () {
    $travel = Travel::factory()->create();
        $tours = Tour::factory(15)->create(['travel_id' => $travel->id]);

        $this->get('/api/v1/travels/'.$travel->slug.'/tours')
        ->assertStatus(200)
        ->assertJsonFragment(['id' => $tours->first()->id])
        ->assertJsonCount(15, 'data')
        ->assertJsonFragment(['travel_id' => $travel->id]);
});


test('tours list filters works correctly', function(){
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
    $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours?priceFrom=110&priceTo=300')
    ->assertStatus(200)
    ->assertJsonCount(1, 'data')
    ->assertJsonFragment(['id' => $tourWithPrice120->id]);

    $response = $this->get('/api/v1/travels/'.$travel->slug.'/tours?priceFrom=150&priceTo=500')
    ->assertStatus(200)
    ->assertJsonCount(1, 'data')
    ->assertJsonFragment(['id' => $tourWithPrice400->id]);
});
