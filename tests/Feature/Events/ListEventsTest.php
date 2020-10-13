<?php

use App\Models\Event;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function () {
   Event::factory()->count(10)->create();
   Event::factory()->state(['name' => 'Bar Night Deluxe XXL'])->create();
});

test('a guest cannot see the events', function () {
    get(route('events'))
        ->assertRedirect(route('login'));
});

test('a user can see the events', function () {
    actingAs(User::factory()->create());

    get(route('events'))
        ->assertSuccessful()
        ->assertSee('Bar Night Deluxe XXL');
});
