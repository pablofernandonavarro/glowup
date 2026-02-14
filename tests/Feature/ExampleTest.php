<?php

use App\Models\User;

test('returns a successful response', function () {
    $this->actingAs(User::factory()->create());

    $response = $this->get('/');

    $response->assertStatus(200);
});
