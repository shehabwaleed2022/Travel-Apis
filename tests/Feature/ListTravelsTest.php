<?php

use App\Models\Travel;


test('Travels listed successfully', function () {
    Travel::factory(20)->create(['is_public' => true]);
    Travel::factory(1)->create(['is_public' => false]);

    $this->get('api/v1/travels/public')
    ->assertStatus(200)
    ->assertJsonCount(20, 'data');
});
